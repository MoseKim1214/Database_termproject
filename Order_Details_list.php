<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Order_Details";
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<a href = 'Order_Details_menu.php' ><button class='button primary small'>음료수별 매출</button></a>
	<a href = 'Order_Details_store.php' ><button class='button primary small'>매장별 매출</button></a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>orderID</th>
            <th>IceHot</th>
            <th>addShot</th>
            <th>addWhip</th>
            <th>totalPrice</th>
            <th>menuID</th>
            <th>storeID</th>
            <th>saleID</th>
            <th>기능</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
        	echo "<td>{$row['orderID']}</td>";
        	echo "<td>{$row['IceHot']}</td>";
        	echo "<td>{$row['addShot']}</td>";
        	echo "<td>{$row['addWhip']}</td>";
        	echo "<td>{$row['totalPrice']}</td>";
        	echo "<td>{$row['menuID']}</td>";
        	echo "<td>{$row['storeID']}</td>";
        	echo "<td>{$row['saleID']}</td>";
           
           echo "<td width='17%'>
				 <a href='Order_Details_form.php?orderID={$row['orderID']}'><button class='button primary small'>수정</button></a>
				 <button onclick='javascript:deleteConfirm(\"{$row['orderID']}\", \"{$row['saleID']}\", {$row['totalPrice']})' class='button danger small'>삭제</button>
				 </td>";

            echo "</tr>";
            $row_index++;
        }
        ?>
        
    </table>
   
    <script>
        function deleteConfirm(orderID, saleID, totalPrice) {
            if (confirm("정말 삭제하시겠습니까?") == true){    //확인
                window.location = "Order_Details_delete.php?orderID=" + orderID + "&saleID=" + saleID + "&totalPrice=" + totalPrice;
            }else{   //취소
                return;
            }
        }
    </script>
</div>
<? include("footer.php") ?>
