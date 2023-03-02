<!DOCTYPE html>
<html lang="en">

<head>
    <title><?php echo $title; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/matrix-style.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/matrix-media.css" />

    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/colorpicker.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/datepicker.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/uniform.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/select2.css" />
    <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/bootstrap-wysihtml5.css" />

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href="<?php echo base_url('assets_matrix/') ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets_matrix/') ?>css/jquery.gritter.css" /> -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <script src="<?php echo base_url('assets') ?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <link href="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
</head>

<body>

    <!--Header-part-->
    <div id="header">
        <h3 style="font-size: 16px;">
            <li class="icon-user"></li> Asesor LSP
        </h3>
    </div>
    <!--close-Header-part-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">
        function logout() {
            swal({
                    title: "Apakah anda ingin keluar ?",
                    type: "warning",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Pilih Ya, apabila anda telah selesai menggunakan sistem ini.",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: "<?php echo site_url('auth/logout_asesor'); ?>",
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
    <!--top-Header-menu-->
    <div id="user-nav" class="navbar navbar-inverse">
        <ul class="nav">
            <li class=""><a title="" href="<?php echo base_url('asesor/data_saya') ?>"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li>
            <li class=""><a href="#" title="" style="background-color: orange;color:black" onclick="logout()"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
        </ul>
    </div>
    <!--close-top-Header-menu-->
    <!--start-top-serch-->
    <div id="search" style="color: white;font-weight: bold;">
        <?php echo $this->session->userdata('first_name'); ?>
    </div>
    <!--close-top-serch-->
    <!--sidebar-menu-->
    <div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
        <ul>
            <!-- Start menu beranda -->
            <li class="<?php if (isset($active_home)) {
                            echo $active_home;
                        } ?>"><a href="<?php echo base_url('asesor') ?>"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
            <!-- End menu beranda -->

            <!-- Start Fitur Permintaan APL 02 -->
            <!-- <?php if (!$checkUserOnAsesor->tanda_tangan) { ?>
                <li class="<?php if (isset($active_permintaan_apl02)) {
                                echo $active_permintaan_apl02;
                            } ?>"> <a href="#" onclick="alert('Fitur tidak aktif !')"><i class="icon icon-table"></i> <span>Pemohon Sertifikasi</span></a> </li>
            <?php } else { ?>
                <li class="<?php if (isset($active_permintaan_apl02)) {
                                echo $active_permintaan_apl02;
                            } ?>"> <a href="<?php echo base_url('asesor/permintaanAPL02') ?>"><i class="icon icon-inbox"></i> <span>Pemohon Sertifikasi</span></a> </li>
            <?php } ?> -->
            <!-- End Fitur Permintaan APL 02 -->

            <!-- Start Fitur Permintaan APL 02 -->
            <?php if (!$checkUserOnAsesor->tanda_tangan) { ?>
                <li class="<?php if (isset($active_asesmen_mandiri)) {
                                echo $active_asesmen_mandiri;
                            } ?>"> <a href="#" onclick="alert('Fitur tidak aktif !')"><i class="icon icon-table"></i> <span>Penilaian Asesmen</span></a> </li>
            <?php } else { ?>
                <li class="<?php if (isset($active_asesmen_mandiri)) {
                                echo $active_asesmen_mandiri;
                            } ?>"> <a href="<?php echo base_url('asesor/asesmenMandiri') ?>"><i class="icon icon-inbox"></i> <span>Penilaian Asesmen</span></a> </li>
            <?php } ?>
            <!-- End Fitur Permintaan APL 02 -->


            <!-- <?php if (!$checkUserOnAsesor->tanda_tangan) { ?>
                <li class="<?php if (isset($active_asesi_saya)) {
                                echo $active_asesi_saya;
                            } ?>"> <a href="#" onclick="alert('Fitur tidak aktif !')"><i class="icon icon-table"></i> <span>Jadwal Pendaftaran</span></a> </li>
            <?php } else { ?>
                <li class="<?php if (isset($active_jadwal)) {
                                echo $active_jadwal;
                            } ?>"> <a href="<?php echo base_url('asesor/jadwal') ?>"><i class="icon icon-list-alt"></i> <span>Jadwal Pendaftaran</span></a> </li>
            <?php } ?> -->

            <!-- <?php if (!$checkUserOnAsesor->tanda_tangan) { ?>
                <li> <a href="#" onclick="alert('Fitur tidak aktif !')"><i class="icon icon-list-ul"></i> <span>Dokumen Asesmen Mandiri</span> <span class="icon-arrow-down"></span></a>
                </li>
            <?php } else { ?>
                <li> <a href="#" onclick="alert('Sedang dalam tahap pengembangan !')"><i class="icon-list-ul"></i> <span>Dokumen Asesmen Mandiri</span> <label class="label label-important"></label></a>
                </li>
            <?php } ?> -->

        </ul>
    </div>
    <!--sidebar-menu-->

    <!--main-container-part-->
    <div id="content">
        <!--breadcrumbs-->
        <div id="content-header">
            <div id="breadcrumb">
                <a href="<?php echo base_url('asesor') ?>" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a>
                <?php foreach ($pageBreadCrumb as $row) { ?>
                    <a href="<?php echo base_url('asesor/') . $row ?>" title="Go to Home" class="tip-bottom"> <?php echo $row ?></a>
                <?php } ?>
            </div>
        </div>
        <!--End-breadcrumbs-->
        <!--Show Page Managed By Controller-->
        <?php include 'pages_asesor/' . $pageName . '.php' ?>
    </div>

    <!--end-main-container-part-->

    <!--Footer-part-->

    <div class="row-fluid">
        <div id="footer" class="span12"> <?php echo date('Y'); ?> &copy; Politeknik Caltex Riau. Alrights Reserved. </div>
    </div>

    <!--end-Footer-part-->

    <script src="<?php echo base_url('assets_matrix/') ?>js/excanvas.min.js"></script>
    <!-- <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script> -->
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.ui.custom.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.flot.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.flot.resize.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.peity.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/fullcalendar.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.dashboard.js"></script>
    <!-- <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.gritter.min.js"></script> -->
    <!-- <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.interface.js"></script> -->
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.chat.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.validate.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.form_validation.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.wizard.js"></script>
    <!-- <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.uniform.js"></script> -->
    <script src="<?php echo base_url('assets_matrix/') ?>js/select2.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.popover.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/matrix.tables.js"></script>
    <script src="<?php echo base_url('assets'); ?>/js/bootstrap/bootstrap-alert.js" type="text/javascript"></script>
    <script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/bootstrap-colorpicker.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/bootstrap-datepicker.js"></script>
    <!-- <script src="<?php echo base_url('assets_matrix/') ?>js/masked.js"></script> -->
    <script src="<?php echo base_url('assets_matrix/') ?>js/wysihtml5-0.3.0.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/jquery.peity.min.js"></script>
    <script src="<?php echo base_url('assets_matrix/') ?>js/bootstrap-wysihtml5.js"></script>


    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>

</html>