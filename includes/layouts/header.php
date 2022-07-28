<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ofori</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="css/mystyles.css">
        <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #222;">
            <div class="container">
                <a class="navbar-brand" href="index.php">Okanta Art Studio</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                
                    <?php
                        if (isset($page) && $page == 'about') {
                    ?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Artworks</a></li>
                            <li class="nav-item active">
                                <a class="nav-link" href="about.php">
                                    About
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li> -->
                        </ul>
                    <?php
                        }else if (isset($page) && $page == 'contact'){
                    ?>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item"><a class="nav-link" href="index.php">Artworks</a></li>
                            <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                            <li class="nav-item active">
                                <a class="nav-link" href="contact.php">
                                    Contact
                                    <span class="sr-only">(current)</span>
                                </a>
                            </li>
                        </ul>
                    <?php
                        }else{
                    ?>
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item active">
                                    <a class="nav-link" href="#!">
                                        Artworks
                                        <span class="sr-only">(current)</span>
                                    </a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li> -->
                            </ul>
                    <?php
                        }
                    ?>
                
                </div>
            </div>
        </nav>

        <?php
            include('includes/db.php');
            include('includes/functions.php');
        ?>