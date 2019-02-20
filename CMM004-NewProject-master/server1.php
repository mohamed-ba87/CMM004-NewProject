<?php
session_start();


$username= "";
$password="";
$errors= array();
 $db = mysqli_connect('CSDM-WEBDEV','1809441','1809441','db1809441_trade');
/*if($db-> connect_error) {die('Error'.('.$db->connect_errno.'));} else {echo "connected";}
*/

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    echo "test_0";
    if (empty($username)) {
        array_push($errors, "Username is required");
       //header('Location: /server1.php?empty');
       // exit()
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
        //header('Location: /server1.php?empty');
    }

    if (count($errors) == 0) {
        //header('Location: /server1.php?empty');
       $password = md5($password);
        $query = "SELECT * FROM user_info WHERE email='$username' AND password='$password'";
        $results = mysqli_query($db, $query);
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









 /*
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






/**/
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

    // first check the database to make sure
    // a user does not already exist with the same username and/or email
    $user_check_query = "SELECT * FROM user_info WHERE username='$username' OR email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }

        if ($user['email'] === $email) {
            array_push($errors, "email already exists");
        }
    }

    // then, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1);//encrypt the password before saving in the database

        $query = "INSERT INTO user_info (firstname,lastname,add1,add2,city,postcode,username, email, password) 
  			  VALUES('$f_name','$L_name','$add_1','$add_2','$city','$postcode','$username', '$email', '$password')";
        mysqli_query($db, $query);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        header('Location: /server1.php?allGood');
    }





}


