<?php
session_start();

if (!isset($_SESSION['totalPrice'])) {
    header("Location: order.php");
    exit();
}


$totalPrice = $_SESSION['totalPrice'];
$paidAmount = $_SESSION['paidAmount'];
$change = $_SESSION['change'];
$dateTime = $_SESSION['dateTime'];


session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: left; 
            margin: 50px;
        }
        h2 {
            font-weight: bold;
            text-align: center; 

        }
        .receipt {
            font-weight: bold; 
            margin: 0 auto;
            width: 50%;
        }
    </style>
</head>
<body>
    <h2>RECEIPT</h2>
    <div class="receipt">
        <p>Total Price: <?php echo $totalPrice; ?></p>
        <p>You PAID: <?php echo $paidAmount; ?></p>
        <p>CHANGE: <?php echo $change; ?></p>
        <p><?php echo $dateTime; ?></p> 
    </div>
</body>
</html>
