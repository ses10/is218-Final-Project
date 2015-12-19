<?php
class formAddEmployee
{
  static public function makeForm()
  {
     $departments = (new collectionDepartments())->getDepartments();

     $html = '<form action="index.php?page=pageAddEmployee" method="post">'.
       'First Name: <input type="text" name="fname"><br>'.
       'Last Name: <input type="text" name="lname"><br>'.
       'Date of Birth: <input type="date" name="birthDate"><br>'.
       'Gender: <input type="radio" name="gender" value="M">Male <input type="radio" name="gender" value="F">Female<br>'.
       'Hire Date: <input type="date" name="hireDate"><br>'.
       'Salary <input type="text" name="salary"><br>'.
       'Department: <select name="department">';
			foreach($departments as $department)
			{
			  $html .= '<option value="'. $department['dept_no']  .'">'. $department['dept_name']  .'</option>';
			}
         $html .=  '</select><br>';
     $html .=  '<input type="submit"></form>';

     return $html;
  }
}
