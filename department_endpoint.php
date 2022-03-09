<?php

$__autoload = __DIR__ . '/vendor/autoload.php';
require_once $__autoload;

$__department_controller = __DIR__ . '/DepartmentController.php';
require_once $__department_controller;

$__utils = __DIR__ . '/utils.php';
require_once $__utils;


function handleCreateDepartmentArray($string_employee_counts)
{

    $employee_counts = explode(";", $string_employee_counts);
    $controller = new DepartmentController();
    $departments = array();
    foreach ($employee_counts as $employee_count) {
        $departments[] = $controller->createWithEmployees((int)$employee_count);
    }
    print $controller->analyzeDepartmentArray(...$departments);
}


$string_employee_counts = getQueryArgument("counts", "1;2;3");
handleCreateDepartmentArray($string_employee_counts);
