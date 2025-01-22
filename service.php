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

    // image
    $allowed_extension = array('jpg', 'png');
    $name = $_FILES['file']['name']; // get image name   
    $dot = explode('.', $name); // spread extension and name image
    $extension = strtolower(end($dot)); // get extension
    $size = $_FILES['file']['size']; // get size
    $file_tmp = $_FILES['file']['tmp_name']; // get file location
    
    // give name to file => encription
    $image = md5(uniqid($name,true) . time()).'.'.$extension; // combine encription file with that extension

    $addtotable = mysqli_query($conn, "insert into product (product_name, deskripsi, price, stock, image) values('$productname', '$description', '$price', '$stock', '$image')");

    $check = mysqli_query($conn, "select * from product where product_name = $name'");
    $hitung = mysqli_num_rows($check);

    // upload image
    if($hitung < 1) {
        if(in_array($extension,  $allowed_extension) === true) {
            // validation file size
            if($size<200000) {
                move_uploaded_file($file_tmp, 'images/'.$image);

                $addtotable = mysqli_query($conn, "insert into product (product_name, deskripsi, stock) values('$name','$deskripsi')");
                if($addtotable) {
                    header('location:index.php');
                } else {
                    echo 'Failed';
                    header('location:index.php');
                }
            } else {
                // if size more than 2mb
                echo '
                    <script>
                        alert("The size too large");
                        window.location.href = "index.php";
                    </script>
                ';
            }
        } else {
            // if it's not png or jpg
            echo '
                <script>
                    alert("File must in png or jpg");
                    window.location.href = "index.php";
                </script>
            ';
        }
    } else {
        // if done
        echo '
            <script>
                alert("Product had saved");
                window.location.href = "index.php";
            </script>
        ';
    }
}

// Tambah supply product
if(isset($_POST['supplyproduct'])) {
    $product = $_POST['product'];
    $note = $_POST['note'];
    $quantity = $_POST['qty'];

    $checkstock = mysqli_query($conn, "select * from product where product_id='$product'");
    $getstock = mysqli_fetch_array($checkstock);
    $stock = $getstock['stock'];
    $addstockqtysupply = $stock + $quantity;

    $addsupply = mysqli_query($conn, "insert into supply (id_product, quantity, receiver) values('$product', '$quantity', '$note')");
    $updatestock = mysqli_query($conn, "update product set stock='$addstockqtysupply' where product_id='$product'");
    if($addsupply && $updatestock) {
        header('location:supply-product.php');
    } else {
        header('location:500.html');
    }
}

// Tambah send product
if(isset($_POST['sendproduct'])) {
    $product = $_POST['product'];
    $receiver = $_POST['receiver'];
    $quantity = $_POST['qty'];

    $checkstock = mysqli_query($conn, "select * from product where product_id='$product'");
    $getstock = mysqli_fetch_array($checkstock);
    $stock = $getstock['stock'];
    $subtstockqtysend = $stock - $quantity;

    $addsend = mysqli_query($conn, "insert into send (id_product, quantity, receiver) values('$product', '$quantity', '$receiver')");
    $updatestock = mysqli_query($conn, "update product set stock='$subtstockqtysend' where product_id='$product'");
    if($addsend && $updatestock) {
        header('location:send-product.php');
    } else {
        header('location:500.html');
    }
}

// Update info product
if(isset($_POST['update'])) {
    $idproduct = $_POST['idproduct'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    // image
    $allowed_extension = array('jpg', 'png');
    $name = $_FILES['file']['name']; // get image name   
    $dot = explode('.', $name); // spread extension and name image
    $extension = strtolower(end($dot)); // get extension
    $size = $_FILES['file']['size']; // get size
    $file_tmp = $_FILES['file']['tmp_name']; // get file location

    // give name to file => encription
    $image = md5(uniqid($name,true) . time()).'.'.$extension; // combine encription file with that extension

    if($size == 0) {
        $update = mysqli_query($conn, "update product set product_name='$name', deskripsi='$description' where product_id='$idproduct'");
        if($update) {
            header('location:index.php');
        } else {
            header('location:index.php');
        }
    } else {
        move_uploaded_file($file_tmp, 'images/'.$image);
        $update = mysqli_query($conn, "update product set product_name='$name', deskripsi='$description', image='$image' where product_id='$idproduct'");
        if($update) {
            header('location:index.php');
        } else {
            header('location:index.php');
        }
    }
}

// Delete Product
if(isset($_POST['delete'])) {
    $name = $_POST['name'];
    $idproduct = $_POST['idproduct'];

    $image = mysqli_query($conn, "select * from product where product_id='$idproduct'");
    $get = mysqli_fetch_array($image);
    $img = 'images/'.$get['image'];
    unlink($img);

    $delete = mysqli_query($conn, "delete from product where product_id='$idproduct'");
    if($delete) {
        header('location:index.php');
    } else {
        header('location:index.php');
    }
}

?>