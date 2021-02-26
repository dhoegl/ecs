<?php
// Djrectory Admin Page
// Last Modified: 2021/02/13
session_start();
require_once 'dbconnect.php';
include('/services/sendmail.php');
include('/services/sendmail_stage.php');


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
<!-- Tenant Configuration JavaScript Call in nav -->
<script type="text/javascript" src="/js/config_ajax_call.js"></script>
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
                            <li class="list-group-item">function sendmail_stage($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $email, $reset) { // params based on each call to sendmail
function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6) { // params based on each call to sendmail</li>
                            <li>$mailtype = type of email to send</li>
                            <ul>
                                <li>password_reset</li>
                                <!-- <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul> -->
                                <li>register_request</li>
                                <!-- <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul> -->
                                <li>approved_member</li>
                                <!-- <ul>
                                    <li>$param1 = 'login' - approved member's user login id</li>
                                    <li>$param2 = 'first' - approved member's first name</li>
                                    <li>$param3 = 'last' - approved member's last name</li>
                                    <li>$param4 = 'email' - approved member's email address</li>
                                </ul> -->
                                <li>registered_notify</li>
                                <!-- <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul> -->
                                <li>contact_us</li>
                                <!-- <ul>
                                    <li>$param1 = 'mailto' - the email address of the recipient</li>
                                    <li>$param2 = 'Subject' - the Subject line text of the outbound email</li>
                                    <li>$param3 = 'Message' - the body text of the outbound email</li>
                                    <li>$param4 = 'Headers' - items containing header information for the outbound email</li>
                                    <li>$param5 = 'NULL' - enter NULL into this field</li>
                                    <li>$param6 = 'NULL' - enter NULL into this field</li>
                                </ul> -->

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
        <div class="card bg-light border-primary p-3 mt-2 my-2">
                <div class="card-body">
                    <div class="card-title font-weight-bold">
                        Sendmail Execute Test
                    </div>
                    <div class="card-text font-weight-bold my-2">
                        <!-- <form name='emailsend' id="email_send" action='' method="POST" onsubmit="return false"> -->
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
                                    <label for="family_select">Family Select:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="family_select" id="family_select_id" aria-describedby="family_select" placeholder="family_select">
                                    </input>
                                    <label for="admin_dir">Admin DirID:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="admin_dir" id="admin_dir_id" aria-describedby="admin_dir" placeholder="admin_dir">
                                    </input>
                                    <label for="param1">Login:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param1" id="param1_id" aria-describedby="param1" placeholder="UserName">
                                    </input>
                                    <label for="param2">First Name:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param2" id="param2_id" aria-describedby="param2" placeholder="First Name">
                                    </input>
                                    <label for="param3">Last Name:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param3" id="param3_id" aria-describedby="param3" placeholder="Last Name">
                                    </input>
                                    <label for="param4">Email Address:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param4" id="param4_id" aria-describedby="param4" placeholder="Email Address">
                                    </input>
                                    <label for="param5">Reset Key:<span id="unique_user"></span></label>
                                    <input type="text" class="form-control" name="param5" id="param5_id" aria-describedby="param5" placeholder="Password Reset Key">
                                    </input>
                                        <input type="hidden" class="form-control hidden_params" id="custname" name="custnamename"></input>
                                        <input type="hidden" class="form-control hidden_params" id="domainname" name="domainnamename"></input> 
                                        <input type="hidden" class="form-control hidden_params" id="headercolorvalue" name="headercolorname"></input> 
                                        <input type="hidden" class="form-control hidden_params" id="headerforecolorvalue" name="headerforecolorname"></input> 
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-secondary" name="clear" value="Clear" />
                                <input type="submit" class="btn btn-primary" name="emailsubmit" id="email_submit" value="Send Email" />
                                <input type="submit" class="btn btn-warning" name="sendmail_stage" id="sendmail_stage" value="sendmail_stage" />
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
    $sendmail_stage = $_POST['sendmail_stage'];

	if($clear) //		echo "Clear was clicked";
	{
        $mailtype = "";
		$param1 = "";
		$param2 = "";
		$param3 = "";
		$param4 = "";
		$param5 = "";
	}
	if ($submit) //		echo "Submit was clicked";
	{
        $mailtype = $_POST['mailtype'];

        
        Switch ($mailtype){
            case 'approved_member':
                break;
            case 'password_reset':
                break;
            case 'register_request':
                break;
            case 'registered_notify':
                break;
            case 'contact_us':
                break;
        }

        // echo "<script language='javascript'>";
        // echo "console.log('mailtype = " . $mailtype . "');";
        // echo "console.log('param1 = " . $param1 . "');";
        // echo "console.log('param2 = " . $param2 . "');";
        // echo "console.log('param3 = " . $param3 . "');";
        // echo "console.log('param4 = " . $param4 . "');";
        // echo "console.log('param5 = " . $param5 . "');";
        // echo "console.log('param6 = " . $param6 . "');";
        // echo "</script>";
    
	}
// Test call sendmail_stage script
    if($sendmail_stage)
    {
    echo "<script language='javascript'>";
    echo "console.log('Arrived at sendmail_stage call = " . $sendmail_stage . "');";
    echo "</script>";
?>
<script language='javascript'>
        $customer = "1";
        $domain = "1";
        $headercolor = "1";
        $headerforecolor = "1";
        $family_select = "1";
        $admin_dir = "1";
        $Login2 = "1";
        $FirstName2 = "1";
        $LastName2 = "1";
        $Email2 = "1";
        $reset = "1";
        sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset)
</script>
<?php
    }
?> 






<!-- **************************** Get the DOM text of hidden parameters ******************** -->
<script type="text/javascript">
var adminjQ = jQuery.noConflict();
adminjQ(document).ready(function () {
    adminjQ("#email_submit").on("click", function () {
        // var buttontitle = adminjQ(this).attr("value");
        // console.log("Button Title = " + buttontitle);
        var mailtype = "";
        var paramcheck2 = "";
        var customer = "";
        var domain = "";
        var headercolorvalue = "";
        var headerforecolorvalue = "";
        var param1_entry = "";
        var param2_entry = "";
        var param3_entry = "";
        var param4_entry = "";
        var param5_entry = "";

        mailtype = adminjQ("input[name='mailtype']:checked").val()
        // mailtype = adminjQ("#mailtype").val();
        // mailtype = "<?php echo($mailtype);?>";
            console.log("mailtype = " + mailtype);
        domain = adminjQ("#domainname").text();
        console.log("Domain = " + domain);
        customer = adminjQ("#custname").text();
        console.log("Customer = " + customer);
        headercolorvalue = adminjQ("#headercolorvalue").text();
        console.log("headercolorvalue = " + headercolorvalue);
        headerforecolorvalue = adminjQ("#headerforecolorvalue").text();
        console.log("headerforecolorvalue = " + headerforecolorvalue);
        family_select_entry = adminjQ("#family_select_id").val();
        console.log("family_select = " + family_select_entry);
        admin_dir_entry = adminjQ("#admin_dir_id").val();
        console.log("admin_dir = " + admin_dir_entry);
        param1_entry = adminjQ("#param1_id").val();
        console.log("login = " + param1_entry);
        param2_entry = adminjQ("#param2_id").val();
        console.log("first = " + param2_entry);
        param3_entry = adminjQ("#param3_id").val();
        console.log("last = " + param3_entry);
        param4_entry = adminjQ("#param4_id").val();
        console.log("email = " + param4_entry);
        param5_entry = adminjQ("#param5_id").val();
        console.log("resetkey = " + param5_entry);

        var email_send = adminjQ.ajax({
            url: 'services/sendmail.php',
            type: "POST",
            // dataType: 'json',
            data: {
                "Mailtype": mailtype,
                "Domain": domain,
                "Customer": customer,
                "HeaderColor": headercolorvalue,
                "Headerforecolorvalue": headerforecolorvalue,
                "Family": family_select_entry,
                "Admin": admin_dir_entry,
                "Login": param1_entry,
                "First": param2_entry,
                "Last": param3_entry,
                "Email": param4_entry,
                "ResetKey": param5_entry
            },
        });
    //$family_select = 'Selected' - which family the approved member is being added to
    //$admin_dir = 'Directory' - Registration Admin's idDirectory entry
            // The ajax call succeeded. 
            email_send.done(function (data, textStatus, jqXHR) {
                alert( "Send Email ajax call Success: " + data);
            });
            // The ajax call failed. 
            email_send.fail(function (jqXHR, textStatus, errorThrown) {
            alert( "Send Email ajax call Fail: " + errorThrown);
            });

    });

        // sendmail(mailtype, customer, domain, headercolorvalue, headerforecolorvalue, login, first, last, email)

        // adminjQ(this).closest(".hidden_params").find("#custname").css("background-color", "red");
            // customer = paramcheck.find("#custname").text();
            // console.log("Customer Name = " + customer);
            // domain = paramcheck.find("#domainname").text();
            // console.log("Domain Name = " + domain);
})
</script>
</body>
</html>    
