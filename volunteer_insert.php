<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$volunteer_id = $_POST['volunteer_id'];
$volunteer_name = $_POST['volunteer_name'];
$volunteer_phone = $_POST['volunteer_phone'];
$volunteer_address = $_POST['volunteer_address'];
$volunteer_date = $_POST['volunteer_date'];
$shelter_id = $_POST['shelter_id'];

// transaction 처리 시작
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation

$ret = mysqli_query($conn, "INSERT INTO volunteer (volunteer_id, volunteer_name, volunteer_phone, volunteer_address, volunteer_date, shelter_id) 
                    values('$volunteer_id', '$volunteer_name', '$volunteer_phone', '$volunteer_address', '$volunteer_date', '$shelter_id')");
if(!$ret)
{
    mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
    echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=volunteer_management.php'>";
}
// transaction 처리 끝
?>