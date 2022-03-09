## PHPWeb project

## At the moment project has

- Employee endpoint: http://u8191062-lab1.local/employee_endpoint.php
- Department endpoint: http://u8191062-lab1.local/department_endpoint.php


## Installation guide
### Requirements:
- PHP 8.x
- Ubuntu 20.x

### Installation steps

- Install php8.0, php8.0-fpm
- Clone this repo git clone https://github.com/strukovsky/PHPWeb/
- In directory PHPWeb execute: `./setup.sh`

### Test endpoints

To test endpoints, one should start internal PHP web server:

    php -S localhost:8080

### Test employee
Go to http://localhost:8000/employee_endpoint.php to check whether all is OK

To specify other values dedicated to created Employee use GET arguments. Example:  
http://localhost:8000/employee_endpoint.php?salary=10012&timestamp_started_working=1000000000&name=Test  
Will create Test employee with salary 10012 and timestamp when started working 1000000000

### Test departments

The idea: departments are created in following way:  
Endpoint receives in `counts` GET parameter a string with numbers of employees separated by semicolon.  
For example
http://localhost:8000/department_endpoint.php?counts=1;2;3
Will create 3 departments: with 1, 2 and 3 employees respectively.  
Each department has the same rule for giving salary:  
- first employee gets 1000 money
- second employee gets 2000 money
- ...
- nth employee gets n * 1000 money  

It is made in this manner due to make testing easier.  
Thus, one can create his own way of salary dispatching in DepartmentController

Once endpoint gets the string with counts, it will calculate max and min values  
and give a HTML page with min and max section in accordance with task 2.