<?php
$__autoload = __DIR__ . '/vendor/autoload.php';
require_once $__autoload;
$__employee_controller = __DIR__ . '/EmployeeController.php';
require_once $__employee_controller;

$controller = new EmployeeController();
print $controller->create();
