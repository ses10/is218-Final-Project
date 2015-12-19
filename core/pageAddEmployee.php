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

    echo 'this is the post';
    print_r($_POST);
    echo '<br><br>';
    foreach($_POST as $key => $value)
  {
    echo $key .' == '. $value. '<br>' ;
  }
    
    $employees->addEmployee($_POST['fname'], $_POST['lname'], $_POST['birthDate'], $_POST['gender'], $_POST['hireDate'], $_POST['salary'], $_POST['department']);
   // echo 'format: '. date('Y-m-d', strtotime($_POST['birthDate']));
   // echo '<br> format: '. date('Y-m-d', strtotime($_POST['hireDate']));
  }
}
