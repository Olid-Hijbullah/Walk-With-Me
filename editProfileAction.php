<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
$id = $_SESSION['userid'];
$name = $_POST['name'];
$email = $_POST['email'];
$age = $_POST['age'];
$interest = $_POST['interest'];
$img = $_FILES['img'];

$tempLocation = $_FILES['img']['tmp_name'];
$img_dest = "images/".$_FILES['img']['name'];
move_uploaded_file($tempLocation,$img_dest);

if($img_dest != "images/"){
    $update_sql = "UPDATE users SET `name`='$name',`email`='$email',`picture`='$img_dest',`age`='$age',`interest`='$interest' WHERE id='$id'";
}
else{
    $update_sql = "UPDATE users SET `name`='$name',`email`='$email',`age`='$age',`interest`='$interest' WHERE id='$id'";
}

$result = mysqli_query($conn,$update_sql);

if($result){
    echo "<script>alert('Profile Updated Succesfully. And $img_dest')</script>";
    echo "<script >location.href='userProfile.php'</script>";
}
else{
    echo "<script>alert('Profile Updation Failed. Try again.')</script>";
    echo "<script >location.href='userProfile.php'</script>";
}
?>