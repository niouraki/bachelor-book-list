<?php
$connection = mysqli_connect("localhost", "root", "", "books_list");

if(mysqli_connect_errno()){
    echo "Connection Failed: " . mysqli_connect_error();
}
?>