<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
  <!-- <script type='text/javascript' src='../js/reg_approve_submit_to_sendmail.js'></script> -->
    <!-- Copied from http://live.datatables.net/geyumizu/1/edit -->
<script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>
<script type="text/javascript">
  function regapprovenotify(email_addr, first_submit, last_submit, user_submit, login_ID, themename, themedomain, themetitle, themecolor, themeforecolor) {
    // console.log("Made it to forgot_password_submit script ");
    // console.log("email address = " + email_addr);
    // console.log("first name = " + first_submit);
    // console.log("last name = " + last_submit);
    // console.log("user name = " + user_submit);
    // console.log("login ID = " + login_ID);
    // console.log("Theme Name = " + themename);
    // console.log("Theme Domain = " + themedomain);
    // console.log("Theme Title = " + themetitle);
    // console.log("Theme Color = " + themecolor);
    // console.log("Theme ForeColor = " + themeforecolor);

    // console.log("Made it to Register Request, just prior to ajax call to sendmail");

    //Updated
    var jQpwr = jQuery.noConflict();
    var request = jQpwr.ajax({
        url: '../services/sendmail.php',
        type: 'POST',
        // dataType: 'json',
        data: { mailtype: 'approved_member', email_address: email_addr, first_name: first_submit, last_name: last_submit, user_name: user_submit, login_id: login_ID, theme_name: themename, theme_domain: themedomain, theme_title: themetitle, theme_color: themecolor, theme_forecolor: themeforecolor}
    });
    request.done(function (data, textStatus, jqXHR) {
        //  Get the result
        var result = "success";
        var testdata = data;
        var teststat = textStatus;
        teststat2 = jqXHR.responseText;
        console.log("ajax response data for registration request = " + teststat);
        console.log("ajax response text for registration request = " + teststat2);
        alert("Your request has been successfully submitted.");
        $welcomepage = window.location.hostname;
        window.locaation = $welcomepage;
        // window.location = "//tec.ourfamilyconnections.org/welcome.php";
        // location.reload();
        return result;
    });
    request.fail(function (jqXHR, textStatus) {
            //  Get the result
            //result = (rtnData === undefined) ? null : rtnData.d;
            var result = "fail";
            var teststat = textStatus;
            var teststat2 = jqXHR.responseText;
            console.log("ajax fail response data for registration request = " + teststat);
            console.log("ajax fail response text for registration request = " + teststat2);
            alert("Registration Request Failure: " + teststat + " at " + teststat2);
            // reportError(teststat);
            //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
            // location.reload();
            return result;
        });
};
</script>
  </head>
  <body>

<?php
//New Registrant Accept script
//Called from regadmin.php (Line 121)
//Last Updated 2021/03/23
echo "<script language='javascript'>";
echo "alert('Arrived at ajax_update_new_registrant');";
echo "console.log('Arrived at ajax_update_new_registrant');";
echo "</script>";

    if ( isset($_POST['Selected']) ) {
        require($_SERVER["DOCUMENT_ROOT"] . '/dbconnect.php');
        include($_SERVER["DOCUMENT_ROOT"] . '/includes/event_logs_update.php');

    // Extract email theme elements from config.xml
    if (file_exists("../_tenant/Config.xml")) {
        $xml = simplexml_load_file("../_tenant/Config.xml");
        $themename = $xml->customer->name;
        $themedomain = $xml->customer->domain;
        $themetitle = $xml->customer->hometitle;
        $themecolor = $xml->customer->banner_color;
        $themeforecolor = $xml->customer->banner_forecolor;
    } else {
        echo "<script language='javascript'>";
        echo "console.log('Failed to open ../_tenant/Config.xml');";
        echo "</script>";
        // exit("Failed to open ../_tenant/Config.xml.");
    }    

        $customer = "";
        $domain = "";
        $headercolor = "";
        $headerforecolor = "";
        $family_select = "";
        $admin_dir = "";
        $Selected2 = $_POST['Selected'];
        $Directory2 = $_POST['Directory'];
        $Login2 = $_POST['Login'];
        $Gender2 = $_POST['Gender'];
        $FirstName2 = $_POST['FirstName'];
        $LastName2 = $_POST['LastName'];
        $Email2 = $_POST['Email'];
        $reset = "";
        $text = array();
        if($Selected2 == '0'){ // New family
            $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1' WHERE idDirectory = '". $Directory2 . "'";
            $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $Directory2 . "' WHERE login_ID = '". $Login2 . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            // eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to New Family - Directory entry: " . $Directory2);
            // Send Registration Approval to handler at reg_approve_submit_to_sendmail.js
            regapprovenotify($Email2, $FirstName2, $LastName2, $user_name, $Login2, $themename, $themedomain, $themetitle, $themecolor, $themeforecolor);
            $response = "success_entry_to_new_family";
        }
// function sendmail_stage($mailtype, $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $login, $first, $last, $email, $reset) { // params based on each call to sendmail
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
    else { // Apply to existing family
            if($Gender2 == 'M'){ // New male added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $Directory2 . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_1 = '" . $FirstName2 . "' WHERE idDirectory = '". $Selected2 . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            else{ // New female added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $Directory2 . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_2 = '" . $FirstName2 . "' WHERE idDirectory = '". $Selected2 . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $Selected2 . "' WHERE login_ID = '". $Login2 . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            // eventLogUpdate('admin_update', "Admin ID: " . $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to Directory entry: " . $Selected2);
            // Send Registration Approval to handler at reg_approve_submit_to_sendmail.js
            regapprovenotify($Email2, $FirstName2, $LastName2, $user_name, $Login2, $themename, $themedomain, $themetitle, $themecolor, $themeforecolor);
        $response = "success_entry_to_existing_family";
        // $text[] = array('Status' => 'Accept Success');
	    // header('Content-type: application/json');
        // echo json_encode($text);
        echo $response;
    }
}
    else{
        // $text[] = array('Status' => 'Accept Failed');
	    // header('Content-type: application/json');
        // echo json_encode($text);
        echo $response;
    }
    // sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset);
    ?>
</body>
</html>