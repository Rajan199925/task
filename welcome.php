<?php
session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    die();
}

include 'config.php';

$query = mysqli_query($conn, "SELECT * FROM users WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);

    // echo "Welcome " . $row['name'] . " <a href='logout.php'>Logout</a>";
}

// Assuming you have retrieved the initial email and name values from a database or elsewhere

// Database credentials

if(isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    // Getting Post Values
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Query for data updation
    $query = mysqli_query($conn, "UPDATE users SET name='$name', email='$email' WHERE ID='$eid'");

    if ($query) {
        echo "<script>alert('You have successfully updated the data');</script>";
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}

?>

<?php
$eid = $_GET['editid'];
$ret = mysqli_query($conn, "SELECT * FROM users WHERE ID='$eid'");

while ($row = mysqli_fetch_array($ret)) {
?>

<h2>Update</h2>

<form method="POST">
    <div class="form-group">
        <?php
        include "config.php";
        ?>
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?php echo $row['name']; ?>" required="true">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" required="true">
        </div>

        <?php 
    }?>

    <div class="form-group">
        <button type="submit" class="btn btn-success btn-lg btn-block" name="submit">Update</button>
    </div>
</form>
