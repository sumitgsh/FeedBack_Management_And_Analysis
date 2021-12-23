

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FeedBack Management|Student Dashboard</title>

    <!-- Google Font: Open Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./teacher/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="./teacher/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="./teacher/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="./teacher/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./teacher/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="./teacher/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="./teacher/plugins/daterangepicker/daterangepicker.css">

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">


        <!-- Navbar -->
        <?php include './main-nav.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './main-sidebar.php' ?>
        <!-- Main SideBar End -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        <?php include './footer.php' ?>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="./teacher/"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="./teacher/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
    $.widget.bridge('uibutton', $.ui.button)
    </script>


    <!-- Bootstrap 4 -->
    <script src="./teacher/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="./teacher/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="./teacher/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="./teacher/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="./teacher/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="./teacher/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="./teacher/plugins/moment/moment.min.js"></script>
    <script src="./teacher/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="./teacher/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="./teacher/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="./teacher/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./teacher/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="./teacher/dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="./teacher/dist/js/pages/dashboard.js"></script>
</body>

</html>