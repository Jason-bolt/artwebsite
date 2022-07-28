<?php
    $page = 'about';
    include('includes/layouts/header.php');

    $about_info = get_about_info();
?>
        <!-- Page Content-->
        <div class="container mb-5 mt-3" id="body">
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

            <hr />

            <div class="container pb-4">
                <h1>Send us a message</h1>

                <form method="POST" action="#" onsubmit="return validate()" class="container">
                  <label>Name <span style="color: red;">*</span></label>
                <div class="form-row">
              
                  <div class="form-group col-md-6">
                    <!-- <label>Name</label> -->
                    <input oninput="return clear_required();" onsuspend="return show_required();" type="text" class="form-control" id="firstName" name="firstName" placeholder="First name" required>
                    <!-- <label id="required" style="color: rgb(200,30,30); font-size: 12px; margin-bottom: 10px; margin-top: 0; display: none; padding-left: 5px;">This field is required</label> -->
                  </div>
              
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="Last Name" required>
                  </div>
                </div>
              
              <!-- Email -->
                <div class="form-group">
                  <label>Email <span style="color: red;">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                </div>
              
              <!-- Prayer request -->
                <div class="form-group">
                  <label>Message <span style="color: red;">*</span></label>
                  <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
                </div>
                <br />

                <button type="submit" name="contact_submit" class="btn btn-secondary">Send message</button>
              
              </form>
            </div>

        </div>

<?php
    include('includes/layouts/footer.php');
?>

<script type="text/javascript">
    function validate(){
        var firstName = document.getElementById("firstName").value;
        var lastName = document.getElementById("lastName").value;
        var email = document.getElementById("email").value;
        var message = document.getElementById("message").value;
        
        if (firstName.trim() == "" || lastName.trim() == "" || email.trim() == "" || message.trim() == ""){
            alert("All fields must be filled!")
            return false;
        }
    }
</script>