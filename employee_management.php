<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "SELECT Abandonment_id, upkind, kind, date_begin, name 
            FROM Abandonment JOIN Shelter ON Abandonment.Shelter_id=Shelter.Shelter_id ORDER BY Abandonment_id";
    if (array_key_exists("search_keyword", $_GET)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_GET["search_keyword"];
        $query =  "SELECT Abandonment_id, upkind, kind, date_begin, name FROM Abandonment JOIN Shelter ON Abandonment.Shelter_id=Shelter.Shelter_id
                    WHERE name LIKE '%$search_keyword%' OR upkind LIKE '%$search_keyword%' OR kind LIKE '%$search_keyword%'
                    ORDER BY Abandonment_id";
    }
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die('Query Error : ' . mysqli_error());
    }
    ?>

    <div class="container">
        <ul class="pull-left">
            <a href="abandonment_form.php">
                <button type="button" class="button primary small">유기동물 등록</button>
            </a>
        </ul>
    </div>

    <form action="abandonment_management.php" method="get">
        <div class="container">
            <ul class="pull-right">
                <input type="text" name="search_keyword" placeholder="보호소명,축종,품종으로 검색"
                       style="padding:5px 0px 5px 0px; margin-bottom:20px " size="30">
            </ul>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>축종</th>
            <th>품종</th>
            <th>발견 날짜</th>
            <th>보호소이름</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='abandonment_view.php?abandonment_id={$row['Abandonment_id']}'>{$row['Abandonment_id']}</a></td>";
            echo "<td>{$row['upkind']}</td>";
//            echo "<td><a href='product_view.php?product_id={$row['product_id']}'>{$row['product_name']}</a></td>";
            echo "<td>{$row['kind']}</td>";
            echo "<td>{$row['date_begin']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td width='17%'>
                <a href='abandonment_form.php?abandonment_id={$row['Abandonment_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['Abandonment_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(abandonment_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "abandonment_delete.php?abandonment_id=" + abandonment_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
