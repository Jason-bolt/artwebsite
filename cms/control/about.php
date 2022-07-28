<?php
    session_start();
    header("Cache-Control: no-cache, must-revalidate");
    $page = 'about';
    include('header.php');

    include('../../includes/db.php');
    include('../../includes/functions.php');

     if (!admin_logged_in()) {
        redirect_to('login.php');
    }

    $about_info = get_about_info();
?>

        <!-- Page Content-->
        <div class="container mb-5" style="min-height: 90vh;" id="body" on>

            <!-- Page Heading -->
            <h1 class="my-4 display-4">Content Management System</h1>

            <div class="container row">
                <div class="row pt-3">
                    <div class="col-md-8 mb-5">
                        <h2>About The Artist</h2>
                        <hr />
                        <p style="white-space: pre-line;"><?php
                            if ($about_info['about_text'] == "") {
                                echo "<span class='display-4 font-weight-light' style='color: #999;'><em>No content added...</em></span>";
                            }else{
                                echo ($about_info['about_text']);
                            }
                        ?></p>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h2>Contact Us</h2>
                        <hr />
                        <address>
                            <span title="Phone"><i class="fa fa-phone"></i> :</span>
                            <?php
                                if ($about_info['phone_number'] == '') {
                                    echo "No phone";
                                }else{
                                    echo $about_info['phone_number'];
                                }
                            ?>
                            <br />
                            <span title="Email"><i class="fa fa-envelope"></i> :</span>
                            <?php
                                if ($about_info['email'] == '') {
                                    echo "No email";
                                }else{
                                    echo $about_info['email'];
                                }
                            ?>
                        </address>
                    </div>
                </div>

            </div>

            <hr />
            
            <!-- About Edit -->
            <h3 class="my-4 h4">Edit Content Here</h3>

            <form class="form mb-5" method="GET" onsubmit="return validate_form()" action="raw_php/update_about.php">
                <div class="form-group">
                    <label class="h5 mb-3">
                        About the artist
                        <br />
                        <small class="text-info">Add spaces and paragraphs as necessary.</small>
                    </label>
                    <textarea class="form-control" name="about_the_artist" id="about_the_artist" required placeholder="Write some content to engage people visiting the site..." rows="10"><?php echo $about_info['about_text']; ?></textarea>
                </div>
                <div class="form-group">
                    <label class="h5 mt-4 mb-3">
                        Phone number 
                        <br />
                        <small class="text-info">Do not add the leading '0'. e.g: 0547832135 should be 547832135</small>
                    </label>
                    <input type="tel" name="phone_number" class="form-control" id="phone_number" placeholder="Phone number..." value="<?php echo $about_info['phone_number']; ?>" required maxlength="9">
                </div>
                <div class="form-group">
                    <label class="h5 mt-4 mb-3">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email address..." value="<?php echo $about_info['email']; ?>" required>
                </div>
                <input class="btn btn-secondary mt-2" type="submit" name="update_about_submit" value="Save changes">
            </form>

            <hr />

            <!-- ************************* NEW PASSWORD ************************* -->
            <div class="my-5">
                <form class="form" method="POST" action="raw_php/change_password.php">
                    <div class="form-group">
                        <input type="password" name="new_password" placeholder="Change password..." class="form-control">
                    </div>
                    <input type="submit" name="password_submit" class="btn btn-primary" value="Change password">
                </form>
            </div>

        </div>

<?php
    include('footer.php');
?>

<!-- Delete Art Alert -->
<?php
    if (isset($_SESSION['update_about_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['update_about_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['update_about_message'] = null;
?>

<!-- Update Password Alert -->
<?php
    if (isset($_SESSION['update_password_message'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['update_password_message']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['update_password_message'] = null;
?>


<script type="text/javascript">

    function validate_form(){
        about_the_artist = document.getElementById('about_the_artist').value;
        phone_number = document.getElementById('phone_number').value;
        email = document.getElementById('email').value;
        if (about_the_artist.trim() == '' || phone_number.trim() == '' || email.trim() == '') {
            alert("Fields can not be left empty!");
            return false;
        }
    }

</script>