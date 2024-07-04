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

    $sess_user_id = $_SESSION['id_user'];

    $stmt = $conn->prepare('SELECT bouquet_id FROM cart WHERE bouquet_id =? AND user_id =?');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('ii', $pid, $sess_user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['bouquet_id'] ?? '';

    if (!$code) {
	    $query = $conn->prepare('INSERT INTO cart (bouquet_qty, total_price, bouquet_id, user_id) VALUES (?, ?, ?, ?)');
		$query->bind_param('ssii',$pqty, $total_price, $pid, $sess_user_id);
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
    $sess_user_id = $_SESSION['id_user'];
    $stmt = $conn->prepare('SELECT * FROM cart WHERE user_id = ?');
    $stmt->bind_param('i', $sess_user_id);
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;
    echo $rows;
}

// Remove single items from cart
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];

    $stmt = $conn->prepare('DELETE FROM cart WHERE cart_id = ? AND user_id = ?');
    $stmt->bind_param('ii', $id, $_SESSION['id_user']);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'Item has been removed!';
    header('location:cart.php');
}

// Remove all items at once from cart
if (isset($_GET['clear'])) {
    $sess_user_id = $_SESSION['id_user'];
    $stmt = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
    $stmt->bind_param('i', $sess_user_id);
    $stmt->execute();

    $_SESSION['showAlert'] = 'block';
    $_SESSION['message'] = 'All items have been removed!';
    header('location:cart.php');
}

// Set total price of the product in the cart table
if (isset($_POST['qty'])) {
    $qty = $_POST['qty'];
    $pid = $_POST['pidc'];
    $pprice = $_POST['pprice'];
    $tprice = $qty * $pprice;

    $sess_user_id = $_SESSION['id_user'];

    $stmt = $conn->prepare('UPDATE cart SET bouquet_qty = ?, total_price = ? WHERE cart_id = ? AND user_id = ?');
    $stmt->bind_param('isii', $qty, $tprice, $pid, $sess_user_id);
    $stmt->execute();
}

// Checkout and save customer info in the orders table
if (isset($_POST['action']) && $_POST['action'] == 'order') {
    $id_user = $_POST['session_user_id'];
    $userUsername = $_POST['session_user_username'];
    $grand_total = $_POST['grand_total'];
    $address = $_POST['address'];
    $pmode = $_POST['pmode'];

	$products = [];

	foreach ($_POST as $key => $value) {
        if (strpos($key, 'produk_id_') === 0) {
            $bouquet_id = str_replace('produk_id_', '', $key);
            $bouquet_qty_key = 'produk_qty_' . $bouquet_id;
            if (isset($_POST[$bouquet_qty_key])) {
                $products[] = [
                    'bouquet_id' => $value,
                    'bouquet_qty' => $_POST[$bouquet_qty_key]
                ];
            }
        }
    }

    $order_date = date('Y-m-d');

	// var_dump($_POST);
	// die;

    $data = '';

    // insert into table orders
    $stmt = $conn->prepare('INSERT INTO orders(address, pmode, amount_paid, id_user, order_date) VALUES (?, ?, ?, ?, ?)');
    if (!$stmt) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt->bind_param('sssis', $address, $pmode, $grand_total, $id_user, $order_date);
    $stmt->execute();

    if($stmt->error){
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    } else {
        $order_id = $conn->insert_id;
        // echo "New order created successfully with ID: " . $order_id;
    }

    // inserts into table orderDetail
    $orderDetailstmt = $conn->prepare('INSERT INTO order_detail(bouquet_id, qty ,order_id) VALUES(?, ?, ?)');

    foreach ($products as $productKey => $product) {
        $bouquet_id = $product['bouquet_id'];
        $bouquet_qty = $product['bouquet_qty']; 

        $orderDetailstmt->bind_param("iii", $bouquet_id, $bouquet_qty, $order_id);
        if(!$orderDetailstmt->execute()){
            echo "Error: ". $orderDetailStmt->error();
        }
    }

    $orderDetailstmt->close();

    $stmt = $conn->prepare('SELECT * FROM cart INNER JOIN tb_user ON cart.user_id = tb_user.id_user where cart.user_id = ?');
    $stmt->bind_param('i', $id_user);
    $stmt->execute();
    $resultUser = $stmt->get_result()->fetch_assoc();
    
    $stmt2 = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
    $stmt2->bind_param('i', $id_user);
    
    if (!$stmt2) {
        echo "Prepare failed: (" . $conn->errno . ") " . $conn->error;
    }
    $stmt2->execute();

    $itemsPurchased = [];
    foreach ($products as $product) {
        $stmtBouquet = $conn->prepare('SELECT bouquet_name FROM tb_produk WHERE bouquet_id = ?');
        $stmtBouquet->bind_param('i', $product['bouquet_id']);
        $stmtBouquet->execute();
        $resultBouquet = $stmtBouquet->get_result()->fetch_assoc();
        $stmtBouquet->close();
        
        $itemsPurchased[] = $resultBouquet['bouquet_name'] . ' (' . $product['bouquet_qty'] . ')';
    }

    $itemsPurchasedDisplay = implode(', ', $itemsPurchased);


    $data .= '<div class="text-center">
        <h1 class="display-4 mt-2 text-danger">Thank You!</h1>
        <h2 class="text-success">Your Order Placed Successfully!</h2>
        <h4 class="bg-danger text-light rounded p-2">Items Purchased : ' . $itemsPurchasedDisplay . ' </h4>
        <h4>Your Name : ' . $resultUser['nama_user'] . '</h4>
        <h4>Your E-mail : ' . $resultUser['email_user'] . '</h4>
        <h4>Your Phone : ' . $resultUser['notelp_user'] . '</h4>
        <h4>Total Amount Paid : Rp.' . number_format($grand_total) . '</h4>
        <h4>Payment Mode : ' . $pmode . '</h4>
    </div>';
    echo $data;
}
?>
