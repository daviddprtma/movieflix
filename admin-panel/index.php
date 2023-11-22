<?php require 'layouts/header.php' ?>            
<?php require '../config/config.php' ?>  
<?php
 if(!isset($_SESSION['admin_name'])){
  header("location: ".ADMINURL."/admins/login-admins.php");
  }
    // shows
    $shows = $conn->query("SELECT COUNT(*) AS shows_count FROM shows");
    $shows->execute();

    $allShow = $shows->fetch(PDO::FETCH_OBJ);

    // episode
    $episode = $conn->query("SELECT COUNT(*) AS episode_count FROM episodes");
    $episode->execute();

    $allEpisode = $episode->fetch(PDO::FETCH_OBJ);

    // genre
    $genre = $conn->query("SELECT COUNT(*) AS genre_count FROM genres");
    $genre->execute();

    $allGenre = $genre->fetch(PDO::FETCH_OBJ);

    
    // admin
    $admin = $conn->query("SELECT COUNT(*) AS admin_count FROM admins");
    $admin->execute();

    $allAdmin = $admin->fetch(PDO::FETCH_OBJ);
?>          
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Shows</h5>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">number of shows: <?php echo $allShow->shows_count;?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Episodes</h5>
              
              <p class="card-text">number of episodes: <?php echo $allEpisode->episode_count;?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Genres</h5>
              
              <p class="card-text">number of genres: <?php echo $allGenre->genre_count;?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Admins</h5>
              
              <p class="card-text">number of admins: <?php echo $allAdmin->admin_count;?></p>
              
            </div>
          </div>
        </div>
      </div>

      <?php require 'layouts/footer.php' ?>