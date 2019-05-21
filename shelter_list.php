<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "SELECT * FROM shelter ORDER BY shelter_id";
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
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['shelter_id']}</td>";
            echo "<td>{$row['shelter_name']}</td>";
            echo "<td>{$row['shelter_phone']}</td>";
            echo "<td>{$row['shelter_address']}</td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

</div>
<? include("footer.php") ?>
