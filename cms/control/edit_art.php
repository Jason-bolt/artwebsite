<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    $page = 'index';
    include('header.php');

    include('../../includes/db.php');
    include('../../includes/functions.php');

     if (!admin_logged_in()) {
        redirect_to('login.php');
    }

    if (!isset($_GET['id'])) {
        redirect_to('admin.php');
    }
    $id = $_GET['id'];

    $artwork = get_artwork_by_id($id);
?>

        <!-- Page Content-->
        <div class="container mb-5" id="body">

                <!-- Page Heading -->
                <h1 class="my-4 display-4">Content Management System</h1>

            <div class="row container mb-3 pt-3">
                <h2>
                    Edit Artwork
                </h2>
            </div>


            <!----------------------------- ARTWORKS ------------------------------>
            <div class="row mb-5">

                <div class="col">
                    <div class="card mb-5">
                        <img class="card-img-top" src="../../assets/artworks/<?php echo $artwork['artwork_image_location']; ?>" alt="<?php echo $artwork['artwork_image_name']; ?>" / style="height: 400px;">
                        <div class="card-body">
                            <p class="h4 text-capitalize"><?php echo $artwork['artwork_name']; ?></p>

                            <?php echo $artwork['artwork_description']; ?>

                        </div>
                    </div>
                </div>

                <div class="col mb-3">
                    <form class="form mb-4" method="GET" action="raw_php/edit_artwork_text.php">
                        
                        <input type="number" name="id" value="<?php echo $id; ?>" hidden>

                        <label class="h4 mb-3">Change art name</label>
                        <div class="form-group">
                            <input type="text" name="art_name" class="form-control" value="<?php echo $artwork['artwork_name']; ?>">
                        </div>

                        <label class="h4 mb-3">Change art description</label>
                        <div class="form-group">
                            <textarea class="form-control" name="art_description" rows="5"><?php echo $artwork['artwork_description']; ?></textarea>
                        </div>
                        <input type="submit" name="art_description_submit" class="btn btn-secondary" value="Save change">
                    </form>

                    <hr />

                    <label class="h4 mt-4 mb-3">Change art image</label>
                    <form class="form" method="POST" action="raw_php/update_artwork_image.php" enctype="multipart/form-data">
                        <input type="number" name="id" value="<?php echo $id; ?>" hidden>

                        <div class="form-group">
                            <input type="file" accept="images/*" name="art_image">
                        </div>
                        <input type="submit" name="art_image_submit" class="btn btn-secondary" value="Save change">
                    </form>
                </div>

            </div>

            <a href="admin.php" class="btn btn-outline-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

        </div>

<?php
    include('footer.php');
?>


<!-- Artwork Text Alert -->
<?php
    if (isset($_SESSION['update_art_text_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['update_art_text_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['update_art_text_message'] = null;
?>

<!-- Artwork Image Alert -->
<?php
    if (isset($_SESSION['update_art_image_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['update_art_image_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['update_art_image_message'] = null;
?>