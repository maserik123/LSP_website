<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Lembaga Sertifikasi Profesi - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script src="<?php echo base_url('assets') ?>/js/jquery/jquery.min.js" type="text/javascript"></script>

    <!-- <script src="<?php echo base_url('assets') ?>/js/jquery/jquery-1.8.2.min.js" type="text/javascript"></script> -->
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
            background: rgba(34, 48, 82, 0.67);
            /* border: black 1px solid; */
        }
    </style>
</head>

<body>
    <script type="text/javascript">
        function changePwd() {
            var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
            var csrf_hash = ''
            var url;
            url = '<?php echo base_url() ?>auth/forgotPassword/changePass';

            swal({
                    title: "Apakah anda sudah yakin ?",
                    type: "warning",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    cancelButtonText: "Kembali",
                    confirmButtonText: "Ya",
                    text: 'Klik Ya untuk melanjutkan !',
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: $('#changePwd').serialize(),
                        dataType: "JSON",
                        success: function(resp) {
                            data = resp.result
                            csrf_hash = resp.csrf['token'];
                            $('#changePwd input[name=' + token_name + ']').val(csrf_hash);
                            if (data['status'] == 'success') {
                                $('.form-group').removeClass('has-error')
                                    .removeClass('has-success')
                                    .find('#text-error').remove();
                                $("#changePwd")[0].reset();
                                setInterval(() => {
                                    window.location = '<?php echo base_url('auth') ?>';
                                }, 1300);
                            } else {
                                $.each(data['messages'], function(key, value) {
                                    var element = $('#' + key);
                                    element.closest('div.form-group')
                                        .removeClass('has-error')
                                        .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                        .find('#text-error')
                                        .remove();
                                    element.after(value);
                                });
                            }
                            swal({
                                html: true,
                                timer: 1600,
                                // text: 'Password telah dikirimkan, Silahkan cek email anda !',
                                showConfirmButton: false,
                                title: data['msg'],
                                type: data['status']
                            });
                        }

                    });
                });
        }
    </script>
    <div id="body-container">
        <div id="body-content">
            <div class='container'>
                <div class="signin-row row">
                    <div class="span16">
                        <div class="span4"></div>
                        <div class="span6">
                            <div class="container-signin" id="box1">
                                <legend style="color:white;text-align: center;font-weight: bold;">Forgot Password</legend>
                                <form method='POST' id='changePwd' class='form-signin'>
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                                    <div class="form-inner">
                                        <div class="input-prepend">
                                            <label style="color:white;" for="">Your Registered Email : </label>
                                            <span class="add-on"><i class="icon-envelope"></i></span>
                                            <input type='text' name="email" class='span4 form-control' id='email' autocomplete="off" />
                                            <?php echo form_error('email'); ?>
                                        </div>
                                    </div>
                                    <footer class="signin-actions">
                                        <div style="text-align: right;">
                                            <button type="button" onclick="window.location = '<?php echo base_url('auth') ?>'" class="btn btn-danger"> Cancel</button>
                                            <button type="button" onclick="changePwd()" class="btn btn-primary"><span class="icon-key"></span> Change Password</button>
                                        </div>
                                    </footer>
                                </form>
                            </div>
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
<script src="<?php echo base_url('assets') ?>/js/jquery/virtual-tour.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets'); ?>/global/scripts/app.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets'); ?>/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?php echo base_url() . 'assets/' ?>plugins/sweetalert/sweetalert.min.js"></script>


</html>