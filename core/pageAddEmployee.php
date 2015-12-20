<?php
class pageAddEmployee extends page
{
  public function get()
  {
    $this->pageBody .= '<a href="index.php">Back</a><br><br>';
    $this->pageBody .= formAddEmployee::makeForm();
  }
 
  public function post()
  { 
    $this->pageBody .= '<a href="index.php">Back</a><br>';
    $employees = new collectionEmployees($_POST['department']);
    
    $newEmpNo = $employees->addEmployee($_POST['fname'], $_POST['lname'], $_POST['birthDate'], $_POST['gender'], $_POST['hireDate'], $_POST['salary'], $_POST['department']);
    
    $this->pageBody .= '<h1>New Employee\'s Information</h1>';   

    $newEmployee = $employees->getEmployee($newEmpNo);
    foreach($newEmployee as $key => $value)
    {
      $this->pageBody .= $key . ': ' . $value . '<br>';
    }
  }
}
