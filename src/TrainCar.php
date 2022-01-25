<?php

namespace Sturm\PhpTrain;

class TrainCar
{
    private float $weight;

    /**
     * @param float $weight;
     */
    public function __construct(float $weight = 10)
    {
        $this->weight = $weight;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight(float $weight): void
    {
        $this->weight = $weight;
    }
}
