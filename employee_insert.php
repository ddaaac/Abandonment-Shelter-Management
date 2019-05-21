<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$employee_id = $_POST['employee_id'];
$name = $_POST['employee_name'];
$phone = $_POST['employee_phone'];
$salary = $_POST['employee_salary'];
$Shelter_id = $_POST['shelter_id'];

$ret = mysqli_query($conn, "INSERT INTO Employee (Employee_id, name, phone, salary, Shelter_id) 
                    values('$employee_id', '$name', '$phone', '$salary', '$Shelter_id')");
if(!$ret)
{
    echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=employee_management.php'>";
}

?>