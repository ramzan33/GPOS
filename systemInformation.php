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

include("./assets/include/connect.php");
$query = "SELECT * FROM main_location";
$result = $cn->query($query);
if ($result->num_rows > 0) {
  $options = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
    //Add Main Location
    function add_main_data() {


      str = $("#mainLocationForm").serialize();
      //console.log(str);
      // alert(str);
      $.ajax({
          type: "POST",
          url: "assets/include/add_main_info.php?" + str
        })
        .done(function(msg) {
          //alert('ok');
          alert(msg);
          var obj = jQuery.parseJSON(msg);
          console.log(obj);

          alert(obj.mesage);
          //alert(obj.locationid);

          if (obj.infonameok == 'yes') {
            window.reload();
            return false;
            // console.log(msg);
            // console.log("Hello its a test.");
            // $('#records').append('<tr id="record' + obj.infoid + '"><td width="92%" class="style14" bgcolor="#e5ded4"><div align="left" class="style15 style19"><strong>' + obj.infoname + '</strong></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="edit_info(' + obj.editplink + ')"><i class="material-icons md-18 orange600">create</i></a></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="delete_info(' + obj.infoid + ')"><i class="material-icons md-18 red600">delete</i></a></div></td></tr>');

          }

        });
      return false;

    }
    //Add Sub Location
    function add_sub_data() {
      str = $("#subLocationForm").serialize();

      $.ajax({
          type: "POST",
          url: "assets/include/add_sub_info.php?" + str
        })
        .done(function(msg) {
          //alert('ok');
          alert(msg);
          var obj = jQuery.parseJSON(msg);
          console.log(obj);

          alert(obj.mesage);
          //alert(obj.locationid);

          if (obj.infonameok == 'yes') {
            window.reload();
            return false;
            // console.log(msg);
            // console.log("Hello its a test.");
            // $('#records').append('<tr id="record' + obj.infoid + '"><td width="92%" class="style14" bgcolor="#e5ded4"><div align="left" class="style15 style19"><strong>' + obj.infoname + '</strong></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="edit_info(' + obj.editplink + ')"><i class="material-icons md-18 orange600">create</i></a></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="delete_info(' + obj.infoid + ')"><i class="material-icons md-18 red600">delete</i></a></div></td></tr>');

          }

        });
      return false;

    }

    function add_device_data() {
      str = $("#deviceForm").serialize();

      $.ajax({
          type: "POST",
          url: "assets/include/add_device_info.php?" + str
        })
        .done(function(msg) {
          //alert('ok');
          alert(msg);
          var obj = jQuery.parseJSON(msg);
          console.log(obj);

          alert(obj.mesage);
          //alert(obj.locationid);

          if (obj.infonameok == 'yes') {
            window.reload();
            return false;
            // console.log(msg);
            // console.log("Hello its a test.");
            // $('#records').append('<tr id="record' + obj.infoid + '"><td width="92%" class="style14" bgcolor="#e5ded4"><div align="left" class="style15 style19"><strong>' + obj.infoname + '</strong></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="edit_info(' + obj.editplink + ')"><i class="material-icons md-18 orange600">create</i></a></div></td><td width="4%" bgcolor="#e5ded4"><div align="center"><a href="#" onClick="delete_info(' + obj.infoid + ')"><i class="material-icons md-18 red600">delete</i></a></div></td></tr>');

          }

        });
      return false;

    }
    //Delete Record
    function dell_info_data(form_val) {


      //alert(form_val);
      var answer = confirm("Are you sure you want to delete information data?")

      if (answer) {

        $.ajax({
            type: "POST",
            url: "assets/include/delete_record.php?del_val=" + form_val
          })
          .done(function(msg) {

            //alert(msg);
            var obj = jQuery.parseJSON(msg);
            //alert(obj.infonameok);

            if (obj.infonameok == 'yes') {


              $('#record' + obj.infoid).remove();
            }

            alert(obj.mesage);
          });
        return false;
      }
    }
    //Select MainLocation
    function selectMain(data) {
      //  alert(data);
      const ajaxReq = new XMLHttpRequest();
      ajaxReq.open('GET', 'http://localhost/GPOS/getData.php?selectValue=' + data, 'TRUE');
      ajaxReq.send();
      ajaxReq.onreadystatechange = function() {
        if (ajaxReq.readyState == 4 && ajaxReq.status == 200) {
          document.getElementById('sub_location').innerHTML = ajaxReq.responseText;
        }
      }
    }
  </script>
  <link href="./assets/demo/demo.css" rel="stylesheet" />

  <style>
    .cardHeight {
      height: 400px;
    }

    form label {
      font-weight: bold;

    }
  </style>
</head>



<body class="">
  <div class="wrapper">
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
                <!-- <b class="caret"></b> -->
              </span>
            </a>

          </div>
        </div>
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#formsExamples">
              <i class="material-icons">move_location</i>
              <p> <strong>Manage Locations</strong>
                <b class="caret"></b>
              </p>
            </a>
            <div class="collapse" id="formsExamples">
              <ul class="nav">
                <li class="nav-item ">
                  <a class="nav-link" href="./systemInformation.php">
                    <span class="sidebar-mini"></span>
                    <i class="material-icons">add_location</i>
                    <span class="sidebar-normal"><strong>Add Locations</strong> </span>

                  </a>
                </li>
              </ul>
              
            </div>
            
          </li>
          <li class="nav-item ">
                  <a class="nav-link" href="./enrollPerson.php">
                    <span class="sidebar-mini"></span>
                    <i class="material-icons">person_add</i>
                    <span class="sidebar-normal"><strong>Enroll Person</strong> </span>

                  </a>
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
            <a class="navbar-brand" href="javascript:;">Device Info</a>
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
        <div class="container-fluid " id="div_Syslocation">
          <div class="row d_flex">
            <!-- Main Location Form -->
            <div class="col-md-4">
              <div class="card cardHeight">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Main Location</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="" id="mainLocationForm" name="mainLocationForm">
                    <div class="card-body"><br>
                      <div class="row">

                        <div style="margin-left:25px" class="form-group col-md-10">
                          <label for="mainLocation" class="bmd-label-floating">Main Location</label>
                          <input type="text" class="form-control" id="mainLocation" name="mainLocation">
                        </div>
                      </div></br></br>
                      <div class="row">
                        <div style="text-align: center;" class="card-body ">
                          <button class="btn btn-primary mt=6" onclick="add_main_data()">Add</button>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- Sub Location Form -->
            <div class="col-md-4">
              <div class="card cardHeight">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Sub Location</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="" id="subLocationForm" name="subLocationForm">
                    <div class="card-body">
                      <div class="row">

                        <label style="margin-left:30px" for="mainLocation_List" class="col-sm-offset-1 col-form-label">Main Location</label>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select id="mainLocation_List" name="mainLocation_List" class="form-control">
                              <?php
                              foreach ($options as $option) {
                              ?>
                                <option><?php echo $option['main_location_name']; ?> </option>
                              <?php
                              }
                              ?>

                            </select><br>
                            <span class="bmd-help"></span>
                          </div>
                        </div>


                        <br>
                        <div class="row">

                          <br>
                          <div style="margin-left:25px" class="form-group col-12">
                            <label class="bmd-label-floating" for="subLocation">Sub Location</label>
                            <input type="text" class="form-control" id="subLocation" name="subLocation">
                          </div>


                        </div>

                      </div>


                      <div class="row">
                        <div style="text-align: center;" class="card-body">

                          <button class="btn btn-primary" onclick="add_sub_data()">Add</button>


                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- Add Machine -->
            <div class="col-md-4 ">
              <div class="card ">
                <div class="card-header card-header-rose card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">mail_outline</i>
                  </div>
                  <h4 class="card-title">Device Info</h4>
                </div>
                <div class="card-body ">
                  <form method="post" action="" id="deviceForm" name="deviceForm">
                    <div class="card-body">
                      <div class="row">

                        <label style="margin-left:30px" for="main_list" class="col-sm-offset-1 col-form-label">Main Location</label>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select id="main_list" name="main_list" class="form-control" onchange="selectMain(this.value)">
                              <?php
                              foreach ($options as $option) {
                              ?>
                                <option><?php echo $option['main_location_name']; ?> </option>
                              <?php
                              }
                              ?>
                            </select><br>
                            <span class="bmd-help"></span>
                          </div>
                        </div>

                      </div><br>
                      <div class="row">

                        <label style="margin-left:30px" for="sub_location" class="col-sm-offset-1 col-form-label">Sub Location</label>
                        <div class="col-md-6">
                          <div class="form-group">
                            <select id="sub_location" name="sub_location" class="form-control">
                              <option>Sub Location</option>

                            </select>
                            <span class="bmd-help"></span>
                          </div>
                        </div>

                      </div>

                      <div class="row">

                        <br>
                        <div style="margin-left:25px" class="form-group col-md-10">
                          <label for="device_name" class="bmd-label-floating">Device Name</label>
                          <input type="text" class="form-control" id="device_name" name="device_name">
                        </div>
                        <div style="margin-left:25px" class="form-group col-md-10">
                          <label for="device_ip" class="bmd-label-floating">Device IP</label>
                          <input type="text" class="form-control" id="device_ip" name="device_ip">
                        </div>

                      </div>

                    </div>
                    <div class="row">

                    </div>

                    <div class="row">
                      <div style="text-align: center;" class="card-body">

                        <button class="btn btn-primary" onclick="add_device_data()">Add</button>


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
                <h4 class="card-title">Device Info</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr id="records">
                        <th class="text-center"><strong>#</strong></th>
                        <th><strong>Main Location</strong></th>
                        <th><strong>Sub Location</strong></th>
                        <th><strong>Device Name</strong></th>
                        <th><strong>IP</strong></th>
                        <th class="text-right"><strong>Actions</strong></th>

                      </tr>
                    </thead>
                    <?php
                    $rs1 = mysqli_query($cn, "SELECT *
                          FROM main_location
                          JOIN sub_location ON main_location.main_id = sub_location.main_id
                          JOIN device_info ON sub_location.sub_id = device_info.sub_id
                         ");
                    // var_dump("result::",$rs1);
                    //$row = mysqli_fetch_array($rs1);
                    while ($row1 = mysqli_fetch_array($rs1)) {

                      $info_id = $row1['machine_id'];
                      $main_location_name = $row1['main_location_name'];
                      $sub_location_name = $row1['sub_location_name'];
                      $device_name = $row1['device_name'];
                      $device_ip = $row1['device_ip'];
                    ?>

                      <tbody>

                        <tr id="record<?php echo $info_id; ?>">
                          <td class="text-center"><?php echo $info_id; ?></td>
                          <td><?php echo $main_location_name; ?></td>
                          <td><?php echo $sub_location_name; ?></td>
                          <td><?php echo $device_name; ?></td>

                          <td><?php echo $device_ip; ?></td>

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