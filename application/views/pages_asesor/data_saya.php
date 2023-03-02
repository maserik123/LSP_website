<script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/data_saya/update';

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

                            }, 1500);
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
        url = '<?php echo base_url() ?>asesor/data_saya/updatePassword';
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

<div class="container-fluid">
    <!--Chart-box-->
    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Personal-info</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post', 'class' => 'form-horizontal')); ?>

                    <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id'); ?>" />
                    <div class="control-group">
                        <label class="control-label" style="font-size: 12px;">Nama Asesor</label>
                        <div class="controls">
                            <input type="text" id="nama_asesor" style="font-size: 12px;" value="<?php echo $checkUserOnAsesor->nama_asesor ?>" name="nama_asesor" class="span11" placeholder="Nama Asesor" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="font-size: 12px;">No Registrasi</label>
                        <div class="controls">
                            <input type="text" id="no_reg" style="font-size: 12px;" name="no_reg" class="span11" value="<?php echo $checkUserOnAsesor->no_reg; ?>" placeholder="Nomor Registrasi" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="font-size: 12px;">Tanda Tangan:</label>
                        <div class="controls">
                            <button class="btn btn-primary btn-mini" data-toggle="modal" data-target="#ModalDataSaya"><span class="icon-picture"></span> Perbarui</button>
                            <a href="<?php echo base_url('g_ttd_asesor/') . $checkUserOnAsesor->tanda_tangan; ?>" class="btn btn-info btn-mini" target="_blank"><span class="icon-search"></span> Lihat</a>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger"><span class="icon-undo"></span> Reset</button>
                        <button type="button" class="btn btn-success" onclick="simpan()"><span class="icon-save"></span> Simpan</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                    <h5>Ganti Password</h5>
                </div>
                <div class="widget-content nopadding">
                    <?php echo form_open('', array('id' => 'form_inputan1', 'method' => 'post', 'class' => 'form-horizontal')); ?>
                    <div class="control-group">
                        <!-- <label class="control-label" style="font-size: 12px;">Email :</label> -->
                        <div class="controls">
                            <input type="hidden" class="span11" name="email" id="email" style="font-size: 12px;" placeholder="Masukkan Email" value="<?php echo $this->session->userdata('email') ?>" readonly />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="font-size: 12px;">Password Baru :</label>
                        <div class="controls">
                            <input type="password" name="password" id="password" class="span11" style="font-size: 12px;" />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" style="font-size: 12px;">Masukkan ulang :</label>
                        <div class="controls">
                            <input type="password" name="password_repeat" id="password_repeat" class="span11" style="font-size: 12px;" />
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="button" onclick="update_password()" class="btn btn-success"><span class="icon-save"></span> Simpan dan Kirim</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <!--End-Chart-box-->
        <hr />

    </div>
</div>

<!-- Modal -->
<div id="ModalDataSaya" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tanda Tangan</h4>
            </div>
            <?php echo form_open('asesor/data_saya/uploadTandaTangan', array('id' => 'form_tanda_tangan', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
            <div class="modal-body">
                <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id'); ?>" />
                <div class="control-group">
                    <label class="control-label">Silahkan upload tanda tangan anda.</label>
                    <small>*File Maksimum 2 MB</small>
                    <div class="controls">
                        <input type="file" name="tanda_tangan" id="tanda_tangan" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="reset" class="btn btn-danger"><span class="icon-undo"></span> Reset</button>
                <button type="submit" class="btn btn-success" onclick="alert('Apakah anda sudah yakin ?')"><span class="icon-save"></span> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>