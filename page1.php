<?php
require_once 'utils/Validation.php';
Validation::$errorMessage = 'error';
echo Validation::$errorMessage;
// $_POST['error']
