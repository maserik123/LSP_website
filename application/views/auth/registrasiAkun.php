<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="layout" content="main" />

    <!-- <script type="text/javascript" src="http://www.google.com/jsapi"></script> -->

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
    </style>
</head>

<body>
    <script>
        console.log('test')

        function simpan() {
            var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
            var csrf_hash = ''
            var url;
            url = '<?php echo base_url() ?>auth/registrasi/addData';

            swal({
                    title: "Apakah anda sudah yakin ?",
                    type: "warning",
                    showCancelButton: true,
                    showLoaderOnConfirm: true,
                    cancelButtonText: "Kembali",
                    confirmButtonText: "Ya",
                    closeOnConfirm: false
                },
                function() {
                    $.ajax({
                        url: url,
                        method: 'POST',
                        data: $('#form_regis').serialize(),
                        dataType: "JSON",
                        success: function(resp) {
                            data = resp.result
                            csrf_hash = resp.csrf['token'];
                            $('#form_regis input[name=' + token_name + ']').val(csrf_hash);
                            if (data['status'] == 'success') {
                                // updateAllTable();
                                $('.form-group').removeClass('has-error')
                                    .removeClass('has-success')
                                    .find('#text-error').remove();
                                $("#form_regis")[0].reset();
                                $url = '<?php echo base_url('/auth/') ?>';
                                setTimeout(() => {
                                    $(location).attr('href', $url)
                                }, 1400);
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
                                timer: 1300,
                                showConfirmButton: false,
                                title: data['msg'],
                                type: data['status']
                            });
                        }

                    });
                });
        }
    </script>

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <button class="btn btn-navbar" data-toggle="collapse" data-target="#app-nav-top-bar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?php echo base_url('auth') ?>" class="brand"><i class="icon-leaf"> Sistem Informasi LSP</i></a>
                <div id="app-nav-top-bar" class="nav-collapse">
                    <!-- <ul class="nav pull-right">
                        <li>
                            <button href="login.html" class="btn btn-primary btn-xs">Login</button>
                        </li>

                    </ul> -->
                </div>
            </div>
        </div>
    </div>

    <div id="body-container">
        <div id="body-content">
            <section id="my-account-security-form" class="page container">
                <?php echo form_open('', array('id' => 'form_regis', 'method' => 'post', 'class' => 'form-horizontal')); ?>
                <div class="container">
                    <legend><span class="icon-user"></span> Pendaftaran Akun Pengguna</legend>
                    <br>
                    <div class="row">
                        <div id="acct-password-row" class="span7">
                            <fieldset>
                                <div class="control-group form-group">
                                    <label class="control-label">Nama Awalan<span class="required">*</span></label>
                                    <div class="controls ">
                                        <input name="first_name" class="span5" type="text" id="first_name" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label">Nama Akhiran<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="last_name" id="last_name" class="span5" type="text" autocomplete="false">
                                    </div>
                                </div>

                                <div class="control-group form-group">
                                    <label class="control-label">Email<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="email" id="email" class="span5" type="email" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label">No Hp<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="phone_number" id="phone_number" class="span5" type="text" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label">Alamat<span class="required">*</span></label>
                                    <div class="controls">
                                        <textarea name="address" id="address" class="span5"></textarea>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div id="acct-password-row" class="span7">
                            <fieldset>

                                <div class="control-group form-group">
                                    <label class="control-label">Jenis Kelamin<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="gender" id="gender" class="span1" type="radio" value="male" autocomplete="false"> Laki-laki
                                        <input name="gender" id="gender" class="span1" type="radio" value="female" autocomplete="false"> Perempuan
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label">Password<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="password" id="password" class="span5" type="password" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label">Confirm Password<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="confirm" id="confirm" class="span5" type="password" autocomplete="false">
                                    </div>
                                </div>
                                <input type="hidden" name="role" id="role" value="asesi">
                                <input type="hidden" name="created" id="created" value="<?php echo date('Y-m-d H:i:s'); ?>">
                            </fieldset>
                        </div>
                    </div>
                    <footer id="submit-actions" style="text-align: right;">
                        Do you have an account ?
                        <button type="button" onclick="window.location='<?php echo base_url('auth') ?>'" class="btn btn-danger btn-sm" name="action">
                            <span class="icon-lock"></span> Login</button>
                        <button type="button" onclick="simpan()" class="btn btn-primary"><span class="icon-save"></span> Simpan</button>
                    </footer>
                </div>
                <?php echo form_close(); ?>
            </section>

        </div>
    </div>

    <div id="spinner" class="spinner" style="display:none;">
        Loading&hellip;
    </div>

    <footer class="application-footer">
        <div class="container">
            <div class="disclaimer" style="color:white">
                <p>Politeknik Caltex Riau</p>
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

    <script type="text/javascript">
        $(function() {
            $('#sample-table').tablesorter();
            $('#datepicker').datepicker();
        });
    </script>

</body>

</html>