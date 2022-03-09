<?php

$__department = __DIR__ . '/Department.php';
require_once $__department;

$__employee = __DIR__ . '/Employee.php';
require_once $__employee;

class DepartmentController
{

    public function createWithEmployees(int $employee_count): Department
    {
        $name = getQueryArgument("name", "Default department");
        $employees = array();
        for ($i = 0; $i < $employee_count; $i++) {
            $name = "Departament_" . ($i + 1);
            $salary = ($i + 1) * 1000;
            $date_started_working = time();
            $employees[] = new Employee($i, $name, $salary, $date_started_working);
        }
        return new Department($name, ...$employees);
    }


    function analyzeDepartmentArray(Department ...$departments): string
    {
        if (count($departments) < 1) {
            return "<html lang='en'><body>No departments</body></html>";
        }
        $min_total_salary = $departments[0]->getTotalSalary();
        $departments_with_min = [$departments[0]];
        $max_total_salary = $departments[0]->getTotalSalary();
        $departments_with_max = [$departments[0]];

        for ($i = 1; $i < count($departments); $i++) {
            $department = $departments[$i];
            $salary = $department->getTotalSalary();
            if ($salary < $min_total_salary) {
                $min_total_salary = $salary;
                $departments_with_min = [$department];
            } else if ($salary == $min_total_salary) {
                $departments_with_min[] = $department;
            }
            if ($salary > $max_total_salary) {
                $max_total_salary = $salary;
                $departments_with_max = [$department];
            } else
                if ($salary == $max_total_salary) {
                    $departments_with_max[] = $department;
                }
        }
        $response_body = "\n<h1>Min section</h1><br>\n";
        $count_departments_with_min = count($departments_with_min);
        if ($count_departments_with_min == 1) {
            $response_body = $response_body . "Min total salary: " . $departments_with_min[0] . "<br>\n ";
        } else if ($count_departments_with_min > 1) {
            $response_body = $response_body . $this->analyzeDepsWithSameTotalSalary(...$departments_with_min);
        }

        $response_body = $response_body . "\n\n<h1>Max section</h1><br>\n";
        $count_departments_with_max = count($departments_with_max);
        if (count($departments_with_max) == 1) {
            $response_body = $response_body . "Max total salary: " . $departments_with_max[0] . " <br>\n ";
        } else if ($count_departments_with_max > 1) {
            $response_body = $response_body . $this->analyzeDepsWithSameTotalSalary(...$departments_with_max);
        }

        return "<html lang='en'><body>" . $response_body . "\n\n</body></html>";

    }

    private function analyzeDepsWithSameTotalSalary(Department ...$departments): string
    {
        $max_employee_count = $departments[0]->getEmployeesCount();
        $departments_with_max = [$departments[0]];
        for ($i = 1; $i < count($departments); $i++) {
            $department = $departments[$i];
            $employee_count = $department->getEmployeesCount();
            if ($employee_count > $max_employee_count) {
                $max_employee_count = $employee_count;
                $departments_with_max = [$department];
            } else if ($employee_count == $max_employee_count) {
                $departments_with_max[] = $department;
            }
        }
        $response = "";
        foreach ($departments_with_max as $department) {
            $response = $response . $department . " <br>\n";
        }
        return $response;
    }


}