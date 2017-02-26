<?php
include 'header.php';

if (isset($_SESSION['user_login'])) {
    header("location:innlogget.php");
}

?>

    <form id="login" action="login.php" method="POST">
        Username:<br>
        <input type="text" name="username" required><br>
        Password:<br>
        <input type="password" name="password" required><br>
        <input type="submit" value="Submit">
    </form>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
include 'footer.php';
?>