<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
  $uid = $_SESSION['userid'];
  $user_profile_sql = "SELECT * FROM users WHERE id='$uid'";
  $result = mysqli_query($conn, $user_profile_sql);
  $user_data = mysqli_fetch_array($result);
  $name = $user_data['name'];
  $email = $user_data['email'];
  $user_id = $user_data['user_id'];
  $age = $user_data['age'];
  $photo_url = $user_data['picture'];
  if($photo_url == ""){
    $photo_url = "https://st3.depositphotos.com/15648834/17930/v/450/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg";
  }
  $interest = $user_data['interest'];


  if(isset($_POST['event_status']) && isset($_POST['event_id'])){
    $d = $_POST['event_date'];
    $now = date("Y-m-d h:i:sa", strtotime("now"));
    $event = date("Y-m-d h:i:sa", strtotime($d));
    if($event > $now){
      echo "<script>alert('Event is not yet finished.')</script>";
      echo "<script>location.href:'userProfile.php'</script>";
    }
    else{
      $event_id = $_POST['event_id'];
      $event_status = $_POST['event_status'];
      if($event_status == 'incomplete'){
        $event_status = 'complete';
      }
      else{
        $event_status = 'incomplete';
      }
      $update_sql = "UPDATE `participants` SET `status`='$event_status' WHERE event_id='$event_id' AND user_id='$uid'";
      $response = mysqli_query($conn,$update_sql);
      if($response){
        echo "<script>alert('Event Status Updated.')</script>";
        echo "<script>location.href:'userProfile.php'</script>";
      }
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>WalkWithMe</title>
    <style>
      body {
        font-family: cambria;
      }
      .size{
        height:25%;
        width: 25%;
      }
    </style>
    
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-success text-lg">
      <div class="container-fluid ">
                <h1 class='text-light'>WalkWithMe</h1>
                <ul class="">
                <a href='user_homepage.php' class='mt-2 btn btn-light'>Home Page</a>
                <a href='userProfile.php' class='mt-2 btn btn-light'>Profile</a>
                <a href='logout.php' class='mt-2 btn btn-light'>Logout</a>
                </ul>
      </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- 
            <div class="col-sm-3 text-center">
                
            </div> -->
            <div class="col-sm-9 mt-3">
              <table class="table table-striped shadow table-success text-center">
              <thead>
                <tr>
                  <th>Serial</th>
                  <th>Event Name</th>
                  <th>Date & Time</th>
                  <th>Meeting Point</th>
                  <th>Starting Point</th>
                  <th>Ending Point</th>
                  <th>Walk Leader</th>
                  <th>Length</th>
                  <th>Distnace</th>
                  <th>Pace</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $current_time = time();
                  $past_week = $current_time - (7 * 24 * 60 * 60); 
                  $get_event_sql = "SELECT * FROM `participants` WHERE user_id = '$uid'";
                  $events = mysqli_query($conn, $get_event_sql);
                  $count = 0;
                  $last_week_total_walk = 0;
                  while($data=mysqli_fetch_array($events)){
                    $count += 1;
                    $event_id = $data['event_id'];
                    $event_status = $data['status'];
                    $sql = "SELECT * FROM `events` WHERE event_id='$event_id'";
                    $response = mysqli_query($conn, $sql);
                    $event_data = mysqli_fetch_array($response);
                    $event_name = $event_data["event_name"];
                    $event_date = $event_data['event_date'];
                    $meeting_point = $event_data['meeting_point'];
                    $starting_point = $event_data['starting_point'];
                    $ending_point = $event_data['ending_point'];
                    $walk_leader = $event_data['walk_leader'];
                    $walk_length = $event_data['length'];
                    $walk_distant = $event_data['walking_distance'];
                    $walk_pace = $event_data['walking_pace'];
                    if($event_status == 'complete'){
                      $event_time = strtotime($event_date);
                      if($event_time >= $past_week && $event_time<=$current_time){
                        $last_week_total_walk += $walk_length;
                      }
                      echo "
                        <tr class=''>
                          <td>$count</td>
                          <td>$event_name</td>
                          <td>$event_date</td>
                          <td>$meeting_point</td>
                          <td>$starting_point</td>
                          <td>$ending_point</td>
                          <td>$walk_leader</td>
                          <td>$walk_length KM</td>
                          <td>$walk_distant</id>
                          <td>$walk_pace</id>
                          <td>
                            <form action='userProfile.php' method='POST'>
                              <input type='hidden' value='$event_status' name='event_status'>
                              <input type='hidden' value='$event_id' name='event_id'>
                              <input type='hidden' value='$event_date' name='event_date'>
                              <button type='submit' class='btn btn-info'>$event_status</button>
                            </form>
                          </td>
                          <td>
                          <a href='feedback.php?event_id=$event_id' class='btn btn-primary'>Feedback</a>
                          </td>
                        </tr>
                    ";
                    }
                    else{
                      echo "
                        <tr class=''>
                          <td>$count</td>
                          <td>$event_name</td>
                          <td>$event_date</td>
                          <td>$meeting_point</td>
                          <td>$starting_point</td>
                          <td>$ending_point</td>
                          <td>$walk_leader</td>
                          <td>$walk_length KM</td>
                          <td>$walk_distant</id>
                          <td>$walk_pace</id>
                          <td>
                            <form action='userProfile.php' method='POST'>
                              <input type='hidden' value='$event_status' name='event_status'>
                              <input type='hidden' value='$event_id' name='event_id'>
                              <input type='hidden' value='$event_date' name='event_date'>
                              <button type='submit' class='btn btn-info'>$event_status</button>
                            </form>
                          </td>
                          <td>
                          <a href='' class='btn btn-secondary'>Feedback</a>
                          </td>
                        </tr>
                    ";
                    }
                  }
                  ?>
                </tbody>
                </table>
            </div>

            <!-- <a class='btn btn-info' href='joinEvent.php?id=$event_id'>Join</a> -->
            <div class="col-sm-3 mt-3">
            <?php
                echo "
                <div class='card'>
                <img src='$photo_url' class='card-img-top rounded mt-2 size mx-auto d-block' alt='Profile Picture'>
                <div class='card-body'>
                    <h3 class='card-title text-center'>$name</h3>
                    <h5 class='card-text'>Email: $email</h5>
                    <h5 class='card-text'>User ID: $user_id</h5>
                    <h5 class='card-text'>Age: $age</h5>
                    <h5 class='card-text text-justify'>Interests: $interest</h5>
                    <a href='editProfile.php' class='btn btn-primary form-control'>Edit</a>
                </div>
                </div>
                ";
                $walk_leader_sql = "SELECT * FROM walkleader WHERE user_id='$uid'";
                $query_result = mysqli_query($conn, $walk_leader_sql);
                $check = 0;
                if($query_result){
                  $check = mysqli_num_rows($query_result);
                }
                if($check > 0){
                  echo "
                  <div class='card-body mt-3'>
                    <a href='walkLeaderProfile.php' class='btn btn-success form-control'>View Walkleader Profile</a>
                  </div>
                  ";
                }
                else{
                  echo "
                  <div class='card-body mt-3'>
                    <a href='walkLeader.php' class='btn btn-danger form-control'>Become Walkleader</a>
                  </div>
                  ";
                }
                echo "
                <div class='card mt-3'>
                <h2 class='text-center'>Last week you walked $last_week_total_walk KM </h2>
                </div>
                "
                ?>
               
            
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>