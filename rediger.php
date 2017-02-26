<?php
include 'header.php';
include 'session.php';

if (isset($_POST['id'])) {
    //If an edited article has been submitted
    update();
} else if (isset($_GET['id'])) {
	//If an article header has been selected to edit
    showForm();
} else {
    header('Location: ../innlogget.php');
}

//Generate a form to edit the article
function showForm()
{
    $id = $_GET['id'];
    global $db;
    $query = "SELECT webcontent.Title, webcontent.Content, webcontent.UserID, webcontent.ID, users.FullName from webcontent, users where webcontent.UserID = users.UserID and webcontent.ID =" . $id;
    $result = $db->DoQuery($query);
    if ($result->GetNumrows() == 1) {
        $post = $result->GetNextRow();
        echo '<form id="update" action="rediger.php" method="POST">';
        echo '<input type="hidden" name="id" value = "' . $post['ID'] . '"> <br>';
        echo 'Title: <br> <input type="text" name="title" value = "' . $post['Title'] . '"> <br>';
        echo 'Content: <br> <textarea name="content" cols="100" rows="20">' . $post['Content'] . '</textarea> <br>';
        echo ' <input type="submit" value="Submit">';
        echo '</form>';
    } else {
        //Something's wrong..
        header('Location: ../innlogget.php');


    }
}

//Update the submitted article
function update()
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    global $db;
    $query = "UPDATE webcontent SET Title = '" . mysql_escape_string($title) . "', Content ='" . mysql_escape_string($content) . "' where ID =" . $id;
    $db->DoQuery($query);
    header('Location: ../innlogget.php');

}


include 'footer.php';

?>
