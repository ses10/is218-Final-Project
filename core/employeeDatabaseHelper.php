<?php
class employeeDatabaseHelper
{
  private $conn;

  public function __construct()
  {
    try
    {
      //log into the db
      $this->conn = new PDO('mysql:host=localhost;dbname=employeesTest', 'root', 'sesma10');
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e)
    {
      echo 'Error: ' . $e->getMessage();
    }
  }

  public function getDepartments()
  {
    $stmt = $this->conn->prepare('SELECT * FROM departments');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if($stmt->execute())
    {
      return $stmt->fetchAll();
    }
    else
    {
      return null;
    }
  }
  
  public function getDeptManager($deptNo)
  {
    $stmt = $this->conn->prepare('SELECT first_name AS manager_firstname, last_name AS manager_lastname FROM employees INNER JOIN dept_manager ON employees.emp_no = dept_manager.emp_no WHERE dept_manager.dept_no = :deptNo AND dept_manager.to_date = \'9999-01-01\'');
    $stmt->bindParam(':deptNo', $deptNo);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    $stmt->execute();
    return $stmt->fetch();
  }
  
  public function getTotalDeptSalary($deptNo)
  {
    $stmt = $this->conn->prepare('SELECT SUM(salaries.salary) AS salary_budget FROM dept_emp INNER JOIN employees ON dept_emp.emp_no = employees.emp_no INNER JOIN salaries ON employees.emp_no = salaries.emp_no WHERE dept_emp.to_date = \'9999-01-01\' AND salaries.to_date = \'9999-01-01\' AND dept_no = :deptNo');
    $stmt->bindParam(':deptNo', $deptNo);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);    

    $stmt->execute();
    return $stmt->fetch();
  }

  public function getNumDeptEmployees($deptNo)
  {
    $stmt = $this->conn->prepare('SELECT COUNT(dept_emp.dept_no) AS employee_count FROM dept_emp INNER JOIN employees ON dept_emp.emp_no = employees.emp_no WHERE dept_emp.to_date = \'9999-01-01\' AND dept_no = :deptNo');
    $stmt->bindParam(':deptNo', $deptNo);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->execute();
    return $stmt->fetch();
  }

  public function getAvgDeptSalary($deptNo)
  {
    $stmt = $this->conn->prepare('SELECT ROUND(AVG(salary),2) AS avg_salary FROM salaries INNER JOIN dept_emp ON salaries.emp_no = dept_emp.emp_no WHERE dept_no = :deptNo');
    $stmt->bindParam(':deptNo', $deptNo);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $stmt->execute();
    return $stmt->fetch();    
  }
  
  public function getDeptEmployees($deptNo)
  {
    $stmt = $this->conn->prepare('SELECT first_name, last_name, hire_date, dept_emp.to_date, salary FROM employees INNER JOIN salaries ON salaries.emp_no = employees.emp_no INNER JOIN dept_emp ON employees.emp_no = dept_emp.emp_no WHERE salaries.to_date=\'9999-01-01\' AND dept_emp.to_date=\'9999-01-01\' AND dept_no = :deptNo');
    $stmt->bindParam(':deptNo', $deptNo);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function addEmployee($fName, $lName, $birthDate, $gender, $hireDate, $salary, $deptNo)
  {
    //since employees table doesn't auto increment, create new emp_no by incrementing lastest emp_no by 1
    $stmt = $this->conn->prepare('SELECT emp_no FROM employees ORDER BY emp_no DESC LIMIT 1;');
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $stmt->execute();
    $row = $stmt->fetch();
    $newEmpNo = $row['emp_no'] + 1;

    $this->conn->beginTransaction();
    
    //employees table insert 
    $stmt = $this->conn->prepare('INSERT INTO employees (emp_no, birth_date, first_name, last_name, gender, hire_date) VALUES (:empNo, :birthDate, :fName, :lName, :gender, :hireDate)');
    $stmt->execute(array(
	  ':empNo' => $newEmpNo,
          ':birthDate' => $birthDate,
	  ':fName' => $fName,
	  ':lName' => $lName,
	  ':gender' => $gender,
   	  ':hireDate' => $hireDate
    ));
    
    //salaries table insert
    $stmt = $this->conn->prepare('INSERT INTO salaries (emp_no, salary, from_date, to_date) VALUES (:empNo, :salary, :hireDate, \'9999-01-01\')');
    $stmt->execute(array(
	  ':empNo' => $newEmpNo,
          ':salary' => $salary,
          ':hireDate' => $hireDate
    ));
    
    //department employees table insert
    $stmt = $this->conn->prepare('INSERT INTO dept_emp (emp_no, dept_no, from_date, to_date) VALUES (:empNo, :deptNo, :hireDate, \'9999-01-01\')');
    $stmt->execute(array(
	   ':empNo' => $newEmpNo,
           'deptNo' => $deptNo,
           ':hireDate' => $hireDate
    ));

    $this->conn->commit();
  }

  public function __destruct()
  {
    $this->conn = null;
  }
}

