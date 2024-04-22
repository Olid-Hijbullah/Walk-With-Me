<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>location.href='login.php'</script>";
  }
else{
    $event_id = $_POST['event_id'];
    $event_name = $_POST['event_name'];
    $event_date_time = $_POST['event_date_time'];
    $meeting_point = $_POST['meeting_point'];
    $starting_point = $_POST['starting_point'];
    $ending_point = $_POST['ending_point'];
    $walk_leader = $_POST['walk_leader'];
    $walk_distance = $_POST['walk_distance'];
    $walk_pace = $_POST['walk_pace'];
    $walk_length = $_POST['length'];
    $leader_id = $_POST['leader_id'];
    $valid = true;
    
    $formatted_event_datetime = date('Y-m-d h:i A', strtotime($event_date_time));
    
    if (strlen($event_name) == 0){
        $valid = false;
        echo "<script>alert('Event Name Cannot Be Empty')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    if (strlen($meeting_point) == 0){
        $valid = false;
        echo "<script>alert('Meeting Point Cannot Be Empty')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    if (strlen($starting_point) == 0){
        $valid = false;
        echo "<script>alert('Stating Point Cannot Be Empty')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    if (strlen($ending_point) == 0){
        $valid = false;
        echo "<script>alert('Ending Point Cannot Be Empty')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    if ($walk_length == 0){
        $valid = false;
        echo "<script>alert('Invalid length.')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    if ($leader_id == 0){
        $valid = false;
        echo "<script>alert('Invalid leader id.')</script>";
        echo "<script >location.href='admin.php'</script>";
    }

$update_event_sql = "UPDATE `events` SET `event_name`='$event_name',`event_date`='$formatted_event_datetime',`meeting_point`='$meeting_point',`starting_point`='$starting_point',`ending_point`='$ending_point',`walk_leader`='$walk_leader',`walking_distance`='$walk_distance',`walking_pace`='$walk_pace', `leader_id`=$leader_id, `length`=$walk_length WHERE `event_id`='$event_id'";
$result = mysqli_query($conn,$update_event_sql);

if($result){
    echo "<script>alert('Event Updated Succesfully')</script>";
    echo "<script >location.href='admin.php'</script>";
}
}

?>