<?php
class pageDeptEmployees extends page
{
  public function get()
  {
    echo 'Employees for deptNo: ' . $_GET['deptNo'];
    $employees = (new collectionEmployees($_GET['deptNo']))->getEmployees(); 
    
    $this->pageBody .= tableDepartmentEmployees::makeTable($employees);
  }
}
