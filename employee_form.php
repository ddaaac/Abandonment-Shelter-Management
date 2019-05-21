<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "employee_insert.php";
if (array_key_exists("employee_id", $_GET)) {
    $employee_id = $_GET["employee_id"];
    $query = "SELECT Employee_id, name, phone, salary, Shelter_id
            FROM Employee WHERE Employee_id=$employee_id";
    $res = mysqli_query($conn, $query);
    $employee = mysqli_fetch_assoc($res);
    if (!$employee) {
        msg("해당 봉사자가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "employee_modify.php";
}
$shelters = array();
$query = "SELECT * FROM Shelter ORDER BY Shelter_id";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $shelters[$row['Shelter_id']] = $row['name'];
}
$last_id = -1;
$query = "SELECT Employee_id FROM Employee ORDER BY Employee_id DESC LIMIT 1";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_array($res);
$last_id = $row['Employee_id'];
?>
    <div class="container">
        <form name="employee_form" action="<?=$action?>" method="post" class="fullwidth">

            <h3>봉사자 <?=$mode?></h3>
            <input type="hidden" id="employee_id" name="employee_id"
                   value="<?= ($employee['Employee_id'] == '') ? $last_id+1 : $employee['Employee_id'] ?>"/>
            <p>
                <label for="employee_name">이름</label>
                <input type="text" id="employee_name" name="employee_name"
                       placeholder="김범준" value="<?= $employee['name'] ?>"/>
            </p>

            <p>
                <label for="employee_phone">전화번호</label>
                <input type="text" id="employee_phone" name="employee_phone"
                       placeholder="(323)122-4343" value="<?= $employee['phone'] ?>"/>
            </p>

            <p>
                <label for="employee_salary">월급</label>
                <input id="employee_salary" name="employee_salary"
                       type="text" placeholder="32.4" value="<?= $employee['salary'] ?>"/>
            </p>

            <p>
                <label for="shelter_id">보호소</label>
                <select id="shelter_id" name="shelter_id">
                    <option value="-1">선택해주세요</option>
                    <?
                    foreach($shelters as $id => $name) {
                        if($id == $employee['Shelter_id']){
                            echo "<option value='{$id}' selected>{$name}</option>";
                        }  else {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    }
                    ?>
                </select>
            </p>

            <p align="center" style="margin-top: 10px;"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("employee_name").value == "") {
                        alert ("이름을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("employee_phone").value == "") {
                        alert ("전화번호를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("employee_salary").value == "") {
                        alert ("월급을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("shelter_id").value == "-1") {
                        alert ("보호소를 선택해주세요"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>