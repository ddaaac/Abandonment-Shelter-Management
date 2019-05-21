<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$employee_id = $_POST['employee_id'];
$employee_name = $_POST['employee_name'];
$employee_phone = $_POST['employee_phone'];
$employee_salary = $_POST['employee_salary'];
$shelter_id = $_POST['shelter_id'];

$query = "UPDATE employee SET employee_id = '$employee_id', employee_name = '$employee_name', 
            employee_phone = '$employee_phone', employee_salary = '$employee_salary', 
            shelter_id = '$shelter_id' WHERE employee_id = '$employee_id'";

$ret = mysqli_query($conn, $query);

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=employee_management.php'>";
}

?>

