<?php
class tableDepartmentsView
{
  public static function makeTable($departments)
  {
    $html = '<table>'.
      '<tr>'.
	'<th>dept_no</th>'.
        '<th>dept_name</th>'.
      '</tr>';

      //make the rest of the table
      foreach($departments as $department)
      {
        $html .= 
        '<tr>'.
          '<td>' . $department['dept_no']  . '</td>'.
          '<td><a href="index.php?page=pageDeptSummary&deptNo='. $department['dept_no'] . '">'. $department['dept_name'] .'</a></td>'.
        '</tr>';
      }

    $html .= '</table>';
    return $html;
  }
}

