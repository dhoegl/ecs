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
    <title>Admin Page</title>

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
        <div class="col-12 col-lg-6">
            <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        Sendmail Testing
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <ul class="list-group">
                            <li class="list-group-item">function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6) { // params based on each call to sendmail</li>
                            <li>$mailtype = type of email to send</li>
                            <ul>
                                <li>password_reset</li>
                                <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul>
                                <li>register_request</li>
                                <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul>
                                <li>approved_member</li>
                                <ul>
                                    <li>$param1 = 'Customer Name' - Name of church/school (email banner)</li>
                                    <li>$param2 = 'Domain' - Site domain - used to insert domain information into login email</li>
                                    <li>$param3 = 'Login' - approved member's user login id</li>
                                    <li>$param4 = 'FirstName' - approved member's first name</li>
                                    <li>$param5 = 'LastName' - approved member's last name</li>
                                    <li>$param6 = 'Email' - approved member's email address</li>
                                </ul>
                                <li>registered_notify</li>
                                <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul>
                                <li>contact_us</li>
                                <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
        <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        Sendmail Execute
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <form name='emailsend' id="email_send" action='' method="POST">
                            <div class="form-group">
                                <div class="form-check mailtypecheck">
                                    <input class="form-check-input" type="radio" name="mailtype" id="type_pr" value="password_reset" checked>
                                    <label class="form-check-label" for="type_pr">password_reset</label>
                                </div>
                                <div class="form-check mailtypecheck">
                                    <input class="form-check-input" type="radio" name="mailtype" id="type_rr" value="register_request">
                                    <label class="form-check-label" for="type_rr">register_request</label>
                                </div>
                                <div class="form-check mailtypecheck">
                                    <input class="form-check-input" type="radio" name="mailtype" id="type_am" value="approved_member">
                                    <label class="form-check-label" for="type_am">approved_member</label>
                                </div>
                                <div class="form-check mailtypecheck">
                                    <input class="form-check-input" type="radio" name="mailtype" id="type_rn" value="registered_notify">
                                    <label class="form-check-label" for="type_rn">registered_notify</label>
                                </div>
                                <div class="form-check mailtypecheck">
                                    <input class="form-check-input" type="radio" name="mailtype" id="type_cu" value="contact_us">
                                    <label class="form-check-label" for="type_cu">contact_us</label>
                                </div>
                                <br />
                                    <label for="param1">param1:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param1" id="param1_id" aria-describedby="param1" placeholder="param1">
                                    </input>
                                    <label for="param1">param2:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param2" id="param2_id" aria-describedby="param2" placeholder="param2">
                                    </input>
                                    <label for="param1">param3:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param3" id="param3_id" aria-describedby="param3" placeholder="param3">
                                    </input>
                                    <label for="param1">param4:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param4" id="param4_id" aria-describedby="param4" placeholder="param4">
                                    </input>
                                    <label for="param1">param5:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param5" id="param5_id" aria-describedby="param5" placeholder="param5">
                                    </input>
                                    <label for="param1">param6:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param6" id="param6_id" aria-describedby="param6" placeholder="param6">
                                    </input>
                                    <div class="hidden_params">
                                        <div>
                                            <h6 id="custname" name="custnamename"></h6>
                                        </div>
                                        <div>
                                            <h6 id="domainname" name="domainnamename"></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                                <input type="submit" class="btn btn-primary" name="emailsubmit" id="email_submit" value="Send Email" />
                            </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	$submit = $_POST['emailsubmit'];
	$clear = $_POST['clear'];

	if($clear) //		echo "Clear was clicked";
	{
        $mailtype = "";
		$param1 = "";
		$param2 = "";
		$param3 = "";
		$param4 = "";
		$param5 = "";
		$param6 = "";
	}
	if ($submit) //		echo "Submit was clicked";
	{
        $mailtype = $_POST['mailtype'];
        Switch ($mailtype){
            case 'approved_member':
                $param1 = $_POST['custnamename'];
                $param2 = $_POST['domainnamename'];
                $param3 = $_POST['param3'];
                $param4 = $_POST['param4'];
                $param5 = $_POST['param5'];
                $param6 = $_POST['param6'];
            case 'password_reset':
                $param1 = $_POST['param1'];
                $param2 = $_POST['param2'];
                $param3 = $_POST['param3'];
                $param4 = $_POST['param4'];
                $param5 = $_POST['param5'];
                $param6 = $_POST['param6'];
            case 'register_request':
                $param1 = $_POST['param1'];
                $param2 = $_POST['param2'];
                $param3 = $_POST['param3'];
                $param4 = $_POST['param4'];
                $param5 = $_POST['param5'];
                $param6 = $_POST['param6'];
            case 'registered_notify':
                $param1 = $_POST['param1'];
                $param2 = $_POST['param2'];
                $param3 = $_POST['param3'];
                $param4 = $_POST['param4'];
                $param5 = $_POST['param5'];
                $param6 = $_POST['param6'];
            case 'contact_us':
                $param1 = $_POST['param1'];
                $param2 = $_POST['param2'];
                $param3 = $_POST['param3'];
                $param4 = $_POST['param4'];
                $param5 = $_POST['param5'];
                $param6 = $_POST['param6'];
                                                                    
        }

        echo "<script language='javascript'>";
        echo "console.log('mailtype = " . $mailtype . "');";
        echo "console.log('param1 = " . $param1 . "');";
        echo "console.log('param2 = " . $param2 . "');";
        echo "console.log('param3 = " . $param3 . "');";
        echo "console.log('param4 = " . $param4 . "');";
        echo "console.log('param5 = " . $param5 . "');";
        echo "console.log('param6 = " . $param6 . "');";
        echo "</script>";
    
	}
?> 



<!-- Tenant Configuration JavaScript Call in nav -->
<script type="text/javascript" src="/js/config_ajax_call.js"></script>


<!-- **************************** Get the DOM text of hidden parameters ******************** -->
<script type="text/javascript">
var adminjQ = jQuery.noConflict();
adminjQ(document).ready(function () {
    adminjQ("#email_submit").click(function () {
        var buttontitle = adminjQ(this).attr("value");
        console.log("Button Title = " + buttontitle);
        // console.log("Session Name = " + sname);
        // console.log("Session ID = " + sid);
        // console.log("Logged in status = " + loggedin);
        var paramcheck = "";
        var customer = "";
        var domain = "";
        paramcheck = adminjQ(this).closest("form");
            // console.log("Child IS closest TR class");
            customer = paramcheck.find("#custname").text();
            console.log("Customer Name = " + customer);
            domain = paramcheck.find("#domainname").text();
            console.log("Domain Name = " + domain);
        });
    })
</script>
</body>
</html>    
