<!DOCTYPE html>
<html lang='ko'>
<head>
    <title>Cafe Sem O</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<form action="Order_Customer_list.php" method="post">
    <div class='navbar fixed'>
        <div class='container'>
            <a class='pull-left title' href="index.php">Cafe Sem O</a>
            <ul class='pull-right'>
                <li>
                    <input type="text" name="search_keyword" placeholder="고객 포인트 조회">
                </li>
                <li><a href='Order_Sales_list.php'>주문매출 목록</a></li>
                <li><a href='Order_Details_list.php'>주문 상세 목록</a></li>
                <li><a href='Order_Details_form.php'>주문 등록</a></li>
                 <li><a href='Order_Customer_list.php'>주문 고객 목록</a></li>
                <li><a href='SemO_db.php'>Cafe Sem O DB</a></li>
            </ul>
        </div>
    </div>
</form>