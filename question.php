<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title>Q&A</title>
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
                </ul>
      </div>
    </nav>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <h1 class='text-center'>Question and Answers</h1>
                <form action="questionAction.php" method='POST'>
                    <div class='input-group mb-5'>
                        <input type="text" name='q' placeholder='Any Question?' class='form-control'>
                        <button type="submit" class='btn btn-primary '>Submit</button>
                    </div>
                </form>
                <?php
                include 'config.php';
                $sql = 'SELECT * FROM question';
                $response  = mysqli_query($conn, $sql);
                while($data=mysqli_fetch_array($response)){
                    $question = $data["question"];
                    $answer = $data["answer"];
                    echo "<strong>Question: $question</strong>";
                    if(strlen($answer)>1){
                        echo "<p>Anwser: $answer</p>";
                    }
                    else{
                        echo "<p>Not yet answered by the manager</p>";
                    }
                    echo "<hr>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>