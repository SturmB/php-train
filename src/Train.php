<?php

namespace Sturm\PhpTrain;

class Train
{
    private array $trainCars;

    public function __construct()
    {
        $this->trainCars = [];
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return array_reduce(
            $this->trainCars,
            function ($a, $b) {
                return $a + $b;
            },
            0
        );
    }

    /**
     * @return float
     */
    public function getLength(): float
    {
        return count($this->trainCars);
    }

    /**
     * @param string $location
     * @param float $weight
     * @return string
     */
    public function addTrainCar(string $location, float $weight = 10)
    {
        if ($this->getLength() >= 30) {
            return "Already at the maximum number of train cars.";
        }
        if ($location === "front") {
            array_unshift($this->trainCars, new TrainCar($weight));
            return "success";
        } elseif ($location === "back") {
            $this->trainCars[] = new TrainCar($weight);
            return "success";
        } else {
            return 'Please specify if you want the new train car to be added to the "front" or "back" of the train.';
        }
    }

    /**
     * @param string $location
     * @return string
     */
    public function removeTrainCar(string $location)
    {
        if ($this->getLength() <= 0) {
            return "Train is empty already.";
        }
        if ($location === "front") {
            array_shift($this->trainCars);
            return "success";
        } elseif ($location === "back") {
            array_pop($this->trainCars);
            return "success";
        } else {
            return 'Please specify if you want to remove a train car from the "front" or "back" of the train.';
        }
    }
}
