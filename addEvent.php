<?php

include 'config.php';

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


$check_duplicate_event_query = "SELECT * FROM events WHERE event_name = '$event_name'";
$result = mysqli_query($conn, $check_duplicate_event_query);


if(mysqli_num_rows($result)>0){
    $valid = false;
    echo "<script>alert('Event title is taken already')</script>";
    echo "<script >location.href='admin.php'</script>";
}
if($valid){
    $insert_event_query = "INSERT INTO 
    `events`(`event_name`, `event_date`, `meeting_point`, `starting_point`, `ending_point`, `walk_leader`, `walking_distance`, `walking_pace`, `leader_id`, `length`) VALUES 
    ('$event_name','$formatted_event_datetime','$meeting_point','$starting_point','$ending_point','$walk_leader','$walk_distance','$walk_pace', '$leader_id', '$walk_length')";
    $flag = mysqli_query($conn,$insert_event_query);
    if($flag){
        echo "<script>alert('Event added successfully')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
    else{
        echo "<script>alert('Event adding operation failed $flag')</script>";
        echo "<script >location.href='admin.php'</script>";
    }
}
?>