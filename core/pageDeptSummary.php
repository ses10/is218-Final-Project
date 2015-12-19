<?php
class pageDeptSummary extends page
{
  public function get()
  {
    $department = (new collectionDepartments)->getDepartment($_GET['deptNo']); 
    
    $this->pageBody .= '<a href="index.php">Back</a><br>';
    $this->pageBody .=  tableDepartmentSummaryView::makeTable($department);
    $this->pageBody .= '<br><a href="index.php?page=pageDeptEmployees&deptNo='. $_GET['deptNo']  .'">Current Employees.</a>';
  }
}
