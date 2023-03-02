<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login - Lembaga Sertifikasi Profesi - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>

    <script src="<?php echo base_url('assets') ?>/js/jquery/jquery.min.js" type="text/javascript"></script>
    <link href="<?php echo base_url('assets') ?>/css/customize-template.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <link href="<?php echo base_url('assets') ?>/global/css/components.min.css" type="text/css" media="screen, projection" rel="stylesheet" />
    <link href="<?php echo base_url('assets') ?>/global/css/components.css" type="text/css" media="screen, projection" rel="stylesheet" />
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


    <style>
        #box1 {
            background: rgba(34, 42, 142, 0.97);
            /* border: black 1px solid; */
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        function login() {
            swal({
                    title: "Do you want to logout ?",
                    type: "warning",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Click yes if you have been finished all the transactions in this system ",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
                function() {
                    $url = '<?php echo base_url('/auth/') ?>';
                    setTimeout(() => {
                        $(location).attr('href', $url)
                    }, 1400);
                    return swal({
                        html: true,
                        timer: 1300,
                        text: "Pemasaran, Kerja Sama dan Alumni (KBP) Dashboard Management",
                        showConfirmButton: false,
                        title: data['msg'],
                        type: data['status']
                    });
                });
        }
    </script>
    <div id="body-container1">
        <div id="body-content1">
            <div class='container'>
                <div id="body-container1">
                    <div class="signin-row row">
                        <div class="span16">
                            <div class="span4"></div>
                            <div class="span6">

                                <div class="container-signin" id="box1">
                                    <div style="text-align: right;"><button type="button" onclick="window.location='<?php echo base_url('dashboard'); ?>'" class="btn btn-info btn-mini">
                                            <li class="fa fa-arrow-left"></li> Kembali
                                        </button></div>
                                    <legend style="color:white;text-align: center;font-weight: bold;">Formulir Login LSP <br> Politeknik Caltex Riau</legend>
                                    <form action='<?php echo base_url('auth/') ?>' method='POST' id='loginForm' class='form-signin' autocomplete='off'>
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                        <div class="form-inner">
                                            <div class="input-prepend">
                                                <label style="color:white;" for="">Email : </label>
                                                <span class="add-on" rel="tooltip" title="Email Address" data-placement="top"><i class="icon-envelope"></i></span>
                                                <input type='text' name="email" class='span4 form-control' id='email' />
                                                <?php echo form_error('email'); ?>
                                            </div>

                                            <div class="input-prepend">
                                                <label style="color:white;" for="">Kata Sandi : </label>
                                                <span class="add-on"><i class="icon-key"></i></span>
                                                <input type='password' name="password" class='span4 form-control' id='password' />
                                                <?php echo form_error('password'); ?>
                                            </div>
                                            <small style="color: white;">Lupa Kata Sandi ?
                                                <a href="<?php echo base_url('forgotPassword') ?>" style="color:white"> Klik disini ! </a>
                                            </small>
                                        </div>
                                        <footer class="signin-actions">
                                            <label style="color:white;">Atau masuk dengan :</label>
                                            <button type="button" onclick="window.location='<?php echo $loginURL; ?>'" class="btn btn-danger"><span class="icon-google-plus"></span> Google</button>
                                            <div style="text-align: right;">
                                                <label style="text-align: right;">
                                                    <small style="color: white;">Anda belum mendaftar akun ?
                                                        <a style="color: white;" href="<?php echo base_url('registration') ?>">Klik disini</a>
                                                    </small>
                                                </label>
                                                <button type="button" onclick="window.location = '<?php echo base_url('registration') ?>'" class="btn btn-success"><span class="icon-book"></span> Daftar Akun</button>
                                                <button type="submit" class="btn btn-primary"><span class="icon-lock"></span> Masuk</button>
                                            </div>

                                        </footer>
                                    </form>
                                    <?php if ($this->session->flashdata('result_login')) { ?>
                                        <div class="alert alert-block alert-danger">
                                            <p style="font-size: 12px;">
                                                <?php echo $this->session->flashdata('result_login'); ?>
                                            </p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="span5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<div id="spinner" class="spinner" style="display:none;">
    Loading&hellip;
</div>

<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-transition.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-alert.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-modal.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-dropdown.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-scrollspy.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-tab.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-tooltip.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-popover.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-button.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-collapse.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-carousel.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-typeahead.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-affix.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/bootstrap/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets') ?>/js/jquery/jquery-tablesorter.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url('assets') ?>/js/jquery/jquery-chosen.js" type="text/javascript"></script> -->
<script src="<?php echo base_url('assets') ?>/js/jquery/virtual-tour.js" type="text/javascript"></script>

<script src="<?php echo base_url('assets'); ?>/global/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets'); ?>/global/scripts/app.min.js" type="text/javascript"></script>
<!-- <script src="<?php echo base_url('assets') ?>/js/jquery/jquery-chosen.js" type="text/javascript"></script> -->

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


</html>