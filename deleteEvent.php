<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Login First')</script>";
    echo "<script>location.href='login.php'</script>";
  }
$event_id = $_GET['event_id'];
// echo "<script>alert('$event_id')</script>";
$delete_event = "DELETE FROM `events` WHERE event_id='$event_id'";

$result = mysqli_query($conn,$delete_event);

if($result){
    echo "<script>alert('Event deleted')</script>";
    echo "<script>location.href='admin.php'</script>";
}
else{
    echo "<script>alert('Event deletion falied. Try again.')</script>";
    echo "<script>location.href='admin.php'</script>";
}

?>