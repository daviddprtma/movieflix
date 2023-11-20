<?php
    require "includes/header.php";
?>
<?php
    require "config/config.php";
?>

<?php
    $shows = $conn->query('SELECT * FROM shows LIMIT 3');
    $shows->execute();

    $allShow = $shows->fetchAll(PDO::FETCH_OBJ);

    // show trending
    $trendingShow = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
    COUNT(views.show_id) AS count_views
    FROM shows
    JOIN views on shows.id = views.show_id 
    GROUP BY (shows.id)
    ORDER BY views.show_id");

    $trendingShow->execute();

    $allTrending = $trendingShow->fetchAll(PDO::FETCH_OBJ);

    // adventure show
    $adventureShow = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
    COUNT(views.show_id) AS count_views
    FROM shows
    JOIN views on shows.id = views.show_id 
    WHERE shows.genre = 'adventure'
    GROUP BY (shows.id)
    ORDER BY views.show_id");

    $adventureShow->execute();

    $allAdventureShow = $adventureShow->fetchAll(PDO::FETCH_OBJ);

    // recently added
    $recentlyAddedShow = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
    COUNT(views.show_id) AS count_views
    FROM shows
    JOIN views on shows.id = views.show_id 
    GROUP BY (shows.id)
    ORDER BY shows.created_at DESC");

    $recentlyAddedShow->execute();

    $allrecentlyAddedShow = $recentlyAddedShow->fetchAll(PDO::FETCH_OBJ);
    
    // live action
    $liveAction = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
    COUNT(views.show_id) AS count_views
    FROM shows
    JOIN views on shows.id = views.show_id 
    WHERE shows.genre = 'Action'
    GROUP BY (shows.id)
    ORDER BY shows.created_at DESC");

    $liveAction->execute();

    $allLiveAction = $liveAction->fetchAll(PDO::FETCH_OBJ);

    // For u shows
    $forUShow = $conn->query("SELECT shows.id AS id, shows.image AS image, shows.num_available AS num_available, shows.num_total AS num_total, shows.title AS title, shows.genre AS genre, shows.type AS type,
    COUNT(views.show_id) AS count_views
    FROM shows
    JOIN views on shows.id = views.show_id 
    GROUP BY (shows.id)
    ORDER BY shows.created_at DESC");

    $forUShow->execute();

    $allForUShow = $forUShow->fetchAll(PDO::FETCH_OBJ);
?>
    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">

                <?php foreach ($allShow as $all) : ?>
                <div class="hero__items set-bg" data-setbg="img/<?php echo $all->image; ?>">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label"><?php echo $all->genre; ?></div>
                                <h2><?php echo $all->title; ?></h2>
                                <p><?php echo $all->description; ?></p>
                                <a href="anime-watching.php?id<?php echo $all->id; ?>"><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Trending Now</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($allTrending as $trending) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/<?php echo $trending->image; ?>">
                                        <div class="ep"><?php echo $trending->num_available; ?> / <?php echo $trending->num_total; ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $trending->count_views; ?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><?php echo $trending->genre; ?></li>
                                            <li><?php echo $trending->type; ?></li>
                                        </ul>
                                        <h5><a href="detail-movie.php?id=<?php echo $trending->id; ?>">One Piece</a></h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="popular__product">
                        <div class="row">   
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Adventure Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($allAdventureShow as $adventure) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/<?php echo $adventure->image; ?>">
                                        <div class="ep"><?php echo $adventure->num_available; ?> / <?php echo $adventure->num_total; ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $adventure->count_views; ?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><?php echo $adventure->genre; ?></li>
                                            <li><?php echo $adventure->type; ?></li>
                                        </ul>
                                        <h5><a href="<?php echo APPURL; ?>/detail-movie.php?id=<?php echo $adventure->id?>"><?php echo $adventure->title; ?></a></h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="recent__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Recently Added Shows</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($allrecentlyAddedShow as $recentlyAdded) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/<?php echo $recentlyAdded->image;?>">
                                        <div class="ep"><?php echo $recentlyAdded->num_available;?> / <?php echo $recentlyAdded->num_total;?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $recentlyAdded->count_views;?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><?php echo $recentlyAdded->genre;?></li>
                                            <li><?php echo $recentlyAdded->type;?></li>
                                        </ul>
                                        <h5><a href="<?php echo APPURL;?>/detail-movie.php?id=<?php echo $recentlyAdded->id;?>"><?php echo $recentlyAdded->title;?></a></h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="live__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    <h4>Live Action</h4>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <div class="btn__all">
                                    <a href="#" class="primary-btn">View All <span class="arrow_right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php foreach ($allLiveAction as $liveAction) : ?>
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/<?php echo $liveAction->image; ?>">
                                        <div class="ep"><?php echo $liveAction->num_available; ?> / <?php echo $liveAction->num_total; ?></div>
                                        <div class="view"><i class="fa fa-eye"></i> <?php echo $liveAction->count_views; ?></div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li><?php echo $liveAction->genre; ?></li>
                                            <li><?php echo $liveAction->type; ?></li>
                                        </ul>
                                        <h5><a href="<?php echo APPURL; ?>/detail-movie.php?id=<?php echo $liveAction->id; ?>"><?php echo $liveAction->title; ?></a></h5>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
        </div>
    </div>
    <div class="product__sidebar__comment">
        <div class="section-title">
            <h5>For You</h5>
        </div>
        <?php foreach ($allForUShow as $forU) : ?>
        <div class="product__sidebar__comment__item">
            <div class="product__sidebar__comment__item__pic">
                <img src="img/<?php echo $forU->image; ?>" alt="" style="width: 200px; height: 200px;">
            </div>
            <div class="product__sidebar__comment__item__text">
                <ul>
                    <li><?php echo $forU->genre; ?></li>
                    <li><?php echo $forU->type; ?></li>
                </ul>
                <h5><a href="<?php echo APPURL;?>/detail-movie.php?id=<?php echo $forU->id; ?>"><?php echo $forU->title; ?></a></h5>
                <span><i class="fa fa-eye"></i> <?php echo $forU->count_views; ?></span>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- Product Section End -->

<!-- Footer Section Begin -->

</body>

<?php require 'includes/footer.php'; ?>