<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url('assets_gentelella/') ?>images/favicon.ico" type="image/ico" />

    <title><?php echo $title; ?></title>

    <!-- Datatables CDN -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/jquery/dist/jquery.min.js"></script>

    <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <!-- Bootstrap -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url('assets_gentelella') ?>/build/css/custom.min.css" rel="stylesheet">
    <link href="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- Datatables -->
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
</head>

<body class="nav-md">

    <script type="text/javascript">
        function logout() {
            swal({
                    title: "Apakah anda ingin keluar ?",
                    type: "warning",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Pilih Ya, apabila anda telah selesai menggunakan sistem ini. ",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: "<?php echo site_url('auth/logout_admin'); ?>",
                        type: "POST",
                        dataType: "JSON",
                        data: {
                            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                        },
                        success: function(data) {
                            $url = '<?php echo base_url('/auth/') ?>';
                            setTimeout(() => {
                                $(location).attr('href', $url)
                            }, 1400);
                            return swal({
                                html: true,
                                timer: 1300,
                                text: "LSP Information System",
                                showConfirmButton: false,
                                title: data['msg'],
                                type: data['status']
                            });
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            alert('Error to Log out, check the connection or configuration !');
                        }
                    });
                });
        }
    </script>

    <script type="text/javascript">
        <?php if ($this->session->flashdata('success')) { ?>
            toastr.success("<?php echo $this->session->flashdata('success'); ?>");
        <?php } else if ($this->session->flashdata('error')) {  ?>
            toastr.error("<?php echo $this->session->flashdata('error'); ?>");
        <?php } else if ($this->session->flashdata('warning')) {  ?>
            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
        <?php } else if ($this->session->flashdata('info')) {  ?>
            toastr.info("<?php echo $this->session->flashdata('info'); ?>");
        <?php } ?>
    </script>
    <script>
        function tempat_sampah() {
            window.location = '<?php echo base_url('asesi/tempat_sampah') ?>';
        }
    </script>
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.html" class="site_title"><i class="fa fa-user"></i> <span style="font-size:15px;">LSP Administrator</span></a>
                    </div>

                    <div class="clearfix"></div>

                    <!-- menu profile quick info -->
                    <div class="profile clearfix" style="background-color: brown;">

                        <div class="profile_info" style="text-align: center;">
                            <h2> <strong>Selamat Datang,</strong> </h2>
                            <small style="color: white;"><span class="fa fa-user" style="color: cyan;"></span> <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') ?> </small>
                        </div>
                    </div>
                    <!-- /menu profile quick info -->

                    <br />

                    <?php if (empty($cekDataByIdUser[0]->id_user)) { ?>
                        <script>
                            setInterval(() => {
                                $('#cek_data_modal').modal('show');
                            }, 1500);
                        </script>
                    <?php } ?>



                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>List Menu</h3>
                            <ul class="nav side-menu">
                                <li><a href="<?php echo base_url('beranda') ?>"><i class="fa fa-home"></i> Beranda </a></li>
                                <li><a><i class="fa fa-desktop"></i> Kelola Asesi <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="<?php echo base_url('asesi_confirmation') ?>">Permohonan Asesi
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('administrator/konfirmasi_apl02') ?>">Daftar Asesi
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo base_url('administrator/skema') ?>"><i class="fa fa-list-alt"></i> Data Skema </a></li>
                                <li><a href="<?php echo base_url('administrator/asesor'); ?>"><i class="fa fa-users"></i> Data Asesor </a></li>
                                <!-- <li><a href="<?php echo base_url('administrator/asesi'); ?>"><i class="fa fa-users"></i> Data Asesi </a></li> -->
                                <li><a href="<?php echo base_url('administrator/jadwal'); ?>"><i class="fa fa-calendar"></i> Data Jadwal </a></li>
                                <li><a href="<?php echo base_url('administrator/pemberitahuan'); ?>"><i class="fa fa-book"></i> Pemberitahuan Asesi </a></li>

                                <li>
                                    <div class="badge bg-red">
                                        <small>Fitur Pengelolaan Halaman Depan</small>
                                    </div>
                                    <a> <i class="fa fa-desktop"></i> Kelola Dashboard <span class="fa fa-arrow-right"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="<?php echo base_url('administrator/pesan') ?>">Pesan Diterima
                                            </a>
                                        </li>
                                        <li>
                                            <a href="<?php echo base_url('administrator/tentang_kami') ?>">Tentang Kami
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <!-- <li><a href="<?php echo base_url('administrator/jadwal'); ?>" onclick="alert('This Feature is under developing..')"><i class="fa fa-list"></i> Data Laporan </a></li> -->

                            </ul>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <?php $getNama = $this->User->getAdminByUserId($this->session->userdata('id')); ?>
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    <span class="fa fa-user"></span> <?php echo $getNama->nama_lengkap; ?>
                                </a>
                                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item label" href="#"> Profil Menu <i class="fa fa-list pull-right"></i></a>

                                    <a class="dropdown-item" href="<?php echo base_url('administrator/dataDiri') ?>"> <span class="fa fa-cogs"></span> Kelola Data Saya</a>
                                    <a class="dropdown-item" style="background-color: orange;" href="#" onclick="logout()"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">

                <?php include 'pages_admin/' . $pageName . '.php'; ?>
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <!-- Bootstrap -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url('assets_gentelella') ?>/build/js/custom.min.js"></script>
    <script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>

    <!-- Datatables -->
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets_gentelella') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>

</body>

</html>