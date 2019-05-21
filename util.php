<?php
function dbconnect($host, $id, $pass, $db)  //데이터베이스 연결
{
    $conn = mysqli_connect($host, $id, $pass, $db);

    if ($conn == false) {
        die('Not connected : ' . mysqli_error());
    }

    return $conn;
}

function msg($msg) // 경고 메시지 출력 후 이전 페이지로 이동
{
    echo "
        <script>
             window.alert('$msg');
             history.go(-1);
        </script>";
    exit;
}

function s_msg($msg) //일반 메시지 출력
{
    echo "
        <script>
            window.alert('$msg');
        </script>";
}

function shelter_array($conn) //shelter[shelter_id] = shelter_name인 배열을 반환
{
    $shelters = array();
    $query = "SELECT * FROM shelter ORDER BY shelter_id";
    $res = mysqli_query($conn, $query);
    while($row = mysqli_fetch_array($res)) {
        $shelters[$row['shelter_id']] = $row['shelter_name'];
    }
    return $shelters;
}

function find_last_id($table_name, $conn) // 테이블에 새로운 튜플 추가시, 마지막 id를 반환해서 그 다음 id에 추가할 수 있게 해주는 함수
{
    $query = "SELECT {$table_name}_id FROM {$table_name} ORDER BY {$table_name}_id DESC LIMIT 1";
    $res = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($res);
    $last_id = $row[$table_name.'_id'];

    return $last_id;
}
?>
