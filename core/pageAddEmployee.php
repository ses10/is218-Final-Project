<?php
class pageAddEmployee extends page
{
  public function get()
  {
    $this->pageBody .= formAddEmployee::makeForm();
  }
 
  public function post()
  {
    echo 'this is the post';
    print_r($_POST);

    echo 'format: '. date('Y-m-d', strtotime($_POST['birthDate']));
    echo '<br> format: '. date('Y-m-d', strtotime($_POST['hireDate']));
  }
}
