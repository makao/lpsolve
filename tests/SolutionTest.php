<?php

namespace makao\LPSolve\Tests;

use makao\LPSolve\Solution;

class SolutionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider solutions
     */
    public function testSolutionObjectConstructor($objective, $count, $variables, $code, $status)
    {
        $solution = new Solution($objective, $count, $variables, $code, $status);

        $this->assertEquals($solution->getObjective(), $objective);
        $this->assertEquals($solution->getCount(), $count);
        $this->assertEquals($solution->getVariables(), $variables);
        $this->assertEquals($solution->getCode(), $code);
        $this->assertEquals($solution->getStatus(), $status);
    }

    public function solutions()
    {
        return [
            [31.78275862069, 1, [28.6, 0, 0, 31.827586206897], 0, 'OPTIMAL solution'],
            [6986.8421052632, 1, [0, 56.578947368421, 18.421052631579], 0, 'OPTIMAL solution'],
            [1.7272337110189E-77, 0, [0, 0], 2, 'Model is primal INFEASIBLE'],
        ];
    }
}
