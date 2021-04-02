<?php
// Last Updated: 20210402: Rebuilding from recover_submit
// Consolidated all recover password scripts into recover.php and recover_submit2.php
// why does this script force a redirect to welcome.php??

require_once('../dbconnect.php');
include_once('../includes/event_logs_update.php');
// echo "<script type='text/javascript' src='../js/forgot_password_submit.js'></script>";
echo "<script language='javascript'>";
echo "alert('Arrived before Isset Post password_reset.');";
echo "console.log('Arrived before Isset Post password_reset.');";
echo "</script>";


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--<title></title>-->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
  <!-- Bootstrap core CSS -->
  <link href="../css/MDBootstrap4191/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="../css/MDBootstrap4191/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="../css/MDBootstrap4191/style.css" rel="stylesheet">


  <!--CSS Scripts for Datatables Bootstrap 4 Responsive functions    -->
    <!-- <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.bootstrap4.min.css"> -->


<!-- Custom styles for this template -->
<link href="../css/jumbotron.css" rel="stylesheet">
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Extended styles for this page -->
    <!-- <link href="css/ofc_css_style.css" rel="stylesheet"> -->
  <!-- Test custom styles (Includes tec style details) -->
  <link href="../css/css_style.css" rel="stylesheet">
    <!-- Tenant-specific stylesheet -->
    <link href="../_tenant/css/tenant.css" rel="stylesheet">

</head>
<body>
<nav class="navbar navbar-expand-lg fixed-top navbar-light" id="headercolor">
<a class="navbar-brand" href="welcome.php">
        <img id="nav_logo" width="30" height="30" class="d-inline-block align-top" alt="Logo" />
        <span id="navbar_brand"></span>
    </a>
</nav>
<div class="container-fluid profile_bg">
    <?php
        // header("Location: //tec.ourfamilyconnections.org");
    ?>
    <p>
    </p>
    <div class="row">
    	<div class="col-sm-12">
            <div class="card bg-light border-primary p-3">
                <h3 class="text-center">Click Login to return to the Login page</h3>
                <form name='returnhome' id="return_home" action='' method="POST">
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" name="login" value="Back to Login Page" />
                    </div>
                </form>
            </div> <!--card-->
        </div> <!--col-sm-12-->
    </div> <!-- row -->
</div> <!-- container-fluid -->
<!-- Bug workaround due to service choice model -->
<div id="directory_service"></div>
<div id="calendar_service"></div>
<div id="prayer_service"></div>
<div id="events_service"></div>

    <!-- Tenant Configuration JavaScript Call in nav -->
    <script type="text/javascript" src="/js/config_ajax_call.js"></script>
</body>
</html>