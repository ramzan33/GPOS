<!--
=========================================================
Material Dashboard PRO - v2.1.2
=========================================================

Product Page: https://www.creative-tim.com/product/material-dashboard-pro
Copyright 2020 Creative Tim (https://www.creative-tim.com)
Coded by Creative Tim

=========================================================
The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. -->
<?php
session_start();
require_once("./assets/include/connection.php");
$query = "SELECT * FROM sub_location_info";
$result = $cn->query($query);
if ($result->num_rows > 0) {
    $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<?php
session_start();
require_once("./assets/include/connection.php");
$query1 = "SELECT * FROM access_point_info";
$result1 = $cn->query($query1);
if ($result1->num_rows > 0) {
    $options1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="./assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        GPOS
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="./assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <script type="text/javascript" src="./assets/include/jquery-1.8.js"></script>
    <script type="text/javascript">
        var staticProperty;

        function preview() {
            frame.src = URL.createObjectURL(event.target.files[0]);
            getBaseUrl();
        }

       

        function add_info_data() {
            // alert("hello");
            var jsonData = {};

            var formData = $("#deviceSetting").serializeArray();
            // console.log(formData);

            $.each(formData, function() {
                if (jsonData[this.name]) {
                    if (!jsonData[this.name].push) {
                        jsonData[this.name] = [jsonData[this.name]];
                    }
                    jsonData[this.name].push(this.value || '');
                } else {
                    jsonData[this.name] = this.value || '';
                }


            });
            //alert(jsonData);
            
            str = JSON.stringify(jsonData);
            // console.log(str);
            //   alert(str);
            $.ajax({
                    data: str,
                    url: 'assets/include/add_info_deviceSetting.php',
                    type: 'POST',
                    processData: false,
                    contentType: 'application/json'
                })
                
                .done(function(msg) {
                    alert('ok');
                    alert(msg);
                    var obj = jQuery.parseJSON(msg);
                    console.log(obj);

                    alert(obj.mesage);
                    
                }),
                error(function(r, s, e) {
                    alert("Unexpected error:" + e);
                    console.log(r);
                    console.log(s);
                    console.log(e);
                });
            return false;

        }

        function dell_info_data(form_val) {


            alert(form_val);
            var answer = confirm("Are you sure you want to delete information data?")

            if (answer) {

                $.ajax({
                        type: "POST",
                        url: "assets/include/dell_informationLocation.php?del_val=" + form_val
                    })
                    .done(function(msg) {

                        alert(msg);
                        var obj = jQuery.parseJSON(msg);
                        alert(obj.infonameok);

                        if (obj.infonameok == 'yes') {


                            $('#record' + obj.infoid).remove();
                        }

                        alert(obj.mesage);
                    });
                return false;
            }
        }


        function edit_info(stat, form_val) {
            //alert("Hello");



            //alert(stat); 


            if (stat == 'calledit') {
                var obj;

                $.ajax({
                        type: "POST",
                        url: "assets/systemInfo/info_edit_data.php?edit_val=" + form_val + "&edit_stat=" + stat
                    })
                    .done(function(msg) {


                        obj = jQuery.parseJSON(msg);
                        alert(msg);
                        $("#div_Syslocation").hide();


                        $('#editinfo_form').css('display', '');

                        //  alert(obj.slocation_id);

                        $cname = $("select[name='sub_location_edit']").empty();

                        var objj;

                        $.ajax({
                                type: "POST",
                                url: "assets/systemInfo/sub_loc_data.php"
                            })
                            .done(function(msg) {

                                // alert(msg);
                                objj = jQuery.parseJSON(msg);
                                alert(obj.slocation_id);
                                for (var i in objj.optionvalue) {

                                    if (objj.optionvalue[i][0] == obj.slocation_id)
                                        var selected = 'selected="selected"';
                                    else
                                        var selected = '';

                                    $('<option value="' + objj.optionvalue[i][0] + '" ' + selected + '>' + objj.optionvalue[i][0] + ' ' + objj.optionvalue[i][1] + '</option>').appendTo($cname);
                                }

                                // alert(obj.message);
                            });

                        $dname = $("select[name='access_point_edit']").empty();

                        var objAc;
                        $.ajax({
                                type: "POST",
                                url: "assets/systemInfo/accessPoint_loc_data.php"
                            })
                            .done(function(msg) {

                                // alert(msg);
                                objAc = jQuery.parseJSON(msg);

                                for (var i in objAc.optionvalue) {

                                    if (objAc.optionvalue[i][0] == obj.access_point_id)
                                        var selected = 'selected="selected"';
                                    else
                                        var selected = '';

                                    $('<option value="' + objAc.optionvalue[i][0] + '" ' + selected + '>' + objAc.optionvalue[i][0] + ' ' + objAc.optionvalue[i][1] + '</option>').appendTo($dname);
                                }
                                // alert(obj.message);
                            });


                        $('#system_info_id').val(obj.system_id);



                        //var cobvalue=obj.slocation_address.''.obj.slocation_id;


                        $('#system_name_edit').val(obj.infoname);
                        $('#system_ip_edit').val(obj.system_ip);

                        // $('#access_on_off_edit').val(obj.access_on_off);
                        // $('#sub_location_edit').val(obj.slocation_id);
                        // $('#access_point_edit').val(obj.acc_point_id);


                    });


                return false;
            }

            if (stat == 'update') {

                str = $("#editinfo_forma").serialize();

                alert(str);
                var obj;

                $.ajax({
                        type: "POST",
                        url: "assets/systemInfo/info_edit_data.php?edit_stat=" + stat,
                        data: str
                    })
                    .done(function(msg) {

                        alert(msg);
                        obj = jQuery.parseJSON(msg);



                        $('#editinfo_form').css('display', 'none');

                        if (obj.infonameok == 'yes') {

                            $('#record' + obj.infoid).remove();
                            $('#records').append('<tr id="record' + obj.infoid + '"><td width="92%" class="style14" bgcolor="#e5ded4"><div align="left" class="style15 style19"><strong>' + obj.infoname + '</strong></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="edit_info(' + obj.editplink + ')"><i class="material-icons md-18 orange600">create</i></a></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="delete_info(' + obj.infoid + ')"><i class="material-icons md-18 red600">delete</i></a></div></td></tr>');
                        }
                        alert(obj.message);
                    });


                return false;
            }

        }
    </script>
    <link href="./assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="rose" data-background-color="black" data-image="./assets/img/sidebar-1.jpg">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
            <div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-mini">
                    G
                </a>
                <a href="http://www.creative-tim.com" class="simple-text logo-normal">
                    POS
                </a>
            </div>
            <div class="sidebar-wrapper">
                <div class="user">
                    <div class="photo">
                        <img src="./assets/img/faces/AQSA (2).jpeg" />
                    </div>
                    <div class="user-info">
                        <a data-toggle="collapse" href="#collapseExample" class="username">
                            <span>
                                AQSA TEC
                                <b class="caret"></b>
                            </span>
                        </a>

                    </div>
                </div>
                <ul class="nav">
                    <li class="nav-item active ">
                        <a class="nav-link" href="./dashboard.php">
                            <i class="material-icons">dashboard</i>
                            <p id="chk"> Dashboard </p>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                            <i class="material-icons">settings</i>
                            <p> <strong>FRS setting</strong>
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="formsExamples">
                            <ul class="nav">
                                <li class="nav-item ">
                                    <a class="nav-link" href="./systemInformation.php">
                                        <span class="sidebar-mini"></span>
                                        <span class="sidebar-normal"> System Info </span>
                                    </a>
                                </li>

                                <li class="nav-item ">
                                    <a class="nav-link" data-toggle="collapse" href="#componentsCollapse">
                                        <span class="sidebar-mini"> </span>
                                        <span class="sidebar-normal"> System Configration
                                            <b class="caret"></b>
                                        </span>
                                    </a>
                                    <div class="collapse" id="componentsCollapse">
                                        <ul class="nav">
                                            <li class="nav-item ">
                                                <a class="nav-link" href="./masterLocation.php">
                                                    <span class="sidebar-mini"></span>
                                                    <span class="sidebar-normal">Master Location</span>
                                                </a>
                                            </li>
                                            <li class="nav-item ">
                                                <a class="nav-link" href="./subLocation.php">
                                                    <span class="sidebar-mini"></span>
                                                    <span class="sidebar-normal">Sub Location</span>
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link" data-toggle="collapse" href="#componentsExamples">
                            <i class="material-icons">settings_suggest</i>
                            <p> General Setting
                                <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="componentsExamples">
                            <ul class="nav">

                                <li class="nav-item ">
                                    <a class="nav-link" href="./addNewUser.php">
                                        <span class="sidebar-mini"> </span>
                                        <span class="sidebar-normal">Manage User </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" href="#componentsCollapse">
                                        <span class="sidebar-mini"> </span>
                                        <span class="sidebar-normal">Other Setting </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-minimize">
                            <button id="minimizeSidebar" class="btn btn-just-icon btn-white btn-fab btn-round">
                                <i class="material-icons text_align-center visible-on-sidebar-regular">more_vert</i>
                                <i class="material-icons design_bullet-list-67 visible-on-sidebar-mini">view_list</i>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:;">Register Facial</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                        <span class="navbar-toggler-icon icon-bar"></span>
                    </button>

                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid" id="div_Syslocation">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header card-header-rose card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">mail_outline</i>
                                    </div>
                                    <h4 class="card-title">Register Facial</h4>
                                </div>
                                <div class="card-body ">
                                    <form method="post" action="" id="deviceSetting" name="deviceSetting" enctype="multipart/form-data">
                                        <div class="card-body mt-5">

                                            <div  class="row mt-3">

                                                <label  class="col-sm-offset-1 col-form-label ml-5" for="volume">Volume</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="volume" name="volume" class="form-control">
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="15">15</option>
                                                            <option value="20">20</option>
                                                            <option value="25">25</option>
                                                            <option value="30">30</option>
                                                            <option value="35">35</option>
                                                            <option value="40">40</option>
                                                            <option value="45">45</option>
                                                            <option value="50" seleted>50</option>
                                                            <option value="55">55</option>
                                                            <option value="60">60</option>
                                                            <option value="65">65</option>
                                                            <option value="70">70</option>
                                                            <option value="75">75</option>
                                                            <option value="80">80</option>
                                                            <option value="85">85</option>
                                                            <option value="90">90</option>
                                                            <option value="95">95</option>
                                                            <option value="100">100</option>
                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>
                                                <label  class="col-sm-offset-1 col-form-label ml-3" for="isShowName">Is Show Name</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="isShowName" name="isShowName" class="form-control">
                                                        <option value="notShow">Not Show</option>   
                                                        <option value="show">Show</option>                                                          
                                                        <option value="partOfShow">Part Of Show</option>
                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>
                                                <label  class="col-sm-offset-1 col-form-label ml-3 col-md-2" for="verifySuccessfulGUIDisplay">Verify Successful GUI Display</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="verifySuccessfulGUIDisplay" name="verifySuccessfulGUIDisplay" class="form-control">
                                                        <option value="snapImage">Snap image</option>   
                                                        <option value="registractionImage">Registraction image</option>                                                              
                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row mt-3 ml-2"> 

                                                <div class="form-group ml-2 mt-8 col-3">
                                                    <label for="locationAddress" class="bmd-label-floating" for="icompanyNameshow">Company Name Show</label>
                                                    <input type="text" class="form-control " id="companyNameshow" name="companyNameshow">
                                                </div>

                                                <div class="form-group ml-1 mt-8 col-3">
                                                    <label for="locationAddress" class="bmd-label-floating" for="verifySuccessfulTipsContent">Verify Successful Tips Content</label>
                                                    <input type="text" class="form-control" id="verifySuccessfulTipsContent" name="verifySuccessfulTipsContent">
                                                </div>

                                                <div class="form-group ml-5 mt-8 col-3">
                                                    <label for="locationAddress" class="bmd-label-floating" for="listUnregisteredTipsConten">List Unregistered Tips Conten</label>
                                                    <input type="text" class="form-control" id="listUnregisteredTipsConten" name="listUnregisteredTipsConten">
                                                </div>


                                            </div>

                                            <div  class="row mt-3 ml-2">

                                               <div class="form-group ml-2 mt-8 col-3">
                                                    <label for="locationAddress" class="bmd-label-floating" for="verifyFailedTipsContent">Verify Failed Tips Content</label>
                                                    <input type="text" class="form-control" id="verifyFailedTipsContent" name="verifyFailedTipsContent">
                                                </div>

                                                <label style="text-align:center"  class="col-sm-offset-1 col-form-label ml-3" for="companylogo">Company logo</label>
                                                <div class="col-md-2 ">
                                                    <div class="form-group">
                                                        <select id="companylogo" name="companylogo" class="form-control">
                                                        <option value="dispaly">Dispaly</option>   
                                                        <option value="notDispaly">Not Dispaly</option>                                                              
                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>

                                                <div class="form-group ml-2 mt-8 col-3">
                                                    <label for="locationAddress" class="bmd-label-floating" for="Abscissa">Abscissa</label>
                                                    <input type="text" class="form-control" id="Abscissa" name="Abscissa">
                                                </div>
                                          </div> 

                                            <div class="row mt-3 ml-2"> 

                                            <div class="form-group ml-2 mt-8 col-3">
                                                 <label for="locationAddress" class="bmd-label-floating" for="ordinate">Ordinate</label>
                                                 <input type="text" class="form-control " id="ordinate" name="ordinate">
                                           </div>

                                           <div class="form-group ml-1 mt-8 col-3">
                                                <label for="locationAddress" class="bmd-label-floating" for="width">Width</label>
                                                <input type="text" class="form-control" id="width" name="width">
                                            </div>

                                            <div class="form-group ml-5 mt-8 col-3">
                                                <label for="locationAddress" class="bmd-label-floating" for="height">Height</label>
                                                <input type="text" class="form-control" id="height" name="height">
                                            </div>

                                            </div>
                                            <div class="row mt-3 ml-2"> 

                                                <div  class="mt-4 ml-5">
                                                    <input class="form-check-input" type="checkBox" id="verifySuccessSound" name="verifySuccessSound" checked>
                                                    <label class="verifySuccessSound" for="verifySuccessSound">
                                                    Verify Success Sound
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="verifyFailedSound" name="verifyFailedSound" checked>
                                                    <label class="verifyFailedSound" for="verifyFailedSound">
                                                    Verify Failed Sound
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="remoteControlSound" name="remoteControlSound" checked>
                                                    <label class="remoteControlSound" for="remoteControlSound">
                                                    Remote Control Sound
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="verifySuccessfulInterfaceTips" name="verifySuccessfulInterfaceTips" checked>
                                                    <label class="verifySuccessfulInterfaceTips" for="verifySuccessfulInterfaceTips">
                                                    Verify Successful Interface Tips
                                                    </label>
                                                </div>
                        
                                            </div>

                                            <div class="row mt-3 ml-2"> 

                                                <div  class="mt-4 ml-5">
                                                    <input class="form-check-input" type="checkBox" id="verifyFailedInterfaceTips" name="verifyFailedInterfaceTips" checked>
                                                    <label class="verifyFailedInterfaceTips" for="verifyFailedInterfaceTips">
                                                    Verify Failed Interface Tips
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="listUnregisteredInterfaceTips" name="listUnregisteredInterfaceTips" checked>
                                                    <label class="listUnregisteredInterfaceTips" for="listUnregisteredInterfaceTips">
                                                    List Unregistered Interface Tips
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="cardNumberHide" name="cardNumberHide" checked>
                                                    <label class="cardNumberHide" for="cardNumberHide">
                                                    Card Number hide
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="iPHide" name="iPHide" checked>
                                                    <label class="iPHide" for="iPHide">
                                                    IP hide
                                                    </label>
                                                </div>
                        
                                            </div>

                                             <div class="row mt-3 ml-2"> 

                                                <div  class="mt-4 ml-5">
                                                    <input class="form-check-input" type="checkBox" id="isShowSn" name="isShowSn" checked>
                                                    <label class="isShowSn" for="isShowSn">
                                                    Is Show SN
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="doorContact" name="doorContact" checked>
                                                    <label class="doorContact" for="doorContact">
                                                    Door Contact
                                                    </label>
                                                </div>

                                                <div style="margin-left:60px" class="mt-4">
                                                    <input class="form-check-input" type="checkBox" id="whetherToDisplayTheNumberOfRegistered" name="whetherToDisplayTheNumberOfRegistered" checked>
                                                    <label class="whetherToDisplayTheNumberOfRegistered" for="whetherToDisplayTheNumberOfRegistered">
                                                    Whether to display the number of registered
                                                    </label>
                                                </div>
                                            </div>
                                             
                                            

 

                                            <div class="row justify-contant-center align-item-center">
                                                <div style="text-align: center;" class="card-body ">

                                                    <button class="btn btn-primary" onclick="add_info_data()">Save</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                



                <div class="container-fluid" id="editinfo_form" name="editinfo_form" style="display:none">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card ">
                                <div class="card-header card-header-rose card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">mail_outline</i>
                                    </div>
                                    <h4 class="card-title">Update System Info</h4>
                                </div>
                                <div class="card-body ">
                                    <form method="post" value="Edit" id="editinfo_forma" name="editinfo_forma">
                                        <div class="card-body">
                                            <div class="row">
                                                <label style="margin-left:80px" for="access_on_off_edit" class="col-sm-offset-1 col-form-label">Access on/off</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="access_on_off_edit" name="access_on_off_edit" class="form-control">
                                                            <option value="On">On</option>
                                                            <option value="Off">Off</option>


                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>
                                                <label style="margin-left:20px" for="sub_location_edit" class="col-sm-offset-1 col-form-label">Sub Location</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="sub_location_edit" name="sub_location_edit" class="form-control">
                                                            <!-- <?php
                                                                    foreach ($options as $option) {
                                                                    ?>
                                                                     <option><?php echo $option['slocation_name']; ?> </option>
                             
                                                                        <?php
                                                                    }
                                                                        ?> -->

                                                        </select>
                                                        <span class="bmd-help"></span>
                                                    </div>
                                                </div>
                                                <label style="margin-left:20px" class="col-sm-offset-1 col-form-label" for="access_point_edit">Access Point</label>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <select id="access_point_edit" name="access_point_edit" class="form-control">
                                                            <!-- <?php
                                                                    foreach ($options1 as $option) {
                                                                    ?>
                                <option><?php echo $option['acc_point_name']; ?> </option>
                              <?php
                                                                    }
                                ?> -->


                                                        </select>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="row">

                                                    <div style="margin:40px 5px 30px 270px" class="form-group">
                                                        <label class="bmd-label-floating" for="system_name_edit">System Name</label>
                                                        <input type="text" class="form-control" id="system_name_edit" name="system_name_edit">
                                                        <input name="system_info_id" type="hidden" id="system_info_id" value="" />
                                                    </div>
                                                    <div style="margin:40px 5px 5px 80px" class="form-group">
                                                        <label for="locationAddress" class="bmd-label-floating" for="system_ip_edit">System IP</label>
                                                        <input type="text" class="form-control" id="system_ip_edit" name="system_ip_edit">
                                                    </div>

                                                </div>
                                            </div>




                                            <div class="row">
                                                <div style="text-align: center;" class="card-body">

                                                    <button class="btn btn-primary" onClick="edit_info('update','1')">Update</button>


                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>




                <div class="container-fluid">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-rose card-header-icon">
                                    <div class="card-icon">
                                        <i class="material-icons">assignment</i>
                                    </div>
                                    <h4 class="card-title">Register Facial</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr id="records">
                                                    <th class="text-center"><strong>#</strong></th>
                                                    <th><strong>Access</strong></th>
                                                    <th><strong>Sub Id</strong></th>
                                                    <th><strong>Sub Location</strong></th>
                                                    <th><strong>Access Id</strong></th>
                                                    <th><strong>Access Point</strong></th>
                                                    <th><strong>System Name</strong></th>
                                                    <th><strong>System Ip</strong></th>
                                                    <th class="text-right"><strong>Actions</strong></th>

                                                </tr>
                                            </thead>
                                            <?php
                                            $rs1 = mysqli_query($cn, "SELECT SI.system_id,Ap.acc_point_name,AP.acc_point_id,
                      S.slocation_id,SI.access_on_off,SI.system_name,SI.system_ip,S.slocation_name
                      FROM system_info SI JOIN sub_location_info S ON SI.slocation_id =S.slocation_id 
                      JOIN access_point_info Ap
                      ON SI.access_point_id=AP.acc_point_id");
                                            // var_dump("result::",$rs1);
                                            //$row = mysqli_fetch_array($rs1);
                                            while ($row1 = mysqli_fetch_array($rs1)) {

                                                $info_id = $row1['system_id'];
                                                $acc_point_id = $row1['acc_point_id'];
                                                $access_point_name = $row1['acc_point_name'];
                                                $slocation_id = $row1['slocation_id'];
                                                $access_on_off = $row1['access_on_off'];
                                                $system_name = $row1['system_name'];
                                                $system_ip = $row1['system_ip'];
                                                $subLocation_name = $row1['slocation_name'];


                                            ?>

                                                <tbody>

                                                    <tr id="record<?php echo $info_id; ?>">
                                                        <td class="text-center"><?php echo $info_id; ?></td>
                                                        <td><?php echo $access_on_off; ?></td>
                                                        <td><?php echo $slocation_id; ?></td>
                                                        <td><?php echo $subLocation_name; ?></td>

                                                        <td><?php echo $acc_point_id; ?></td>
                                                        <td><?php echo $access_point_name; ?></td>
                                                        <td><?php echo $system_name; ?></td>
                                                        <td><?php echo $system_ip; ?></td>
                                                        <td class="td-actions text-right">

                                                            <button type="button" rel="tooltip" class="btn btn-success btn-link" onclick="edit_info('calledit',<?php echo $info_id; ?>)">
                                                                <i class="material-icons">edit</i>
                                                            </button>
                                                            <button type="button" rel="tooltip" class="btn btn-danger btn-link" onclick="dell_info_data(<?php echo $info_id; ?>)">
                                                                <i class="material-icons">close</i>
                                                            </button>
                                                            </button>
                                                        </td>


                                                    </tr>


                                                </tbody>
                                            <?php
                                            }
                                            ?>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <!--   Core JS Files   -->
            <script src="./assets/js/core/jquery.min.js"></script>
            <script src="./assets/js/core/popper.min.js"></script>
            <script src="./assets/js/core/bootstrap-material-design.min.js"></script>
            <script src="./assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
            <!-- Plugin for the momentJs  -->
            <script src="./assets/js/plugins/moment.min.js"></script>
            <!--  Plugin for Sweet Alert -->
            <script src="./assets/js/plugins/sweetalert2.js"></script>
            <!-- Forms Validations Plugin -->
            <script src="./assets/js/plugins/jquery.validate.min.js"></script>
            <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
            <script src="./assets/js/plugins/jquery.bootstrap-wizard.js"></script>
            <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
            <script src="./assets/js/plugins/bootstrap-selectpicker.js"></script>
            <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
            <script src="./assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
            <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
            <script src="./assets/js/plugins/jquery.dataTables.min.js"></script>
            <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
            <script src="./assets/js/plugins/bootstrap-tagsinput.js"></script>
            <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
            <script src="./assets/js/plugins/jasny-bootstrap.min.js"></script>
            <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
            <script src="./assets/js/plugins/fullcalendar.min.js"></script>
            <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
            <script src="./assets/js/plugins/jquery-jvectormap.js"></script>
            <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
            <script src="./assets/js/plugins/nouislider.min.js"></script>
            <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
            <!-- Library for adding dinamically elements -->
            <script src="./assets/js/plugins/arrive.min.js"></script>
            <!--  Google Maps Plugin    -->
            <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
            <!-- Chartist JS -->
            <script src="./assets/js/plugins/chartist.min.js"></script>
            <!--  Notifications Plugin    -->
            <script src="./assets/js/plugins/bootstrap-notify.js"></script>
            <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
            <script src="./assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
            <!-- Material Dashboard DEMO methods, don't include it in your project! -->
            <script src="./assets/demo/demo.js"></script>
            <script>
                $(document).ready(function() {
                    $().ready(function() {
                        $sidebar = $('.sidebar');

                        $sidebar_img_container = $sidebar.find('.sidebar-background');

                        $full_page = $('.full-page');

                        $sidebar_responsive = $('body > .navbar-collapse');

                        window_width = $(window).width();

                        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                            if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                                $('.fixed-plugin .dropdown').addClass('open');
                            }

                        }

                        $('.fixed-plugin a').click(function(event) {
                            // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                            if ($(this).hasClass('switch-trigger')) {
                                if (event.stopPropagation) {
                                    event.stopPropagation();
                                } else if (window.event) {
                                    window.event.cancelBubble = true;
                                }
                            }
                        });

                        $('.fixed-plugin .active-color span').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-color', new_color);
                            }

                            if ($full_page.length != 0) {
                                $full_page.attr('filter-color', new_color);
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.attr('data-color', new_color);
                            }
                        });

                        $('.fixed-plugin .background-color .badge').click(function() {
                            $(this).siblings().removeClass('active');
                            $(this).addClass('active');

                            var new_color = $(this).data('background-color');

                            if ($sidebar.length != 0) {
                                $sidebar.attr('data-background-color', new_color);
                            }
                        });

                        $('.fixed-plugin .img-holder').click(function() {
                            $full_page_background = $('.full-page-background');

                            $(this).parent('li').siblings().removeClass('active');
                            $(this).parent('li').addClass('active');


                            var new_image = $(this).find("img").attr('src');

                            if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                $sidebar_img_container.fadeOut('fast', function() {
                                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                    $sidebar_img_container.fadeIn('fast');
                                });
                            }

                            if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $full_page_background.fadeOut('fast', function() {
                                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                    $full_page_background.fadeIn('fast');
                                });
                            }

                            if ($('.switch-sidebar-image input:checked').length == 0) {
                                var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                                var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                            }

                            if ($sidebar_responsive.length != 0) {
                                $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                            }
                        });

                        $('.switch-sidebar-image input').change(function() {
                            $full_page_background = $('.full-page-background');

                            $input = $(this);

                            if ($input.is(':checked')) {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar_img_container.fadeIn('fast');
                                    $sidebar.attr('data-image', '#');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page_background.fadeIn('fast');
                                    $full_page.attr('data-image', '#');
                                }

                                background_image = true;
                            } else {
                                if ($sidebar_img_container.length != 0) {
                                    $sidebar.removeAttr('data-image');
                                    $sidebar_img_container.fadeOut('fast');
                                }

                                if ($full_page_background.length != 0) {
                                    $full_page.removeAttr('data-image', '#');
                                    $full_page_background.fadeOut('fast');
                                }

                                background_image = false;
                            }
                        });

                        $('.switch-sidebar-mini input').change(function() {
                            $body = $('body');

                            $input = $(this);

                            if (md.misc.sidebar_mini_active == true) {
                                $('body').removeClass('sidebar-mini');
                                md.misc.sidebar_mini_active = false;

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                            } else {

                                $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                                setTimeout(function() {
                                    $('body').addClass('sidebar-mini');

                                    md.misc.sidebar_mini_active = true;
                                }, 300);
                            }

                            // we simulate the window Resize so the charts will get updated in realtime.
                            var simulateWindowResize = setInterval(function() {
                                window.dispatchEvent(new Event('resize'));
                            }, 180);

                            // we stop the simulation of Window Resize after the animations are completed
                            setTimeout(function() {
                                clearInterval(simulateWindowResize);
                            }, 1000);

                        });
                    });
                });
            </script>
            <script>
                $(document).ready(function() {
                    // Javascript method's body can be found in assets/js/demos.js
                    md.initDashboardPageCharts();

                    md.initVectorMap();

                });
            </script>
</body>

</html>