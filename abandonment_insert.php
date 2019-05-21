<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_POST['abandonment_id'];
$abandonment_upkind = $_POST['abandonment_upkind'];
$abandonment_kind = $_POST['abandonment_kind'];
$abandonment_date = $_POST['abandonment_date'];
$abandonment_is_neuter = $_POST['abandonment_is_neuter'];
$shelter_id = $_POST['shelter_id'];

$ret = mysqli_query($conn, "INSERT INTO abandonment (abandonment_id, abandonment_upkind, abandonment_kind, abandonment_date, abandonment_is_neuter, shelter_id) 
                    values('$abandonment_id', '$abandonment_upkind', '$abandonment_kind', '$abandonment_date', '$abandonment_is_neuter', '$shelter_id')");
if(!$ret)
{
    echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=abandonment_management.php'>";
}

?>