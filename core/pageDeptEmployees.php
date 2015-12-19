<?php
class pageDeptEmployees extends page
{
  public function get()
  {
    $this->pageBody .= '<a href="index.php">Back</a><br>';
    $this->pageBody .= '<h1>Employees for deptNo: ' . $_GET['deptNo'] . '</h1>';
    $employees = (new collectionEmployees($_GET['deptNo']))->getEmployees(); 
    
    $this->pageBody .= tableDepartmentEmployees::makeTable($employees);
  }
}
