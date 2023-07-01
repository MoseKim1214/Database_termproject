<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select Dates, sum(Sales) from Order_Sales group by Dates";
    
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
	<p>
    	<a href = 'Order_Sales_list.php' ><button class='button primary small'>전체 조회</button></a>
    </p>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Dates</th>
            <th>sum(Sales)</th>
        </tr>
        <?
        
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row['Dates']}</td>";
            echo "<td>{$row['sum(Sales)']}</td>";
            echo "</tr>";
            
        }
        ?>
    </table>
    
</div>
<? include("footer.php") ?>
