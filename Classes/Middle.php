<?php

namespace App\Classes;

class Middle
{
    public Lower $lower;
    public LowerTwo $lowerTwo;

    public function __construct(Lower $lower, LowerTwo $lowerTwo)
    {
        $this->lower = $lower;
        $this->lowerTwo = $lowerTwo;
    }
}