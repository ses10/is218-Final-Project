<?php
class collectionEmployees
{
  protected $employees;  
  
  public function __construct($deptNo)
  {
    $employeeModel = array(
      'first_name',
      'last_name',
      'start_date',
      'end_date',
      'salary'
    );  
 
    $db = new employeeDatabaseHelper();
    $employees = $db->getDeptEmployees($deptNo);
 
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
}
