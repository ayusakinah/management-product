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
    $quantity = $_POST['qty']

    $addsupply = mysqli_query($conn, "insert into supply (id_product, quantity, receiver) values('$product', '$quantity, '$receiver')");

    if($addsupply) {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
}

?>