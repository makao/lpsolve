<?php

namespace makao\LPSolve;

class Constraint
{
    private $coefficients = [];
    private $comparison;
    private $value;

    /**
     * Constructor
     *
     * @param array     $coefficients Constraint left side
     * @param int|float $comparison   Comparison sign (LE, GE, EQ, FR)
     * @param int|float $value        Constraint right side
     */
    public function __construct(array $coefficients = [], $comparison = null, $value = null)
    {
        $this->coefficients = $coefficients;
        $this->comparison = $comparison ?: FR;
        $this->value = $value;
    }

    /**
     * Create constraint from string
     *
     * @param  string $string String constraint
     * @return self
     */
    public static function fromString($string)
    {
        $split = preg_split('/(<=|=|>=)/', $string, -1, PREG_SPLIT_DELIM_CAPTURE);

        $coefficients = self::parseCoefficients($split[0]);
        $comparison = self::parseComparison($split[1]);
        $value = floatval($split[2]);

        return new Constraint($coefficients, $comparison, $value);
    }

    public function getCoefficients()
    {
        return $this->coefficients;
    }

    public function setCoefficients($coefficients)
    {
        $this->coefficients = $coefficients;

        return $this;
    }

    /**
     * Parse coefficients from string
     *
     * @param  string $expression Left side of equation
     * @return array
     */
    private static function parseCoefficients($expression)
    {
        $coefficients = [];
        $split = preg_split('/[a-zA-Z]/', trim($expression), -1, PREG_SPLIT_NO_EMPTY);

        foreach ($split as $coefficient) {
            $coefficients[] = floatval(preg_replace('/\s+/', '', $coefficient));
        }

        return $coefficients;
    }

    public function getComparison()
    {
        return $this->comparison;
    }

    public function setComparison($comparison)
    {
        $this->comparison = $comparison;

        return $this;
    }

    /**
     * Parse comparison sign
     *
     * @param  string $comparison Comparison sign
     * @return int
     */
    private static function parseComparison($comparison)
    {
        if ($comparison === '<=') {
            return LE;
        }
        if ($comparison === '>=') {
            return GE;
        }

        return EQ;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
