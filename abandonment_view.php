<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

일부러 내는 에러@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
// view에 입양가족 볼수있게 추가!!!!

if (array_key_exists("abandonment_id", $_GET)) {
    $abandonment_id = $_GET["abandonment_id"];
    $query = "SELECT Abandonment_id, upkind, kind, date_begin, is_neuter, name, phone, city
                FROM Abandonment JOIN Shelter ON Abandonment.Shelter_id=Shelter.Shelter_id where Abandonment_id = $abandonment_id";
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
            <input readonly type="text" id="abandonment_id" name="abandonment_id" value="<?= $abandonment['Abandonment_id'] ?>"/>
        </p>

        <p>
            <label for="abandonment_upkind">축종</label>
            <input readonly type="text" id="abandonment_upkind" name="abandonment_upkind" value="<?= $abandonment['upkind'] ?>"/>
        </p>

        <p>
            <label for="abandonment_kind">품종</label>
            <input readonly type="text" id="abandonment_kind" name="abandonment_kind" value="<?= $abandonment['kind'] ?>"/>
        </p>

        <p>
            <label for="abandonment_date">유기 날짜</label>
            <input readonly type="text" id="abandonment_date" name="abandonment_date" value="<?= $abandonment['date_begin'] ?>"/>
        </p>

        <p>
            <label for="abandonment_isneuter">중성화 여부</label>
            <input readonly type="text" id="abandonment_isneuter" name="abandonment_isneuter" value="<?= ($abandonment['is_neuter']==0)? 'N' : 'Y'; ?>"/>
        </p>

        <p>
            <label for="shelter_name">보호소 이름</label>
            <input readonly type="text" id="shelter_name" name="shelter_name" value="<?= $abandonment['name'] ?>"/>
        </p>

        <p>
            <label for="shelter_phone">보호소 전화번호</label>
            <input readonly type="text" id="shelter_phone" name="shelter_phone" value="<?= $abandonment['phone'] ?>"/>
        </p>

        <p>
            <label for="shelter_address">보호소 위치</label>
            <input readonly type="text" id="shelter_address" name="shelter_address" value="<?= $abandonment['city'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>