<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);

if (array_key_exists("product_id", $_GET)) {
    $product_id = $_GET["product_id"];
    $query = "select * from product natural join manufacturer where product_id = $product_id";
    $res = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($res);
    if (!$product) {
        msg("물품이 존재하지 않습니다.");
    }
}
?>
    <div class="container fullwidth">

        <h3>상품 정보 상세 보기</h3>

        <p>
            <label for="product_id">상품 코드</label>
            <input readonly type="text" id="product_id" name="product_id" value="<?= $product['product_id'] ?>"/>
        </p>

        <p>
            <label for="manufacturer_id">제조사 코드</label>
            <input readonly type="text" id="manufacturer_id" name="manufacturer_id" value="<?= $product['manufacturer_id'] ?>"/>
        </p>

        <p>
            <label for="manufacturer_name">제조사</label>
            <input readonly type="text" id="manufacturer_name" name="manufacturer_name" value="<?= $product['manufacturer_name'] ?>"/>
        </p>

        <p>
            <label for="product_name">상품명</label>
            <input readonly type="text" id="product_name" name="product_name" value="<?= $product['product_name'] ?>"/>
        </p>

        <p>
            <label for="product_desc">상품설명</label>
            <textarea readonly id="product_desc" name="product_desc" rows="10"><?= $product['product_desc'] ?></textarea>
        </p>

        <p>
            <label for="price">가격</label>
            <input readonly type="number" id="price" name="price" value="<?= $product['price'] ?>"/>
        </p>
    </div>
<? include("footer.php") ?>