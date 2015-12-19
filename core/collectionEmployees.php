<?php
class collectionEmployees
{
  protected $employees;  
  private $dbHelper;  

  public function __construct($deptNo)
  {
    $employeeModel = array(
      'first_name',
      'last_name',
      'start_date',
      'end_date',
      'salary'
    );  
 
    $this->dbHelper = new employeeDatabaseHelper();
    $employees = $this->dbHelper->getDeptEmployees($deptNo);
 
    foreach($employees as $employee)
    {
      $modelValues = [];
      foreach($employee as $key => $value)
      {
        array_push($modelValues, $value);
      }
      $this->employees[] = array_combine($employeeModel, $modelValues);
    }
  }
  
  public function getEmployees()
  {
    return $this->employees;
  }

  public function addEmployee($fName, $lName, $birthDate, $gender, $hireDate, $salary, $deptNo)
  {
    $this->dbHelper->addEmployee($fName, $lName, $birthDate, $gender, $hireDate, $salary, $deptNo);
  }
}
