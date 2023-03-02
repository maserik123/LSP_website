<script>
    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesi/dataDiri/update';

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
                                window.location = '<?php echo base_url('data_diri') ?>'
                            }, 1600);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            // $('#modal').modal('hide');
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
<section class="page container" id="dc">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Form Perubahan Data Pemohon
                </legend>
                <p>Data profil pemohon akan digunakan untuk mengisi form pada APL-01. Silahkan isi data berikut dengan baik dan benar !</p>
            </div>
        </div>
    </div>
    <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
    <div class="row">
        <div class="span11">
            <div class="box">
                <div class="box-header">
                    <i class="icon-book"></i>
                    <h5>Data Pribadi</h5>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div id="acct-password-row" class="span5">
                            <br>
                            <fieldset>
                                <input type="hidden" name="id" value="<?php echo encrypt($getById->id); ?>" id="id">
                                <div class="control-group form-group">
                                    <label class="control-label span2">Nama Lengkap<span class="required">*</span></label>
                                    <div class="controls form-group">
                                        <input class="span3" id="dd_nama_lengkap" name="dd_nama_lengkap" type="text" value="<?php echo $getById->dd_nama_lengkap; ?>">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">NIK<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="dd_nik" id="dd_nik" value="<?php echo $getById->dd_nik; ?>" class="span3" type="number">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Tempat Lahir<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="dd_tempat_lahir" id="dd_tempat_lahir" class="span3" value="<?php echo $getById->dd_tempat_lahir; ?>" type="text">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Tanggal Lahir<span class="required">*</span></label>
                                    <div class="controls form-group">
                                        <input name="dd_tgl_lahir" id="dd_tgl_lahir" class="span3 datepicker" value="<?php echo $getById->dd_tgl_lahir; ?>" type="text" placeholder="yyyy-mm-dd">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Jenis Kelamin<span class="required">*</span></label>
                                    <div class="controls">
                                        <select name="dd_jenis_kelamin" id="dd_jenis_kelamin" class="span3">
                                            <option value="">Pilih</option>
                                            <?php if ($getById->dd_jenis_kelamin == 'laki-laki') { ?>
                                                <option value="laki-laki" selected>Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            <?php } else if ($getById->dd_jenis_kelamin == 'perempuan') { ?>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan" selected>Perempuan</option>
                                            <?php } else { ?>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Kebangsaan<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="dd_kebangsaan" id="dd_kebangsaan" value="<?php echo $getById->dd_kebangsaan; ?>" class="span3" type="text">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Alamat Rumah<span class="required">*</span></label>
                                    <div class="controls">
                                        <textarea name="dd_alamat_rumah" id="dd_alamat_rumah" class="span3"><?php echo $getById->dd_alamat_rumah; ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Kode Pos<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="dd_kode_pos" id="dd_kode_pos" value="<?php echo $getById->dd_kode_pos; ?>" class="span3" type="number">
                                    </div>
                                </div>

                            </fieldset>
                        </div>
                        <div id="acct-password-row" class="span5">
                            <br>
                            <fieldset>
                                <div class=" control-group form-group">
                                    <label class="control-label span2">No Hp<span class="required">*</span></label>
                                    <div class="controls ">
                                        <input name="dd_no_hp" id="dd_no_hp" value="<?php echo $getById->dd_no_hp; ?>" class="span3" type="number" readonly>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">No Telp<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="dd_no_telp" id="dd_no_telp" value="<?php echo $getById->dd_no_telp; ?>" class="span3" type="number">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Email<span class="required">*</span></label>
                                    <div class="controls">
                                        <input name="dd_email" id="dd_email" value="<?php echo $getById->dd_email; ?>" class="span3" type="email" readonly>
                                    </div>
                                </div>

                                <div class="control-group form-group">
                                    <label class="control-label span2">Kantor<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="dd_kantor" id="dd_kantor" class="span3" value="<?php echo $getById->dd_kantor; ?>" type="number" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Pendidikan Terakhir<span class="required">*</span></label>
                                    <div class="controls">
                                        <select name="dd_pendidikan_terakhir" id="dd_pendidikan_terakhir" class="span3">
                                            <option value="">Pilih Pendidikan Terakhir</option>
                                            <?php if ($getById->dd_pendidikan_terakhir == 'SMA/SMK') { ?>
                                                <option value="SMA/SMK" selected>SMA/SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1/D4">S1/D4</option>
                                                <option value="S2">S2</option>
                                            <?php } else if ($getById->dd_pendidikan_terakhir == 'D3') {  ?>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3" selected>D3</option>
                                                <option value="S1/D4">S1/D4</option>
                                                <option value="S2">S2</option>
                                            <?php } else if ($getById->dd_pendidikan_terakhir == 'S1/D4') { ?>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1/D4" selected>S1/D4</option>
                                                <option value="S2">S2</option>
                                            <?php } else if ($getById->dd_pendidikan_terakhir == 'S2') { ?>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1/D4">S1/D4</option>
                                                <option value="S2" selected>S2</option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="span5">
            <div class="box">
                <div class="box-header">
                    <i class="icon-book"></i>
                    <h5>Data Pekerjaan</h5>
                </div>
                <div class="box-content">
                    <div class="row">
                        <div id="acct-password-row" class="span5">
                            <fieldset>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Nama Perusahaan<small class="required">(Optional)</small></label>
                                    <div class="controls ">
                                        <input name="k_lembaga" id="k_lembaga" value="<?php echo $getById->k_lembaga; ?>" class="span2-5" type="text">
                                        <div class="text-error"></div>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Jabatan<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="k_jabatan" id="k_jabatan" class="span2-5" value="<?php echo $getById->k_jabatan; ?>" type="text" autocomplete="false">
                                    </div>
                                </div>

                                <div class="control-group form-group">
                                    <label class="control-label span2">Alamat Perusahaan<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <textarea name="k_alamat" id="k_alamat" style="width: 135px;" class="span2-5"><?php echo $getById->k_alamat; ?></textarea>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Kode Pos<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="k_kode_pos" id="k_kode_pos" class="span2" type="number" value="<?php echo $getById->k_kode_pos; ?>" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">No Fax<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="k_fax" id="k_fax" class="span2-5" type="number" value="<?php echo $getById->k_fax; ?>" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">No Telp<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="k_telp" id="k_telp" class="span2-5" type="number" value="<?php echo $getById->k_telp; ?>" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span2">Email Perusahaan<small class="required">(Optional)</small></label>
                                    <div class="controls">
                                        <input name="k_email" id="k_email" class="span2-5" type="text" value="<?php echo $getById->k_email; ?>" autocomplete="false">
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span3">Tanda Tangan Saya</label>
                                    <div class="controls">
                                        <button type="button" data-toggle="modal" class="btn btn-success" style="font-size: 12px;" data-target="#modal_tanda_tangan">
                                            <span class="icon-upload"></span> Perbarui
                                        </button>
                                    </div>
                                </div>
                                <div class="control-group form-group">
                                    <label class="control-label span3">Foto Profil</label>
                                    <div class="controls">
                                        <button type="button" data-toggle="modal" class="btn btn-success" style="font-size: 12px;" data-target="#modal_foto">
                                            <span class="icon-upload"></span> Perbarui
                                        </button>
                                    </div>
                                </div>
                                <input name="create_date" id="create_date" value="<?php echo date('Y-m-d') ?>" class="span2-5" type="hidden" readonly>

                            </fieldset>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer" style="text-align:right;">
        <button type="button" onclick="history.back(-1);" class="btn btn-danger">
            <i class="icon-user"></i>
            Batal
        </button>
        <button type="reset" class="btn btn-warning">
            <i class="icon-undo"></i>
            Reset
        </button>
        <button type="button" class="btn btn-primary" onclick="simpan()">
            <i class="icon-save"></i> Simpan
        </button>
    </div>
    <?php echo form_close(); ?>

</section>

<!-- Modal tanda tangan-->
<div id="modal_tanda_tangan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Tanda Tangan</h4>
                <div style="text-align: right;color:blue">
                </div>
            </div>
            <?php echo form_open('asesi/dataDiri/uploadTandaTangan', array('id' => 'form_pengalaman_kerja', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" value="<?php echo $getById->id; ?>" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Update Tanda Tangan<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="dd_tanda_tangan_asesi" id="dd_tanda_tangan_asesi" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                </fieldset>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<!-- Modal foto-->
<div id="modal_foto" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Update Foto</h4>
                <div style="text-align: right;color:blue">
                </div>
            </div>
            <?php echo form_open('asesi/dataDiri/uploadFoto', array('id' => 'form_foto', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" value="<?php echo $getById->id; ?>" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Update Foto<small class="required">(Optional)<br> Max File Size. 2 MB.</small></label>
                        <div class="controls">
                            <input name="dd_foto" id="dd_foto" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                </fieldset>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#sample-table').tablesorter();
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>