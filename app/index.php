<!DOCTYPE html>
<html lang="en">
<head>
  <title>Payroll System</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="../public/css/bootstrap.min.css"></link>
  <link rel="stylesheet" href="../lib/css/datepick.css"></link>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<style>
    body {
        padding-top: 70px;
    }

    .datepicker {
    z-index:1051 !important;
}


</style>
<body>


<!-- navbar -->
<div class="nav navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a href="#" class="navbar-brand">Payroll System</a>
    </div>
    <p class="navbar-text navbar-right">Signed in as Nasa<span class="caret"></span></p>
</div>
<!-- end of navbar -->

<div class="container" ng-app="payrollApp">
    <div class="row">

        <!-- sidebar -->
        <div class="col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Menu</h3>
                </div>
                <div class="panel-body">

                    <ul class="nav nav-pills nav-stacked" id="nav_samping">
                        <li id="karyawan">
                            <a href="#/karyawan">
                              <span class="glyphicon glyphicon-user pull-right"></span>
                                 Data Karyawan
                            </a>
                        </li>
                        <li id="golongan">
                           <a href="#">
                             <span class="glyphicon glyphicon-book pull-right"></span>
                             Setup Golongan
                           </a>
                        </li>
                        <li id="lembur">
                            <a href="#/lembur">
                               <span class="glyphicon glyphicon-file pull-right"></span>
                               Setup Lembur
                            </a>
                        </li>
                        <li id="prestasi">
                            <a href="#">
                                <span class="glyphicon glyphicon-file pull-right"></span>
                                    Form Prestasi
                                </a>
                        </li>
                        <li id="laporan">
                            <a href="#">
                                <span class="glyphicon glyphicon-list-alt pull-right"></span>
                                Laporan
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
        <!-- end of sidebar -->

        <!-- content -->
        <div class="col-md-9" ng-view>
           <h1>Content Goes here</h1>
        </div>
    </div>
</div>

<script src="../lib/js/jquery/jquery-1.10.2.min.js"></script>
<script src="../public/js/bootstrap.min.js"></script>
<script src="../lib/js/jquery/datepick.js"></script>
<script src="../lib/js/angular/angular-file-upload-shim.min.js"></script>
<script src="../lib/js/angular/angular.min.js"></script>
<script src="../lib/js/angular/angular-route.min.js"></script>
<script src="../lib/js/angular-file-upload.js"></script>
<script src="../lib/js/angular/angular-file-upload.min.js"></script>
<script src="../lib/js/angular/promise-tracker.js"></script>
<script src="js/main.js"></script>

<script>
  $(document).ready(function() {
    var $nav_samping = $('#nav_samping');
    var $karyawan = $('#karyawan');
    var $golongan = $('golongan');
    var $lembur = $('#lembur');
    var $prestasi = $('#prestasi');
    var $laporan = $('#laporan');
    var $pgbar = $('#pgbar');
    $pgbar.hide();

    var $selectFile = $('#select_file');

    $(document).on('change', '#select_file', function() {
      $pgbar.removeAttr('style');
    });

      $('#btnTmbhLembur').click(function() {alert('hello');});

      $('#nav_samping>li').click(function() {
        $('#nav_samping>li.active').removeClass('active');
        $(this).fadeIn("slow", function() {
          $(this).addClass('active');
        });

      });

  });
</script>
</body>
</html>
