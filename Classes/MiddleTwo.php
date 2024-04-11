<?php

namespace App\Classes;

class MiddleTwo
{
    public Lower $lower;
    public LowerTwo $lowerTwo;

    public function __construct(Lower $lower, LowerTwo $lowerTwo){
        $this->lower = $lower;
        $this->lowerTwo = $lowerTwo;
    }
}