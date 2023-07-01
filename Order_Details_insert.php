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

echo "menuID: ";
var_dump($menuID);
echo "saleID: ";
var_dump($saleID);
echo "IceHot: ";
var_dump($IceHot);
echo "addShot: ";
var_dump($addShot);
echo "addWhip: ";
var_dump($addWhip);
echo "storeID: ";
var_dump($storeID);
echo "totalPrice: ";
var_dump($totalPrice);
echo "orderID: ";
var_dump($orderID);

$result = mysqli_query($conn, "insert into Order_Details (orderID, IceHot, addShot, addWhip, totalPrice, menuID, storeID, saleID) values ('$orderID', '$IceHot', $addShot, '$addWhip', $totalPrice, '$menuID', '$storeID', '$saleID')");
mysqli_query($conn, "update Order_Sales SET Sales = Sales + $totalPrice where saleID = '$saleID'");
$updatePointQuery = "UPDATE Order_Customer SET Points = Points + ($totalPrice / 20) WHERE customerID = '$customerID'";
mysqli_query($conn, $updatePointQuery);
if(!$result)
{
    // msg('Query Error : '.mysqli_error($conn));
}
else
{
    s_msg ('성공적으로 입력 되었습니다');
    echo "<script>location.replace('Order_Details_list.php');</script>";
}

?>

