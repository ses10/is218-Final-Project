<?php
class pageDepartments extends page
{
  public function get()
  {
    $departments = (new collectionDepartments())->getDepartments();
    
    $this->pageBody .= tableDepartmentsView::makeTable($departments);
    $this->pageBody .= '<br><a href="index.php?page=pageAddEmployee"><button>Add new Employee</button></a>';
  }
}
