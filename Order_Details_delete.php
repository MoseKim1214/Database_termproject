<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$orderID = $_GET['orderID'];
$temp = $_GET['saleID'];
$totalPrice = $_GET['totalPrice'];

$flag = 0;

$countQuery = "select count(orderID) as orderCount from Order_Details where saleID = '$temp'";
$countResult = mysqli_query($conn, $countQuery);
$countRow = mysqli_fetch_assoc($countResult);
$orderCount = $countRow['orderCount'];


//주문고객의 customerID를 가져오기 
$getCustomerIDQuery = "SELECT distinct customerID
FROM Order_Details
LEFT JOIN Order_Sales ON Order_Details.saleID = Order_Sales.saleID
WHERE Order_Sales.saleID = '$temp'";
$getCustomerID = mysqli_query($conn, $getCustomerIDQuery);
$customerIDRow = mysqli_fetch_assoc($getCustomerID);
$customerID = $customerIDRow['customerID'];


$flag = 1;

if ($flag == '1'){
	
	if ($orderCount == '1') {
		
		mysqli_query($conn, "delete from Order_Details where orderID = '$orderID'");
		$deleteSaleQuery = "delete from Order_Sales where saleID = '$temp'";
		mysqli_query($conn, $deleteSaleQuery);
		
	} else {
		mysqli_query($conn, "delete from Order_Details where orderID = '$orderID'");
		mysqli_query($conn, "update Order_Sales SET Sales = Sales - $totalPrice where saleID = '$temp'");
	}
	
	$updatePointQuery = "UPDATE Order_Customer SET Points = Points - ($totalPrice / 20) WHERE customerID = '$customerID'";
	mysqli_query($conn, $updatePointQuery);
	
	 s_msg ('성공적으로 삭제 되었습니다');
	    echo "<meta http-equiv='refresh' content='0;url=Order_Details_list.php'>";

} else {
	msg('Query Error : '.mysqli_error($conn));
}

?>

