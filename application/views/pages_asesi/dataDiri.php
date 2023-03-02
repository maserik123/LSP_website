<script>
    console.log('test')
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
            "dom": 'Bfrtip',
            "buttons": [
                'excel', 'pdf', 'print'
            ],
            "ajax": {
                "url": "<?php echo site_url('manajemen/rekapRanmor/getAllData') ?>",
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

    function updateAllInput() {
        document.ajax.reload();
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
            url: "<?php echo site_url('manajemen/rekapRanmor/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="id_kesatuan"]').val(data.id_kesatuan);
                $('[name="hilang"]').val(data.hilang);
                $('[name="temu"]').val(data.temu);

                $('.reset').hide();
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
                    url: "<?php echo site_url('manajemen/rekapRanmor/delete'); ?>/" + id,
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
        url = '<?php echo base_url() ?>asesi/dataDiri/addData';

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
                            // window.location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            setInterval(() => {
                                window.location = '<?php echo base_url('data_diri') ?>';
                            }, 1500);
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

<script type="text/JavaScript">
    //Script courtesy of BoogieJack.com
var message="NoRightClicking";
function defeatIE() {if (document.all) {(message);return false;}}
function defeatNS(e) {if 
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers) 
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=defeatNS;}
else{document.onmouseup=defeatNS;document.oncontextmenu=defeatIE;}
document.oncontextmenu=new Function("return false");

function disableSelection(e) {
        if (typeof e.onselectstart != "undefined") e.onselectstart = function() {
            return false
        };
        else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
        else e.onmousedown = function() {
            return false
        };
        e.style.cursor = "default"
    }
    window.onload = function() {
        disableSelection(document.body)
    }

</script>

<?php if (!$checkUserOnAsesi) { ?>
    <section class="page container">
        <div class="row">
            <div class="span16">
                <div class="">
                    <legend class="lead">
                        Data Pemohon
                    </legend>
                    <p style="font-weight: bold;">Hak Pemohon:</p>
                    <ol>
                        <li>
                            Memperoleh penjelasan tentang gambaran proses sertifikasi sesuai dengan skema sertifikasi.
                        </li>
                        <li>
                            Mendapatkan hak bertanya berkaitan dengan kompetensi.
                        </li>
                        <li>
                            Memperoleh pemberitahuan tentang kesempatan untuk menyatakan, dengan alasan, permintaan untuk disediakan kebutuhan khusus sepaniang integritas asesmen tidak dilanggar, serta mempertimbangkan aturan yang bersifat Nasional.
                        </li>
                        <li>
                            Memperoleh hak banding terhadap keputusan Sertifikasi.
                        </li>
                        <li>
                            Memperoleh sertifikat kompetensi jika dinyatakan kompeten.
                        </li>
                        <li> Menggunakan sertifikat untuk promosi diri sesuai kompetensi.</li>
                    </ol>
                    <p style="font-weight: bold;font-size:13px;">Data pemohon akan digunakan untuk keperluan data sertifikasi. Cantumkan data pribadi, pendidikan formal serta data pekerjaan anda saat ini.</p>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                $('#dd_kk').show();
                $('#s_bk').hide();
            })

            function hide_dd_kk() {
                $('#dd_kk').hide();
                $('#s_bk').show();
            }

            function show_dd_kk() {
                $('#dd_kk').show();
                $('#s_bk').hide();
            }
        </script>
        <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
        <!-- Data diri dan kerjaan -->
        <div class="row" id="dd_kk">
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
                                    <input type="hidden" name="id" id="id">
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Nama Lengkap<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input class="span2" type="text" name="dd_nama_lengkap" id="dd_nama_lengkap" value="<?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name');; ?>">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">NIK<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="dd_nik" id="dd_nik" class="span3" type="number">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Tempat Lahir<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="dd_tempat_lahir" id="dd_tempat_lahir" class="span3" type="text">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Tanggal Lahir<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input name="dd_tgl_lahir" id="dd_tgl_lahir" class="span3 datepicker" type="text" placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Jenis Kelamin<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="dd_jenis_kelamin" id="dd_jenis_kelamin" class="span3">
                                                <option value="">Pilih</option>
                                                <option value="laki-laki">Laki-laki</option>
                                                <option value="perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Kebangsaan<span class="required">*</span></label>
                                        <div class="controls">
                                            <!-- <input name="dd_kebangsaan" id="dd_kebangsaan" class="span3" type="text"> -->
                                            <select name="dd_kebangsaan" id="dd_kebangsaan" class="span3">
                                                <option value="">Pilih Kebangsaan</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="England">England</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Finlandia">Finlandia</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Norwegia">Norwegia</option>
                                                <option value="Jerman">Jerman</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Alamat Rumah<span class="required">*</span></label>
                                        <div class="controls">
                                            <textarea name="dd_alamat_rumah" id="dd_alamat_rumah" class="span3"><?php echo $this->session->userdata('address') ?></textarea>
                                            <!-- <input name="address" id="address" class="span5" type="text" autocomplete="false"> -->
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div id="acct-password-row" class="span5">
                                <br>
                                <fieldset>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Kode Pos<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="dd_kode_pos" id="dd_kode_pos" class="span3" type="number">
                                        </div>
                                    </div>
                                    <div class=" control-group form-group">
                                        <label class="control-label span2">No Hp<span class="required">*</span></label>
                                        <div class="controls ">
                                            <input name="dd_no_hp" id="dd_no_hp" value="<?php echo $this->session->userdata('phone_number') ?>" class="span3" type="number" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">No Telp<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="dd_no_telp" id="dd_no_telp" class="span3" type="number">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Email<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="dd_email" id="dd_email" value="<?php echo $this->session->userdata('email'); ?>" class="span3" type="email" readonly>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <label class="control-label span2">No Kantor<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="dd_kantor" id="dd_kantor" class="span3" type="number" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Pendidikan Terakhir<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="dd_pendidikan_terakhir" id="dd_pendidikan_terakhir" class="span3">
                                                <option value="">Pilih Pendidikan Terakhir</option>
                                                <option value="SMA/SMK">SMA/SMK</option>
                                                <option value="D3">D3</option>
                                                <option value="S1/D4">S1/D4</option>
                                                <option value="S2">S2</option>
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
                                            <input name="k_lembaga" id="k_lembaga" class="span2-5" type="text">
                                            <div class="text-error"></div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Jabatan<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="k_jabatan" id="k_jabatan" class="span2-5" type="text" autocomplete="false">
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <label class="control-label span2">Alamat Perusahaan<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <textarea name="k_alamat" id="k_alamat" style="width: 135px;" class="span2-5"></textarea>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Kode Pos<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="k_kode_pos" id="k_kode_pos" class="span2" type="number" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">No Fax<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="k_fax" id="k_fax" class="span2-5" type="number" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">No Telp<small class="required">(Optional)</small></label>
                                        <div class="controls">
                                            <input name="k_telp" id="k_telp" class="span2-5" type="number" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Email Perusahaan<span class="required">*</span></label>
                                        <div class="controls">
                                            <input name="k_email" id="k_email" class="span2-5" type="text" autocomplete="false">
                                        </div>
                                    </div>

                                    <input name="create_date" id="create_date" value="<?php echo date('Y-m-d') ?>" class="span2-5" type="hidden" readonly>

                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-footer" style="text-align:right;">
                <button type="button" onclick="window.location='<?php echo base_url('asesi') ?>'" class="btn btn-danger">
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
        </div>
        <?php echo form_close(); ?>
    </section>
<?php } else { ?>
    <section class="page container">
        <div class="row">
            <div class="span16">
                <div class="">
                    <legend class="lead">
                        Profil Data Pemohon
                    </legend>
                    <div style="text-align: right;">
                        <?php if ($checkUserOnAsesi) { ?>
                            <button type="button" class="btn btn-success" onclick="window.location='<?php echo base_url('apl_01'); ?>'">
                                <i class="icon-list-alt"></i> Pilih Skema
                            </button>
                        <?php } ?>
                        <button type="button" class="btn btn-info" onclick="window.location='<?php echo base_url('asesi/updateDataDiri/') . encrypt($getByIdUser->id); ?>'">
                            <i class="icon-pencil"></i> Ubah Data
                        </button>
                    </div>
                    <br>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="span16">
                <div class="box">
                    <div class="box-content">
                        <div class="row">
                            <div class="span9">
                                <h5>&emsp;<i class="icon-book"></i> Data Pekerjaan</h5>
                                <hr>
                                <div id="acct-password-row" style="font-size: 13px;" class="span4">
                                    <br>
                                    <fieldset>
                                        <input type="hidden" name="id" id="id">
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Nama Lengkap</label>
                                            <div class="controls form-group">
                                                <small><?php echo $getByIdUser->dd_nama_lengkap; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">NIK</label>
                                            <div class="controls form-group">
                                                <small><?php echo $getByIdUser->dd_nik; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Tempat Lahir</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_tempat_lahir; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Tanggal Lahir</label>
                                            <div class="controls form-group">
                                                <small><?php echo $getByIdUser->dd_tgl_lahir; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Jenis Kelamin</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_jenis_kelamin; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Kebangsaan</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_kebangsaan; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Alamat Rumah</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_alamat_rumah; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Kode Pos</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_kode_pos; ?></small>
                                            </div>
                                        </div>

                                    </fieldset>
                                </div>
                                <div id="acct-password-row" style="font-size: 13px;" class="span4">
                                    <br>
                                    <fieldset>
                                        <div class=" control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">No Hp</label>
                                            <div class="controls ">
                                                <small><?php echo $getByIdUser->dd_no_hp; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">No Telp</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_no_telp; ?></small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span1" style="font-weight: bold;font-size:11px;">Email</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_email; ?></small>
                                            </div>
                                        </div>

                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Kantor</label>
                                            <div class="controls">
                                                <small>
                                                    <?php if ($getByIdUser->dd_kantor == '') {
                                                        echo '0';
                                                    } else {
                                                        echo $getByIdUser->dd_kantor;
                                                    } ?>
                                                </small>
                                            </div>
                                        </div>
                                        <div class="control-group form-group">
                                            <label class="control-label span2" style="font-weight: bold;font-size:11px;">Pendidikan Terakhir</label>
                                            <div class="controls">
                                                <small><?php echo $getByIdUser->dd_pendidikan_terakhir; ?></small>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div id="acct-password-row" style="font-size: 13px;" class="span4">
                                <h5>&emsp;<i class="icon-book"></i> Data Pekerjaan</h5>
                                <hr>
                                <fieldset>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Nama Perusahaan</label>
                                        <div class="controls ">
                                            <small><?php echo empty($getByIdUser->k_lembaga) ? '-' : $getByIdUser->k_lembaga; ?></small>

                                            <div class="text-error"></div>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Jabatan</label>
                                        <div class="controls">
                                            <small><?php echo empty($getByIdUser->k_jabatan) ? '-' : $getByIdUser->k_jabatan; ?></small>
                                        </div>
                                    </div>

                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Alamat Perusahaan</label>
                                        <div class="controls">
                                            <small><?php echo empty($getByIdUser->k_alamat) ? '-' : $getByIdUser->k_alamat; ?></small>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Kode Pos</label>
                                        <div class="controls">
                                            <small><?php echo empty($getByIdUser->k_kode_pos) ? '-' : $getByIdUser->k_kode_pos; ?></small>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">No Fax</label>
                                        <div class="controls">
                                            <small>
                                                <?php if ($getByIdUser->k_fax == '') {
                                                    echo '0';
                                                } else {
                                                    echo $getByIdUser->k_fax;
                                                } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">No Telp</label>
                                        <div class="controls">
                                            <small>
                                                <?php if ($getByIdUser->k_telp == 0) {
                                                    echo '0';
                                                } else {
                                                    echo $getByIdUser->k_telp;
                                                } ?>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Email Perusahaan</label>
                                        <div class="controls">
                                            <small><?php echo !empty($getByIdUser->k_email) ? $getByIdUser->k_email : '-'; ?></small>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2" style="font-weight: bold;font-size:11px;">Tanda Tangan</label>
                                        <div class="controls">
                                            <?php if ($getByIdUser->dd_tanda_tangan_asesi == '') {
                                                echo ' <small style="color:red;font-size:10px">Tanda Tangan Belum diupload !</small>';
                                            ?>
                                            <?php
                                            } else { ?>
                                                <img src="<?php echo 'g_ttd_asesi/' . $getByIdUser->dd_tanda_tangan_asesi; ?>" width="80px" height="50px">

                                            <?php } ?>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div id="acct-password-row" class="span2">
                                <h5>&emsp;<i class="icon-picture"></i> Foto</h5>
                                <hr>
                                <small></small>
                                <fieldset>
                                    <?php if ($getByIdUser->dd_foto == '') {
                                        echo ' <small style="color:red;font-size:10px">Foto Belum diupload ! <br> Ukuran maksimum 2 MB.</small>';
                                    ?>
                                    <?php
                                    } else { ?>

                                        <div style="max-width: 260px;max-height: 320px;width: 120px;height: 160px;">
                                            <img src="<?php echo 'g_foto_asesi/' . $getByIdUser->dd_foto; ?>" style="max-width: 260px;max-height: 320px;width: 120px;height: 160px;">
                                        </div>
                                    <?php } ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <?php if (empty($getByIdUser->dd_tanda_tangan_asesi)) { ?>
        <script>
            $(document).ready(function() {
                setInterval(() => {
                    $('#modal_tanda_tangan').modal('show');
                }, 1500);
            });
        </script>
    <?php } else if (empty($getByIdUser->dd_foto)) { ?>
        <script>
            $(document).ready(function() {
                setInterval(() => {
                    $('#modal_foto').modal('show');
                }, 1500);
            });
        </script>
    <?php } ?>

    <!-- Modal tanda tangan-->
    <div id="modal_tanda_tangan" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Tanda Tangan</h4>
                    <div style="text-align: right;color:blue">
                        <small>Tanda tangan wajib diupload !</small>
                    </div>
                </div>
                <?php echo form_open('asesi/dataDiri/uploadTandaTangan', array('id' => 'form_pengalaman_kerja', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
                <div class="modal-body">
                    <input type="hidden" id="id" value="<?php echo $getByIdUser->id; ?>" name="id">
                    <fieldset>
                        <div class="control-group form-group">
                            <label class="control-label span4">Upload Tanda Tangan<small class="required">(Optional)</small></label>
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
                    <input type="hidden" id="id" value="<?php echo $getByIdUser->id; ?>" name="id">
                    <fieldset>
                        <div class="control-group form-group">
                            <label class="control-label span4">Update Foto<small class="required">(Optional)</small></label>
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
<?php } ?>
<script type="text/javascript">
    $(function() {
        $('#sample-table').tablesorter();
        $('.datepicker').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    });
</script>