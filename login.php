<?php

include 'database.php';
session_start();


if (isset($_POST)) {
    checkLogin();
}

function checkLogin()
{
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (!empty($username) && !empty($password)) {
        checkCredentials($username, $password);
    } else {
        //Username and/or Password not filled out
        redirectToIndex('Please Fill out Username and Password');
    }
}


function checkCredentials($username, $password)
{
    global $db;
    $query = "SELECT HashedPassword, FullName from users where Username = '" .mysql_escape_string($username) . "'";
    $result = $db->DoQuery($query);
    if ($result->GetNumrows() == 1) {
        $firstRow = $result->GetNextRow();
        if (password_verify($password, $firstRow['HashedPassword'])) {
            //login ok
            performLogin($username, $firstRow['FullName']);
        } else {
            //Wrong Password
            redirectToIndex('Wrong Username and/or Password');
        }
    } else {
        //Username not found, Should not return more than one as username is unique
        //same error message as wrong password to not reveal unnecessary information
        redirectToIndex('Wrong Username and/or Password');
    }
}


function errorMessage($msg)
{
    $_SESSION['message'] = $msg;
}


function redirectToIndex($msg)
{
    errorMessage($msg);
    header('Location: index.php');
    exit;
}

function performLogin($username, $fullName)
{
    $_SESSION['user_login'] = $username;
    $_SESSION['full_name'] = $fullName;
    header('Location: innlogget.php');
    exit;
}

?>