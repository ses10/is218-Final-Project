<?php
class tableDepartmentEmployees
{
  public static function makeTable($employees)
  {
    $html = '<table>'.
      '<tr>';
      foreach($employees[0] as $key => $value)
      {
        $html .= '<th>' . $key . '</th>';
      }
    $html .= '</tr>';
    
      foreach($employees as $employee)
      {
        $html .= '</tr>';
        foreach($employee as $key => $value)
        {
          $html .= '<td>' . $value . '</td>';
        }
       $html .= '</tr>';
      }

    $html .= '</table>';
    
    return $html; 
  }
}
