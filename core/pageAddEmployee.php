<?php
class pageAddEmployee extends page
{
  public function get()
  {
    $this->pageBody .= formAddEmployee::makeForm();
  }
 
  public function post()
  {
    $employees = new collectionEmployees($_POST['department']);
    
    $employees->addEmployee($_POST['fname'], $_POST['lname'], $_POST['birthDate'], $_POST['gender'], $_POST['hireDate'], $_POST['salary'], $_POST['department']);
    
    header('Location: index.php');
  }
}
