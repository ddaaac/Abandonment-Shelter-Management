<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$shelters = array();
$query = "SELECT * FROM Shelter ORDER BY Shelter_id";
$res = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($res)) {
    $shelters[$row['Shelter_id']] = $row['name'];
}
?>

<div class="container">
    <?
    $query = "SELECT Employee_id, Employee.name, Employee.phone, salary, Employee.Shelter_id, 
            Shelter.name AS Shelter_name, Shelter.phone AS Shelter_phone, Shelter.city AS Shelter_city 
            FROM Employee JOIN Shelter ON Employee.Shelter_id=Shelter.Shelter_id";
    if (array_key_exists("search_keyword", $_GET)) {  // array_key_exists() : Checks if the specified key exists in the array
        $search_keyword = $_GET["search_keyword"];
        $query = $query . " WHERE Employee.name LIKE '%$search_keyword%'";
    }
    if (array_key_exists("shelter_select", $_GET) && $_GET["shelter_select"] != "") {
        $shelter_select = $_GET["shelter_select"];
        $query = $query . " HAVING Shelter_id=$shelter_select";
    }
    $query = $query . " ORDER BY Employee_id";
    $res = mysqli_query($conn, $query);
    if (!$res) {
        die('Query Error : ' . mysqli_error());
    }
    ?>

    <div class="container">
        <ul class="pull-left">
            <a href="employee_form.php">
                <button type="button" class="button primary small">담당자 등록</button>
            </a>
        </ul>
    </div>
    <form action="employee_management.php" method="get">
        <div class="container">
            <ul class="pull-right">
                <input type="text" name="search_keyword" placeholder="담당자 이름으로 검색"
                       style="padding:5px 0px 5px 0px; margin-bottom:20px " size="30">
            </ul>
            <ul class="pull-right">
                <select id="shelter_select" name="shelter_select">
                    <option value="">보호소 선택</option>
                    <?
                    foreach($shelters as $id => $name) {
                        if(array_key_exists("shelter_select", $_GET) && $_GET['shelter_select'] != "" && $_GET['shelter_select'] == $id){
                            echo "<option value='{$id}' selected>{$name}</option>";
                        }  else {
                            echo "<option value='{$id}'>{$name}</option>";
                        }
                    }
                    ?>
                </select>
            </ul>
        </div>
    </form>
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>이름</th>
            <th>전화번호</th>
            <th>월급</th>
            <th>보호소이름</th>
            <th>기능</th>
        </tr>
        </thead>
        <tbody>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($res)) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td>{$row['salary']}</td>";
            echo "<td>{$row['Shelter_name']}</td>";
            echo "<td width='17%'>
                <a href='employee_form.php?employee_id={$row['Employee_id']}'><button class='button primary small'>수정</button></a>
                 <button onclick='javascript:deleteConfirm({$row['Employee_id']})' class='button danger small'>삭제</button>
                </td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
        </tbody>
    </table>
    <script>
        function deleteConfirm(employee_id) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "employee_delete.php?employee_id=" + employee_id;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
