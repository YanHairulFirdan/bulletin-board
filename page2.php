<?php
require_once 'utils/Validation.php';
echo isset(Validation::$errorMessage) ? 'yes' : 'no';
