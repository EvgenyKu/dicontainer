<?php

namespace App\Classes;

class LowerTwo
{
    private string $text = 'Привет я объект класса Lower Two';

    public function printText():void
    {
        echo $this->text;
    }
}