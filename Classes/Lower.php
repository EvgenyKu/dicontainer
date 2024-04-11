<?php

namespace App\Classes;

class Lower
{
    private string $text = 'Привет я объект класса Lower';

    public function printText():void
    {
        echo $this->text;
    }
}