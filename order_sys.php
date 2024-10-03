<?php
session_start();

$menu = [
    "Burgers" => 50,
    "Fries" => 75,
    "Steak" => 150
];

$totalPrice = 0;
$paidAmount = 0;
$change = 0;
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        
        $selectedOrder = $_POST['order'];
        $quantity = $_POST['quantity'];
        $paidAmount = $_POST['cash'];

        
        $totalPrice = $menu[$selectedOrder] * $quantity;

        
        if ($paidAmount >= $totalPrice) {
            $change = $paidAmount - $totalPrice;
            
            $_SESSION['totalPrice'] = $totalPrice;
            $_SESSION['paidAmount'] = $paidAmount;
            $_SESSION['change'] = $change;
            $_SESSION['dateTime'] = date("Y-m-d H:i:s");
            
            header("Location: receipt.php");
            exit();
        } else {
            
            header("Location: insufficient.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Menu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        h2 {
            font-weight: bold;
        }
        table {
            width: 50%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
        }
        .message {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Menu</h2>
    <table>
        <tr>
            <th>Order</th>
            <th>Amount</th>
        </tr>
        <?php foreach ($menu as $item => $price): ?>
            <tr>
                <td><?php echo $item; ?></td>
                <td><?php echo $price; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <form method="post">
        <label for="order">Select an order:</label>
        <select name="order" id="order" required>
            <option value="">--Select an Order--</option>
            <?php foreach ($menu as $item => $price): ?>
                <option value="<?php echo $item; ?>"><?php echo $item; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" min="1" required><br><br>

        <label for="cash">Cash:</label>
        <input type="number" name="cash" id="cash" min="0" required><br><br>

        <input type="submit" name="submit" value="Submit"><br><br>
    </form>

    <div class="message"><?php echo $message; ?></div>
</body>
</html>
