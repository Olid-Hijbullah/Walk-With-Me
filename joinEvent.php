<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('To join walking event, please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
else{
    $user_id =  $_SESSION['userid'];
    $event_id = $_GET['id'];
    $check_participation_sql = "SELECT * FROM participants WHERE event_id=$event_id AND user_id=$user_id";
    $result = mysqli_query($conn, $check_participation_sql);
    if(mysqli_num_rows($result)>0){
        echo "<script>alert('Already participated to this walking event.')</script>";
        echo "<script >location.href='user_homepage.php'</script>";
    }
    else{
        $join_event_sql = "INSERT INTO participants (`event_id`, `user_id`, `status`, `feedback`) VALUES ('$event_id','$user_id','incomplete', '')";
        $result = mysqli_query($conn, $join_event_sql);
        if($result){
            echo "<script>alert('Event registration successfull.')</script>";
        } 
        else{
            echo "<script>alert('Event registration failed. Try again.')</script>";
        }
        echo "<script >location.href='user_homepage.php'</script>";
    }
}
?>