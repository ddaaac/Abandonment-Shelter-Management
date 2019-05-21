<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "SELECT * FROM abandonment NATURAL JOIN shelter NATURAL LEFT OUTER JOIN adopting_family";
    if (array_key_exists("search_keyword", $_GET)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_GET["search_keyword"];
        $query =  $query . " WHERE shelter_name LIKE '%$search_keyword%' OR abandonment_upkind LIKE '%$search_keyword%' OR abandonment_kind LIKE '%$search_keyword%'";
    }
    $query = $query . " ORDER BY abandonment_id";
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
            <th>입양</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td><a href='abandonment_view.php?abandonment_id={$row['abandonment_id']}'>{$row['abandonment_id']}</a></td>";
            echo "<td>{$row['abandonment_upkind']}</td>";
            echo "<td>{$row['abandonment_kind']}</td>";
            echo "<td>{$row['abandonment_date']}</td>";
            echo "<td>{$row['shelter_name']}</td>";
            echo "<td>";
            echo ($row['adopting_family_phone'] == "") ?
                "<a href = 'abandonment_adopt_form.php?abandonment_id={$row['abandonment_id']}' ><button class='button small'> 입양</button ></a>" :
                "<a href = 'adoptfamily_view.php?abandonment_id={$row['abandonment_id']}'>입양완료</a>";
            echo "</td>";
            echo "<td width='17%'>
                <a href='abandonment_form.php?abandonment_id={$row['abandonment_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['abandonment_id']})' class='button danger small'>삭제</button></td>";
            echo "</tr>";
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
