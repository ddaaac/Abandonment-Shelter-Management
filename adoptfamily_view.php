<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("abandonment_id", $_GET)) {
    $abandonment_id = $_GET["abandonment_id"];
    $query = "SELECT * FROM abandonment NATURAL JOIN adopting_family WHERE adopting_family.abandonment_id = $abandonment_id";
    $res = mysqli_query($conn, $query);
    $adopting_family = mysqli_fetch_assoc($res);
    if (!$adopting_family) {
        msg("해당 유기동물이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>입양 가족 상세 보기</h3>

        <p>
            <label for="abandonment_id">입양동물 id</label>
            <input readonly type="text" id="abandonment_id" name="abandonment_id" value="<?= $adopting_family['abandonment_id'] ?>"/>
        </p>

        <p>
            <label for="adopting_family_salary">월급</label>
            <input readonly type="text" id="adopting_family_salary" name="adopting_family_salary" value="<?= $adopting_family['adopting_family_salary'] ?>"/>
        </p>

        <p>
            <label for="adopting_family_phone">전화번호</label>
            <input readonly type="text" id="adopting_family_phone" name="adopting_family_phone" value="<?= $adopting_family['adopting_family_phone'] ?>"/>
        </p>

        <p>
            <label for="adopting_family_address">주소</label>
            <input readonly type="text" id="adopting_family_address" name="adopting_family_address" value="<?= $adopting_family['adopting_family_address'] ?>"/>
        </p>

        <p>
            <label for="adopting_family_house">거주 형태</label>
            <input readonly type="text" id="adopting_family_house" name="adopting_family_house" value="<?= $adopting_family['adopting_family_house']?>"/>
        </p>
    </div>
<? include("footer.php") ?>