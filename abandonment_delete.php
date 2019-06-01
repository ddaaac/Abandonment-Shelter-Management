<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_GET['abandonment_id'];

// transaction 처리 시작
mysqli_query($conn, "set autocommit = 0");	// autocommit 해제
mysqli_query($conn, "set transaction isolation level serializable");	// isolation level 설정
mysqli_query($conn, "begin");	// begins a transation


// 해당 유기동물을 key로 갖고 있을 수 있는 입양가족의 기록부터 먼저 삭제 -> 무결성 지키기
$ret = mysqli_query($conn, "DELETE FROM adopting_family WHERE abandonment_id = $abandonment_id");
if(!$ret)
{
    mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
    alert_message('Query Error : '.mysqli_error($conn));
}
$ret = mysqli_query($conn, "DELETE FROM abandonment WHERE abandonment_id = $abandonment_id");
if(!$ret)
{
    mysqli_query($conn, "rollback"); // query 수행 실패. 수행 전으로 rollback
    alert_message('Query Error : '.mysqli_error($conn));
}

else
{
    mysqli_query($conn, "commit"); // query 수행 성공. 수행 내역 commit
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=abandonment_management.php'>";
}
// transaction 처리 끝

?>