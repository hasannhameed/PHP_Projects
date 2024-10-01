<?php
//updating the data
include "connect.php";
try{
 // updating the data
if (isset($_POST['update'])) {
  $id = $_GET['delete_id-2'];
  $namee = mysqli_real_escape_string($conn, $_POST['fname']);
  $location = mysqli_real_escape_string($conn, $_POST['flocation']);
  $sql = "UPDATE students SET name='$namee', location='$location' WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  if ($result) {
      header("Location:user.php");
  } else {
      die(mysqli_error($conn));
  }
}

}catch(Exception $e){
   echo $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <title>crud app</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container " style="margin-top: 10rem;">
    <form method="POST">
                <div class="mb-3">
                  <label  class="form-label">Enter your name</label>
                  <input type="text" required class="form-control" autocomplete="off" name="fname">

                </div>
                <div class="mb-3">
                  <label  >Enter your Location</label>
                  <input type="datetime-local" required class="form-control" autocomplete="off" name="flocation">
                </div>
                <button name="update" type="submit" class="btn btn-primary" style="margin-top:1rem;">Update</button>
            </form>
    </div>
</body>
</html>

