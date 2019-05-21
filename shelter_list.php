<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "SELECT Shelter_id, Shelter.name, Shelter.phone, Shelter.city
              FROM Shelter ORDER BY Shelter_id";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die('Query Error : ' . mysqli_error());
    }
    ?>

    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>보호소이름</th>
            <th>전화번호</th>
            <th>위치</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['Shelter_id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['city']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>

</div>
<? include("footer.php") ?>
