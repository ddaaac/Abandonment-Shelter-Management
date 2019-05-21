<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_GET['abandonment_id'];

// 해당 유기동물을 key로 갖고 있을 수 있는 입양가족의 기록부터 먼저 삭제 -> 무결성 지키기
$ret = mysqli_query($conn, "DELETE FROM adopting_family WHERE abandonment_id = $abandonment_id");
$ret = mysqli_query($conn, "DELETE FROM abandonment WHERE abandonment_id = $abandonment_id");

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 삭제 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=abandonment_management.php'>";
}

?>