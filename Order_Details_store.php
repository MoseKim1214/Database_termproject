<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select Order_Details.storeID, storeCity, sum(totalPrice) from Order_Details left join Store on Order_Details.storeID = Store.storeID group by Order_Details.storeID, storeCity";
    
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<p>
    	<a href = 'Order_Details_list.php' ><button class='button primary small'>전체 조회</button></a>
    </p>
    <table class="table table-striped table-bordered">
        <tr>
            <th>No.</th>
            <th>매장 아이디</th>
            <th>도시</th>
            <th>총매출</th>
 
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['storeID']}</td>";
            echo "<td>{$row['storeCity']}</td>";
            echo "<td>{$row['sum(totalPrice)']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
    
</div>
<? include("footer.php") ?>
