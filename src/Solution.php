<?php

namespace makao\LPSolve;

class Solution
{
    private $objective;
    private $count;
    private $variables;
    private $code;
    private $status;

    /**
     * Constructor
     *
     * @param int|float $objective Objective value
     * @param int|float $count     Solutions count
     * @param array     $variables Variables value
     * @param int       $code      Status code
     * @param string    $status    Status text
     */
    public function __construct($objective, $count, $variables, $code, $status)
    {
        $this->objective = $objective;
        $this->count = $count;
        $this->variables = $variables;
        $this->code = $code;
        $this->status = $status;
    }

    public function getObjective()
    {
        return $this->objective;
    }

    public function getCount()
    {
        return $this->count;
    }

    public function getVariables()
    {
        return $this->variables;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getStatus()
    {
        return $this->status;
    }
}
