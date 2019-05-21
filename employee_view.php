<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("employee_id", $_GET)) {
    $employee_id = $_GET["employee_id"];
    $query = "SELECT Employee_id, Employee.name, Employee.phone, salary,  Employee.Shelter_id, 
            Shelter.name AS Shelter_name, Shelter.phone AS Shelter_phone, Shelter.city AS Shelter_city 
            FROM Employee JOIN Shelter ON Employee.Shelter_id=Shelter.Shelter_id WHERE Employee_id=$employee_id";
    $res = mysqli_query($conn, $query);
    $employee = mysqli_fetch_assoc($res);
    if (!$employee) {
        msg("해당 봉사자가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>담장자 상세 보기</h3>

        <p>
            <label for="employee_id">id</label>
            <input readonly type="text" id="employee_id" name="employee_id" value="<?= $employee['Employee_id'] ?>"/>
        </p>

        <p>
            <label for="employee_name">이름</label>
            <input readonly type="text" id="employee_name" name="employee_name" value="<?= $employee['name'] ?>"/>
        </p>

        <p>
            <label for="employee_phone">전화번호</label>
            <input readonly type="text" id="employee_phone" name="employee_phone" value="<?= $employee['phone'] ?>"/>
        </p>

        <p>
            <label for="employee_address">월급</label>
            <input readonly type="text" id="employee_salary" name="employee_salary" value="<?= $employee['salary'] ?>"/>
        </p>

        <p>
            <label for="shelter_name">보호소 이름</label>
            <input readonly type="text" id="shelter_name" name="shelter_name" value="<?= $employee['Shelter_name'] ?>"/>
        </p>

        <p>
            <label for="shelter_phone">보호소 전화번호</label>
            <input readonly type="text" id="shelter_phone" name="shelter_phone" value="<?= $employee['Shelter_phone'] ?>"/>
        </p>

        <p>
            <label for="shelter_address">보호소 위치</label>
            <input readonly type="text" id="shelter_address" name="shelter_address" value="<?= $employee['Shelter_city'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>