<?php
include 'config.php';
$r_name=$_POST["r_name"];
$r_passsword=$_POST["r_password"];
$r_con_password=$_POST["r_con_password"];
$r_email=$_POST["r_email"];
$name_validator = "/^[a-z'\-]+(?:\s+[a-z'\-]+)+$/i";
$password_validator = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/";
$email_validator = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i";
$valid = true;
if(!preg_match($name_validator,$r_name)){
    $valid = false;
    echo "<script>alert('Invalid Nname. Length range 5-31. Must have only Alphabet')</script>";
    echo "<script >location.href='register.php'</script>";
}
else if(!preg_match($password_validator,$r_passsword)){
    $valid = false;
    echo "<script>alert('Invalid Password. e.g. Hijbullah13 or Length must be greater than 5')</script>";
    echo "<script >location.href='register.php'</script>";
}
else if(!preg_match($email_validator,$r_email)){
    $valid = false;
    echo "<script>alert('Invalid email. e.g. abc@gmail.com')</script>";
    echo "<script >location.href='register.php'</script>";
}
else if($r_con_password != $r_passsword){
    $valid = false;
    echo "<script>alert('Password is not matched')</script>";
    echo "<script >location.href='register.php'</script>";
}

$check_duplicate_user = "SELECT * FROM users WHERE email = '$r_email'";
$result = mysqli_query($conn, $check_duplicate_user);


if(mysqli_num_rows($result)>0){
    $valid = false;
    echo "<script>alert('Email is taken already')</script>";
    echo "<script >location.href='register.php'</script>";
}
if($valid){
    $user_number_query = "SELECT * FROM users";
    $result2 = mysqli_query($conn, $user_number_query);
    $count = mysqli_num_rows($result2);
    $count = 1000 + $count;
    $user_unique_id = "WalkWithMe-" . $count;
    $insert_query = "INSERT INTO `users` (`name`, `email`, `pass`, `user_id`, `picture`, `age`, `interest`) VALUES ('$r_name','$r_email','$r_passsword','$user_unique_id','','','')";
    $flag = mysqli_query($conn,$insert_query);

    if($flag){
        echo "<script>alert('Registration successful and your User ID is $user_unique_id')</script>";
        echo "<script >location.href='login.php'</script>";
    }
    else{
        echo "<script>alert('Registration failed $flag')</script>";
        echo "<script >location.href='register.php'</script>";
    }
}
?>