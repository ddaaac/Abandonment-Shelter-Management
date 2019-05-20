<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_POST['abandonment_id'];
$upkind = $_POST['abandonment_upkind'];
$kind = $_POST['abandonment_kind'];
$date_begin = $_POST['abandonment_date'];
$is_neuter = $_POST['abandonment_isneuter'];
$Shelter_id = $_POST['shelter_id'];

$ret = mysqli_query($conn, "INSERT INTO Abandonment (Abandonment_id, upkind, kind, date_begin, is_neuter, Shelter_id) 
                    values('$abandonment_id', '$upkind', '$kind', '$date_begin', '$is_neuter', '$Shelter_id')");
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