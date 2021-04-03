<!-- ******************************************** -->
<!-- ******************************************** -->
<!-- New Registrant Accept script - called from regadmin.php -->
<!-- Last Updated 2021/04/01 - consolidated registration approve to only 2 files regadmin + registrantupdate -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="en">
  <head>
    <script type='text/javascript' src='//code.jquery.com/jquery-latest.min.js'></script>
</head>
  <body>
<?php
// *** May need to delete this - Include Sendmail Script
// include('../services/sendmail.php');

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
    // echo "<script language='javascript'>";
    // echo "alert('Arrived at registrantupdate.php');";
    // echo "console.log('RegistrantUpdate function successfully called');";
    // echo "console.log('approve_registrant : Response = ' + $Response);";
    // echo "</script>";

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
        $reset = "";
        $text = array();
        if($SelectID == '0'){ // New family
            $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1' WHERE idDirectory = '". $DirID . "'";
            $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $DirID . "' WHERE login_ID = '". $LoginID . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $LoginID . " to New Family - idDirectory: " . $DirID);
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
                // $emailworks = mail($mailto,$mailsubject,$mailmessage,$mailheaders);
                $emailworks = mail($mailto,$mailsubject,$mailmessage,$mailheaders);
            // if($emailworks){
                    eventLogUpdate('mail', "User: " .  $First . " " . $Last, "Registrant Approve email", "SUCCESS");
                    // eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $LoginID . " to New Family - idDirectory: " . $DirID);
                    // }
                // else {
                //     eventLogUpdate('mail', "User: " .  $First . " " . $Last, "Registrant Approve email", "FAILED");
                // }

            $response = "success_entry_to_new_family";
        }
    else { // Apply to existing family
            if($Gender == 'M'){ // New male added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $DirID . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_1 = '" . $First . "', Email_1 = '" . $Email . "' WHERE idDirectory = '". $SelectID . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            else{ // New female added to existing family
                $regacceptdirsetassignquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '4' WHERE idDirectory = '". $DirID . "'";
                $regacceptdirsetassign = $mysql->query($regacceptdirsetassignquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
                $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1', " . " Name_2 = '" . $First . "', Email_2 = '" . $Email . "' WHERE idDirectory = '". $SelectID . "'";
                $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            }
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $SelectID . "' WHERE login_ID = '". $LoginID . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $LoginID . " added to existing Family - idDirectory: " . $DirID);
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
        // echo $response;
    }
?>

<script type="text/javascript">
</script>
            
</body>
</html>
