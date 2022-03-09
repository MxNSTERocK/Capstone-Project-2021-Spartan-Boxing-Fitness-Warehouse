<?php
include('membership_security.php');
include('body_customer/cheader.php');
include('body_customer/cnavbar.php');
?>

<!DOCTYPE html>

<html style="font-size: 16px;">

<head>
    <title>Home</title>
    <link href="css/googleapis.css" rel="stylesheet" />
    <link href="css/mdb.css" rel="stylesheet" />
    <link rel="stylesheet" href="profile/nicepage.css" media="screen">
    <link rel="stylesheet" href="profile/Home.css" media="screen">
    <script class="u-script" type="text/javascript" src="profile/jquery.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="profile/nicepage.js" defer=""></script>

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "logo": "images/default-logo.png"
        }
    </script>
    <meta name="theme-color" content="#18a32b">
    <meta property="og:title" content="Home">
    <meta property="og:type" content="website">
</head>

<?php
$firstname = $_SESSION['firstname'];

$query = "SELECT * FROM tbl_customer WHERE email = '$firstname' ";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($result)) {
?>

    <section class="u-align-center u-clearfix u-white u-section-2" id="carousel_7e65">
        <div class="u-clearfix u-sheet u-valign-middle-lg u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-sheet-1">
            <div class="u-align-left u-container-style u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-group u-palette-2-base u-radius-20 u-shape-round u-group-1">
                <div class="u-container-layout u-valign-middle-md u-valign-middle-sm u-valign-middle-xs u-container-layout-1">
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-3">Username</h6>
                    <p class="u-custom-font u-text u-text-4"><?php echo $row['username'] ?></p>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-5">ADDRESS</h6>
                    <p class="u-custom-font u-text u-text-6"><?php echo $row['firstname'] . " " . $row['lastname']; ?></p>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-7">ROLE</h6>
                    <p class="u-custom-font u-text u-text-8"><?php echo $row['role'] ?></p>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-9">EMAIL</h6>
                    <a href="#" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-2-base u-btn u-button-style u-none u-text-active-palette-2-base u-text-body-alt-color u-text-hover-palette-2-base u-btn-1">
                        <p class="u-custom-font u-text u-text-8"><?php echo $row['email'] ?></p>
                    </a>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-10">PHONE</h6>
                    <a href="tel:+987987654321" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-2-base u-btn u-button-style u-none u-text-active-palette-2-base u-text-body-alt-color u-text-hover-palette-2-base u-btn-2">0<?php echo $row['contact'] ?></a>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-11">STATUS</h6>
                    <a href="#" class="u-border-1 u-border-active-palette-2-base u-border-hover-palette-2-base u-btn u-button-style u-none u-text-active-palette-2-base u-text-body-alt-color u-text-hover-palette-2-base u-btn-3">
                        <?php
                        if ($row['status'] == 1) {
                            echo 'Active';
                        } elseif ($row['status'] == 0) {
                            echo 'Inactive';
                        } ?></a>
                    <!-- <h6 class="u-custom-font u-font-open-sans u-text u-text-12">location</h6>
                    <p class="u-custom-font u-text u-text-13">New York, USA</p>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-14">Interests</h6>
                    <p class="u-custom-font u-text u-text-15">Games, Books, Movies</p>
                    <h6 class="u-custom-font u-font-open-sans u-text u-text-default u-text-16">Social</h6> -->
                    <div class="u-social-icons u-spacing-10 u-social-icons-1">
                        <!-- put icon here -->
                    </div>
                </div>
            </div>

            <img class="u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-image u-image-round u-radius-20 u-image-1" alt="" data-image-width="997" data-image-height="700" src="profile/images/ghghhgh.jpg">
            <div class="u-expanded-width-md u-expanded-width-sm u-expanded-width-xs u-list u-list-1">
                <div class="u-repeater u-repeater-1">
                    <div class="u-align-left u-container-style u-list-item u-repeater-item u-shape-rectangle">
                        <div class="u-container-layout u-similar-container u-valign-middle u-container-layout-3">
                            <p class="u-text u-text-default u-text-palette-1-dark-2 u-text-50">Customer ID:</p>
                            <h3 class="u-custom-font u-font-montserrat u-text u-text-default u-text-palette-2-base u-text-21" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"><?php echo $row['id'] ?></h3>
                        </div>
                    </div>
                    <div class="u-align-left u-container-style u-list-item u-repeater-item u-shape-rectangle">
                        <div class="u-container-layout u-similar-container u-valign-middle u-container-layout-2">
                            <p class="u-text u-text-default u-text-palette-1-dark-2 u-text-50">PHONE</p>
                            <h3 class="u-custom-font u-font-montserrat u-text u-text-default u-text-palette-2-base u-text-19" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"><?php echo $row['contact'] ?></h3>
                        </div>
                    </div>
                    <div class="u-align-left u-container-style u-list-item u-repeater-item u-shape-rectangle">
                        <div class="u-container-layout u-similar-container u-valign-middle u-container-layout-4">
                            <p class="u-text u-text-default u-text-palette-1-dark-2 u-text-50">PHONE</p>
                            <h3 class="u-custom-font u-font-montserrat u-text u-text-default u-text-palette-2-base u-text-23" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000"><?php echo $row['contact']
                                                                                                                                                                                                                            ?></h3>
                        </div>
                    </div>
                <?php
            }
                ?>
                <div class="u-align-left u-container-style u-list-item u-repeater-item u-shape-rectangle">
                    <!-- <div class="u-container-layout u-similar-container u-valign-middle u-container-layout-5">
                            <p class="u-text u-text-default u-text-palette-1-dark-2 u-text-24">projects</p>
                            <h3 class="u-custom-font u-font-montserrat u-text u-text-default u-text-palette-2-base u-text-25" data-animation-name="counter" data-animation-event="scroll" data-animation-duration="3000">150</h3>
                        </div> -->

                </div>
                </div>
            </div>

            <a href="mailto:hi@freedesigner.com" class="u-active-palette-2-light-1 u-border-none u-btn u-btn-round u-button-style u-hover-palette-2-light-1 u-palette-2-base u-radius-8 u-text-active-white u-text-body-alt-color u-text-hover-white u-btn-5">Download cv&nbsp;&nbsp;<span class="u-icon u-icon-5"><svg class="u-svg-content" viewBox="0 0 512 512" x="0px" y="0px" style="width: 1em; height: 1em;">
                        <g>
                            <g>
                                <path d="M382.56,233.376C379.968,227.648,374.272,224,368,224h-64V16c0-8.832-7.168-16-16-16h-64c-8.832,0-16,7.168-16,16v208h-64    c-6.272,0-11.968,3.68-14.56,9.376c-2.624,5.728-1.6,12.416,2.528,17.152l112,128c3.04,3.488,7.424,5.472,12.032,5.472    c4.608,0,8.992-2.016,12.032-5.472l112-128C384.192,245.824,385.152,239.104,382.56,233.376z"></path>
                            </g>
                        </g>
                        <g>
                            <g>
                                <path d="M432,352v96H80v-96H16v128c0,17.696,14.336,32,32,32h416c17.696,0,32-14.304,32-32V352H432z"></path>
                            </g>
                        </g>
                    </svg><img></span>
            </a>
        </div>
        </div>
    </section>

</html>

<?php
include('body_customer/cscript.php');
include('body_customer/cfooter.php');
?>