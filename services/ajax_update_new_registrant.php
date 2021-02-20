<?php
//New Registrant Accept script
//Called from regadmin.php
//Last Updated 2020/12/09
    if ( isset($_POST['Selected']) ) {
        require('../dbconnect.php');
        include('../includes/event_logs_update.php');
        include('sendmail.php');
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
            eventLogUpdate('admin_update', "Admin ID: " .  $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to New Family - Directory entry: " . $Directory2);
            // sendmail('approved_member', $param1, $param2, $param3, $param4, $Login2, $Selected2, $Directory2, $FirstName2, $LastName2, $Email2);
            sendmail('approved_member', $param1, $param2, $param3, $param4, $Login2, $FirstName2, $LastName2, $Email2);
        }
        // function sendmail($mailtype, $param1, $param2, $param3, $param4, $param5, $param6, $param7, $param8) { // params based on each call to sendmail
            //$mailtype = type of email to send
            //$param1 = 'Customer Name' - Name of church/school (email banner)
            //$param2 = 'Domain' - Site domain - used to insert domain information into login email
            //$param3 = 'headercolor' - brand banner color for email header
            //$param4 = 'headerforecolor' - brand text color for email header
            //$param5 = 'Login' - approved member's user login id
            //$param6 = 'FirstName' - approved member's first name
            //$param7 = 'LastName' - approved member's last name
            //$param8 = 'Email' - approved member's email address
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
            eventLogUpdate('admin_update', "Admin ID: " . $_SESSION['idDirectory'], "Registrant Approve", "LoginID: " . $Login2 . " to Directory entry: " . $Selected2);
            // sendmail('approved_member', $Login2, $Selected2, $Directory2, $FirstName2, $LastName2, $Email2);
            sendmail('approved_member', $param1, $param2, $param3, $param4, $Login2, $FirstName2, $LastName2, $Email2);
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