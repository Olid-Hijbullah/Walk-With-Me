<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
}
if(isset($_POST['exp']) && isset($_POST['routes'])){
    $exp = $_POST['exp'];
    $routes = $_POST['routes'];
    $id = $_SESSION['userid'];
    $sql = "UPDATE `walkleader` SET `experience`='$exp',`routes`='$routes' WHERE `user_id`='$id'";
    $response = mysqli_query($conn, $sql);
    if($response){
        echo "<script>alert('Updated successfully.')</script>";
    }
    echo "<script>location.href='walkleaderProfile.php'</script>";
}else{
    echo "<script>alert('Experience and Routes cannot be empty.')</script>";
    echo "<script>location.href='walkleaderProfile.php'</script>";
}
?>