<?php
// Transform sendmail function call from pages that require outbound email. Convert php sendmail function into AJAX calls to sendmail script
// Last Modified: 2021/02/24
session_start();
require_once 'dbconnect.php';
include('sendmail.php');

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

<input type="hidden" class="form-control hidden_params" id="custname" name="custnamename"></input>
<input type="hidden" class="form-control hidden_params" id="domainname" name="domainnamename"></input> 
<input type="hidden" class="form-control hidden_params" id="headercolorvalue" name="headercolorname"></input> 
<input type="hidden" class="form-control hidden_params" id="headerforecolorvalue" name="headerforecolorname"></input> 


<!-- **************************** Get the DOM text of hidden parameters ******************** -->
<script type="text/javascript">
var adminjQ = jQuery.noConflict();
adminjQ(document).ready(function () {
    function sendmail_stage($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $email, $reset) { // params based on each call to sendmail
// function sendmail_setup($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $email, $reset) { // params based on each call to sendmail
    //$mailtype = type of email to send
    //$customer = 'Customer Name' - Name of church/school (email banner)
    //$domain = 'Domain' - Site domain - used to insert domain information into login email
    //$headercolor = 'headercolor' - brand banner color for email header
    //$headerforecolor = 'headerforecolor' - brand text color for email header
    //$family_select = 'Selected' - which family the approved member is being added to
    //$admin_dir = 'Directory' - Registration Admin's idDirectory entry
    //$login/$Login2 = 'Login' - approved member's user login id
    //$first/$FirstNane2 = 'FirstName' - approved member's first name
    //$last/$LastName2 = 'LastName' - approved member's last name
    //$email/$Email2 = 'Email' - approved member's email address
    //$reset = 'ResetKey' - key credential for password reset
    domain = adminjQ("#domainname").text();
    console.log("Domain = " + domain);
    customer = adminjQ("#custname").text();
    console.log("Customer = " + customer);
    headercolorvalue = adminjQ("#headercolorvalue").text();
    console.log("headercolorvalue = " + headercolorvalue);
    headerforecolorvalue = adminjQ("#headerforecolorvalue").text();
    console.log("headerforecolorvalue = " + headerforecolorvalue);
           
                    var email_send = adminjQ.ajax({
                        url: 'services/sendmail.php',
                        type: "POST",
                        // dataType: 'json',
                        data: {
                            "Mailtype": $mailtype,
                            "Domain": domain,
                            "Customer": customer,
                            "HeaderColor": headercolorvalue,
                            "Headerforecolorvalue": headerforecolorvalue,
                            "Family": $family_select,
                            "Admin": $admin_dir,
                            "Login": $login,
                            "First": $first,
                            "Last": $last,
                            "Email": $email,
                            "ResetKey": $reset
                        },
                    });
                        // The ajax call succeeded. 
                        email_send.done(function (data, textStatus, jqXHR) {
                            alert( "Send Email ajax call Success: " + data);
                        });
                        // The ajax call failed. 
                        email_send.fail(function (jqXHR, textStatus, errorThrown) {
                        alert( "Send Email ajax call Fail: " + errorThrown);
                        });
            
                };
            
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
