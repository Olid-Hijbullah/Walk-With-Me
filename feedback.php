<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
  $user_id = $_SESSION['userid'];
  if(isset($_POST['feedback'])){
    $given_feedback = $_POST['feedback'];
    $event_id = $_POST['event_id'];
    $feedback_sql = "UPDATE `participants` SET `feedback`='$given_feedback' WHERE user_id='$user_id' AND event_id='$event_id'";
    $result = mysqli_query($conn, $feedback_sql);
    if($result){
        echo "<script>alert('Feedback Added.')</script>";
        echo "<script>location.href='userProfile.php'</script>";
    }
  }
  else{
    $event_id = $_GET['event_id'];
    $sql = "SELECT * FROM participants WHERE user_id='$user_id' AND event_id='$event_id'";
    $response = mysqli_query($conn, $sql);
    if($response){
        $data = mysqli_fetch_array($response);
        $feeedback = $data['feedback'];
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Event Feedback</title>
    <style>
        body {
            font-family: cambria;
        }
        input {
            height: 120%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h1 class='text-center'>Feedback Form</h1>
                <form action="feedback.php" method='POST'>
                    <div class='mt-2'>
                    <input type="text" name='feedback' class='form-control' value="<?php echo $feeedback ?>">
                    </div>
                    <div class='mt-2'>
                    <input type="hidden" name='event_id' class='form-control' value="<?php echo $event_id?>">
                    </div>
                    <div class='mt-2'>
                        <button type='submit' class='form-control'>Submit</button>
                    </div>
                    
                </form>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
</body>
</html>
