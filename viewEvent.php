
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
      body {
        font-family: cambria;
        
      }
  </style>
  </head>
  <body>
  <?php
    include "config.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM events where event_id = '$id'";
    $result = mysqli_query($conn,$sql);
    if($result){
        $data=mysqli_fetch_array($result);
        $event_name = $data["event_name"];
        $event_date = $data['event_date'];
        $meeting_point = $data['meeting_point'];
        $starting_point = $data['starting_point'];
        $ending_point = $data['ending_point'];
        $walk_leader = $data['walk_leader'];
        $walk_distant = $data['walking_distance'];
        $walk_pace = $data['walking_pace'];
        $walk_length = $data['length'];
        $leader_id = $data['leader_id'];
        $dateTime = new DateTime($event_date);
        $dateTimeLocal = $dateTime->format('Y-m-d\TH:i');
    }


?>
<div class='containter mx-auto'>
<nav class="navbar navbar-expand-lg navbar-light bg-success text-lg">
    <div class="container-fluid ">
        
        <?php
               //echo "<img src='images/artshop.jpg' alt='artshop' class='mt-2 img-fluid rounded-circle d-block mx-auto' width=80px height=50px> <br>";
                //echo "<div class='mt-2' >";
                echo "<h4 class='text-light' style='inline-block'>User ID: ".$_SESSION['userid']."</h4>";
                echo "<h1 class='text-light'>WalkWithMe</h1>";
                echo "<a href='admin.php' class='m-2 btn btn-light'>Home Page</a>";
                //echo "</div>";
        ?>
        </div>
    </div>
    </nav>
        <div class='row justify-content-center'>
            <div class='col-sm-4'>
                <h1 class = 'text-center'>Event Details</h1>
                <form action="updateEvent.php" class="shadow p-2 bg-light" method="POST">
                  <div class="mb-3">
                      Event Name:
                      <input type="text" name="event_name" value= "<?php echo $event_name ?>" class="form-control">
                  </div>
                  <div class="mb-3 input-group">
                      <div style="width: 12rem;" class="me-2">
                        Date and Time:
                        <input type="datetime-local" name="event_date_time" value= "<?php echo $dateTimeLocal?>" class="form-control">
                      </div>
                      <div style="width: 12rem;" class="me-2">
                        Walk Length (KM)
                        <input type="number" class="form-control" name='length' value= "<?php echo $walk_length ?>" >
                      </div>
                      <div style="width: 12rem;" class="me-2">
                        Walkleader ID
                        <input type="number" class="form-control" name='leader_id' value= "<?php echo $leader_id ?>" >
                      </div>
                  </div>
                  <div class="mb-3 input-group">
                        <div style="width: 12rem;" class="me-2">
                        Meeting Points:
                        <input type="text" name="meeting_point" value= "<?php echo $meeting_point?>" class="form-control">
                        </div>
                        <div style="width:12rem;" class="me-2">
                        Starting Points:
                        <input type="text" name="starting_point" value= "<?php echo $starting_point?>" class="form-control">
                        </div>
                        <div style="width:12rem;">
                        Ending Points:
                        <input type="text" name="ending_point" value= "<?php echo $ending_point ?>" class="form-control">
                        </div>
                  </div>

                  <div class="mb-3 input-group">
                        <div style="width: 12rem;" class="me-2">
                        Walk Leader:
                        <input type="text" name="walk_leader" value= "<?php echo $walk_leader?>" class="form-control">
                        </div>
                        <div style="width:12rem;" class="me-2">
                        Walking Distant:
                        <select name="walk_distance" value="<?php echo $walk_distant; ?>" class="form-control">
                        <option value="short" <?php if($walk_distant=="short") echo "selected"?>>Short</option>
                        <option value="medium" <?php if($walk_distant=="medium")echo "selected"?>>Medium</option>
                        <option value="long" <?php if($walk_distant=="long") echo "selected"?>>Long</option>
                      </select>

                        </div>
                        <div style="width:12rem;">
                        Walking Pace:
                        <select name="walk_pace" value="<?php echo $walk_pace; ?>" class="form-control">
                        <option value="slow" <?php if($walk_pace=="slow") echo "selected"?>>Slow</option>
                        <option value="medium" <?php if($walk_pace=="medium") echo "selected"?>>Medium</option>
                        <option value="fast" <?php if($walk_pace=="fast") echo "selected"?>>Fast</option>
                      </select>
                        </div>
                  </div>

                  <div class="mb-3">
                  <input type="hidden" name="event_id" value="<?php echo  $id ?>">
                  <button type="submit" class="btn-warning btn d-block m-auto w-100">Update</button>
                  
                  </div>
                  <div class="mb-3">
                  <a type='button' href=<?php echo "deleteEvent.php?event_id=$id"?> class='btn btn-danger btn d-block m-auto w-100'>Delete</a>
                  </div>
            </form>
                
            </div> 
            <div class="col-sm-6">
                <h1 class = 'text-center'>Event Participant List</h1>
                <table class="table table-striped shadow table-success text-center">
                  <thead>
                    <tr>
                      <th>Serial</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Feedback</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $participant_sql = "SELECT * FROM `participants` WHERE event_id='$id'";
                      $response = mysqli_query($conn,$participant_sql);
                      $count=0;
                      while($data1=mysqli_fetch_array($response)){
                        $count += 1;
                        $user_id = $data1['user_id'];
                        $user_feedback = $data1['feedback'];
                        $user_status = $data1['status'];
                        $get_user_name_sql = "SELECT * FROM users WHERE id='$user_id'";
                        $user_data_response = mysqli_query($conn,$get_user_name_sql);
                        if($user_data_response){
                          $user_data = mysqli_fetch_array($user_data_response);
                          $user_name = $user_data['name']; 
                          $user_email = $user_data['email'];
                          echo "
                              <tr>
                                <td>$count</td>
                                <td>$user_name</td>
                                <td>$user_email</td>
                                <td>$user_status</td>
                                <td>$user_feedback</td>
                              </tr>
                          ";
                        }
                      }
                      ?>
                  </tbody>
                </table>
                
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>