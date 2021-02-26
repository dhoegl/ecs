<?php
//New Registrant Accept script
//Called from regadmin.php
//Last Updated 2020/12/09
    if ( isset($_POST['Selected']) ) {
        require('../dbconnect.php');
        include('../includes/event_logs_update.php');
        // include('sendmail_stage.php');
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
        $text = array();
        if($Selected2 == '0'){ // New family
            $regacceptdirquery = "UPDATE " . $_SESSION['dirtablename'] . " SET status = '1' WHERE idDirectory = '". $Directory2 . "'";
            $regacceptdir = $mysql->query($regacceptdirquery) or die("A database error occurred when trying to update new Registrant info into directory table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            $regacceptloginquery = "UPDATE " . $_SESSION['logintablename'] . " SET active = '1', " . " idDirectory = '" . $Directory2 . "' WHERE login_ID = '". $Login2 . "'";
            $regacceptlogin = $mysql->query($regacceptloginquery) or die("A database error occurred when trying to update new Registrant info into Login table. See ajax_update_new_registrant.php. Error:" . $mysql->errno . " : " . $mysql->error);
            // eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to New Family - Directory entry: " . $Directory2);
            // sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset);
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
            // sendmail_stage('approved_member', $customer, $domain, $headercolor, $headerforecolor, $family_select, $admin_dir, $Login2, $FirstName2, $LastName2, $Email2, $reset);
        }
        $text[] = array('Status' => 'Accept Success');
	    header('Content-type: application/json');
        echo json_encode($text);
    }
    else{
        $text[] = array('Status' => 'Accept Failed');
	    header('Content-type: application/json');
        echo json_encode($text);
    }
?>