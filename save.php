<?php
require_once('helpers/functions.php');
require_once('utils/Validation.php');
require_once('Database/Model.php');

$rules = [
    'title' => [
        'required' => true,
        'min' => 10,
        'max' => 32
    ],
    'body' => [
        'required' => true,
        'min' => 10,
        'max' => 220
    ]
];

$validation = new Validation($rules);
$validation->validate($_POST);

$bulletinsModel = new Model('bulletins');
$bulletinsModel->create($_POST);
header("Location: index.php");
