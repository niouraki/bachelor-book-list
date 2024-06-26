<?php
include "dbconnection.php";

// comment in to display error messages
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

if(isset($_POST['submit'])){
    //getting the post values
    $bookTitle = htmlspecialchars($_POST["book_title"]);
    $publication = $_POST['publication_year'];
    $firstName = htmlspecialchars($_POST['author_first_name']);
    $lastName = htmlspecialchars($_POST['author_last_name']);
    $readingStatus = $_POST['reading_status'];

    $isbn = isset($_POST['isbn']) ? strval($_POST['isbn']) : null;

    $publisher = isset($_POST['publisher']) ? htmlspecialchars($_POST['publisher']) : NULL;
    
    // create the query
    $sqlQuery = "INSERT INTO books_list (book_title, publication_year, author_first_name, author_last_name, is_read, isbn, publisher)
                value ('$bookTitle', '$publication', '$firstName', '$lastName', '$readingStatus', '$isbn', '$publisher')";

    if(mysqli_query($connection, $sqlQuery)){
        header("Location: index.php");
    } else {
        echo "There was a problem. Please try again";
    }
}

mysqli_close($connection);

?>
