<?php if (!$checkUserOnAsesor) { ?>
    <script>
        setInterval(() => {
            $('#pengisian_data_diri').modal('show');
        }, 6000);
    </script>
<?php } ?>
<script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    console.log('test')

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/data_saya/addData';

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
                                // window.location.reload();
                                $('#tanda_tangan').modal('show');
                                $('#pengisian_data_diri').modal('hide');
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
</script>

<div class="container-fluid">

    <div class="quick-actions_homepage">

        <ul class="quick-actions">
            <li class="bg_lo"> <a href="#"> <i class="icon-th"></i> <span class="label label-success"><?php echo $getTotalSkema->jlh_skema; ?> Totals</span> Total Skema Sertifikasi</a> </li>
            <li class="bg_ls"> <a href="#"> <i class="icon-user"></i><span class="label label-success"><?php echo $totalAsesor->jlh_asesor ?> Totals</span> Total Asesor</a> </li>
            <li class="bg_ls"> <a href="#"> <i class="icon-tag"></i><span class="label label-success"><?php echo $totalAsesiDiterima->jumlah ?> Totals</span> Permohonan Asesi diterima</a> </li>
            <li class="bg_lb"> <a href="#"> <i class="icon-refresh"></i><span class="label label-success"><?php echo $totalAsesiDitolak->jumlah ?> Totals</span> Permohonan Asesi ditolak</a> </li>
        </ul>
    </div>
    <!--End-Action boxes-->

    <!--Chart-box-->
    <div class="row-fluid">
        <div class="widget-content">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Daftar Permohonan Asesi </h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table id="mytable" class="table table-bordered data-table ">
                                <thead>
                                    <tr>
                                        <th style="font-size: 10px;">No</th>
                                        <th style="font-size: 10px;">Nama Pemohon</th>
                                        <th style="font-size: 10px;">Pilihan Skema</th>
                                        <th style="font-size: 10px;">Tujuan Sertifikasi</th>
                                        <th style="font-size: 10px;">Tanggal Pengajuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 0;
                                    foreach ($getAllData1_1 as $r) { ?>
                                        <tr>
                                            <td><?php echo ++$no; ?></td>
                                            <td><?php echo $r->dd_nama_lengkap; ?></td>
                                            <td><?php echo $r->judul_skema; ?></td>
                                            <td><?php echo $r->tujuan_sertifikasi; ?></td>
                                            <td><?php echo tgl_indo($r->tanggal_pengajuan); ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--End-Chart-box-->
    <hr />

</div>
<?php if (empty($checkUserOnAsesor->tanda_tangan)) { ?>
    <script>
        setInterval(() => {
            $('#tanda_tangan').modal('show');
        }, 1500);
    </script>
<?php } ?>
<!-- Modal pengisian data diri-->
<div id="pengisian_data_diri" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tambahkan data diri</h4>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-content nopadding">
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id'); ?>" />
                            <div class="control-group">
                                <label class="control-label">Nama Asesor</label>
                                <div class="controls">
                                    <input type="text" id="nama_asesor" value="<?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>" name="nama_asesor" class="span11" placeholder="Nama Asesor" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">No Registrasi</label>
                                <div class="controls">
                                    <input type="text" id="no_reg" name="no_reg" class="span11" placeholder="Nomor Registrasi" />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Upload Tanda Tangan :</label>
                                <div class="controls">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tanda_tangan"><span class="icon-upload"></span> Perbarui Tanda Tangan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="simpan()">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- Modal tanda tangan-->
<div id="tanda_tangan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Tanda Tangan</h4>
            </div>
            <?php echo form_open('asesor/data_saya/uploadTandaTangan', array('id' => 'form_tanda_tangan', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-content nopadding">
                            <input type="hidden" id="id" name="id">
                            <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id'); ?>" />
                            <div class="control-group">
                                <label class="control-label">Silahkan upload tanda tangan anda.</label>
                                <small>*File Maksimum 2 MB</small>
                                <div class="controls">
                                    <input type="file" name="tanda_tangan" id="tanda_tangan" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" onclick="alert('Apakah anda sudah yakin ?')">Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>