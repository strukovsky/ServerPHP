<?php

class Employee
{
    private int $id;

    private string $name;

    private int $salary;

    private int $timestamp_started_working;

    public function __construct($id, $name, $salary, $date_started_working)
    {
        $this->id = $id;
        $this->name = $name;
        $this->salary = $salary;
        $this->timestamp_started_working = $date_started_working;
    }

    function getExperienceInYears(): string
    {
        $year_now = date("Y");
        return $year_now - date("Y", $this->timestamp_started_working);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getSalary(): int
    {
        return $this->salary;
    }

    /**
     * @return int
     */
    public function getTimestampStartedWorking(): int
    {
        return $this->timestamp_started_working;
    }


}


