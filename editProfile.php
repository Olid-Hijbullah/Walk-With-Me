<?php
include 'config.php';
if(!isset($_SESSION['userid'])){
    echo "<script>alert('Please login first.')</script>";
    echo "<script>location.href='login.php'</script>";
  }
  $id = $_SESSION['userid'];
  $sql = "SELECT * FROM users WHERE id='$id'";
  $result = mysqli_query($conn, $sql);
  $user_data = mysqli_fetch_array($result);
  $name = $user_data['name'];
  $email = $user_data['email'];
  $user_id = $user_data['user_id'];
  $age = $user_data['age'];
  $photo = $user_data['picture'];
  $interest = $user_data['interest'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Edit Profile</title>
    <style>
      body {
        font-family: cambria;
      }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4 shadow p-3" >
                <form action="editProfileAction.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        Profile Picture:
                        <input type="file" name="img" class="form-control">
                    </div>
                    <div class="mb-3">
                        Name:
                        <input type="text" name="name" value="<?php echo $name?>" class="form-control" >
                    </div>
                    <div class="mb-3">
                        Email:
                        <input type="text" name="email" value="<?php echo $email?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        Age:
                        <input type="number" name="age" value="<?php echo $age?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        Interest:
                        <input type="text" name="interest" value="<?php echo $interest?>" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn-primary btn form-control">Update</button>
                    </div>
                    <div class="mb-3">
                        <a href="userProfile.php" class="btn-primary btn form-control">Cancel</a>
                    </div>
                </form>     
                    
            </div>
            <div class="col-sm-4"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>