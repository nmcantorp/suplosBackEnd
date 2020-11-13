<?php

use Dotenv\Dotenv;

require __DIR__ . "/vendor/autoload.php";
require_once(__DIR__ . '/bootstrap.php');


$dotenv = new Dotenv(__DIR__.'/config');
$dotenv->load();

$request = new App\Http\Request;
$request->send();