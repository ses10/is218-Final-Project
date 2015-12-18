<?php
class tableDepartmentSummaryView{
  public static function makeTable($department)
  {
    $html = '<h1>Summary for '. $department['dept_name']  .'</h1>';
    $html .= '<table>'.
      '<tr>'.
        '<td>Current Manager</td>'.
	'<td>' . $department['manager_firstname'] . ' '. $department['manager_lastname'] . '</td>'.
      '</tr>'.
      '<tr>'.
        '<td>Total Salary</td>'.
        '<td>$' . number_format((int)$department['salary_budget']) . '</td>'.
      '</tr>'.
      '<tr>'.
        '<td>Number of employees</td>'.
        '<td>' . number_format((int)$department['employee_count']) . '</td>'.
      '</tr>'.
      '<tr>'.
        '<td>Average Salary</td>'.
        '<td>$' . number_format((int)$department['avg_salary']) . '</td>'.
      '</tr>';
    $html .= '</table>';

    return $html;
  }
}
