<?php

namespace makao\LPSolve\Tests;

use makao\LPSolve\Constraint;

class ConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider constraints
     */
    public function testConstraintFromString($string, $coefficients, $comparison, $value)
    {
        $constraint = Constraint::fromString($string);
        $this->assertEquals($constraint, new Constraint($coefficients, $comparison, $value));
        $this->assertEquals($constraint->getCoefficients(), $coefficients);
        $this->assertEquals($constraint->getComparison(), $comparison);
        $this->assertEquals($constraint->getValue(), $value);
    }

    /**
     * @dataProvider constraints
     */
    public function testConstraintAccessors($string, $coefficients, $comparison, $value)
    {
        $constraint = new Constraint();
        $constraint
            ->setCoefficients($coefficients)
            ->setComparison($comparison)
            ->setValue($value)
        ;

        $this->assertEquals($constraint->getCoefficients(), $coefficients);
        $this->assertEquals($constraint->getComparison(), $comparison);
        $this->assertEquals($constraint->getValue(), $value);
    }

    public function constraints()
    {
        return [
            ['0a + 78.26b + 0c + 2.9d >= 92.3', [0, 78.26, 0, 2.9], GE, 92.3],
            ['0.24a + 0b + 11.31c + 0d <= 14.8', [0.24, 0, 11.31, 0], LE, 14.8],
            ['12.68a + 0b + 0.08c + 0.9d >= 4', [12.68, 0, 0.08, 0.9], GE, 4],
            ['120x + 210y + 150.75z <= 15000', [120, 210, 150.75], LE, 15000],
            ['110x + 30y + 125z <= 4000', [110, 30, 125], LE, 4000],
            ['1x + 1y + 1z <= 75', [1, 1, 1], LE, 75],
            ['10x + 2y + 3z = 40', [10, 2, 3], EQ, 40],
        ];
    }
}
