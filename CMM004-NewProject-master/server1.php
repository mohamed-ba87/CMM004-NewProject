<?php
session_start();


$username= "";
$password="";
$error= array();
 $db = mysqli_connect('CSDM-WEBDEV','1809441','1809441','db1809441_trade');

 if(isset($_POST['login'])) {
     $lo_username = filter_input($db, $_POST['username5']);
     $lo_password = filter_input($db, $_POST['password5']);

     if (empty($lo_username)) {
         array_push($error, "username is required");
     }
     if (empty($lo_password)) {
         array_push($error, "password is required");
     }

     if (count($error) == 0) {
         $do = "SELECT * FROM user_info WHERE email='" . $lo_username . "' OR password= '" . $lo_password . "'";
         $result = mysqli_query($db, $do);
         if (mysqli_num_rows($result) == 1) {
             //$_SESSION ['username']= $lo_username;
             //  $_SESSION['success']= "you are no logged in Successfully";
             echo " we done it 2";
         }

     }
 }






 /*
//register user
if(isset($_POST['userRej'])){

    $username= mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['email']);
    $password_1= mysqli_real_escape_string($db,$_POST['password']);
    $password_2 = mysqli_real_escape_string($db,$_POST['password1']);
    $f_name= mysqli_real_escape_string($db,$_POST['1name']);
    $L_name= mysqli_real_escape_string($db,$_POST['u2name']);
    $add_1= mysqli_real_escape_string($db,$_POST['add1']);
    $add_2= mysqli_real_escape_string($db,$_POST['add2']);
    $city= mysqli_real_escape_string($db,$_POST['city']);
    $postcode= mysqli_real_escape_string($db,$_POST['postcode']);

    //to make sure all or most of the places are filled correctly
    if(empty($username)){ array_push($error,"username is required");}
    if(empty($email)){ array_push($error,"email is required");}
    if(empty($password_1)){ array_push($error,"Password is required");}
    if($password_1 != $password_2){array_push($error,"the password do not match");}
    if(empty($f_name)){ array_push($error,"First name is required");}
    if(empty($L_name)){ array_push($error,"Last name is required");}
    if(empty($add_1)){ array_push($error,"the first line is required");}
    if(empty($city)){ array_push($error,"city name is required");}
    if(empty($postcode)){ array_push($error,"postcode is required");}

    $user_check= " SELECT * FROM user_info WHERE (username='$username' OR email= '$email') LIMIT 1";
    $result= mysqli_query($db,$user_check);
    $user= mysqli_fetch_assoc($result);

    if($user){
        if($user['username'])
    }





}


