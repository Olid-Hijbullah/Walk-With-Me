<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
      body {
        font-family: cambria;
      }
    </style>
</head>
  <body>
    <div class="container">
       <div class="row">
         <div class="col-sm-4"></div>
         <div class="col-sm-4 shadow p-3" >
          <h1 class="text-success text-center p-3">WalkWithMe</h1>
            <form action="registerAction.php" method="POST">
                <div class="mb-3">
                    Full Name:
                    <input type="text" name="r_name" class="form-control">
                </div>
                <div class="mb-3">
                    Email:
                    <input type="email" name="r_email" class="form-control">
                </div>
                <div class="mb-3">
                    Password:
                    <input type="text" name="r_password" class="form-control">
                </div>
                <div class="mb-3">
                    Confirm Password:
                    <input type="text" name="r_con_password" class="form-control">
                </div>
                <button type="submit" class="btn-primary btn d-block m-auto w-100">Register</button>
                <div class="mb-3 text-center">
                    Already have an account?
                    <a href="login.php" class="text-decoration-none">Login</a>
                </div>
            </form>
        </div>
        <div class="col-sm-4"></div>
       </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>