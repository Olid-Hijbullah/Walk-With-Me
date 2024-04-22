
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
    </style>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-success text-lg">
      <div class="container-fluid ">
                <h1 class='text-light'>WalkWithMe</h1>
                <ul class="">
                <a href='user_homepage.php' class='mt-2 btn btn-light'>Home Page</a>
                <a href='userProfile.php' class='mt-2 btn btn-light'>Profile</a>
                <a href='question.php' class='mt-2 btn btn-light'>Ask Question</a>
                <a href='logout.php' class='mt-2 btn btn-light'>Logout</a>
                </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="col-sm-12">
              <div>
                <form action="user_homepage.php" method="post">
                    <div class="input-group m-2">
                    <input type="text" name="pace" placeholder="Search by pace(slow,fast,medium)" class="form-control">
                    <input type="text" name="distant" placeholder="Search by distant(long,short,medium)" class="form-control">
                    <input type="submit" value="Search", class="form-control btn btn-secondary">
                    </div>
                </form>
                <h2 class= "text-center bg-info text-light">All Events</h2>
              </div>
              <table class="table table-striped shadow table-primary text-center">
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                
                <?php
                  include 'config.php';
                  $count = 0;
                  if(isset($_POST['pace']) || isset($_POST['distant'])){
                    $pace = $_POST['pace'];
                    $distant = $_POST['distant'];
                    if($pace=='' && $distant==''){
                      echo "<script>location.href='user_homepage.php'</script>";
                    }
                    $sql = "SELECT * FROM events WHERE walking_distance='$distant' OR walking_pace='$pace'";
                  }
                  else{
                    $sql = "SELECT * FROM events";
                  }
                  $result = mysqli_query($conn,$sql);
                  while($data=mysqli_fetch_array($result)){
                    $count += 1;
                    $serial = $count;
                    $id = $data['event_id'];
                    $event_name = $data["event_name"];
                    $event_date = $data['event_date'];
                    $meeting_point = $data['meeting_point'];
                    $starting_point = $data['starting_point'];
                    $ending_point = $data['ending_point'];
                    $walk_leader = $data['walk_leader'];
                    $walk_length = $data['length'];
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
                          <td>$walk_leader</td>
                          <td>$walk_length KM</td>
                          <td>$walk_distant</id>
                          <td>$walk_pace</id>
                          <td>
                            <a class='btn btn-info' href='joinEvent.php?id=$id'>Join</a>
                          </td>
                        </tr>
                    ";
                    }
                    else{
                      echo "
                        <tr class='table-danger'>
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
                          <td>Past Event</td>
                        </tr>
                    ";
                    }
                  }
                ?>
              </tbody>
              </table>
      </div>
    </div>

  

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>