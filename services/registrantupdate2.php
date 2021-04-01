<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>
    <!-- <script type='text/javascript' src='../js/reg_approve_submit_to_sendmail.js'></script> -->
    <!-- <script type="text/javascript"> -->
        <!-- // function regapprovenotify(email_addr, first_submit, last_submit, user_submit, login_ID, themename, themedomain, themetitle, themecolor, themeforecolor) { -->
        <!-- //     console.log("Made it to reg_approve_submit_to_sendmail script ");
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

            // console.log("Made it to regapprovenotify, just prior to ajax call to sendmail");

            //Updated -->
            <!-- var jQpwr = jQuery.noConflict();
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
                console.log("ajax response data for registrantupdate = " + teststat);
                console.log("ajax response text for registrantupdate = " + teststat2);
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
                }); -->
            <!-- } -->
    <!-- </script> -->
</head>
  <body>
<?php
// Include Sendmail Script
include('../services/sendmail.php');

// Collect registrant approval details - send to ajax_update_new_registrant.php
// RegistrantUpdate(testforSelect, DirID, LoginID, Gender, FirstName, LastName, Email);
// function RegistrantUpdate($data1, $data2, $data3, $data4, $data5, $data6, $data7) {

    $SelectID = $_POST['Selected'];
    $DirID = $_POST['Directory'];
    $LoginID = $_POST['Login'];
    $Gender = $_POST['Gender'];
    $First = $_POST['FirstName'];
    $Last = $_POST['LastName'];
    $Email = $_POST['Email'];
    
    $data1 = "Select = " + $SelectID;
    $data2 = "Directory = " + $DirID;
    $data3 = "Login = " + $LoginID;
    $data4 = "Gender = " + $Gender;
    $data5 = "FirstName = " + $First;
    $data6 = "LastName = " + $Last;
    $data7 = "Email = " + $Email;
    $Response = $data1 + " " + $data2 + " " + $data3 + " " + $data4 + " " + $data5 + " " + $data6 + " " + $data7;
    echo "<script language='javascript'>";
    echo "alert('Arrived at registrantupdate.php');";
    echo "console.log('RegistrantUpdate function successfully called');";
    echo "console.log('approve_registrant : Response = ' + $Response);";
    echo "</script>";
//********************************************
//********************************************
//New Registrant Accept script
//Last Updated 2021/03/23

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
        echo "alert('Failed to open ../_tenant/Config.xml');";
        echo "</script>";
        // exit("Failed to open ../_tenant/Config.xml.");
    }    

        $customer = "";
        $domain = "";
        $headercolor = "";
        $headerforecolor = "";
        $family_select = "";
        $admin_dir = "";
        // $Selected2 = $_POST['Selected'];
        // $Directory2 = $_POST['Directory'];
        // $Login2 = $_POST['Login'];
        // $Gender2 = $_POST['Gender'];
        // $FirstName2 = $_POST['FirstName'];
        // $LastName2 = $_POST['LastName'];
        // $Email2 = $_POST['Email'];
        $reset = "";
        $text = array();
        if($SelectID == '0'){ // New family
            echo "<script language='javascript'>";
            echo "console.log('SelectID = 0');";
            echo "</script>";
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1' WHERE idDirectory = '". $DirID . "'";
            $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $DirID . "' WHERE login_ID = '". $LoginID . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            // eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to New Family - Directory entry: " . $Directory2);
            // Sendmail copy into this PHP flow...
                $maillink = $themedomain;
                $mailto = $Email;
                $mailsubject = "Approved access to the " . $themename . " family directory" . "\n..";
                $mailmessage = "<html><body>";
                $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
                $mailmessage .= "<p style='background-color: " .  $themecolor . "; font-size: 30px; font-weight: bold; color: " . $themeforecolor . "; padding: 25px; width=100%;'>";
                $mailmessage .= $themename . "</p>";
                $mailmessage .= "<p>Hello <strong>" . $First . " " . $Last . "</strong></p>";
                $mailmessage .= "<p>You have been approved to access " . $themename . "'s directory site!</p>";
                $mailmessage .= "<p>Click on the link below to login<br /></p>";
                $mailmessage .= "<p><a href=http://" . $maillink . ">" . $themename . "</a></p>";
                $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
                $mailmessage .= "</body></html>";
                $mailfrom = "noreply@ourfamilyconnections.org";
                $mailheaders = "From:" . $mailfrom . "\r\n";
                $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
                $mailheaders .= "MIME-Version: 1.0\r\n";
                $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                mail($mailto,$mailsubject,$mailmessage,$mailheaders);

            $response = "success_entry_to_new_family";
        }
    else { // Apply to existing family
            if($Gender2 == 'M'){ // New male added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $DirID . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_1 = '" . $First . "' WHERE idDirectory = '". $SelectID . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            else{ // New female added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $DirID . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_2 = '" . $First . "' WHERE idDirectory = '". $SelectID . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $SelectID . "' WHERE login_ID = '". $LoginID . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            // eventLogUpdate('admin_update', "Admin ID: " . $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to Directory entry: " . $Selected2);
            // Sendmail copy into this PHP flow...
            $maillink = $themedomain;
            $mailto = $Email;
            $mailsubject = "Approved access to the " . $themename . " family directory" . "\n..";
            $mailmessage = "<html><body>";
            $mailmessage .= "<p>(This was sent from an unmonitored mailbox)</p>";
            $mailmessage .= "<p style='background-color: " .  $themecolor . "; font-size: 30px; font-weight: bold; color: " . $themeforecolor . "; padding: 25px; width=100%;'>";
            $mailmessage .= $themename . "</p>";
            $mailmessage .= "<p>Hello <strong>" . $First . " " . $Last . "</strong></p>";
            $mailmessage .= "<p>You have been approved to access " . $themename . "'s directory site!</p>";
            $mailmessage .= "<p>Click on the link below to login<br /></p>";
            $mailmessage .= "<p><a href=http://" . $maillink . ">" . $themename . "</a></p>";
            $mailmessage .= "<p><br />Thank you!<br />The OurFamilyConnections team.</p>";            
            $mailmessage .= "</body></html>";
            $mailfrom = "noreply@ourfamilyconnections.org";
            $mailheaders = "From:" . $mailfrom . "\r\n";
            $mailheaders .= "Reply-To:" . $mailfrom . "\r\n";
            $mailheaders .= "MIME-Version: 1.0\r\n";
            $mailheaders .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($mailto,$mailsubject,$mailmessage,$mailheaders);
    $response = "success_entry_to_existing_family";
        // $text[] = array('Status' => 'Accept Success');
	    // header('Content-type: application/json');
        // echo json_encode($text);
        echo $response;
    }
?>

<script type="text/javascript">
</script>
            
</body>
</html>
