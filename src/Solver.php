<?php

namespace makao\LPSolve;

class Solver
{
    const MIN = 'set_minim';
    const MAX = 'set_maxim';

    private $type;
    private $scaling;
    private $verbose = IMPORTANT;

    /**
     * Constructor
     *
     * @param string $type Type of optimalization (minimize or maximize)
     */
    public function __construct($type = null)
    {
        if (!function_exists('lpsolve')) {
            throw new \Exception('Extension lpsolve not found');
        }

        $this->type = $type ?: self::MIN;

        if ($this->type !== self::MIN && $this->type !== self::MAX) {
            throw new \Exception('Objective function must be minimized or maximized');
        }
    }

    /**
     * Set scaling option
     *
     * @param string $scaling Flag
     * @link http://lpsolve.sourceforge.net/5.5/set_scaling.htm
     */
    public function setScaling($scaling)
    {
        $this->scaling = $scaling;

        return $this;
    }

    /**
     * Set verbose, available flags: NEUTRAL, CRITICAL, SEVERE, IMPORTANT, NORMAL, DETAILED, FULL
     *
     * @param int $verbose Flag
     * @link http://lpsolve.sourceforge.net/5.5/set_verbose.htm
     */
    public function setVerbose($verbose)
    {
        $this->verbose = $verbose;

        return $this;
    }

    /**
     * Solve problem
     *
     * @param  Problem  $problem Defined problem
     * @return Solution
     */
    public function solve(Problem $problem)
    {
        $lpsolve = lpsolve('make_lp', 0, $problem->countCols());
        lpsolve('set_verbose', $lpsolve, $this->verbose);
        lpsolve('set_obj_fn', $lpsolve, $problem->getObjective());

        foreach ($problem->getConstraints() as $constraint) {
            lpsolve(
                'add_constraint',
                $lpsolve,
                $constraint->getCoefficients(),
                $constraint->getComparison(),
                $constraint->getValue()
            );
        }
        lpsolve($this->type, $lpsolve);

        if ($problem->getLowerBounds()) {
            lpsolve('set_lowbo', $lpsolve, $problem->getLowerBounds());
        }

        if ($problem->getUpperBounds()) {
            lpsolve('set_upbo', $lpsolve, $problem->getUpperBounds());
        }

        if ($this->scaling) {
            lpsolve('set_scaling', $lpsolve, $this->scaling);
        }

        // Solve
        lpsolve('solve', $lpsolve);
        $statusCode = lpsolve('get_status', $lpsolve);
        $solution = new Solution(
            lpsolve('get_working_objective', $lpsolve),
            lpsolve('get_solutioncount', $lpsolve),
            lpsolve('get_variables', $lpsolve)[0],
            $statusCode,
            lpsolve('get_statustext', $lpsolve, $statusCode)
        );

        lpsolve('delete_lp', $lpsolve);

        return $solution;
    }
}
