<?php

include 'config.php';

$l_userid = $_POST['l_userid'];
$l_password = $_POST['l_password'];

$search_query = "SELECT * FROM users WHERE user_id='$l_userid' AND pass='$l_password'";
$get_user = mysqli_query($conn,$search_query);
if(mysqli_num_rows($get_user)>0){
    session_start();
    $data=mysqli_fetch_array($get_user);
    $_SESSION['userid'] = $data['id'];
    $uid = $data['id'];
    echo "<script>alert('Login Successfull.')</script>";
    echo "<script>location.href = 'user_homepage.php'</script>";
}
else if($l_password=='admin14125513' && $l_userid='admin'){
    session_start();
    $_SESSION['userid'] = $l_userid;
    echo "<script>alert('Login Successfull')</script>";
    echo "<script>location.href = 'admin.php'</script>";
}
else{
    echo "<script>alert('Incorrect username and password')</script>" ;
    echo "<script>location.href = 'login.php'</script>";
}
?>