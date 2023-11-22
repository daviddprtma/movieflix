<?php require '../layouts/header.php'; ?>
<?php require '../../config/config.php'; ?>

<?php
  if(!isset($_SESSION['admin_name'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
  }
  if(isset($_POST['submit'])){

  if(empty($_POST['name'])){
      echo "<script>alert('name is empty')</script>";
  }
  else{
  $name = $_POST['name'];

  $insert = $conn->prepare("INSERT INTO genres (name) VALUES (?)");
  $insert->execute([$name]); 

      if($insert){
      header("location: show-genres.php");
      }else{
      echo "Error: " . $insert . "<br>" . PDO::ATTR_ERRMODE;
      }
  }
  }
?>  

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Genres</h5>
          <form method="POST" action="create-genres.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>
              
              

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
    <?php require '../layouts/footer.php'; ?>