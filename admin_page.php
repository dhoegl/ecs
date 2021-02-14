<?php
// Djrectory Admin Page
// Last Modified: 2021/02/13
session_start();
require_once 'dbconnect.php';
include('/services/sendmail.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Recover Password</title>

    <!-- Bootstrap 4 BETA CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    
    
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap453/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/MDBootstrap4191/style.css" rel="stylesheet">

<!-- Test custom styles (Includes tec style details) -->
<link href="css/css_style.css" rel="stylesheet">
<!-- Tenant-specific stylesheet -->
<link href="_tenant/css/tenant.css" rel="stylesheet">
<!-- Initialize jquery js script -->
<script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>

<!-- jQuery (necessary for Bootstrap's (BOOTSTRAP 4 BETA) JavaScript plugins) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</head>
<body>
    <!--Navbar-->
    <?php
        $activeparam = '11'; // sets nav element highlight
        require_once('nav.php');
        require_once('includes/footer.php');
    ?>
<div class="container-fluid profile_bg">
    <div class="row pt-2">
        <div class="col-4">
            <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        Sendmail Testing
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <ul class="list-group">
                            <li>function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6) { // params based on each call to sendmail</li>
                            <li>$mailtype = type of email to send</li>
                            <ul>
                                <li>password_reset</li>
                                <ul>
                                    <li>$param1 = 'Selected' - which family the approved member is being added to</li>
                                    <li class="list-group-item">$param2 = 'Directory' - Registration Admin's idDirectory entry</li>
                                    <li class="list-group-item">$param3 = 'Login' - approved member's user login id</li>
                                    <li class="list-group-item">$param4 = 'FirstName' - approved member's first name</li>
                                    <li class="list-group-item">$param5 = 'LastName' - approved member's last name</li>
                                    <li class="list-group-item">$param6 = 'Email' - approved member's email address</li>
                                </ul>
                                <li class="list-group-item">register_request</li>
                                <li class="list-group-item">approved_member</li>
                                <ul>
                                    <li class="list-group-item">$param1 = 'Selected' - which family the approved member is being added to</li>
                                    <li class="list-group-item">$param2 = 'Directory' - Registration Admin's idDirectory entry</li>
                                    <li class="list-group-item">$param3 = 'Login' - approved member's user login id</li>
                                    <li class="list-group-item">$param4 = 'FirstName' - approved member's first name</li>
                                    <li class="list-group-item">$param5 = 'LastName' - approved member's last name</li>
                                    <li class="list-group-item">$param6 = 'Email' - approved member's email address</li>
                                </ul>
                                <li class="list-group-item">registered_notify</li>
                                <li class="list-group-item">contact_us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
        <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        This is a Title
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <p>
                            Mi eget mauris pharetra et ultrices neque ornare aenean. Vel elit scelerisque mauris pellentesque pulvinar. Faucibus a pellentesque sit amet porttitor eget. Convallis convallis tellus id interdum. Cursus mattis molestie a iaculis at erat pellentesque adipiscing commodo. Amet consectetur adipiscing elit duis tristique. Sit amet volutpat consequat mauris nunc congue nisi. Ipsum faucibus vitae aliquet nec ullamcorper sit amet. At lectus urna duis convallis convallis. Scelerisque mauris pellentesque pulvinar pellentesque habitant morbi tristique senectus et.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
        <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        This is a Title
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <p>
                            Urna nunc id cursus metus aliquam eleifend. In hendrerit gravida rutrum quisque non tellus orci ac. Faucibus turpis in eu mi. Netus et malesuada fames ac turpis egestas maecenas pharetra. Nulla porttitor massa id neque aliquam vestibulum morbi blandit cursus. Lorem donec massa sapien faucibus et. Urna id volutpat lacus laoreet. Lacinia at quis risus sed vulputate odio. Nisl rhoncus mattis rhoncus urna. Aliquet lectus proin nibh nisl condimentum id. Ipsum nunc aliquet bibendum enim facilisis gravida neque convallis. Sit amet porttitor eget dolor morbi non arcu. Eleifend donec pretium vulputate sapien nec sagittis aliquam malesuada. Neque vitae tempus quam pellentesque nec nam. Porttitor lacus luctus accumsan tortor posuere ac ut consequat. Integer vitae justo eget magna fermentum iaculis eu non diam. Sit amet nisl suscipit adipiscing bibendum est ultricies integer quis. Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa eget egestas.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    <!-- Tenant Configuration JavaScript Call in nav -->
    <script type="text/javascript" src="/js/config_ajax_call.js"></script>
</body>
</html>    
