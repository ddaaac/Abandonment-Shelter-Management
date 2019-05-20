<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_POST['abandonment_id'];
$upkind = $_POST['abandonment_upkind'];
$kind = $_POST['abandonment_kind'];
$date = $_POST['abandonment_date'];
$is_neuter = $_POST['abandonment_isneuter'];
$Shelter_id = $_POST['shelter_id'];

$query = "UPDATE Abandonment SET Abandonment_id = '$abandonment_id', upkind = '$upkind', kind = '$kind', date_begin = '$date', 
                    is_neuter = '$is_neuter', Shelter_id = '$Shelter_id' WHERE Abandonment_id = '$abandonment_id'";

$ret = mysqli_query($conn, $query);

if(!$ret)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=abandonment_management.php'>";
}

?>

