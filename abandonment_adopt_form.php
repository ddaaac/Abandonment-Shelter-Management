<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

?>
    <div class="container">
        <form name="abandonment_adopting_family_form" action="abandonment_adopt.php" method="post" class="fullwidth">

            <h3>유기 동물 입양</h3>
            <input type="hidden" id="abandonment_id" name="abandonment_id"
                   value="<?= $_GET['abandonment_id']?>"/>
            <p>
                <label for="adopting_family_salary">월급</label>
                <input type="text" id="adopting_family_salary" name="adopting_family_salary"
                       placeholder="23.32"/>
            </p>

            <p>
                <label for="adopting_family_phone">전화번호</label>
                <input type="text" id="adopting_family_phone" name="adopting_family_phone"
                       placeholder="(322)343-2433"/>
            </p>

            <p>
                <label for="adopting_family_address">주소</label>
                <input type="text" id="adopting_family_address" name="adopting_family_address"
                        placeholder="경기 고양"/>
            </p>

            <p>
                <label for="adopting_family_house">거주형태</label>
                <input type="text" id="adopting_family_house" name="adopting_family_house"
                       placeholder="단독주택"/>
            </p>


            <p align="center" style="margin-top: 10px;"><button class="button primary large" onclick="javascript:return validate();">등록</button></p>

            <script>
                function validate() {
                    if(document.getElementById("adopting_family_salary").value == "") {
                        alert ("월급을 입력해주세요"); return false;
                    }
                    else if(document.getElementById("adopting_family_phone").value == "") {
                        alert ("전화번호를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("adopting_family_address").value == "") {
                        alert ("주소를 입력해주세요"); return false;
                    }
                    else if(document.getElementById("adopting_family_house").value == "") {
                        alert ("거주형태를 입력해주세요"); return false;
                    }
                    return true;
                }
            </script>

        </form>
    </div>
<? include("footer.php") ?>