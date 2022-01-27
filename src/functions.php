<?php
require_once __DIR__ . "/../vendor/autoload.php";
session_start();

use Sturm\PhpTrain\Train;

$train = $_SESSION["train"] ?? new Train();
$_SESSION["train"] = $train;

if (isset($_POST["action"])) {
    switch ($_POST["action"]) {
        case "addTrainCar":
            addTrainCar($train, $_POST["location"], $_POST["weight"]);
            break;
        case "removeTrainCar":
            removeTrainCar($train, $_POST["location"]);
            break;
    }
}

function addTrainCar(Train $train, string $location, float $weight)
{
    $result = $train->addTrainCar($location, $weight);
    $_SESSION["train"] = $train;
    echo json_encode([$result, $train->getLength(), $train->getWeight()]);
    exit();
}

function removeTrainCar(Train $train, string $location)
{
    $result = $train->removeTrainCar($location);
    $_SESSION["train"] = $train;
    echo json_encode([$result, $train->getLength(), $train->getWeight()]);
    exit();
}
