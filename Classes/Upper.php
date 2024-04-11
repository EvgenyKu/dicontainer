<?php

namespace App\Classes;

class Upper
{
    private Middle $middle;
    private MiddleTwo $middleTwo;

    public function __construct(Middle $middle, MiddleTwo $middleTwo)
    {
        $this->middle = $middle;
        $this->middleTwo = $middleTwo;
    }

    public function printLowerText()
    {
        $this->middle->lower->printText();
    }
}