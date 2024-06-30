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

    $stmt = $conn->prepare('SELECT bouquet_id FROM cart WHERE bouquet_id = ? AND user_id = ?');
    $stmt->bind_param('ii', $pid, $sess_user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $code = $r['bouquet_id'] ?? '';

    if (!$code) {
        $query = $conn->prepare('INSERT INTO cart (bouquet_qty, total_price, bouquet_id, user_id) VALUES (?, ?, ?, ?)');
        $query->bind_param('ssii', $pqty, $total_price, $pid, $sess_user_id);
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
