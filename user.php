<?php

      include "connect.php";
      //inserting data
      try {
          if (isset($_POST['submit'])) {
            $namee = $_POST["fname"];
            $location = $_POST["flocation"];
            $namee = mysqli_real_escape_string($conn, $namee);
            $location = mysqli_real_escape_string($conn, $location);
            $sql = "INSERT INTO students (id, name, location) VALUES (NULL, '$namee', '$location')";
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


<!DOCTYPE html>
<html lang="en">
<head>
  <title>crud app</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" style="margin:10rem auto; width:60%">
  <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <h2 style="margin-bottom:4rem; margin-top:0">Crud application</h2>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <!-- Trigger the modal with a button -->
        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add User</button>
      </div>
  </div>
  
  <table class="table ">
    <thead>
       <tr>
          <th>id</th>
          <th>Name</th>
          <th>Location</th>
          <th></th>
          <th></th>
       </tr>
    </thead>
    <?php  if($result->num_rows>0){  ?>
          <?php while($row = $result->fetch_assoc()){?>
          <tbody>
                <tr>
                  <td><?php echo $row['id'] ?></td>
                  <td><?php echo $row['name'] ?></td>
                  <td><?php echo $row['location'] ?></td>
                  <td>
                    <a href="http://localhost/crud/user.php?delete_id=<?php echo $row['id'] ?>" name="submit-1" type="submit"  class="btn btn-danger">Delete</a>
                  </td> 
                  <td>
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
          <form method="POST">
                <div class="mb-3">
                  <label  class="form-label">Enter your name</label>
                  <input type="text" required class="form-control" autocomplete="off" name="fname">

                </div>
                <div class="mb-3">
                  <label  >Enter your Location</label>
                  <input type="text" required class="form-control" autocomplete="off" name="flocation">
                </div>
              
                <button name="submit" type="submit" class="btn btn-primary" style="margin-top:1rem;">Submit</button>
            </form>
        </div>
        <div class="modal-footer ">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  
</div>

</body>
</html>

