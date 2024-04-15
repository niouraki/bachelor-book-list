<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="book_list_styles.scss">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ce3703125e.js" crossorigin="anonymous"></script>
    <title>Book table</title>
</head>

<body>
<?php
include "dbconnection.php";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$query = '';
$result;

//if the user has searched a term show only data for search
if (isset($_POST["submit-search"])) {
    // user adds sth in the input search, otherwise fetch all the data
    if(!empty($_POST['search'])) {
        $searchValue = $_POST['search'];
        $query = "SELECT * FROM books_list WHERE book_title LIKE '%$searchValue%' OR author_first_name LIKE '%$searchValue%' OR author_last_name LIKE '%$searchValue%' OR publication_year LIKE '$searchValue'";
    } else {
        $query = "SELECT * FROM books_list";
    }
} else {
//    if not get all the data
    $query = "SELECT * FROM books_list";
//    $result = mysqli_query($connection, $query);
}

$result = mysqli_query($connection, $query);
$number_of_rows=mysqli_num_rows($result);


?>

<h1>My Books</h1>

<div class="actions-row">
    <form method="POST">
        <div class="d-inline-block search-wrapper">
            <label for="searchInput">Search books</label>
            <input type="text" name="search" id="searchInput" placeholder="Search by book title, author name or publication year">
        </div>

        <button type="submit" name="submit-search">Search</button>
    </form>

    <a href="book_form.html" class="add-book">Add a new book</a>
</div>

<?php
if($number_of_rows>0){
?>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead class="table-light">
        <tr>
            <th>#</th>
            <th class="text-nowrap">Book title</th>
            <th class="text-nowrap">Publication year</th>
            <th class="text-nowrap">Author full name</th>
            <th class="text-nowrap">Reading status</th>
            <th class="text-nowrap">ISBN</th>
            <th class="text-nowrap">Publisher</th>
        </tr>
        </thead>

        <tbody>
        <?php
                 while ($rowdata=mysqli_fetch_array($result)) {
        ?>
        <tr>

            <td><?php echo $rowdata['book_id'];?></td>
            <td><?php echo $rowdata['book_title'];?></td>
            <td><?php echo $rowdata['publication_year'];?></td>
            <td><?php echo $rowdata['author_first_name'] . " " . $rowdata['author_last_name'];?></td>
            <td>
                <?php
                if($rowdata['is_read']==1){
                    echo("Read");
                } else {
                    echo("Unread");
                }
                ?>
            </td>
            <td>
                <?php
                    if ($rowdata['isbn']) {
                        echo $rowdata['isbn'];
                    } else {
                        echo "-";
                    }
                ?>
            </td>
            <td>
                <?php
                if ($rowdata['publisher']) {
                    echo $rowdata['publisher'];
                } else {
                    echo "-";
                }
                ?>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>

    <?php } else { ?>

        <div class="no-results">No results found</div>
    <?php } ?>
</div>


</body>
</html>