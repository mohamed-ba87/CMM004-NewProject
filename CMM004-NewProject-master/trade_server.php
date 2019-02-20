<?php
session_start();


$username= "";
$password="";
$errors= array();
$db = mysqli_connect('CSDM-WEBDEV','1809441','1809441','db1809441_trade');
if($db-> connect_error) {die('Error'.('.$db->connect_errno.'));} else {echo "connected";}


if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    echo "test_0";
    if (empty($username)) {
        array_push($errors, "Username is required");
        //header('Location: /server1.php?empty');
        // exit();
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
        //header('Location: /server1.php?empty');
    }

    if (count($errors) == 0) {
        //header('Location: /server1.php?empty');
        //$password = md5($password);
        $query_tr = "SELECT * FROM tradesman_info WHERE email='$username' AND password='$password'";
        $results = mysqli_query($db, $query_tr);
        echo "test_2";
        if (mysqli_num_rows($results) == 1) {
            echo "test_3";
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";
            header('location: index.php/?weDoneIt');
            echo "test_4";
        }else {
            echo "test_5";
            array_push($errors, "Wrong username/password combination");
            header('location: index.php/?wrong');
            echo "test_6";}
    }
}