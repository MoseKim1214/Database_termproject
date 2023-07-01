<?
include "config.php";    //데이터베이스 연결 설정파일
include "util.php";      //유틸 함수

$conn = dbconnect($host,$dbid,$dbpass,$dbname);

$menuID = $_POST['menuID'];
$saleID = $_POST['saleID'];
$IceHot = $_POST['IceHot'];
$addShot = $_POST['addShot'];
$addWhip = $_POST['addWhip'];
$storeCity = $_POST['storeCity'];
$totalPrice = $_POST['totalPrice'];
$orderID = $_POST['orderID'];
$previousPrice = $_POST['previousPrice'];

$getCustomerIDQuery = "SELECT distinct customerID
FROM Order_Details
LEFT JOIN Order_Sales ON Order_Details.saleID = Order_Sales.saleID
WHERE Order_Sales.saleID = '$saleID'";
$getCustomerID = mysqli_query($conn, $getCustomerIDQuery);
$customerIDRow = mysqli_fetch_assoc($getCustomerID);
$customerID = $customerIDRow['customerID'];

$getStoreIDQuery = "Select storeID from Store where storeCity = '$storeCity'";
$getStoreID = mysqli_query($conn, $getStoreIDQuery);
$storeIDRow = mysqli_fetch_assoc($getStoreID);
$storeID = $storeIDRow['storeID'];


$result = mysqli_query($conn, "UPDATE Order_Details SET orderID = '$orderID', IceHot = '$IceHot', addShot = $addShot, addWhip = '$addWhip', totalPrice = $totalPrice, menuID = '$menuID', storeID = '$storeID', saleID = '$saleID' WHERE orderID = '$orderID'");


mysqli_query($conn, "update Order_Sales SET Sales = Sales + ($totalPrice - $previousPrice) where saleID = '$saleID'");
$updatePointQuery = "UPDATE Order_Customer SET Points = Points + (($totalPrice - $previousPrice) / 20) WHERE customerID = '$customerID'";

mysqli_query($conn, $updatePointQuery);
if(!$result)
{
    msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 수정 되었습니다');
    echo "<script>location.replace('Order_Details_list.php');</script>";
}

?>

