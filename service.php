<?php
session_start();

// Membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","db_management_product");

// Tambah produk
if(isset($_POST['addproduct'])) {
    $productname = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $addtotable = mysqli_query($conn, "insert into product (product_name, deskripsi, price, stock) values('$productname', '$description', '$price', '$stock')");

    if($addtotable) {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
}

// Tambah supply product
if(isset($_POST['supplyproduct'])) {
    $product = $_POST['product'];
    $receiver = $_POST['receiver'];
    $quantity = $_POST['qty'];

    $checkstock = mysqli_query($conn, "select * from product where product_id='$product'");
    $getstock = mysqli_fetch_array($checkstock);
    $stock = $getstock['stock'];
    $addstockqtysupply = $stock + $quantity;

    $addsupply = mysqli_query($conn, "insert into supply (id_product, quantity, receiver) values('$product', '$quantity', '$receiver')");
    $updatestock = mysqli_query($conn, "update product set stock='$addstockqtysupply' where product_id='$product'");
    if($addsupply && $updatestock) {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
}

?>