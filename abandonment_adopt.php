<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_POST['abandonment_id'];
$adopting_family_house = $_POST['adopting_family_house'];
$adopting_family_phone = $_POST['adopting_family_phone'];
$adopting_family_salary = $_POST['adopting_family_salary'];
$adopting_family_address = $_POST['adopting_family_address'];

$ret = mysqli_query($conn, "INSERT INTO adopting_family (abandonment_id, adopting_family_house, adopting_family_phone, adopting_family_salary, adopting_family_address) 
                    values('$abandonment_id', '$adopting_family_house', '$adopting_family_phone', '$adopting_family_salary', '$adopting_family_address')");
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