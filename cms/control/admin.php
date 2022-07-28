<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    $page = 'index';
    include('header.php');

    include('../../includes/db.php');
    include('../../includes/functions.php');

    $banner_info = get_banner_info();
    $artworks = get_artworks();

    if (!admin_logged_in()) {
        redirect_to('login.php');
    }

?>

        <!-- Page Content-->
        <div class="container mb-5" id="body" on>

                <!-- Page Heading -->
                <h1 class="my-4 display-4">Content Management System</h1>

                <section class="container bg-white rounded shadow p-3" id="banner-edit">

                    <!----------------- BANNER ---------------->
                    <h4>Banner</h4>
                    <!---------------- Banner Text --------------->
                    <p class="my-0"><u>Text</u></p>
                    <div class="d-flex flex-row">
                        <div class="mr-auto p-2">
                            <p class="text-uppercase">
                                <?php
                                    if ($banner_info['banner_text'] == '') {
                                        echo "<em>NO BANNER TEXT</em>";
                                    }else{
                                        echo $banner_info['banner_text'];
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="p-2">
                            <a title="Edit banner text" class="h5" onclick="displayBannerEditText()" href="#banner-edit"><i class="fa fa-edit text-success" id="banner-edit-text-button" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Form for banner text -->
                    <div id="banner-text-form" style="display: none;">
                        <form class="form mt-0" method="GET" action="raw_php/update_banner_text.php">
                            <div class="form-group">
                                <input class="form-control" type="text" name="banner_text" value="<?php echo ($banner_info['banner_text']); ?>" >
                            </div>
                            <input class="btn btn-secondary" type="submit" name="banner_text_submit" value="Save">
                        </form>
                    </div>

                    <hr />

                    <!--------------- Banner Image ------------------->
                    <p class="my-0"><u>Image</u></p>
                    <div class="d-flex flex-row">
                        <div class="mr-auto p-2">
                            <p class="text-uppercase">
                                <?php
                                    if ($banner_info['banner_image_name'] == '') {
                                        echo "<em>NO BANNER IMAGE</em>";
                                    }else{
                                        echo $banner_info['banner_image_name'];
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="p-2">
                            <a title="Edit banner image" class="h5" onclick="displayBannerEditImage()" href="#banner-edit"><i class="fa fa-edit text-success" id="banner-edit-image-button" aria-hidden="true"></i></a>
                        </div>
                    </div>

                    <!-- Form for banner image -->
                    <div id="banner-image-form" style="display: none;">
                        <form class="form mt-0" enctype="multipart/form-data" method="POST" action="raw_php/update_banner_image.php" id="banner-image">
                            <div class="form-group">
                                <input type="file" accept="image/*" name="banner-image">
                            </div>
                            <input class="btn btn-secondary" type="submit" name="banner_image_submit" value="Save">
                        </form>
                    </div>

                    <!-- /.row -->

                </section>

            <div class="row container mb-3 pt-3">
                <h2 id="artworks">
                    Artworks
                </h2>
            </div>

            <!----------------------------- ARTWORKS ------------------------------>
            <div class="row">

                <?php
                    if (mysqli_num_rows($artworks) <= 0) {
                ?>

                <p class="display-4 my-5">
                    No Artworks have been added at the moment.
                </p>

                <?php
                    }else{
                        while ($artwork = mysqli_fetch_assoc($artworks)){
                ?>
                    <div class="col-md-3 mb-5">
                        <div class="card">
                            <img class="card-img-top" src="../../assets/artworks/<?php echo ($artwork['artwork_image_location']); ?>" alt="<?php $artwork['artwork_image_name']; ?>" / style="height: 200px;">
                            <div class="card-body">
                                <span class="text-sentence">
                                    <strong>
                                        <?php echo ($artwork['artwork_name']); ?>
                                    </strong>
                                </span>
                                <br />
                                <?php echo (substr_replace($artwork['artwork_description'], '...', 45)); ?>
                            </div>

                            <div class="card-footer bg-white text-center">
                                <a title="Delete artwork" class="btn btn-outline-danger text-danger mr-2" href="raw_php/delete_art.php?id=<?php echo ($artwork['artwork_id']) ?>" onclick="return confirm('Are you sure you want to delete?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                <a title="Edit artwork" class="btn btn-outline-success text-success ml-2" href="edit_art.php?id=<?php echo ($artwork['artwork_id']) ?>"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <!-- <button title="Edit artwork" id="edit_art_button_color" onclick="return display_edit_form()" class="btn btn-outline-success text-success ml-2"><i class="fa fa-edit" id="edit_art_button_icon" aria-hidden="true"></i></button> -->
                            </div>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>

            </div>

            <a href="#add_artwork" id="addCancelColor" class="btn btn-outline-secondary" onclick="displayNewArtForm()"><i class="fa fa-plus" id="addCancelSign" aria-hidden="true"></i> <span id="addCancel">Add Artwork</span></a>


            <!--------------- Add New Artwork Form ---------------->
            <div id="add_artwork" class="bg-white rounded p-3" style="display: none;">

                <h3 class="my-4 display-4">Add New Artwork</h3>

                <form class="form" method="POST" enctype="multipart/form-data" onsubmit="return validate_new_art_form()" action="raw_php/add_artwork.php">
                    <div class="form-group">
                        <label class="h5 mb-3">Art Image</label>
                        <input type="file" class="form-row" accept="images/*" name="new_art_image">
                    </div>
                    <div class="form-group">
                        <label class="h5 mt-4 mb-3">Art Name</label>
                        <input type="text" name="new_art_name" class="form-control" id="new_art_name" placeholder="Name of artwork..." required>
                    </div>
                    <div class="form-group">
                        <label class="h5 mt-4 mb-3">Art Description</label>
                        <textarea class="form-control" id="new_art_description" name="new_art_description" rows="3" placeholder="Type in the description the artwork if any..." required></textarea>
                    </div>
                    <input class="btn btn-secondary" type="submit" name="new_artwork_submit" value="Submit Artwork">
                </form>
            </div>

        </div>

<?php
    include('footer.php');
?>

<!-- Banner Text Alert -->
<?php
    if (isset($_SESSION['update_banner_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['update_banner_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['update_banner_message'] = null;
?>

<!-- Add Art Alert -->
<?php
    if (isset($_SESSION['add_art_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['add_art_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['add_art_message'] = null;
?>

<!-- Delete Art Alert -->
<?php
    if (isset($_SESSION['delete_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['delete_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['delete_message'] = null;
?>

<script type="text/javascript">
    function displayBannerEditText() {
        var editBannerText = document.getElementById('banner-text-form');
        var button_class = document.getElementById('banner-edit-text-button');
        if (editBannerText.style.display === "none") {
            editBannerText.style.display = "block";
            button_class.className = "fa fa-close text-danger";
        }else{
            editBannerText.style.display = "none";
            button_class.className = "fa fa-edit text-success";
        }
    }

    function displayBannerEditImage() {
        var editBannerImange = document.getElementById('banner-image-form');
        var button_class = document.getElementById('banner-edit-image-button');
        if (editBannerImange.style.display === "none") {
            editBannerImange.style.display = "block";
            button_class.className = "fa fa-close text-danger";
        }else{
            editBannerImange.style.display = "none";
            button_class.className = "fa fa-edit text-success";
        }
    }

    function displayNewArtForm() {
        var newArtForm = document.getElementById('add_artwork');
        var button_color_class = document.getElementById('addCancelColor');
        var button_sign_class = document.getElementById('addCancelSign');
        if (newArtForm.style.display === "none") {
            newArtForm.style.display = "block";
            document.getElementById('addCancel').innerHTML = "Cancel Art Addition";
            button_color_class.className = "btn btn-outline-danger";
            button_sign_class.className = "fa fa-close";
        }else{
            newArtForm.style.display = "none";
            document.getElementById('addCancel').innerHTML = "Add Artwork";
            document.getElementById('addCancel').style.border_color = 'red';
            button_color_class.className = "btn btn-outline-secondary";
            button_sign_class.className = "fa fa-plus";
        }
    }

    function validate_new_art_form(){
        new_art_description = document.getElementById('new_art_description').value;
        new_art_name = document.getElementById('new_art_name').value;
        if (new_art_description.trim() == '' || new_art_name.trim() == '') {
            alert("Art name or description can not be left empty!");
            return false;
        }
    }

</script>