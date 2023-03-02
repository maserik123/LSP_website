<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        table = $('#data').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            // "bFilter": false,
            "bPaginate": false,
            // "dom": 'Bfrtip',
            // "buttons": [
            //     'excel', 'pdf', 'print'
            // ],
            "ajax": {
                "url": "<?php echo site_url('administrator/asesi/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "desc"]
            ],
            "columnDefs": [{
                "targets": [0],
                "className": "center"
            }]
        });
    });

    var save_method;

    function updateAllTable() {
        table.ajax.reload();
    }

    function tambah() {
        save_method = 'add';
        $('#form_inputan')[0].reset();
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $('#modal').modal('show');
        $('.reset').show();
    }

    function ubah(id) {
        save_method = 'update';
        $('#form_inputan')[0].reset();
        $('#modal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/asesor/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data

                $('[name="id"]').val(data.id);
                $('[name="nama_asesor"]').val(data.nama_asesor);
                $('[name="no_reg"]').val(data.no_reg);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function hapus(id) {
        swal({
                title: "Apakah Yakin Akan Dihapus?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/asesi/delete'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        updateAllTable();
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error Deleting Data');
                    }
                });
            });
    }

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/dataDiri/addData';

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
                    data: $('#form_inputan').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 3000);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
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
                            timer: 1800,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status'],
                            // text: 'Silahkan lanjutkan dengan mengupload tanda tangan !'
                        });
                    }
                });
            });
    }

    function update() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/dataDiri/update';

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
                    data: $('#form_inputan').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 3000);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
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
                            timer: 1800,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status'],
                            // text: 'Silahkan lanjutkan dengan mengupload tanda tangan !'
                        });
                    }
                });
            });
    }

    function update_password() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/dataDiri/updatePassword';
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
                    data: $('#form_inputan1').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan1 input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan1")[0].reset();

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
                            timer: 1800,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status'],
                            // text: 'Silahkan lanjutkan dengan mengupload tanda tangan !'
                        });
                    }
                });
            });
    }
</script>

<div class="col-md-12 col-sm-12">
    <div class="x_title">
        <h2>Manajemen Data Diri</h2>
        <div class="clearfix"></div>
        <small>Anda dapat melakukan pengelolaan data diri dan perubahan password melalui halaman ini.</small>
    </div>
</div>
<div class="col-md-6 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data Diri <small>Formulir Data Diri</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="#">Settings 1</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <br />
            <?php $firstName = $this->session->userdata('first_name'); ?>
            <?php $lastName = $this->session->userdata('last_name'); ?>
            <?php $email = $this->session->userdata('email'); ?>
            <?php if (!empty($cekDataByIdUser[0]->id_user)) { ?>
                <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                <input type="hidden" id="id" value="<?php echo $cekDataByIdUser[0]->id; ?>" name="id">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-6 ">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $cekDataByIdUser[0]->nama_lengkap; ?>" required="required" class="form-control ">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-6 ">
                        <input type="text" id="email" name="email" value="<?php echo $cekDataByIdUser[0]->email; ?>" required="required" readonly class="form-control">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Tanda Tangan <span class="required">*</span>
                    </label>
                    <div class="col-md-8 col-sm-6 ">
                        <button class="btn btn-success btn-sm" type="button" data-toggle="modal" data-target="#modal_ttd"><span class="fa fa-upload"></span> Perbarui Tanda Tangan</button>
                        <a href="<?php echo base_url('g_ttd_admin/') . $cekDataByIdUser[0]->tanda_tangan; ?>" class="btn btn-info btn-sm" target="_blank"><span class="fa fa-search"></span> Lihat</a>

                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-warning btn-sm" type="reset"><span class="fa fa-undo"></span> Reset</button>
                    <button type="button" class="btn btn-primary btn-sm" onclick="update()"><span class="fa fa-save"></span> Simpan Perubahan</button>
                </div>
                <?php echo form_close(); ?>

                <?php if (empty($cekDataByIdUser[0]->tanda_tangan)) { ?>
                    <script>
                        setInterval(() => {
                            $('#modal_ttd').modal('show');

                        }, 2000);
                    </script>
                <?php } ?>
                <!-- Modal -->
                <div id="modal_ttd" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <h6 class="modal-title">Silahkan upload tanda tangan</h6>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <?php echo form_open('administrator/dataDiri/upload_ttd', array('id' => 'form_inputan', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                                <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id'); ?>">
                                <div class="item form-group">
                                    <label class="col-form-label col-md-4 col-sm-3 label-align" for="first-name">Upload Tanda Tangan<span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 ">
                                        <input type="file" id="tanda_tangan" name="tanda_tangan" value="<?php echo $cekDataByIdUser[0]->tanda_tangan; ?>">
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-warning btn-sm" type="reset"><span class="fa fa-undo"></span> Reset</button>
                                <button type="submit" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Simpan</button>
                            </div>
                            <?php echo form_close(); ?>
                        </div>

                    </div>
                </div>
            <?php } else { ?>
                <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                <input type="hidden" id="id" name="id">
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Nama Lengkap <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo $firstName . ' ' . $lastName; ?>" required="required" class="form-control ">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Email <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 ">
                        <input type="text" id="email" name="email" value="<?php echo $email; ?>" required="required" readonly class="form-control">
                    </div>
                </div>
                <div class="ln_solid"></div>
                <div class="item form-group ">
                    <div class="col-md-12 col-sm-6 offset-md-3">
                        <button class="btn btn-warning btn-sm" type="reset"><span class="fa fa-undo"></span> Reset</button>
                        <button type="button" class="btn btn-primary btn-sm" onclick="simpan()"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            <?php } ?>
        </div>
    </div>
</div>
<div class="col-md-6 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Data Diri <small>Perubahan Data Password</small></h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a class="dropdown-item" href="#">Settings 1</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Settings 2</a>
                        </li>
                    </ul>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php echo form_open('', array('id' => 'form_inputan1', 'method' => 'post', 'class' => 'form-horizontal')); ?>
            <div class="control-group">
                <!-- <label class="control-label" style="font-size: 12px;">Email :</label> -->
                <div class="controls">
                    <input type="hidden" class="form-control" name="email" id="email" style="font-size: 12px;" placeholder="Masukkan Email" value="<?php echo $this->session->userdata('email') ?>" readonly />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" style="font-size: 12px;">Password Baru :</label>
                <div class="controls">
                    <input type="password" name="password" id="password" class="form-control" style="font-size: 12px;" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" style="font-size: 12px;">Masukkan ulang :</label>
                <div class="controls">
                    <input type="password" name="password_repeat" id="password_repeat" class="form-control" style="font-size: 12px;" />
                </div>
            </div>
            <br><br>
            <div class="form-actions">
                <button type="button" onclick="update_password()" class="btn btn-success btn-sm"><span class="fa fa-save"></span> Simpan dan Kirim</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>