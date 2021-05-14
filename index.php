<?php

//This is my controller for the diner project

//Turn on error-reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Start a session
session_start();

//Require neccassary files
require_once ('vendor/autoload.php');
require_once ('model/data-layer.php');
require_once ('model/validation.php');

//Instantiate Fat-Free
$f3 = Base::instance();

//Define default route
$f3->route('GET /', function(){

    //Display the home page
    $view = new Template();
    echo $view->render('views/home.html');
});

$f3->route('GET /breakfast', function(){

    //Display the breakfast page
    $view = new Template();
    echo $view->render('views/breakfast.html');
});

$f3->route('GET /breakfast/brunch/mothers-day', function(){

    //Display the breakfast page
    $view = new Template();
    echo $view->render('views/mothers-day-brunch.html');
});

$f3->route('GET|POST /order1', function($f3){

    //If the form has been submitted, add the data to session
    //and send the user to the next order form
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        //If data is valid, store data and redirect
        if(validFood($_POST['food'])) {
            $_SESSION['food'] = $_POST['food'];
            $_SESSION['meal'] = $_POST['meal'];
            header('location: order2');
        }
        //Otherwise, set an error variable in the hive
        else {
            $f3->set('errors["food"]', 'Please enter a food');
        }
    }

    //Get the data from the model
    $f3->set('meals',getMeals());


    //Display the first order form
    $view = new Template();
    echo $view->render('views/orderForm1.html');
});

$f3->route('GET|POST /order2', function($f3){

    //If the form has been submitted, add the data to session
    //and send the user to the summary page
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);
        //Data validation will go here

        $_SESSION['conds'] = implode(", ", $_POST['conds']);
        header('location: summary');
    }

    $f3->set('flavors', getFlavors());


    //Display the second order form
    $view = new Template();
    echo $view->render('views/orderForm2.html');
});

$f3->route('GET /summary', function(){

    //Display the second order form
    $view = new Template();
    echo $view->render('views/summary.html');
});



/*
 * $f3->set('ONERROR', function() {
    $view = new Template();
    echo $view->render('views/custom-error.html');
});
 */

//Run Fat-Free
$f3->run();
