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
        <div class="container mb-5 text-center" id="body" style="min-height: 60vh;">

        	<p class="display-2">
				<strong>404</strong> <small>Page not found</small>
			</p>
            
			<p>The page you are looking for might have been removed or has its name changed or is temporarily unavailable.</p>	            

			<a href="index.php">Back to home page</a>

        </div>

<?php
    include('includes/layouts/footer.php');
?>