<?php
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Okanta - Login</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.ico" />
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<style type="text/css">
		body{
			background-image: url('../../assets/images/background2.jpg');
			background-size: fit;
			background-repeat: repeat;
		}
		#login .container #login-row #login-column #login-box {
		  margin-top: 50px;
		  max-width: 600px;
		  height: 320px;
		  background-color: #fff;
		  box-shadow: 2px 2px 5px #888;
		}
		#login .container #login-row #login-column #login-box #login-form {
		  padding: 20px;
		}
		#login .container #login-row #login-column #login-box #login-form #register-link {
		  margin-top: -85px;
		}
	</style>

</head>

<body class="container">

	<div id="login">
        <h3 class="text-center pt-5 pb-0 display-3">Okanta CMS</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <form id="login-form" class="form" action="raw_php/login_process.php" method="POST">
                            <h3 class="text-center">Login</h3>
                            <div class="form-group">
                                <label for="username">Username:</label><br>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label><br>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="login_submit" class="btn btn-secondary btn-md" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<a href="../../index.php"><- Back to website</a>
</body>
</html>


<!-- Banner Text Alert -->
<?php
    if (isset($_SESSION['login_notice'])) {
?>
    <script>
        setTimeout(() => {alert('<?php echo($_SESSION['login_notice']); ?>'); }, 500);
    </script>
<?php
    }$_SESSION['login_notice'] = null;
?>