<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="<?php echo base_url('assets') ?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <link href="<?php echo base_url('assets') ?>/css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <!-- Font Awesome -->
    <link href="<?php echo base_url('assets') ?>/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url('assets') ?>/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="<?php echo base_url('assets') ?>/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="<?php echo base_url('assets') ?>/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- Sweetalert -->
    <link href="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url('assets') ?>/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>

    <script type="text/javascript">
        function logout() {
            swal({
                    title: "Apakah anda ingin keluar ?",
                    type: "warning",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Pilih Ya, Apabila anda telah selesai menggunakan sistem ini.",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: "<?php echo site_url('auth/logout'); ?>",
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
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url('asesi') ?>" class="brand"><i class="icon-leaf"> Sistem Informasi LSP</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <ul class="nav pull-right">
                        <li>
                            <button class="btn btn-danger" onclick="logout()"><span class="icon-off"></span>Logout</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div id="body-container">
        <div id="body-content">
            <div class="body-nav body-nav-horizontal body-nav-fixed">
                <div class="container">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('home') ?>">
                                <i class="icon-home icon-large" style="font-size: 20px;"></i> Beranda
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('daftar%20skema') ?>">
                                <i class="icon-list-alt icon-large" style="font-size: 20px;"></i> Daftar Skema
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('jadwal') ?>">
                                <i class="icon-calendar icon-large" style="font-size: 15px;"></i>Jadwal Pendaftaran
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('data_diri') ?>">
                                <i class="icon-user icon-large" style="font-size: 20px;"></i> Data Diri Saya
                            </a>
                        </li>

                        <li>
                            <?php if (!$checkUserOnAsesi) { ?>
                                <a href="#" data-toggle="modal" data-target="#myModal">
                                    <i class="icon-table icon-large" style="font-size: 20px;"></i> Permohonan Asesi
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('apl_01') ?>">
                                    <i class="icon-table icon-large" style="font-size: 20px;"></i> Permohonan Asesi
                                </a>
                            <?php } ?>
                        </li>
                        <li>
                            <?php if (!$checkUserOnAsesi) { ?>
                                <a href="#" data-toggle="modal" data-target="#myModal">
                                    <i class="icon-th icon-large" style="font-size: 20px;"></i> Asesmen Mandiri
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('apl_02') ?>">
                                    <i class="icon-th icon-large" style="font-size: 20px;"></i> Asesmen Mandiri
                                </a>
                            <?php } ?>
                        </li>

                        <li>
                            <?php if (!$checkUserOnAsesi) { ?>
                                <a href="#" data-toggle="modal" data-target="#myModal">
                                    <i class="icon-time icon-large" style="font-size: 20px;"></i> Riwayat
                                </a>
                            <?php } else { ?>
                                <a href="<?php echo base_url('skema%20saya') ?>">
                                    <i class="icon-time icon-large" style="font-size: 20px;"></i> Riwayat
                                </a>
                            <?php } ?>

                        </li>

                    </ul>

                </div>
            </div>
            <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Information</h4>
                        </div>
                        <div class="modal-body">
                            <p>Anda belum melengkapi data diri, silahkan lengkapi data diri terlebih dahulu !</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"> Cancel</button>

                            <button type="button" class="btn btn-info" onclick="window.location = '<?php echo base_url('data_diri') ?>'" data-dismiss="modal"><i class="icon-check"></i> Oke</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php include 'pages_asesi/' . $pageName . '.php'; ?>
        </div>
    </div>
    <div id="spinner" class="spinner" style="display:none;">
        Loading&hellip;
    </div>
    <footer class="application-footer">
        <div class="container">
            <div class="disclaimer" style="color:white">
                <p>Politeknik Caltex Riau (<?php echo date('Y'); ?>)</p>
                <p>Sekretariat LSP PCR, Jl. Umbansari (Patin) No.1 Rumbai, Pekanbaru, Riau 28265,</p>
                <p> Telp : (0761) 53803, Fax : (0761) 53803, Email: lsp@pcr.ac.id</p>
            </div>
        </div>
    </footer>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-transition.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-alert.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-modal.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-dropdown.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-scrollspy.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-tooltip.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-popover.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-button.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-collapse.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-carousel.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-typeahead.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-affix.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets'); ?>/js/jquery/jquery-tablesorter.js" type="text/javascript"></script>
    <!-- <script src="<?php echo base_url('assets'); ?>/js/jquery/jquery-chosen.js" type="text/javascript"></script> -->
    <script src="<?php echo base_url('assets'); ?>/js/jquery/virtual-tour.js" type="text/javascript"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $('#sample-table').tablesorter();
            $('#datepicker').datepicker();
            // $(".chosen").chosen();
        });
    </script>

</body>

</html>