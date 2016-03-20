<?php

namespace makao\LPSolve;

class Problem
{
    private $objective = [];
    private $constraints = [];
    private $upperBounds = [];
    private $lowerBounds = [];

    /**
     * Constructor
     *
     * @param array $objective   Array of objective coefficients
     * @param array $constraints Array of Constraint objects
     * @param array $lowerBounds Array of lower bounds coefficients
     * @param array $upperBounds Array of upper bounds coefficients
     */
    public function __construct(
        array $objective = [],
        array $constraints = [],
        array $lowerBounds = [],
        array $upperBounds = []
    ) {
        $this->objective = $objective;
        $this->constraints = $constraints;
        $this->lowerBounds = $lowerBounds;
        $this->upperBounds = $upperBounds;
    }

    public function getObjective()
    {
        return $this->objective;
    }

    public function setObjective(array $objective)
    {
        $this->objective = $objective;

        return $this;
    }

    public function getConstraints()
    {
        return $this->constraints;
    }

    public function setConstraints(array $constraints)
    {
        $this->constraints = $constraints;

        return $this;
    }

    public function addConstraint(Constraint $constraint)
    {
        $this->constraints[] = $constraint;

        return $this;
    }

    public function getLowerBounds()
    {
        return $this->lowerBounds;
    }

    public function setLowerBounds($lowerBounds)
    {
        $this->lowerBounds = $lowerBounds;

        return $this;
    }

    public function getUpperBounds()
    {
        return $this->upperBounds;
    }

    public function setUpperBounds($upperBounds)
    {
        $this->upperBounds = $upperBounds;

        return $this;
    }

    /**
     * Helper method for make_lp
     *
     * @return int
     */
    public function countRows()
    {
        return count($this->constraints);
    }

    /**
     * Helper method for make_lp
     *
     * @return int
     */
    public function countCols()
    {
        return count($this->objective);
    }
}
