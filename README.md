# LPSolve
[LPSolve](http://lpsolve.sourceforge.net) is a PHP extension for solving linear programming problems. This library provides a wrapper for standard lpsolve() function.

## Installation
Run composer
```
composer require makao/lpsolve
```
Require autoloader
```php
require 'vendor/autoload.php'
```

## Usage
```php
use makao\LPSolve\Constraint;
use makao\LPSolve\Problem;
use makao\LPSolve\Solver;

// Define constraints
$constraints = [
    new Constraint([120, 210, 150.75], LE, 15000),
    new Constraint([110, 30, 125], LE, 4000),
    new Constraint([1, 1, 1], LE, 75)
];

// Or initialize them from string
// $constraints = [
//     Constraint::fromString('120x + 210y + 150.75z <= 15000'),
//     Constraint::fromString('110x + 30y + 125z <= 4000'),
//     Constraint::fromString('1x + 1y + 1z <= 75')
// ];

// Define problem
$problem = new Problem([143, 60, 195], $constraints);

// Solve it!
$solver = new Solver(Solver::MAX); // Can be either Solver::MIN for minimalization
$solution = $solver->solve($problem);

var_dump($solution);
```

**Note:** Do not omit coefficient value when create constraint from string.

There are 3 examples provided in example.php.

For more information please visit: http://lpsolve.sourceforge.net

## License
MIT