<?php
session_start();

define('MyConst', TRUE);

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $session = $_SESSION["user_id"];

    include('databaselogin.php');

    $conn = mysqli_connect($servername, $db_user, $db_pass, $database);

    if (!$conn) {
        die("Connection failed" . mysqli_connect_error());
    }

    $query = "SELECT * FROM logins WHERE session = '$session'";

    $data = mysqli_query($conn, $query);

    if (!$data) {
        $status_err = "Failed to connect";
    } else {
        $rows = mysqli_fetch_assoc($data);

        if ($rows >= 1) {
            if ($rows['officer'] == 1) {
                require('policenav.php');
            } else {
                require('membernav.php');
            }
        }
    }
} else {
    require('nav.php');
}
?>

<!DOCTYPE html>
<body>
    <div class="container">
        <div class="jumbotron jumbotron-fluid" id="hero">
            <!-- you can also add something like style="min-height: 70vh;" to the div above -->
            <div class="container">
                <h1 class="display-3">About Us</h1>
                <p class="lead"> The Newark Fraternal Order of Police Lodge #12 is an active Union office that represents about 850 active police officers and over 700 retirees. We protect our officers rights in incidents where an officer has taken a legal action while on or off duty. We negotiate for their benefits, salaries and work schedules.
                    Along with just being an active lodge. We also have great support from within our communities that become associate members and show their support for our law enforcement community.
                    With their support we donate to various organizations.</p>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="jumbotron jumbotron-fluid" id="meetTeam">
            <section class="team-section my-5">

                <!-- Section heading -->
                <h2 class="h1-responsive font-weight-bold text-center my-5">Our amazing team</h2>
                <!-- Section description -->
                <p class="grey-text text-center w-responsive mx-auto mb-5">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas
                    nostrum quisquam eum porro a pariatur veniam.</p>

                <!-- Grid row-->
                <div class="row text-center text-md-left">

                    <!-- Grid column -->
                    <div class="col-xl-6 col-lg-12 mb-5 d-md-flex justify-content-between">
                        <div class="avatar mb-md-0 mb-4 mx-4">
                            <img src="images/pres.jpg" class="rounded z-depth-1" style="width: 40%" alt="Sample avatar">
                        </div>
                        <div class="ms-4">
                            <h4 class="font-weight-bold mb-3">John Doe</h4>
                            <h6 class="font-weight-bold grey-text mb-3">President</h6>
                            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                                tenetur.</p>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-xl-6 col-lg-12 mb-5 d-md-flex justify-content-between">
                        <div class="avatar mb-md-0 mb-4 mx-4">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(20).jpg" class="rounded z-depth-1" alt="Sample avatar">
                        </div>
                        <div class="mx-4">
                            <h4 class="font-weight-bold mb-3">Maria Kate</h4>
                            <h6 class="font-weight-bold grey-text mb-3">Photographer</h6>
                            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                                tenetur.</p>
                        </div>
                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row-->

                <!-- Grid row-->
                <div class="row text-center text-md-left">

                    <!-- Grid column -->
                    <div class="col-xl-6 col-lg-12 mb-xl-0 mb-5 d-md-flex justify-content-between">
                        <div class="avatar mb-md-0 mb-4 mx-4">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(26).jpg" class="rounded z-depth-1" alt="Sample avatar">
                        </div>
                        <div class="mx-4">
                            <h4 class="font-weight-bold mb-3">Anna Deynah</h4>
                            <h6 class="font-weight-bold grey-text mb-3">Web Developer</h6>
                            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                                tenetur.</p>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-xl-6 col-lg-12 d-md-flex justify-content-between">
                        <div class="avatar mb-md-0 mb-4 mx-4">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(29).jpg" class="rounded z-depth-1 img-fluid" alt="Sample avatar">
                        </div>
                        <div class="mx-4">
                            <h4 class="font-weight-bold mb-3">Sarah Melyah</h4>
                            <h6 class="font-weight-bold grey-text mb-3">Front-end Developer</h6>
                            <p class="grey-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos id officiis hic
                                tenetur.</p>
                        </div>
                    </div>
                    <!-- Grid column -->

                </div>
                <!-- Grid row-->

            </section>
            <!-- Section: Team v.3 -->
        </div>

    </div>

    <!-- <div class="team_img">
        <div class="mem">
            <center>President</center>
            <img src="pres.jpg">
            <div class="contact">
                James Stewart Jr.
                <br>
                <A HREF="mailto:stewee68@comcast.net ">stewee68@comcast.net</A>
                <br>
                732-991-0689
            </div>
        </div>
        <div class="mem">
            <center>Vice President</center>
            <img src="vp.jpg">
            <div class="contact">
                Walter Melvin
                <br>
                <A HREF="mailto:wal6425@aol.com "> wal6425@aol.com </A>
                <br>
                973-642-0390
            </div>
        </div>
        <div class="mem">
            <center>Treasurer</center>
            <img src="tres.jpg">
            <div class="contact">
                Ariel Cortez
                <br>
                <A HREF="mailto:acortez@newarkfop.com  "> acortez@newarkfop.com </A>
                <br>
                973-642-0390
            </div>
        </div>
        <div class="mem">
            <center>Secretary</center>
            <img src="sec.jpg">
            <div class="contact">
                Daniel P. Eames
                <br>
                <A HREF="mailto: nwrkfop@aol.com  "> nwrkfop@aol.com </A>
                <br>
                973-642-0390
            </div>
        </div>
        <div class="mem">
            <center>Office Manager</center>
            <img src="om.jpg">
            <div class="contact">
                Robert D'Angelo
                <br>
                <A HREF="mailto: nwrkfop@aol.com  "> nwrkfop@aol.com </A>
                <br>
                973-642-0390
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>


    </div> -->

    <div class="footer">
        <div class="footer-image">
            <img class="seniorprojectlogo" src="seniorprojectlogo.png">
        </div>
        <div class="footer-bottom">
            Copyright &copy; 2020, All Rights Reserved.<br> Rutgers Newark Computer Science
        </div>
    </div>

</body>
<!-- Jquery -->
<script src="js/jquery.min.js"></script>
<!-- BS JS -->
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>

</html>