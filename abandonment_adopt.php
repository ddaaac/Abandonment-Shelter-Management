<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$abandonment_id = $_POST['abandonment_id'];
$house_type = $_POST['adopt_housetype'];
$phone = $_POST['adopt_phone'];
$salary = $_POST['adopt_salary'];
$address = $_POST['adopt_address'];

$ret = mysqli_query($conn, "INSERT INTO AdoptingFamily (Abandonment_id, house_type, phone, monthly_income, address) 
                    values('$abandonment_id', '$house_type', '$phone', '$salary', '$address')");
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