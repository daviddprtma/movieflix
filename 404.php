<?php
        require 'includes/header.php';
        require 'config/config.php';
    ?>

    <?php

        if(!isset($_SESSION['user_id'])){
            echo "<script>location.href='".APPURL."'</script>";
        }
        // list of followings movie
        $following = $conn->query("SELECT shows.id AS id, shows.title AS title, shows.image AS image, shows.type AS type, shows.genre AS genre, shows.num_available AS num_available, shows.num_total AS num_total, followings.user_id AS user_id, followings.show_id AS show_id
        FROM shows
        INNER JOIN followings ON followings.show_id=shows.id
        WHERE followings.user_id='$_SESSION[user_id]'");

        $following->execute();

        $allFollowings = $following->fetchAll(PDO::FETCH_OBJ);

    ?>
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="<?php echo APPURL; ?>"><i class="fa fa-home"></i> Home</a>
                        <span>404 Not Found</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Section Begin -->
    <section class="product-page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="product__page__content">
                        <div class="product__page__title">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6">
                                    <div class="section-title">
                                        <h4>404</h4>
                                    </div>
                                </div>
                              
                            </div>
                        </div>
                        <div class="row">
                            <p class="text-white">404 Not Found</p>
                        </div>
                    </div>
                   
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                        </div>
                    <!-- </div>
                </div>         -->
    </div>
</div>
</div>
</div>
</div>
</section>
<!-- Product Section End -->

<?php require 'includes/footer.php'; ?>