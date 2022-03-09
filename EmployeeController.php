<?php

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;

$__employee = __DIR__ . '/Employee.php';
require_once $__employee;

$__utils = __DIR__ . '/utils.php';
require_once $__utils;


class EmployeeController
{
    private int $current_id = 0;

    private function validate_field(mixed $field, array $constraints): array
    {
        $validator = Validation::createValidator();
        $errors = [];
        $errors_in_salary = $validator->validate($field, $constraints);
        foreach ($errors_in_salary as $error_in_salary) {
            $errors[] = (string)$error_in_salary;
        }
        return $errors;
    }

    private function validate(Employee $employee): string
    {

        $errors = [];
        $errors = array_merge($errors, $this->validate_field($employee->getSalary(), [
            new GreaterThan(999),
            new NotBlank()
        ]));
        $errors = array_merge($errors, $this->validate_field($employee->getName(), [
            new Length(null, 2),
            new NotBlank()
        ]));
        $errors = array_merge($errors, $this->validate_field($employee->getTimestampStartedWorking(), [
            new GreaterThan(946674000),
            new NotBlank()
        ]));
        $errors = array_merge($errors, $this->validate_field($employee->getId(), [
            new GreaterThan(-1),
            new NotBlank()
        ]));

        if (count($errors) > 0) {
            $errors_string = implode("<br>", $errors);
            return ($errors_string);
        }
        return
            '<html lang="en"><body>Created employee with id=' . $employee->getId() . ' with name=' . $employee->getName() . ' with salary = ' . $employee->getSalary() . 'with experience ' . $employee->getExperienceInYears() . 'years. </body></html>';

    }

    public function create(): string
    {
        $name = getQueryArgument("name", "Default name");
        $salary = getQueryArgument("salary", 10000);
        $timestamp_started_working = getQueryArgument("timestamp_started_working", 946674001);

        $employee = new Employee($this->current_id, $name, $salary, $timestamp_started_working);
        $response = $this->validate($employee);
        $this->current_id++;
        return $response;
    }
}