<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
}
$id = $_SESSION['userid'];
$user_sql = "SELECT * FROM users WHERE id = '$id'";
$response = mysqli_query($conn, $user_sql);
if($response){
    $user_data = mysqli_fetch_array($response);
    $photo_url = $user_data['picture'];
    $name = $user_data['name'];
    if(isset($_POST['exp']) && isset($_POST['routes'])){
        $experience = $_POST['exp'];
        $routes = $_POST['routes'];
        $walkleader_sql = "INSERT INTO `walkleader`(`name`, `picture`, `experience`, `routes`, `user_id`) VALUES ('$name','$photo_url','$experience','$routes', '$id')"; 
        $result = mysqli_query($conn, $walkleader_sql);
        if($result){
            echo "<script>alert('Response submitted successfully.')</script>";
            echo "<script>location.href='userProfile.php'</script>";
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
    <title>Walkleader</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <form action="walkLeader.php" method='POST'>
                    <div class="mt-2">
                        Name:
                        <input type="text" value="<?php echo $name ?>" class='form-control' name='name' disabled>
                    </div>
                    <div class="mt-2">
                        Walking Expericence:
                        <input type="text" class='form-control' name='exp'>
                    </div>
                    <div class="mt-2">
                        Name of all routes you know:
                        <input type="text" class='form-control' name='routes' placeholder='Eg. Miles to Hackney'>
                    </div>
                    <div class="mt-2">
                        <button type='submit' class='btn btn-primary form-control'>Submit</button>
                    </div>

                </form>
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>