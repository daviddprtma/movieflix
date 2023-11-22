<?php
    require 'includes/header.php';
?>

<?php
    require 'config/config.php';
?>

<?php

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $show = $conn->query("SELECT * FROM shows WHERE id = '.$id'");

        $detailMovie = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
        shows.description AS description, shows.duration AS duration, shows.date_aired AS created_at, shows.quality AS quality,
        shows.status AS status, shows.studios AS studios,
        COUNT(views.show_id) AS count_views
        FROM shows  
        JOIN views on shows.id = views.show_id 
        WHERE shows.id = '$id'
        GROUP BY (shows.id)");
    
        $detailMovie->execute();
    
        $allDetailMovie = $detailMovie->fetch(PDO::FETCH_OBJ);

            // For u shows
        $forUShow = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
        COUNT(views.show_id) AS count_views
        FROM shows
        JOIN views on shows.id = views.show_id 
        GROUP BY (shows.id)
        ORDER BY shows.created_at DESC");

        $forUShow->execute();

        $allForUShow = $forUShow->fetchAll(PDO::FETCH_OBJ);

        // comments
        $comments = $conn->query('SELECT * FROM comments WHERE show_id = '.$id.'');
        $comments->execute();

        $allComments = $comments->fetchAll(PDO::FETCH_OBJ);

        // following
        if(isset($_POST['submit'])){
            $show_id = $_POST['show_id'];
            $user_id = $_POST['user_id'];

            $follow = $conn->prepare("INSERT INTO followings (show_id, user_id) VALUES (:show_id, :user_id)");
            $follow->execute([
                ":show_id" => "$show_id",
                ":user_id" => "$user_id"
            ]);
            echo "<script>alert('you followed this show')</script>";

            // header("location: ".APPURL."/detail-movie.php?id=".$id."");
        }

        // checking if user follow a show
        if($_SESSION['user_id'] == null){
            echo "<script>location.href='".APPURL."/auth/login.php'</script>";
        }
        else{
        $checkFollowing = $conn->query("SELECT * FROM followings WHERE show_id='$id' AND user_id='$_SESSION[user_id]'");
        $checkFollowing->execute();
        }

        // inserting comments
        if(isset($_POST['inserting_comments'])){

            if(empty($_POST['comment'])){
                echo "<script>alert('Comment is empty')</script>";
            }
            else{
                $comment = $_POST['comment'];
                $show_id = $id;
                $user_id = $_SESSION['user_id'];
                $user_name = $_SESSION['username'];

                $insert = $conn->prepare("INSERT INTO comments (comment,show_id,user_id,user_name) VALUES (:comment,:show_id,:user_id,:user_name)");
                $insert->execute([
                    ":comment"=> $comment,
                    ":show_id"=> $show_id,
                    ":user_id"=> $user_id,
                    ":user_name"=> $user_name,
                ]);         
                echo "<script>alert('Comment Added!')</script>";
            }
            
        }

        // checking if user views the page or not
        $checkView = $conn->query('SELECT * FROM views WHERE show_id = '.$id.' AND user_id = '.$_SESSION['user_id'].'');
        $checkView->execute();

        if($checkView->rowCount() > 0){
            // do nothing
        }
        else{
            $view = $conn->prepare("INSERT INTO views (show_id, user_id) VALUES (:show_id, :user_id)");
            $view->execute([
                ":show_id" => "$id",
                ":user_id" => "$_SESSION[user_id]"
            ]);
        }
    }
    else{
        echo "<script>location.href='".APPURL."/404.php';</script>";
    }
?>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="<?php echo APPURL; ?>"><i class="fa fa-home"></i> Home</a>
                        <a href="<?php echo APPURL; ?>/detail-movie.php?id=<?php echo $allDetailMovie->id;?>">Details</a>
                        <span><?php echo $allDetailMovie->title;?>  </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="anime__details__pic set-bg" data-setbg="img/<?php echo $allDetailMovie->image;?>">
                            <div class="view"><i class="fa fa-eye"></i> <?php echo $allDetailMovie->count_views;?></div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3><?php echo $allDetailMovie->title;?></h3>
                            </div>
                           
                            <p>
                            <?php echo $allDetailMovie->description;?>
                            </p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Type:</span> <?php echo $allDetailMovie->type;?></li>
                                            <li><span>Studios:</span> <?php echo $allDetailMovie->studios;?></li>
                                            <li><span>Genres:</span> <?php echo $allDetailMovie->genre;?></li>
                                            <li><span>Date aired:</span> <?php echo $allDetailMovie->created_at;?></li>
                                            <li><span>Status:</span> <?php echo $allDetailMovie->status;?></li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Duration:</span> <?php echo $allDetailMovie->duration;?></li>
                                            <li><span>Quality:</span> <?php echo $allDetailMovie->quality;?></li>
                                            <li><span>Views:</span> <?php echo $allDetailMovie->count_views;?></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <form action="detail-movie.php?id=<?php echo $id; ?>" method="POST">
                                <input type="text" value="<?php echo $id;?>" name="show_id" hidden>
                                <input type="text" value="<?php echo $_SESSION['user_id'];?>" name="user_id" hidden>
                                <?php if($checkFollowing->rowCount() > 0) : ?>
                                    <button name="submit" type="submit" class="follow-btn" disabled><i class="fa fa-heart-o" style="color: green;"></i> Followed</button>
                                <?php else :  ?>
                                    <button name="submit" type="submit" class="follow-btn"><i class="fa fa-heart-o"></i> Follow</button>
                                <?php endif; ?>
                                <a href="movie-watching.php?id=<?php echo $id; ?>&ep=1" class="watch-btn"><span>Watch Now</span> <i
                                    class="fa fa-angle-right"></i></a>
                                </form>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-8">
                        <div class="anime__details__review">
                            <div class="section-title">
                                <h5>Comments</h5>
                            </div>
                            <?php foreach($allComments as $comment):?>
                            <div class="anime__review__item">
                                <div class="anime__review__item__text">
                                    <h6><?php echo $comment->user_name;?> <span><?php echo $comment->created_at;?></span></h6>
                                    <p><?php echo $comment->comment;?></p>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <div class="anime__details__form">
                            <div class="section-title">
                                <h5>Your Comment</h5>
                            </div>
                            <form method="POST" action="<?php echo APPURL;?>/detail-movie.php?id=<?php echo $id;?>">
                                <textarea name="comment" placeholder="Your Comment"></textarea>
                                <button name="inserting_comments" type="submit"><i class="fa fa-location-arrow"></i> Comment</button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <div class="anime__details__sidebar">
                            <div class="section-title">
                                <h5>you might like...</h5>
                            </div>
                            <?php foreach($allForUShow as $forUShow):?>
                            <div class="product__sidebar__view__item set-bg" data-setbg="img/<?php echo $forUShow->image;?>">
                                <div class="ep"><?php echo $forUShow->num_available; ?> / <?php echo $forUShow->num_total; ?></div>
                                <div class="view"><i class="fa fa-eye"></i> <?php echo $forUShow->count_views; ?></div>
                                <h5><a href="<?php echo APPURL;?>/detail-movie.php?id=<?php echo $forUShow->id;?>"><?php echo $forUShow->title; ?></a></h5>
                            </div>
                            <?php endforeach;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Anime Section End -->

        <?php require 'includes/footer.php';?>