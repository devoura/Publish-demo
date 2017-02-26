<?php
include 'header.php';
include 'session.php';

echo '<h1> Hei, ' . $_SESSION['full_name'] . ' </h1>';
echo '<a href ="logout.php"> Logout </a>';

$query = "SELECT webcontent.Title, webcontent.Content, webcontent.UserID, webcontent.ID, users.FullName from webcontent, users where webcontent.UserID = users.UserID";
$result = $db->DoQuery($query);
foreach ($result->GetResult() as $content) {
    echo '<a href="rediger.php/?id=' . $content['ID'] . '"> <h1>' . $content['Title'] . '</h1> </a>';
    echo '<h4>Written by: ' . $content['FullName'] . '</h4> ';
    echo '<p>' . $content['Content'] . '</p>';
}

include 'footer.php';
?>