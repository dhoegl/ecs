// Collect registrant approval details - send to ajax_update_new_registrant.php
// RegistrantUpdate(testforSelect, DirID, LoginID, Gender, FirstName, LastName, Email);
        function RegistrantUpdate(data1, data2, data3, data4, data5, data6, data7) {
            var Selected = "Select = " + data1;
            var DirID = "Directory = " + data2;
            var LoginID = "Login = " + data3;
            var Gender = "Gender = " + data4;
            var First = "FirstName = " + data5;
            var Last = "LastName = " + data6;
            var Email = "Email = " + data7;
            var $Response = Selected + " " + DirID + " " + LoginID + " " + Gender + " " + First + " " + Last + " " + Email;
            console.log("approve_registrant : Response = " + $Response);
            jQ10.ajax({
                url: '../services/ajax_update_new_registrant.php',
                type: 'POST',
                //dataType: 'json',
                dataType: 'text',
                data: { Selected: data1, Directory: data2, Login: data3, Gender: data4, FirstName: data5, LastName: data6, Email: data7 }
            })
                .done(function (jqXHR, textStatus) {
                    //  Get the result
                    var result = "success";
                    var teststat = textStatus;
                    teststat2 = jqXHR.responseText;
                    console.log("ajax response data = " + teststat);
                    console.log("ajax response text = " + teststat2);
                    alert("Updates have been made. Registrant has been notified.");
                    location.reload();
                    return result;
                })
                .fail(function (jqXHR, textStatus) {
                    //  Get the result
                    //result = (rtnData === undefined) ? null : rtnData.d;
                    var result = "fail";
                    var teststat = textStatus;
                    var teststat2 = jqXHR.responseText;
                    // console.log("ajax response data = " + teststat);
                    // console.log("ajax response text = " + teststat2);
                    reportError(teststat);
                    //alert("A problem has occurred with your approval - ofc_approve_registrant. Please copy this error and contact your OurFamilyConnections administrator for details.");
                    location.reload();
                    return result;
                });
        };
