
<?php

      include "connect.php";
      //inserting data
      try {
          if (isset($_POST['submit'])) {
            $file = $_FILES['image']['tmp_name'];
            $targetDir = 'uploads/';
            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
              if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
               // echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
            $namee = $_POST["fname"];
            $location = $_POST["flocation"];
            $namee = mysqli_real_escape_string($conn, $namee);
            $location = mysqli_real_escape_string($conn, $location);
            $sql = "INSERT INTO students (id, name, location,img_url) VALUES (NULL, '$namee', '$location','$targetFile')";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
              die(mysqli_error($conn));
                }
          }
         
      } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
      }
?>
<?php
    //deleting all the data
    try{
      
      if(isset($_GET['delete_all'])){
        $sql = "DELETE FROM students";
        if(mysqli_query($conn,$sql)){
          header("Location:user.php");
        }else{
          die(mysqli_error($conn));
        }
      }
    }catch(Exception $e){
      echo $e->getMessage();
    }
?>

<?php
     //Retriving data
      try{
          $sql = "SELECT * FROM students";
          $result = mysqli_query($conn, $sql);
          if (!$result){
            die(mysqli_error($conn));
          }

      }catch(Exception $e){
        echo $e->getMessage();
      }

?>

<?php
    //deleting the data
    try{
      
      if(isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        $sql = "DELETE FROM students WHERE id=$id";
        if(mysqli_query($conn,$sql)){
          header("Location:user.php");
        }else{
          die(mysqli_error($conn));
        }
      }
    }catch(Exception $e){
      echo $e->getMessage();
    }

?>

<?php
//delete all data

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>crud app</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        padding: 5px;
        line-height: 1.42857143;
        vertical-align: middle;
        border-top: 1px solid #ddd;
    }
  </style>
</head>
<body>
<div class="container" style="margin:10rem auto;">
  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 style="margin-bottom:4rem; margin-top:0">Time table application</h2>
        <button type="button" style="margin-bottom: 2rem;" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Time Table</button>
      </div>
  </div>
  
  <table class="table table-condensed ">
    <thead>
       <tr>
          <th>S.NO</th>
          <th>WORK</th>
          <th>DATE&TIME</th>
          <th>IMAGE</th>
          <th>ACTION</th>
       </tr>
    </thead>
    <?php  if($result->num_rows>0){  ?>
          <?php while($row = $result->fetch_assoc()){?>
          <tbody>
                <tr>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['location'] ?></td>
                  <td><img src="<?php echo $row['img_url'] ?>" style="width:50px" alt="img"></td>
                  <td>
                    <a href="user.php?delete_id=<?php echo $row['id'] ?>" name="submit-1" type="submit" style="padding: 6px 14.5px;margin-bottom:2px;"  class="btn btn-danger">Delete</a>
                    <a class="btn btn-success" href="update.php?delete_id-2=<?php echo $row['id'] ?>">Update</a>
                  </td> 
                </tr>
          </tbody>
          <?php }?>
    <? } else{?>
         <tr>
          <td colspan="5"><php? echo"no data found"; ?></td>
         </tr>
    <?php }?>
  </table>
  <a href="user.php?delete_all=1"  class="btn btn-danger btn-lg">DELETE ALL RECORDS</a>

  <!-- Modal for INSERT-->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add user</h4>
        </div>
        <div class="modal-body">
          <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                  <label  class="form-label">Enter your Work</label>
                  <input type="text" required class="form-control" autocomplete="off" name="fname">

                </div>
                <div class="mb-3">
                  <label  >Enter your DATE&TIME</label>
                  <input type="datetime-local" required class="form-control" autocomplete="off" name="flocation">
                </div>
                <div class="mb-3">
                  <label  >Upload Image</label>
                  <input type="file"  class="form-control"  name="image">
                </div>
              
                <button name="submit" type="submit" class="btn btn-primary" style="margin-top:1rem;">Submit</button>
            </form>
        </div>
        <div class="modal-footer ">
          <button  type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>

</body>
</html>


