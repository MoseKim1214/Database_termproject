<?
include "config.php";    //데이터베이스 연결 설정파일
include "header.php";
include "util.php";      //유틸 함수

$conn = dbconnect($host, $dbid, $dbpass, $dbname);
$mode = "입력";
$action = "Order_Details_insert.php";

if (array_key_exists("orderID", $_GET)) {
    $orderID = $_GET["orderID"];
    $query =  "select * from Order_Details left join Order_Sales on Order_Details.saleID = Order_Sales.saleID where orderID = '$orderID'";
    $result = mysqli_query($conn, $query);
    $order = mysqli_fetch_array($result);
    if(!$order) {
        msg("주문이 존재하지 않습니다.");
    }
    $mode = "수정";
    $action = "Order_Details_modify.php";
}

$menu = array();

$query = "select * from Menu";
$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_array($result)) {
    $menu[$row['menuID']] = $row['menuName'];
}
?>
    <div class="container">
        <form name="Order_Details_form" action="<?=$action?>" method="post" class="fullwidth">
            <input type="hidden" name="orderID" value="<?=$order['orderID']?>"/>
            <h3>주문 정보 <?=$mode?></h3>
            <p>
                <label for="menuID">메뉴</label>
                <select name="menuID" id="menuID">
                    <option value="-1">선택해 주십시오.</option>
                    <?
                        foreach($menu as $id => $name) {
                            if($id == $order['menuID']){
                                echo "<option value='{$id}' selected>{$name}</option>";
                            } else {
                                echo "<option value='{$id}'>{$name}</option>";
                            }
                        }
                    ?>
                </select>
            </p>
            <p>
                <label for="saleID">매출 아이디</label>
                <input type="text" placeholder="saleID" id="saleID" name="saleID" value="<?=$order['saleID']?>" />
            </p>
            <p>
                <label for="orderID">주문 아이디</label>
                <input type="text" placeholder="orderID" id="orderID" name="orderID" value="<?=$order['orderID']?>" />
            </p>
            <p>
                <label for="IceHot">아이스/핫</label>
                <input type="text" placeholder="Ice/Hot" id="IceHot" name="IceHot" value="<?=$order['IceHot']?>" />
            </p>
            <p>
                <label for="addShot">샷 추가</label>
                <input type="number" placeholder="정수 입력" id="addShot" name="addShot" value="<?=$order['addShot']?>" />
            </p>
			<p>
			    <label for="addWhip">휘핑 추가</label>
			    <select name="addWhip" id="addWhip">
			        <option value="-1">선택해 주십시오.</option>
			        <option value="1">휘핑 O</option>
			        <option value="0">휘핑 X</option>
			    </select>
			</p>
			<p>
			    <label for="storeCity">매장 위치</label>
			    <select name="storeCity" id="storeCity">
			        <option value="-1">선택해 주십시오.</option>
			        <option value="Seoul">서울</option>
			        <option value="Pusan">부산</option>
			    </select>
			</p>

            
          
            <p>
                <label for="totalPrice">가격</label>
                <input type="number" placeholder="정수로 입력" id="totalPrice" name="totalPrice" value="<?=$order['totalPrice']?>" />
                <input type="hidden" name="previousPrice" value= "<?=$order['totalPrice']?>"/>
            </p>

            <p align="center"><button class="button primary large" onclick="javascript:return validate();"><?=$mode?></button></p>

            <script>
                function validate() {
                	if(document.getElementById("menuID").value == "-1") {
                        alert ("메뉴를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("saleID").value == "") {
                        alert ("매출 아이디를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("orderID").value == "") {
                        alert ("주문 아이디를 입력해 주십시오"); return false;
                    }
                    else if(document.getElementById("IceHot").value == "") {
                        alert ("음료 온도를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("addShot").value == "") {
                        alert ("샷추가 여부를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("addWhip").value == "") {
                        alert ("휘핑 추가 여부를 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("storeCity").value == "") {
                        alert ("매장을 선택해 주십시오"); return false;
                    }
                    else if(document.getElementById("price").value == "") {
                        alert ("가격을 입력해 주십시오"); return false;
                    }
                    return true;
                }
            </script>
			
        </form>
    </div>
<? include("footer.php") ?>