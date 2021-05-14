<?php

/* validation.php
 * Validate data for the diner app
 *
 */

//return if a food is valid
function validName($inputName)
{
    return strlen(trim($inputName)) >= 2;
}

//Return true if meal is valid


//Return true if *all* condiments are valid
function validFlavors($flavors)
{
    $validFlavors = getFlavors();

    //Make sure each selected condiment is valid
    foreach ($flavors as $userChoice) {
        if (!in_array($userChoice, $validFlavors)) {
            return false;
        }
    }

    //All choices are valid
    return true;
}