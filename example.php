<?php

require 'vendor/autoload.php';

use makao\LPSolve\Constraint;
use makao\LPSolve\Problem;
use makao\LPSolve\Solver;
use makao\LPSolve\Solution;

// Example 1
$constraints = [
    Constraint::fromString('0a + 78.26b + 0c + 2.9d >= 92.3'),
    Constraint::fromString('0.24a + 0b + 11.31c + 0d <= 14.8'),
    Constraint::fromString('12.68a + 0b + 0.08c + 0.9d >= 4'),
];

$problem = new Problem([1, 3, 6.24, 0.1], $constraints, [28.6, 0, 0, 18], [Infinite, Infinite, Infinite, 48.98]);

$solver = new Solver(Solver::MIN);
$solution = $solver->solve($problem);

var_dump($solution);

// Example 2
$constraints = [
    Constraint::fromString('120x + 210y + 150.75z <= 15000'),
    Constraint::fromString('110x + 30y + 125z <= 4000'),
    Constraint::fromString('1x + 1y + 1z <= 75'),
];

$problem = new Problem([143, 60, 195], $constraints);

$solver = new Solver(Solver::MAX);
$solution = $solver->solve($problem);

var_dump($solution);

// Example 3: infeasible, no solutions
$constraints = [
    Constraint::fromString('1x + 1y = 20'),
    Constraint::fromString('0x + 1y <= 5'),
    Constraint::fromString('1x + 0y <= 5'),
];

$problem = new Problem([10, 10], $constraints);

$solver = new Solver(Solver::MIN);
$solution = $solver->solve($problem);

var_dump($solution);
