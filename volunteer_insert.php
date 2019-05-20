<?php
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$volunteer_id = $_POST['volunteer_id'];
$name = $_POST['volunteer_name'];
$phone = $_POST['volunteer_phone'];
$address = $_POST['volunteer_address'];
$date = $_POST['volunteer_date'];
$Shelter_id = $_POST['shelter_id'];

$ret = mysqli_query($conn, "INSERT INTO Volunteer (Volunteer_id, name, phone, address, date, Shelter_id) 
                    values('$volunteer_id', '$name', '$phone', '$address', '$date', '$Shelter_id')");
if(!$ret)
{
    echo mysqli_error($conn);
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<meta http-equiv='refresh' content='0;url=volunteer_management.php'>";
}

?>