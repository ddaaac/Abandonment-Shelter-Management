<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "SELECT Volunteer_id, Volunteer.name, Volunteer.phone, address, date, Volunteer.Shelter_id, Shelter.name AS Shelter_name 
            FROM Volunteer JOIN Shelter ON Volunteer.Shelter_id=Shelter.Shelter_id ORDER BY Volunteer_id";
    if (array_key_exists("search_keyword", $_GET)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_GET["search_keyword"];
        $query = "SELECT Volunteer_id, Volunteer.name, Volunteer.phone, address, date, Volunteer.Shelter_id, Shelter.name AS Shelter_name 
            FROM Volunteer JOIN Shelter ON Volunteer.Shelter_id=Shelter.Shelter_id
            WHERE Volunteer.name LIKE '%$search_keyword%' ORDER BY Volunteer_id";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die('Query Error : ' . mysqli_error());
    }
    ?>

    <div class="container">
        <ul class="pull-left">
            <a href="volunteer_form.php">
                <button type="button" class="button primary small">봉사자 등록</button>
            </a>
        </ul>
    </div>

    <form action="volunteer_management.php" method="get">
        <div class="container">
            <ul class="pull-right">
                <input type="text" name="search_keyword" placeholder="봉사자 이름으로 검색" style="padding:5px 0px 5px 0px; margin-bottom:20px " size="30">
            </ul>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>이름</th>
            <th>봉사 날짜</th>
            <th>보호소이름</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='volunteer_view.php?volunteer_id={$row['Volunteer_id']}'>{$row['name']}</a></td>";
            echo "<td>{$row['date']}</td>";
            echo "<td>{$row['Shelter_name']}</td>";
            echo "<td width='17%'>
                 <button onclick='javascript:deleteConfirm({$row['Volunteer_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(volunteer_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "volunteer_delete.php?volunteer_id=" + volunteer_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
