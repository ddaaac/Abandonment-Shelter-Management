<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "employee_insert.php";
if (array_key_exists("employee_id", $_GET)) {
    $employee_id = $_GET["employee_id"];
    $query = "SELECT * FROM employee WHERE employee_id=$employee_id";
    $res = mysqli_query($conn, $query);
    $employee = mysqli_fetch_assoc($res);
    if (!$employee) {
        msg("해당 직원이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "employee_modify.php";
}

$shelters = shelter_array($conn);
$last_id = find_last_id('employee', $conn);
?>
    <div class="container">
        <form name="employee_form" action="<?=$action?>" method="post" class="fullwidth">

            <h3>직원 <?=$mode?></h3>
            <input type="hidden" id="employee_id" name="employee_id"
                   value="<?= ($employee) ? $employee['employee_id'] : $last_id+1?>"/>
            <p>
                <label for="employee_name">이름</label>
                <input type="text" id="employee_name" name="employee_name"
                       placeholder="김범준" value="<?= $employee['employee_name'] ?>"/>
            </p>

            <p>
                <label for="employee_phone">전화번호</label>
                <input type="text" id="employee_phone" name="employee_phone"
                       placeholder="(323)122-4343" value="<?= $employee['employee_phone'] ?>"/>
            </p>

            <p>
                <label for="employee_salary">월급</label>
                <input id="employee_salary" name="employee_salary"
                       type="text" placeholder="32.4" value="<?= $employee['employee_salary'] ?>"/>
            </p>

            <p>
                <label for="shelter_id">보호소</label>
                <select id="shelter_id" name="shelter_id">
                    <?
                    foreach($shelters as $id => $name) {
                        if($id == $employee['shelter_id']){
                            echo "<option value='{$id}' selected>{$name}</option>";
                        }  else {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    }
                    ?>
                    <option value="-1" <?= ($employee)? '' : 'selected';?>>선택해주세요</option>
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