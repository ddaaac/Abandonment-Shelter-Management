<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("volunteer_id", $_GET)) {
    $volunteer_id = $_GET["volunteer_id"];
    $query = "SELECT Volunteer_id, Volunteer.name, Volunteer.phone, address, date, Volunteer.Shelter_id, 
            Shelter.name AS Shelter_name, Shelter.phone AS Shelter_phone, city 
            FROM Volunteer JOIN Shelter ON Volunteer.Shelter_id=Shelter.Shelter_id WHERE Volunteer_id=$volunteer_id";
    $res = mysqli_query($conn, $query);
    $volunteer = mysqli_fetch_assoc($res);
    if (!$volunteer) {
        msg("해당 봉사자가 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>봉사자 상세 보기</h3>

        <p>
            <label for="volunteer_id">id</label>
            <input readonly type="text" id="volunteer_id" name="volunteer_id" value="<?= $volunteer['Volunteer_id'] ?>"/>
        </p>

        <p>
            <label for="volunteer_name">이름</label>
            <input readonly type="text" id="volunteer_name" name="volunteer_name" value="<?= $volunteer['name'] ?>"/>
        </p>

        <p>
            <label for="volunteer_phone">전화번호</label>
            <input readonly type="text" id="volunteer_phone" name="volunteer_phone" value="<?= $volunteer['phone'] ?>"/>
        </p>

        <p>
            <label for="volunteer_address">주소</label>
            <input readonly type="text" id="volunteer_address" name="volunteer_address" value="<?= $volunteer['address'] ?>"/>
        </p>

        <p>
            <label for="volunteer_date">봉사일자</label>
            <input readonly type="text" id="volunteer_date" name="volunteer_date" value="<?= $volunteer['date'] ?>"/>
        </p>

        <p>
            <label for="shelter_name">보호소 이름</label>
            <input readonly type="text" id="shelter_name" name="shelter_name" value="<?= $volunteer['Shelter_name'] ?>"/>
        </p>

        <p>
            <label for="shelter_phone">보호소 전화번호</label>
            <input readonly type="text" id="shelter_phone" name="shelter_phone" value="<?= $volunteer['Shelter_phone'] ?>"/>
        </p>

        <p>
            <label for="shelter_address">보호소 위치</label>
            <input readonly type="text" id="shelter_address" name="shelter_address" value="<?= $volunteer['city'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>