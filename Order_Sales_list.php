<?
include "header.php";
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수
?>
<div class="container">
    <?
    $conn = dbconnect($host, $dbid, $dbpass, $dbname);
    $query = "select * from Order_Sales";
    // if (array_key_exists("search_keyword", $_POST)) {  // array_key_exists() : Checks if the specified key exists in the array
    //     $search_keyword = $_POST["search_keyword"];
    //     $query .= " where product_name like '%$search_keyword%' or manufacturer_name like '%$search_keyword%'";
    // }
    $result = mysqli_query($conn, $query);
    if (!$result) {
         die('Query Error : ' . mysqli_error());
    }
    ?>
     <p>
    	<a href = 'Order_Sales_dates.php' ><button class='button primary small'>일별 조회</button></a>
    </p>
    <table class="table table-striped table-bordered">
        <tr>
        	<th>No.</th>
            <th>saleID</th>
            <th>Sales</th>
            <th>Dates</th>
            <th>customerID</th>
        </tr>
        <?
        $row_index = 1;
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$row_index}</td>";
            echo "<td>{$row['saleID']}</td>";
            echo "<td>{$row['Sales']}</a></td>";
            echo "<td>{$row['Dates']}</td>";
            echo "<td>{$row['customerID']}</td>";
            echo "</tr>";
            $row_index++;
        }
        ?>
    </table>
   
</div>
<? include("footer.php") ?>
