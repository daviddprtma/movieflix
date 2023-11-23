<?php require '../layouts/header.php'; ?>
<?php require '../../config/config.php'; ?>
<?php
  if(!isset($_SESSION['admin_name'])){
    header("location: ".ADMINURL."/admins/login-admins.php");
  }
    $episode = $conn->query('SELECT * FROM episodes');
    $episode->execute();

    $allEpisode = $episode->fetchAll(PDO::FETCH_OBJ);
?>
          <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Episodes</h5>
              <a  href="create-episodes.php" class="btn btn-primary mb-4 text-center float-right">Create Episodes</a>

              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">video</th>
                    <th scope="col">thumbnail</th>
                    <th scope="col">name</th>
                    
                    <th scope="col">delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allEpisode as $episode): ?>
                  <tr>
                    <th scope="row"><?php echo $episode->id;?></th>
                    <td><video width="320" height="240" controls>
                      <source src="videos/<?php echo $episode->video;?>" type="video/mp4">
                    </video></td>
                    <td><img src="videos/<?php echo $episode->thumbnail;?>" style="width: 100px; height: 100px;"></td>
                    <td>ep <?php echo $episode->name;?></td>

                    <td><a href="delete-episodes.php?id=<?php echo $episode->id?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                  <?php endforeach; ?>
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>
    <?php require '../layouts/footer.php'; ?>