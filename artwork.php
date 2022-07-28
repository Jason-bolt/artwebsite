<?php
    $page = 'index';
    include('includes/layouts/header.php');

    $id = $_GET['id'];
    $artwork = get_artwork_by_id($id);
?>

<!-- Page Content-->
<div class="container mb-5" id="body">

    <!----------------------------- ARTWORK ------------------------------>
    <div class="row mb-5 mt-3">

        <div class="col" style="flex-basis: fill;">
            <div class="card mb-5">
                <img class="card-img-top" src="assets/artworks/<?php echo $artwork['artwork_image_location']; ?>" alt="<?php echo $artwork['artwork_image_name']; ?>" / style="height: 400px; width: 100%; min-width: 300px;">
            </div>
        </div>

        <div class="col mb-3">
            <p class="h4">
                <?php echo $artwork['artwork_name']; ?>
            </p>
            <p><?php echo $artwork['artwork_description']; ?></p>
        </div>

    </div>

    <a href="index.php?#artworks" class="btn btn-outline-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>

</div>

<?php
    include('includes/layouts/footer.php');
?>