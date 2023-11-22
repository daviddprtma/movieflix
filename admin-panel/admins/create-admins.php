<?php require '../layouts/header.php'; ?>
<?php require '../../config/config.php'; ?>

<?php
  if(!isset($_SESSION['admin_name'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
  }
  if(isset($_POST['submit'])){

  if(empty($_POST['email']) || empty($_POST['admin_name']) || empty($_POST['password'])){
      echo "<script>alert('Please fill in the blanks')</script>";
  }
  else{

  $email = $_POST['email'];
  $admin_name = $_POST['admin_name'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $insert = $conn->prepare("INSERT INTO admins (email, admin_name, password) VALUES (?,?,?)");
  $insert->execute([$email, $admin_name, $password]); 

      if($insert){
      header("location: admins.php");
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
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
          <form method="POST" action="create-admins.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="admin_name" id="form2Example1" class="form-control" placeholder="username" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
      <?php require '../layouts/footer.php'; ?>