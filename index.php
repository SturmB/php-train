<?php
require_once __DIR__ . "/vendor/autoload.php";
session_start();

use Sturm\PhpTrain\TrainCar;
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <!--suppress SpellCheckingInspection -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Train Exercise</title>
</head>
<body>

<div class="container">
    <div class="row mb-3">
        <div class="col">
            <h1 class="display-1">A Virtual Train</h1>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col">
            <div class="card">
                <div class="card-body bg-info">
                    Your train for this session currently has
                    <span class="fw-bold" id="totalTrainLength"><?= $_SESSION["train"]->getLength() ??
                        0 ?></span> train car(s)
                    in it and weighs <span class="fw-bold" id="totalTrainWeight"><?= $_SESSION["train"]->getWeight() ??
                        0 ?></span> ton(s).
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">Add a Train Car</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <label for="add-location" class="form-label">Location</label>
                            <select name="add-location" id="add-location" class="form-select" aria-label="Location">
                                <option value="front" selected>Front</option>
                                <option value="back">Back</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="weight" class="form-label">Weight</label>
                            <input type="number" id="weight" class="form-control" value="10" min="0">
                        </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="addTrainCar">Add Train Car</button>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">Remove a Train Car</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="remove-location" class="form-label">Location</label>
                        <select name="remove-location" id="remove-location" class="form-select" aria-label="Location">
                            <option value="front" selected>Front</option>
                            <option value="back">Back</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-danger" id="removeTrainCar">Remove Train Car</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JavaScript -->
<!--suppress SpellCheckingInspection -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $('#addTrainCar').click(function () {
        const location = $('#add-location option:selected').val();
        const weight = $('#weight').val();
        $.ajax({
            type: "POST",
            url: "src/functions.php",
            data: {
                action: "addTrainCar",
                location: location,
                weight: weight
            }
        }).done(function (msg) {
            const returnedArray = JSON.parse(msg);
            if (returnedArray[0] !== "success") {
                alert(returnedArray[0]);
                return;
            }
            $('#totalTrainLength').html(returnedArray[1]);
            $('#totalTrainWeight').html(returnedArray[2]);
        });
    });
    $('#removeTrainCar').click(function () {
        const location = $('#remove-location option:selected').val();
        $.ajax({
            type: "POST",
            url: "src/functions.php",
            data: {
                action: "removeTrainCar",
                location: location
            }
        }).done(function (msg) {
            const returnedArray = JSON.parse(msg);
            if (returnedArray[0] !== "success") {
                alert(returnedArray[0]);
                return;
            }
            $('#totalTrainLength').html(returnedArray[1]);
            $('#totalTrainWeight').html(returnedArray[2]);
        });
    });
</script>
</body>
</html>
