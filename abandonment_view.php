<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("abandonment_id", $_GET)) {
    $abandonment_id = $_GET["abandonment_id"];
    $query = "SELECT * FROM abandonment NATURAL JOIN shelter WHERE abandonment_id = $abandonment_id";
    $res = mysqli_query($conn, $query);
    $abandonment = mysqli_fetch_assoc($res);
    if (!$abandonment) {
        msg("해당 유기동물이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>유기 동물 상세 보기</h3>

        <p>
            <label for="abandonment_id">유기동물 id</label>
            <input readonly type="text" id="abandonment_id" name="abandonment_id" value="<?= $abandonment['abandonment_id'] ?>"/>
        </p>

        <p>
            <label for="abandonment_upkind">축종</label>
            <input readonly type="text" id="abandonment_upkind" name="abandonment_upkind" value="<?= $abandonment['abandonment_upkind'] ?>"/>
        </p>

        <p>
            <label for="abandonment_kind">품종</label>
            <input readonly type="text" id="abandonment_kind" name="abandonment_kind" value="<?= $abandonment['abandonment_kind'] ?>"/>
        </p>

        <p>
            <label for="abandonment_date">발견 날짜</label>
            <input readonly type="text" id="abandonment_date" name="abandonment_date" value="<?= $abandonment['abandonment_date'] ?>"/>
        </p>

        <p>
            <label for="abandonment_isneuter">중성화 여부</label>
            <input readonly type="text" id="abandonment_is_neuter" name="abandonment_is_neuter" value="<?= ($abandonment['abandonment_is_neuter']==0)? 'N' : 'Y'; ?>"/>
        </p>

        <p>
            <label for="shelter_name">보호소 이름</label>
            <input readonly type="text" id="shelter_name" name="shelter_name" value="<?= $abandonment['shelter_name'] ?>"/>
        </p>

        <p>
            <label for="shelter_phone">보호소 전화번호</label>
            <input readonly type="text" id="shelter_phone" name="shelter_phone" value="<?= $abandonment['shelter_phone'] ?>"/>
        </p>

        <p>
            <label for="shelter_address">보호소 위치</label>
            <input readonly type="text" id="shelter_address" name="shelter_address" value="<?= $abandonment['shelter_address'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>