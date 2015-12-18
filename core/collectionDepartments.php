<?php
class collectionDepartments
{
  protected $departments;
 
  //load collection from database
  public function __construct()
  {
    $db = new employeeDatabaseHelper();
    $departments = $db->getDepartments();
    
    //load all data into each department model
    foreach($departments as $department){
      
      $department += $db->getDeptManager($department['dept_no']);
      $department += $db->getTotalDeptSalary($department['dept_no']);
      $department += $db->getNumDeptEmployees($department['dept_no']);
      $department += $db->getAvgDeptSalary($department['dept_no']);
      
      $this->departments[$department['dept_no']] = $department;
    }
  }
  
  public function getDepartments()
  {
    return $this->departments;
  }
  
  public function getDepartment($deptNo)
  {
     return $this->departments[$deptNo];
  }
}
