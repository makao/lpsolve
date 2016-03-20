<?php

namespace makao\LPSolve\Tests;

use makao\LPSolve\Problem;
use makao\LPSolve\Constraint;

class ProblemTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider problems
     */
    public function testProblemConstructor($objective, $constraints, $lowerBounds, $upperBounds)
    {
        $problem = new Problem($objective, $constraints, $lowerBounds, $upperBounds);

        $this->assertEquals($problem->getObjective(), $objective);
        $this->assertEquals($problem->getConstraints(), $constraints);
        $this->assertEquals($problem->getLowerBounds(), $lowerBounds);
        $this->assertEquals($problem->getUpperBounds(), $upperBounds);
        $this->assertEquals($problem->countRows(), count($constraints));
        $this->assertEquals($problem->countCols(), count($objective));
    }

    /**
     * @dataProvider problems
     */
    public function testProblemAccessors($objective, $constraints, $lowerBounds, $upperBounds)
    {
        $problem = new Problem();

        $problem
            ->setObjective($objective)
            ->setConstraints($constraints)
            ->setLowerBounds($lowerBounds)
            ->setUpperBounds($upperBounds)
        ;

        $this->assertEquals($problem->getObjective(), $objective);
        $this->assertEquals($problem->getConstraints(), $constraints);
        $this->assertEquals($problem->getLowerBounds(), $lowerBounds);
        $this->assertEquals($problem->getUpperBounds(), $upperBounds);
        $this->assertEquals($problem->countRows(), count($constraints));
        $this->assertEquals($problem->countCols(), count($objective));

        $testConstraint = new Constraint();
        $constraints[] = $testConstraint;

        $problem->addConstraint($testConstraint);

        $this->assertEquals($problem->getConstraints(), $constraints);
        $this->assertEquals($problem->countRows(), count($constraints));
    }

    public function problems()
    {
        return [
            [
                [1, 3, 6.24, 0.1],
                [
                    new Constraint([0, 78.26, 0, 2.9], GE, 92.3),
                    new Constraint([0.24, 0, 11.31, 0], LE, 14.8),
                    new Constraint([12.68, 0, 0.08, 0.9], GE, 4),
                ],
                [28.6, 0, 0, 18],
                [Infinite, Infinite, Infinite, 48.98],
            ],
            [
                [143, 60, 195],
                [
                    new Constraint([120, 210, 150.75], LE, 15000),
                    new Constraint([110, 30, 125], LE, 4000),
                    new Constraint([1, 1, 1], LE, 75),
                ],
                [],
                [],
            ],
        ];
    }
}
