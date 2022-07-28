<?php
    header("Cache-Control: no-cache, must-revalidate");
    $page = 'index';
    include('includes/layouts/header.php');

    $banner_info = get_banner_info();
?>

        <!-- Header-->
        <?php
            if ($banner_info['banner_image_name'] == '') {
        ?>
            <header class="bg-dark py-5 mb-5" id="banner">
        <?php
            }else{
        ?>
            <header class="py-5 mb-5" id="banner" style="background-image: url('assets/images/banner/<?php echo $banner_info['banner_image_location']; ?>');">
        <?php
            }
        ?>
            <div class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-lg-12">
                        <h1 class="display-4 text-white mt-5 mb-2" id="banner-label">
                            <?php
                                if ($banner_info == '') {
                                    echo "Okanta Art Studio";
                                }else{
                                    echo $banner_info['banner_text'];
                                }
                            ?>
                        </h1>
                        <!-- <p class="lead mb-5 text-white-50">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non possimus ab labore provident mollitia. Id assumenda voluptate earum corporis facere quibusdam quisquam iste ipsa cumque unde nisi, totam quas ipsam.</p> -->
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content-->
        <div class="container mb-5" id="body">


            <div class="row container mb-3 pt-3">
                <h2 id="artworks">
                    Artworks
                </h2>
            </div>


            <div class="row">

                <?php
                    $artworks = get_artworks();
                    if (mysqli_num_rows($artworks) <= 0) {
                ?>

                <p class="display-4 my-5">
                    No Artworks have been added at the moment.
                </p>

                <?php
                    }else{

                    while ($artwork = mysqli_fetch_assoc($artworks)) {
                ?>
                    <div class="col-md-3 mb-5">
                        <div class="card">
                            <img class="card-img-top" src="assets/artworks/<?php echo($artwork['artwork_image_location']); ?>" alt="<?php echo($artwork['artwork_image_name']); ?>" / style="height: 200px;">
                            <div class="card-footer bg-white text-center"><a class="btn btn-outline-secondary" href="artwork.php?id=<?php echo($artwork['artwork_id']); ?>">More Details</a></div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>

            </div>
        </div>

<?php
    include('includes/layouts/footer.php');
?>