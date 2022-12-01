<?php

function isUserLoggedIn(){
    return !empty($_SESSION['idautore']);
}


>