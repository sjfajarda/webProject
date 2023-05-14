<?php
$xml = new DOMDocument("1.0");
$xml->formatOutput = true;
$xml->preserveWhiteSpace = false;
$xml->load("./assets/xml/BSIT3EG1G5.xml");

$restoName = $_POST['resto-name'];
$location = $_POST['location'];
$price = $_POST['price'];
$sOptions = implode(", ", $_POST['service']);
$oHours = $_POST['oHours'];
$cHours = $_POST['cHours'];
$rating = $_POST['rating'];
$restoPic = $_POST['restoPic'];
$logo = $_POST['logo'];

$buffet = $xml->createElement("buffet");
$rName = $xml->createElement("restaurantName", $restoName);
$rLocation = $xml->createElement("location", $location);
$rPrice = $xml->createElement("basePrice", $price);
$rService = $xml->createElement("serviceOptions", $sOptions);
$rOHours = $xml->createElement("openingHours", $oHours);
$rCHours = $xml->createElement("closingHours", $cHours);
$rRating = $xml->createElement("googleReviewRatings", $rating);

$rPic = $xml->createElement("restoPic");
$rPicImg = "./assets/images/" . $restoPic;
$rPicData = file_get_contents($rPicImg);
$rPicBase64 = base64_encode($rPicData);
$rPicCData = $xml->createCDATASection($rPicBase64);
$rPic->appendChild($rPicCData);

$rLogo = $xml->createElement("picture");
$rLogoImg = "./assets/images/" . $logo;
$rLogoData = file_get_contents($rLogoImg);
$rLogoBase64 = base64_encode($rLogoData);
$rLogoCData = $xml->createCDATASection($rLogoBase64);
$rLogo->appendChild($rLogoCData);

$buffet->appendChild($rName);
$buffet->appendChild($rLocation);
$buffet->appendChild($rPrice);
$buffet->appendChild($rService);
$buffet->appendChild($rOHours);
$buffet->appendChild($xml->createTextNode("\n"));
$buffet->appendChild($rLogo);
$buffet->appendChild($rCHours);
$buffet->appendChild($rRating);
$buffet->appendChild($xml->createTextNode("\n"));
$buffet->appendChild($rPic);
$buffet->appendChild($xml->createTextNode("\n"));

$xml->getElementsByTagName("buffets")->item(0)->appendChild($buffet);
$xml->save("./assets/xml/BSIT3EG1G5.xml");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="styles/modal.css" />
    <script src="script.js"></script>
    <title>Luxe Buffet PH</title>
    <meta name="title" content="Luxe Buffet PH" />
    <meta name="description"
        content="This website shows some of the most luxurious buffet restaurant in the philippines" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Forum&display=swap"
        rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!--link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            // Show the modal on page load
            $("#myModal").modal('show');

            // Redirect to desired URL when "Save changes" button is clicked
            $("#btnLink").click(function () {
                window.location.href = "index.php";

            });
        });
    </script>
</head>
<div class="modal top" id="myModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text">Luxe Buffet PH</h5>
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Restaurant Successfully Added!</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-toggle="modal" id="btnLink" data-target="#myModal"
                            class="btn btn-primary">Ok</button>
                    </div>
                </div>
            </div>
        </div>
<body id="top" onload="hideScreens()">

    <!--Loading Screen-->
    <div class="preload" data-preaload>
        <div class="circle"></div>
        <p class="text">Luxe Buffet PH</p>
    </div>

    <!--Nav Bar-->
    <header class="header" data-header>
        <div class="container">

            <a href="#" class="logo">
                <img src="./assets/images/logo.svg" width="188" height="95" alt="Luxe Buffet PH - Home">
            </a>

            <nav class="navbar" data-navbar>

                <button class="close-btn" aria-label="close menu" data-nav-toggler>
                    <ion-icon name="close-outline" aria-hidden="true"></ion-icon>
                </button>

                <a href="#" class="logo">
                    <img src="./assets/images/logo.svg" width="160" height="50" alt="Grilli - Home">
                </a>

                <ul class="navbar-list">

                    <li class="navbar-item">
                        <a class="navbar-link hover-underline active" id="home-button">
                            <div class="separator"></div>

                            <span class="span">Home</span>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a class="navbar-link hover-underline" id="view-button">
                            <div class="separator"></div>

                            <span class="span">View</span>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a class="navbar-link hover-underline" id="add-button">
                            <div class="separator"></div>

                            <span class="span">Add</span>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a class="navbar-link hover-underline" id="edit-button">
                            <div class="separator"></div>

                            <span class="span">Edit</span>
                        </a>
                    </li>

                    <li class="navbar-item">
                        <a class="navbar-link hover-underline" id="delete-button">
                            <div class="separator"></div>

                            <span class="span">Delete</span>
                        </a>
                    </li>

                </ul>

            </nav>
            <form method="post" action="searchProcess.php" id="search-form">
                <div id="txtHint">
                    <div class="search-container">
                        <input type="text" name="iSearch" id="iSearch" placeholder="Search Restaurant"
                            onkeyup="showHint(this.value)"
                            style="width: 250px; border-bottom: solid 2px var(--gold-crayola); color: var(--white); padding-left:5px;" />
                        <div id="options-container"></div>
                    </div>
                </div>
            </form>



            <button class="nav-open-btn" aria-label="open menu" data-nav-toggler>
                <span class="line line-1"></span>
                <span class="line line-2"></span>
                <span class="line line-3"></span>
            </button>

            <div class="overlay" data-nav-toggler data-overlay></div>
        </div>
    </header>
    <main>
        <article>

            <!--#HERO - Home Screen-->

            <section class="hero text-center" aria-label="home" id="home-screen">

                <ul class="hero-slider" data-hero-slider>

                    <li class="slider-item active" data-hero-slider-item>

                        <div class="slider-bg">
                            <img src="./assets/images/hero-slider-1.png" width="1880" height="950" alt=""
                                class="img-cover">
                        </div>

                        <p class="label-2 section-subtitle slider-reveal">Luxe Buffet PH</p>

                        <h1 class="display-1 hero-title slider-reveal">
                            Luxurious
                        </h1>

                        <p class="body-2 hero-text slider-reveal">
                            Taste the most luxurious buffet restaurants in the Philippines
                        </p>

                    </li>

                    <li class="slider-item" data-hero-slider-item>

                        <div class="slider-bg">
                            <img src="./assets/images/hero-slider-2.png" width="1880" height="950" alt=""
                                class="img-cover">
                        </div>

                        <p class="label-2 section-subtitle slider-reveal">Luxe Buffet PH</p>

                        <h1 class="display-1 hero-title slider-reveal">
                            Unlimited
                        </h1>

                        <p class="body-2 hero-text slider-reveal">
                            Eat all you can with your family and friends
                        </p>

                    </li>

                    <li class="slider-item" data-hero-slider-item>

                        <div class="slider-bg">
                            <img src="./assets/images/hero-slider-3.png" width="1880" height="950" alt=""
                                class="img-cover">
                        </div>

                        <p class="label-2 section-subtitle slider-reveal">Luxe Buffet PH</p>

                        <h1 class="display-1 hero-title slider-reveal">
                            Diverse Cuisines
                        </h1>

                        <p class="body-2 hero-text slider-reveal">
                            Taste the best cuisines in the world
                        </p>

                    </li>

                </ul>

                <button class="slider-btn prev" aria-label="slide to previous" data-prev-btn>
                    <ion-icon name="chevron-back"></ion-icon>
                </button>

                <button class="slider-btn next" aria-label="slide to next" data-next-btn>
                    <ion-icon name="chevron-forward"></ion-icon>
                </button>

            </section>

            <!-- View -->

            <section class="section service bg-black-10 text-center" aria-label="service" id="view-screen">
                <div class="container">

                    <p class="section-subtitle label-2">Sovereign Savors</p>

                    <h2 class="headline-1 section-title">Worth Every Penny</h2>

                    <p class="section-text">
                        Experience the ultimate indulgence in gastronomy as we bring you a comprehensive list of the
                        most lavish and sumptuous buffets that the Philippines has to offer. </p>
                    <ul class="grid-list">

                        <?php
                        $xml = new DOMDocument("1.0");
                        $xml->load("./assets/xml/BSIT3EG1G5.xml");
                        $buffets = $xml->getElementsByTagName("buffet");
                        foreach ($buffets as $buffet) {
                            $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                            $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                            $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                            $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                            $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                            $closingHours = $buffet->getElementsByTagName("closingHours")->item(0)->nodeValue;
                            $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                            $restoPic = $buffet->getElementsByTagName("restoPic")->item(0)->nodeValue;
                            $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

                            echo "<li>";
                            echo "<div class='service-card'>";
                            echo "<div class='has-before hover:shine'>";
                            echo "<figure class='card-banner img-holder' style='--width: 285; --height: 336;'>";
                            echo "<div class='details' style='display: none;'>";
                            echo "<h3 class='title-5 card-title'>" . $location . "</h3>";
                            echo "<div style='display: block;'><label for='price' style='display: inline;' class='label-3'>Php </label><span style='display: inline;' id='price' class='label-3'>" . $basePrice . "</span></div>";
                            echo "<span class='label-3'>" . $serviceOptions . "</span>";
                            echo "<div class='oHours' style='display: block;'><span style='display: inline;' id='hours' class='label-3'>" . $openingHours . "</span><span class='label-3' style='display: inline;'> - </span><span style='display: inline;' class='label-3'>" . $closingHours . "</span></div>";
                            echo "<div style='display: block;'><span class='label-3' style='display:inline'>" . $googleReviewRatings . "</span><label for='rating' style='display: inline;' class='label-3'> ★</label></div>";
                            echo "</div>";
                            echo "<img src='data:image;base64," . $restoPic . "'alt='Restaurant Image' width='285' height='336' loading='lazy' class='img-cover' id='resto-pic''>";
                            echo "</figure>";
                            echo "</div>";
                            echo "<div class='overlay-image'>";
                            echo "<img src='data:image;base64," . $picture . "'alt='Restaurant Logo' width='250' height='250'>";
                            echo "</div>";
                            echo "<div class='card-content'>";
                            echo "<h3 class='title-4 card-title'>" . $restaurantName . "</h3>";
                            echo "<button class='btn-text hover-underline label-2'>Details</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";
                        }
                        ?>

                    </ul>

                    <img src="./assets/images/shape-1.png" width="1000" height="505" loading="lazy" alt="shape"
                        class="shape shape-1 move-anim">
                    <img src="./assets/images/shape-2.png" width="1000" height="505" loading="lazy" alt="shape"
                        class="shape shape-2 move-anim">
                </div>
            </section>

            <section class="section about text-center" aria-labelledby="about-label" id="add-screen">

                <div class="container2" id="univ-form">

                    <h1 class="title-5">Add Restaurant</h1>

                    <form action="addProcess.php" method="POST" id="add-form" onsubmit="validateForm(event)">

                        <div class="input-name">
                            <label for="resto-name">Restaurant Name</label>
                            <input type="text" name="resto-name" id="resto-name" placeholder="Enter Restaurant Name"
                                onkeyup="check()" required>
                            <label for="resto-name" id="prompt" style="display: block">Prompt</label>
                        </div>

                        <div class="input-location">
                            <label for="location">Location</label>
                            <input type="text" name="location" id="location" placeholder="Enter Location" required>
                        </div>

                        <div class="input-price">
                            <label for="price">Price</label>
                            <input type="number" name="price" id="price" placeholder="Enter Price" required>
                        </div>

                        <div class="service-checkboxes">
                            <label for="service">Service Options</label>
                            <div class="prompt" style="text-align: left;">
                                <span id="prompt" style="display: inline;">You selected:&nbsp;</span><span
                                    style="display: inline;" id="selected"></span>
                            </div>
                            <div class="checkboxes">
                                <div class="checkbox">
                                    <input type="checkbox" name="service[]" id="service" value="Dine-in">
                                    <label for="service">Dine-in</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="service[]" id="service" value="Take-out">
                                    <label for="service">Take-out</label>
                                </div>
                                <div class="checkbox">
                                    <input type="checkbox" name="service[]" id="service" value="Delivery">
                                    <label for="service">Delivery</label>
                                </div>
                            </div>
                        </div>

                        <div class="input-oHours">
                            <label for="oHours">Opening Hours</label>
                            <input type="time" name="oHours" id="oHours" placeholder="Enter Opening Hours" required>
                        </div>

                        <div class="input-cHours">
                            <label for="cHours">Closing Hours</label>
                            <input type="time" name="cHours" id="cHours" placeholder="Enter Closing Hours" required>
                        </div>

                        <div class="input-rating">
                            <label for="rating">Google Review Ratings</label>
                            <input type="number" step="0.01" min="0.00" max="5.00" name="rating" id="rating"
                                placeholder="Enter Google Review Ratings" required>
                        </div>

                        <div class="input-restoPic">
                            <label for="restoPic">Restaurant Image</label>
                            <input type="file" name="restoPic" id="restoPic" placeholder="Enter Restaurant Picture"
                                required>
                        </div>

                        <div class="input-logo">
                            <label for="logo">Restaurant Logo</label>
                            <input type="file" name="logo" id="logo" placeholder="Enter Restaurant Logo" required>
                        </div>

                        <button type="submit" class="btn btn-secondary">
                            <span class="text text-1">Submit</span>
                            <span class="text text-2" aria-hidden="true">Submit</span>
                        </button>

                    </form>

                </div>

            </section>

            <section class="section service bg-black-10 text-center" aria-label="service" id="edit-screen"
                style="display: none;">
                <div class="update-form"></div>
                <div class="container">

                    <p class="section-subtitle label-2">Sovereign Savors</p>

                    <h2 class="headline-1 section-title">Worth Every Penny</h2>

                    <p class="section-text">
                        Experience the ultimate indulgence in gastronomy as we bring you a comprehensive list of the
                        most lavish and sumptuous buffets that the Philippines has to offer. </p>
                    <ul class="grid-list">

                        <?php
                        $xml = new DOMDocument("1.0");
                        $xml->load("./assets/xml/BSIT3EG1G5.xml");
                        $buffets = $xml->getElementsByTagName("buffet");
                        foreach ($buffets as $buffet) {
                            $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                            $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                            $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                            $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                            $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                            $closingHours = $buffet->getElementsByTagName("closingHours")->item(0)->nodeValue;
                            $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                            $restoPic = $buffet->getElementsByTagName("restoPic")->item(0)->nodeValue;
                            $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

                            echo "<li>";
                            echo "<div class='service-card'>";
                            echo "<div class='has-before hover:shine'>";
                            echo "<figure class='card-banner img-holder' style='--width: 285; --height: 336;'>";
                            echo "<div class='details' style='display: none;'>";
                            echo "<h3 class='title-5 card-title' id='location'>" . $location . "</h3>";
                            echo "<div style='display: block;'><label for='price' style='display: inline;' class='label-3'>Php </label><span style='display: inline;' id='price' class='label-3'>" . $basePrice . "</span></div>";
                            echo "<span class='label-3' id='sOptions'>" . $serviceOptions . "</span>";
                            echo "<div class='oHours' style='display: block;'><span style='display: inline;' id='hours' class='label-3'>" . $openingHours . "</span><span class='label-3' style='display: inline;'> - </span><span style='display: inline;' class='label-3'>" . $closingHours . "</span></div>";
                            echo "<div style='display: block;'><span class='label-3' style='display:inline'>" . $googleReviewRatings . "</span><label for='rating' style='display: inline;' class='label-3'> ★</label></div>";
                            echo "</div>";
                            echo "<img src='data:image;base64," . $restoPic . "'alt='Restaurant Image' width='285' height='336' loading='lazy' class='img-cover' id='resto-pic'>";
                            echo "</figure>";
                            echo "</div>";
                            echo "<div class='overlay-image'>";
                            echo "<img src='data:image;base64," . $picture . "'alt='Restaurant Logo' width='250' height='250'>";
                            echo "</div>";
                            echo "<div class='card-content'>";
                            echo "<h3 class='title-4 card-title' id='resto-name'>" . $restaurantName . "</h3>";
                            echo "<button class='btn-text hover-underline label-2' onclick='update(this)'>Edit</button>";
                            echo "</div>";
                            echo "</div>";
                            echo "</li>";
                        }
                        ?>

                    </ul>

                    <img src="./assets/images/shape-1.png" width="1000" height="505" loading="lazy" alt="shape"
                        class="shape shape-1 move-anim">
                    <img src="./assets/images/shape-2.png" width="1000" height="505" loading="lazy" alt="shape"
                        class="shape shape-2 move-anim">
                </div>
            </section>

            <section class="section service bg-black-10 text-center" aria-label="service" id="delete-screen"
                style="display: none;">
                <div class="delete-form">

                    <div class="container">

                        <p class="section-subtitle label-2">Sovereign Savors</p>

                        <h2 class="headline-1 section-title">Worth Every Penny</h2>
                        <form action="deleteSearch.php" method="POST" id="delete-form">
                            <input type='text' name='Search' id='tbSearch' />
                        </form>
                        <p class="section-text">
                            Experience the ultimate indulgence in gastronomy as we bring you a comprehensive list of the
                            most lavish and sumptuous buffets that the Philippines has to offer. </p>
                        <ul class="grid-list">
                            <?php
                            $xml = new DOMDocument("1.0");
                            $xml->load("./assets/xml/BSIT3EG1G5.xml");
                            $buffets = $xml->getElementsByTagName("buffet");
                            foreach ($buffets as $buffet) {
                                $restaurantName = $buffet->getElementsByTagName("restaurantName")->item(0)->nodeValue;
                                $basePrice = $buffet->getElementsByTagName("basePrice")->item(0)->nodeValue;
                                $serviceOptions = $buffet->getElementsByTagName("serviceOptions")->item(0)->nodeValue;
                                $location = $buffet->getElementsByTagName("location")->item(0)->nodeValue;
                                $openingHours = $buffet->getElementsByTagName("openingHours")->item(0)->nodeValue;
                                $closingHours = $buffet->getElementsByTagName("closingHours")->item(0)->nodeValue;
                                $googleReviewRatings = $buffet->getElementsByTagName("googleReviewRatings")->item(0)->nodeValue;
                                $restoPic = $buffet->getElementsByTagName("restoPic")->item(0)->nodeValue;
                                $picture = $buffet->getElementsByTagName("picture")->item(0)->nodeValue;

                                echo "<li>";
                                echo "<div class='service-card'>";
                                echo "<div class='has-before hover:shine'>";
                                echo "<figure class='card-banner img-holder' style='--width: 285; --height: 336;'>";
                                echo "<div class='details' style='display: none;'>";
                                echo "<h3 class='title-5 card-title' id='location'>" . $location . "</h3>";
                                echo "<div style='display: block;'><label for='price' style='display: inline;' class='label-3'>Php </label><span style='display: inline;' id='price' class='label-3'>" . $basePrice . "</span></div>";
                                echo "<span class='label-3' id='sOptions'>" . $serviceOptions . "</span>";
                                echo "<div class='oHours' style='display: block;'><span style='display: inline;' id='hours' class='label-3'>" . $openingHours . "</span><span class='label-3' style='display: inline;'> - </span><span style='display: inline;' class='label-3'>" . $closingHours . "</span></div>";
                                echo "<div style='display: block;'><span class='label-3' style='display:inline'>" . $googleReviewRatings . "</span><label for='rating' style='display: inline;' class='label-3'> ★</label></div>";
                                echo "</div>";
                                echo "<img src='data:image;base64," . $restoPic . "'alt='Restaurant Image' width='285' height='336' loading='lazy' class='img-cover' id='resto-pic'>";
                                echo "</figure>";
                                echo "</div>";
                                echo "<div class='overlay-image'>";
                                echo "<img src='data:image;base64," . $picture . " 'alt='Restaurant Logo' width='250' height='250'>";
                                echo "</div>";
                                echo "<div class='card-content'>";
                                echo "<h3 class='title-4 card-title' id='resto-name' name='restoName'>" . $restaurantName . "</h3>";
                                echo "<button class='btn-text hover-underline label-2' data-value = '$restaurantName' onclick='deleteEntry(this)'>Delete</button>";
                                echo "</div>";
                                echo "</div>";
                                echo "</li>";
                            }
                            ?>

                        </ul>

                        <img src="./assets/images/shape-1.png" width="1000" height="505" loading="lazy" alt="shape"
                            class="shape shape-1 move-anim">
                        <img src="./assets/images/shape-2.png" width="1000" height="505" loading="lazy" alt="shape"
                            class="shape shape-2 move-anim">
                    </div>
                    </form>

            </section>

        </article>
    </main>

    <a href="#top" class="back-top-btn active" aria-label="back to top" data-back-top-btn>
        <ion-icon name="chevron-up" aria-hidden="true"></ion-icon>
    </a>

    <link rel="stylesheet" href="./assets/styles/modal.css" />
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="./assets/scripts/script.js"></script>
</body>

</head>