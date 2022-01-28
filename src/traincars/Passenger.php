<?php

namespace Sturm\PhpTrain;

class Passenger extends TrainCar
{

    public function __construct()
    {
        $this->weight = 15;
    }
}