<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "volunteer_insert.php";

if (array_key_exists("volunteer_id", $_GET)) {
    $volunteer_id = $_GET["volunteer_id"];
    $query = "SELECT Volunteer_id, name, phone, address, date,
            FROM Volunteer WHERE Volunteer_id=$volunteer_id";
    $res = mysqli_query($conn, $query);
    $volunteer = mysqli_fetch_assoc($res);
    if (!$volunteer) {
        msg("해당 봉사자가 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "volunteer_modify.php";
}

$shelters = array();
$query = "SELECT * FROM Shelter ORDER BY Shelter_id";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $shelters[$row['Shelter_id']] = $row['name'];
}

$last_id = -1;
$query = "SELECT Volunteer_id FROM Volunteer ORDER BY Volunteer_id DESC LIMIT 1";
$res = mysqli_query($conn, $query);
$row = mysqli_fetch_array($res);
$last_id = $row['Volunteer_id'];

?>
    <div class="container">
        <form name="volunteer_form" action="<?=$action?>" method="post" class="fullwidth">

            <h3>봉사자 <?=$mode?></h3>
            <input type="hidden" id="volunteer_id" name="volunteer_id"
                   value="<?= ($volunteer['Volunteer_id'] == '') ? $last_id+1 : $volunteer['Volunteer_id'] ?>"/>
            <p>
                <label for="volunteer_name">이름</label>
                <input type="text" id="volunteer_name" name="volunteer_name"
                       placeholder="김범준" value="<?= $volunteer['name'] ?>"/>
            </p>

            <p>
                <label for="volunteer_phone">전화번호</label>
                <input type="text" id="volunteer_phone" name="volunteer_phone"
                       placeholder="(323)122-4343" value="<?= $volunteer['phone'] ?>"/>
            </p>

            <p>
                <label for="volunteer_date">봉사 날짜</label>
                <input type="date" id="volunteer_date"
                       name="volunteer_date" value="<?= $volunteer['date'] ?>"/>
            </p>

            <p>
                <label for="volunteer_address">주소</label>
                <input id="volunteer_address" name="volunteer_address"
                        type="text" placeholder="경기 고양"/>
            </p>

            <p>
                <label for="shelter_id">보호소</label>
                <select id="shelter_id" name="shelter_id">
                    <option value="-1">선택해주세요</option>
                    <?
                    foreach($shelters as $id => $name) {
                        if($id == $volunteer['Shelter_id']){
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
                    if(document.getElementById("volunteer_name").value == "") {
                        alert ("이름을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("volunteer_phone").value == "") {
                        alert ("전화번호를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("volunteer_date").value == "") {
                        alert ("날짜를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("volunteer_address").value == "") {
                        alert ("주소를 입력해주세요"); return false;
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