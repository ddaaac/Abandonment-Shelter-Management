<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "abandonment_insert.php";

if (array_key_exists("abandonment_id", $_GET)) {
    $abandonment_id = $_GET["abandonment_id"];
    $query = "SELECT * FROM abandonment NATURAL JOIN shelter WHERE abandonment_id = $abandonment_id";
    $res = mysqli_query($conn, $query);
    $abandonment = mysqli_fetch_assoc($res);
    if (!$abandonment) {
        msg("해당 유기동물이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "abandonment_modify.php";
}

$shelters = shelter_array($conn);
$last_id = find_last_id('abandonment', $conn);

?>
    <div class="container">
        <form name="abandonment_form" action="<?=$action?>" method="post" class="fullwidth">

            <h3>유기 동물 <?=$mode?></h3>
            <input type="hidden" id="abandonment_id" name="abandonment_id"
                   value="<?= ($abandonment) ? $abandonment['abandonment_id'] : $last_id+1 ?>"/>
            <p>
                <label for="abandonment_upkind">축종</label>
                <input type="text" id="abandonment_upkind" name="abandonment_upkind"
                       placeholder="개" value="<?= $abandonment['abandonment_upkind'] ?>"/>
            </p>

            <p>
                <label for="abandonment_kind">품종</label>
                <input type="text" id="abandonment_kind" name="abandonment_kind"
                       placeholder="시베리안허스키" value="<?= $abandonment['abandonment_kind'] ?>"/>
            </p>

            <p>
                <label for="abandonment_date">발견 날짜</label>
                <input type="date" id="abandonment_date"
                       name="abandonment_date" value="<?= $abandonment['abandonment_date'] ?>"/>
            </p>

            <p>
                <label for="abandonment_is_neuter">중성화 여부</label>
                <select id="abandonment_is_neuter" name="abandonment_is_neuter">
                    <option value="1" <?= ($abandonment['abandonment_is_neuter']==1)? 'selected' : ''; ?>>Y</option>
                    <option value="0" <?= ($abandonment['abandonment_is_neuter']==0)? 'selected' : ''; ?>>N</option>
                    <option value ="-1"<?= ($abandonment)? '' : 'selected'; ?>>선택해주세요</option>
                </select>
            </p>

            <p>
                <label for="shelter_id">보호소</label>
                <select id="shelter_id" name="shelter_id">
                    <?
                        foreach($shelters as $id => $name) {
                            if($id == $abandonment['shelter_id']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            }  else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                    <option value="-1"<?= ($abandonment)? '' : 'selected'; ?>>선택해주세요</option>
                </select>
            </p>

            <p align="center" style="margin-top: 10px;"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                    if(document.getElementById("abandonment_upkind").value == "") {
                        alert ("축종을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("abandonment_kind").value == "") {
                        alert ("품종을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("abandonment_date").value == "") {
                        alert ("날짜를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("abandonment_is_neuter").value == "-1") {
                        alert ("중성화 여부를 선택해주세요"); return false;
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