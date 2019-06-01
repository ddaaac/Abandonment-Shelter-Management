<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$employee_id = $_POST['employee_id'];
$employee_name = $_POST['employee_name'];
$employee_phone = $_POST['employee_phone'];
$employee_salary = $_POST['employee_salary'];
$shelter_id = $_POST['shelter_id'];

// transaction 처리 시작
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$query = "UPDATE employee SET employee_id = '$employee_id', employee_name = '$employee_name', 
            employee_phone = '$employee_phone', employee_salary = '$employee_salary', 
            shelter_id = '$shelter_id' WHERE employee_id = '$employee_id'";

$ret = mysqli_query($conn, $query);

if(!$ret)
{
    mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=employee_management.php'>";
}
// transaction 처리 끝

?>

