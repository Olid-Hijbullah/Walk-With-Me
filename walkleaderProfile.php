<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
}
$id = $_SESSION['userid'];
$sql = "SELECT * FROM walkleader WHERE user_id = '$id'";
$response = mysqli_query($conn, $sql);
if($response){
    $walkleaderData = mysqli_fetch_array($response);
    $name = $walkleaderData['name'];
    $routes = $walkleaderData['routes'];
    $experience = $walkleaderData['experience'];
    $photo_url = $walkleaderData['picture'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Walkleader</title>
    <style>
        body {
            font-family: cambria;
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
            <div class="col-sm-8">
                <h1 class='text-center'>Event as Walkleader</h1>
                <table class="table table-striped shadow table-primary text-center">
                <thead>
                <tr>
                  <th>Serial</th>
                  <th>Event Name</th>
                  <th>Date & Time</th>
                  <th>Meeting Point</th>
                  <th>Starting Point</th>
                  <th>Ending Point</th>
                  <th>Distnace</th>
                  <th>Pace</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $sql = "SELECT * FROM events WHERE walk_leader='$name'";
                $result = mysqli_query($conn, $sql);
                $count = 0;
                while($data=mysqli_fetch_array($result)){
                    $count += 1;
                    $serial = $count;
                    $id = $data['event_id'];
                    $event_name = $data["event_name"];
                    $event_date = $data['event_date'];
                    $meeting_point = $data['meeting_point'];
                    $starting_point = $data['starting_point'];
                    $ending_point = $data['ending_point'];
                    $walk_distant = ucfirst($data['walking_distance']);
                    $walk_pace = ucfirst($data['walking_pace']);
                    $now = date("Y-m-d h:i:sa", strtotime("now"));
                    $event = date("Y-m-d h:i:sa", strtotime($event_date));
                    if ($event >= $now){
                    echo "
                        <tr class=''>
                          <td>$count</td>
                          <td>$event_name</td>
                          <td>$event_date</td>
                          <td>$meeting_point</td>
                          <td>$starting_point</td>
                          <td>$ending_point</td>
                          <td>$walk_distant</id>
                          <td>$walk_pace</id>
                          <td>Upcomming</td>
                        </tr>
                    ";
                    }
                    else{
                      echo "
                        <tr class='table-warning'>
                          <td>$count</td>
                          <td>$event_name</td>
                          <td>$event_date</td>
                          <td>$meeting_point</td>
                          <td>$starting_point</td>
                          <td>$ending_point</td>
                          <td>$walk_distant</id>
                          <td>$walk_pace</id>
                          <td>Finished</td>
                        </tr>
                    ";
                    }
                  }
                ?>
              </tbody>
                </table>
            </div>
            <div class="col-sm-4">
                
                <?php
                echo "
                
                <img src='$photo_url' class='h-25 w-25 rounded mt-2 size mx-auto d-block' alt='Profile Picture'>
                
                ";
                ?>
                <form action="walkLeaderProfileUpdate.php" method='POST'>
                    <div class="mt-2">
                        Name:
                        <input type="text" value="<?php echo $name ?>" class='form-control' name='name' disabled>
                    </div>
                    <div class="mt-2">
                        Walking Expericence:
                        <input type="text" class='form-control' value="<?php echo $experience ?>" name='exp'>
                    </div>
                    <div class="mt-2">
                        Name of all routes you know:
                        <input type="text" class='form-control' value="<?php echo $routes ?>" name='routes' placeholder='Eg. Miles to Hackney'>
                    </div>
                    <div class="mt-2">
                        <button type='submit' class='btn btn-primary form-control'>Update</button>
                    </div>

                </form>
            </div>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>