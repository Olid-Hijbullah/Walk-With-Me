<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>location.href='login.php'</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Admin Homepage</title>
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
                <a href='answer.php' class='mt-2 btn btn-light'>Q&A</a>
                <a href='logout.php' class='mt-2 btn btn-light'>Logout</a>
                </ul>
        </div>
      </div>
    </nav>

    <div class="containter mx-auto">
        <div class="row justify-content-center">
            
            <div class="col-sm-4">
                <h2 class="text-center">Add A Walking Event</h2>
                <form action="addEvent.php" class="shadow p-2 bg-light" method="POST">
                  <div class="mb-3">
                      Event Name:
                      <input type="text" name="event_name" class="form-control">
                  </div>
                  <div class="mb-3 input-group">
                      <div style="width: 13rem;" class="me-2">
                        Date and Time:
                        <input type="datetime-local" name="event_date_time" class="form-control">
                      </div>
                      <div style="width: 11rem;" class="me-2">
                        Walk Length (KM)
                        <input type="number" name='length' class="form-control">
                      </div>
                      <div style="width: 11rem;" class="me-2">
                        Walkleader User ID
                        <input type="number" name='leader_id' class="form-control">
                      </div>
                  </div>
                  <div class="mb-3 input-group">
                    <div style="width: 12rem;" class="me-2">
                    Meeting Points:
                      <input type="text" name="meeting_point" class="form-control">
                    </div>
                    <div style="width:12rem;" class="me-2">
                    Starting Points:
                      <input type="text" name="starting_point" class="form-control">
                    </div>
                    <div style="width:12rem;">
                    Ending Points:
                      <input type="text" name="ending_point" class="form-control">
                    </div>
                      
                  </div>

                  <div class="mb-3 input-group">
                    <div style="width: 12rem;" class="me-2">
                    Walk Leader:
                      <input type="text" name="walk_leader" class="form-control">
                    </div>
                    <div style="width:12rem;" class="me-2">
                    Walking Distant:
                      <select name="walk_distance" class="form-control">
                        <option value="short">Short</option>
                        <option value="medium">Medium</option>
                        <option value="long">Long</option>
                      </select>
                    </div>
                    <div style="width:12rem;">
                    Walking Pace:
                    <select name="walk_pace" class="form-control">
                        <option value="slow">Slow</option>
                        <option value="medium">Medium</option>
                        <option value="fast">Fast</option>
                      </select>
                    </div>
                      
                  </div>

                  <div class="mb-3">
                  <button type="submit" class="btn-primary btn d-block m-auto w-100">Create Event</button>
                  </div>
                </form>
            </div>

            <div class="col-sm-6 ">
              <h2 class= "text-center">All Events</h2>
              <table class="table table-striped shadow table-success text-center">
                <thead>
                  <tr>
                    <th>Serial</th>
                    <th>Event Name</th>
                    <th>Date & Time</th>
                    <!-- <th>Meeting Point</th>
                    <th>Starting Point</th>
                    <th>Ending Point</th>
                    <th>Walk Leader</th>
                    <th>Distnace</th>-->
                    <th>Length</th> 
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <?php
                    $count = 0;
                    $sql = "SELECT * FROM events";
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
                      $walk_distant = $data['walking_distance'];
                      $walk_pace = $data['walking_pace'];
                      
                      echo "
                          <tr class=''>
                            <td>$count</td>
                            <td>$event_name</td>
                            <td>$event_date</td>
                            <td>$walk_length KM</td>
                            <td>
                              <a class='btn btn-info' href='viewEvent.php?id=$id'>View</a>
                            </td>
                          </tr>
                      ";
                    }
                  ?>
                </tbody>
              </table>
            </div>

        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                <h2 class="text-center">All Users</h2>
                <table class="table table-striped shadow table-success text-center">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Name</th>
                      <th>User ID</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                      $count = 0;
                      $sql = "SELECT * FROM users";
                      $result = mysqli_query($conn,$sql);
                      while($data=mysqli_fetch_array($result)){
                        $count += 1;
                        $serial = $count;
                        $name = $data["name"];
                        $user_id = $data['user_id'];
                        $email = $data['email'];
                        
                        echo "
                            <tr class=''>
                              <td>$count</td>
                              <td>$name</td>
                              <td>$user_id</td>
                              <td>$email</td>
                              
                            </tr>
                        ";
                      }
                    ?>
                  </tbody>
                </table>
            </div>

            <div class="col-sm-6">
                <h2 class="text-center">Walkleaders</h2>
                <table class="table table-striped shadow table-success text-center">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>User ID</th>
                      <th>Experience</th>
                      <th>Routes</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    <?php
                      $count = 0;
                      $sql = "SELECT * FROM walkleader";
                      $result = mysqli_query($conn,$sql);
                      while($data=mysqli_fetch_array($result)){
                        $count += 1;
                        $serial = $count;
                        $name = $data["name"];
                        $user_id = $data['user_id'];
                        $experience = $data['experience'];
                        $routes = $data['routes'];
                        $photo_url = $data['picture'];
                        //<img src='$photo_url' alt='image' style='height: 20px; width: 20px;'>
                        echo "
                            <tr class=''>
                              <td>$count</td>
                              <td><img src='$photo_url' alt='image' style='height: 50px; width: 50px;'></td>
                              <td>$name</td>
                              <td>$user_id</td>
                              <td>$experience</td>
                              <td>$routes</td>
                            </tr>
                        ";
                      }
                    ?>
                  </tbody>
                </table>
            </div>
        </div>
    </div>



    <footer class="text-center d-flex flex-column vh-100">
    
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
<?php
/***
 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Features</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Pricing</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>
      </ul> */
      ?>