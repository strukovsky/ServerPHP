<?php


class Department
{
    private string $name;
    private $employees;

    public function __construct(string $name, Employee ...$employees)
    {
        $this->name = $name;
        $this->employees = $employees; /*array();
        foreach ($employees as $employee)
        {
            $this->employees[] = $employee;
        }*/
    }

    function getEmployeesCount(): int {
        return count($this->employees);
    }

    public function __toString(): string
    {
        return $this->name . " with count of employees " . $this->getEmployeesCount() . " and total salary " . $this->getTotalSalary();
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function getTotalSalary(): int
    {
        $result = 0;
        foreach ($this->employees as $employee) {
            $result += $employee->getSalary();
        }
        return $result;
    }

}


