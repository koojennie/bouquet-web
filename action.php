<?php
session_start();
require 'koneksi.php';

// Add products into the cart table
if (isset($_POST['pid'])) {
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $pprice = $_POST['pprice'];
    $pimage = $_POST['pimage'];
    $pcode = $_POST['pcode'];
    $pqty = $_POST['pqty'];
    $total_price = $pprice * $pqty;

    $stmt = $conn->prepare('SELECT bouquet_id FROM cart WHERE bouquet_id =?');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('i', $pid);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['bouquet_id'] ?? '';

    if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (bouquet_qty, total_price, bouquet_id) VALUES (?, ?, ?)');
		$query->bind_param('ssi',$pqty, $total_price, $pid);
		$query->execute();

        echo '<script>alert("data sudah masuk")</script>';
        echo '<div class="alert alert-success alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item added to your cart!</strong>
        </div>';
    } else {
        echo '<script>alert("data kagak masuk")</script>';
        echo '<div class="alert alert-danger alert-dismissible mt-2">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Item already added to your cart!</strong>
        </div>';
    }
}

// Get no.of items available in the cart table
if (isset($_GET['cartItem']) && $_GET['cartItem'] == 'cart_item') {
    $stmt = $conn->prepare('SELECT * FROM cart');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE cart_id=?');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('i', $id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item removed from the cart!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $stmt = $conn->prepare('DELETE FROM cart');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All Items removed from the cart!';
    header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
	$qty = $_POST['qty'];
	$pidc = $_POST['pidc'];
	$pprice = $_POST['pprice'];

	$tprice = $qty * $pprice;

	$stmt = $conn->prepare('UPDATE cart SET bouquet_qty=?, total_price=? WHERE cart_id=?');
	$stmt->bind_param('isi',$qty,$tprice,$pidc);
	$stmt->execute();
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && $_POST['action'] == 'order') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $products = $_POST['products'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];

    $data = '';

    $stmt = $conn->prepare('INSERT INTO orders (name, email, phone, address, pmode, products, amount_paid) VALUES (?, ?, ?, ?, ?, ?, ?)');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('sssssss', $name, $email, $phone, $address, $pmode, $products, $grand_total);
    $stmt->execute();
    
    $stmt2 = $conn->prepare('DELETE FROM cart');
    if (!$stmt2) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt2->execute();

    $data .= '<div class="text-center">
        <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
        <h2 class="text-success">Your Order Placed Successfully!</h2>
        <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $products . '</h4>
        <h4>Your Name : ' . $name . '</h4>
        <h4>Your E-mail : ' . $email . '</h4>
        <h4>Your Phone : ' . $phone . '</h4>
        <h4>Total Amount Paid : ' . number_format($grand_total) . '</h4>
        <h4>Payment Mode : ' . $pmode . '</h4>
    </div>';
    echo $data;
}
?>
