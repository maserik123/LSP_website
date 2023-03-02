<script>
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
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="id_skema"]').val(data.id_skema);
                $('[name="tujuan_sertifikasi"]').val(data.tujuan_sertifikasi);
                // $('[name="temu"]').val(data.temu);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function upload_ktm(id) {
        $('#form_ktm')[0].reset();
        $('#modal_ktm').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function upload_transkrip(id) {
        $('#form_transkrip')[0].reset();
        $('#modal_transkrip').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function upload_ktp_sim(id) {
        $('#form_ktp_sim')[0].reset();
        $('#modal_ktp_sim').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function upload_sertifikat_pelatihan(id) {
        $('#form_sertifikat_pelatihan')[0].reset();
        $('#modal_sertifikat_pelatihan').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_pengalaman_kerja(id) {
        $('#form_pengalaman_kerja')[0].reset();
        $('#modal_pengalaman_kerja').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_bukti_relevan_1(id) {
        $('#form_bukti_relevan_1')[0].reset();
        $('#modal_bukti_relevan_1').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="keterangan_bukti_1"]').val(data.keterangan_bukti_1);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_bukti_relevan_2(id) {
        $('#form_bukti_relevan_2')[0].reset();
        $('#modal_bukti_relevan_2').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_bukti_relevan_3(id) {
        $('#form_bukti_relevan_3')[0].reset();
        $('#modal_bukti_relevan_3').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_bukti_relevan_4(id) {
        $('#form_bukti_relevan_4')[0].reset();
        $('#modal_bukti_relevan_4').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function upload_bukti_relevan_5(id) {
        $('#form_bukti_relevan_5')[0].reset();
        $('#modal_bukti_relevan_5').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function tanda_tangan_asesi(id) {
        $('#form_tanda_tangan_asesi')[0].reset();
        $('#modal_tanda_tangan_asesi').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);

                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }

    function confirm_lengkap(id) {
        swal({
                title: "Terimakasih, Dokumen Anda Telah Lengkap !",
                text: 'Dengan memilih Ya, Anda masih dapat menambahkan dokumen lain sebelum dikonfirmasi oleh admin LSP !',
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('asesi/apl_01/confirmLengkap'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        setInterval(() => {
                            window.location.reload();
                        }, 1500);
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var conf = confirm('Error Deleting Data, Please Reload this page !');
                        if (conf) {
                            window.location.reload();
                        } else {
                            alert('Your connection or configuration is not secure, please reload this page and try again to delete this item !');
                        }
                    }
                });
            });
    }

    function confirm_selesai(id) {
        swal({
                title: "Konfirmasi Selesai ?",
                text: "Anda telah menyelesaikan pendaftaran sertifikasi, silahkan konfirmasi !",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('asesi/apl_01/confirmSelesai'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        setInterval(() => {
                            window.location.reload();
                        }, 1500);
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var conf = confirm('Error Deleting Data, Please Reload this page !');
                        if (conf) {
                            window.location.reload();
                        } else {
                            alert('Your connection or configuration is not secure, please reload this page and try again to delete this item !');
                        }
                    }
                });
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
                    url: "<?php echo site_url('asesi/apl_01/delete'); ?>/" + id,
                    type: "POST",
                    dataType: "JSON",
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                    },
                    success: function(resp) {
                        data = resp.result;
                        setInterval(() => {
                            window.location.reload();
                        }, 1500);
                        return swal({
                            html: true,
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        var conf = confirm('Error Deleting Data, Please Reload this page !');
                        if (conf) {
                            window.location.reload();
                        } else {
                            alert('Your connection or configuration is not secure, please reload this page and try again to delete this item !');
                        }
                    }
                });
            });
    }

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>asesi/apl_01/addData';
        } else if (save_method == 'update') {
            url = '<?php echo base_url() ?>asesi/apl_01/update';
        }
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
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            $('#modal').modal('hide');
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);
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

    function verifikasiTandaTangan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesi/apl_01/verifikasiTandaTangan';

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
                    data: $('#form_tanda_tangan_asesi').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_tanda_tangan_asesi input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_tanda_tangan_asesi")[0].reset();
                            $('#modal').modal('hide');
                            setInterval(() => {
                                window.location.reload();
                            }, 2000);
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

    function tempat_sampah() {
        window.location = '<?php echo base_url('asesi/tempat_sampah') ?>';
    }
</script>

<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        /* width: 300px; */
        height: 700px;
        overflow-x: auto;

    }

    .auto {
        display: block;
        border: 1px solid red;
        padding: 5px;
        margin-top: 5px;
        width: 300px;
        height: 50px;
        overflow: auto;
    }
</style>
<!-- <script type="text/JavaScript">
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

</script> -->

<section class="page container" id="page">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Pilih Skema Sertifikasi
                    <small>Lengkapi data berikut untuk melengkapi dokumen APL-01</small>
                </legend>
                <!-- Tombol Tempat Sampah -->
                <div style="text-align: right;"><?php
                                                //  echo get_btn_delete('tempat_sampah()', 'Tempat Sampah'); 
                                                ?></div>

                <div style="padding-bottom: 12px;">
                    <label for="">Silahkan pilih skema sertifikasi yang akan anda ikuti.</label>
                    <button type="button" class="btn btn-info" onclick="tambah()">
                        <i class="icon-save"></i> Tambah Skema
                    </button>
                    <button type="button" class="btn btn-success" onclick="window.location='<?php echo base_url('apl_02') ?>'">
                        <i class="icon-list-alt"></i> APL-02
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <?php
        date_default_timezone_set('Asia/Jakarta');
        ?>
        <?php foreach ($getPilihanSkema as $row) { ?>
            <?php if ($row->status_selesai == 'selesai') {
            } else { ?>
                <?php
                $getApl02FinishByIdPilihanSkema = $this->M_apl_02_finish->getDataByIdPilSkema($row->id_ps);
                if (!empty($getApl02FinishByIdPilihanSkema->tanda_tangan_asesor)) { ?>
                    <script>
                        $(document).ready(function() {
                            setInterval(() => {
                                confirm_selesai("<?php echo $row->id_ps; ?>");
                            }, 7000);
                        });
                    </script>
            <?php } else {
                }
            } ?>
            <?php if ((!empty($row->upload_ktm)) && (!empty($row->upload_transkrip)) && (!empty($row->upload_ktp_sim)) && (!empty($row->tanda_tangan_asesi))) { ?>
                <?php if ($row->status_dokumen != 1) { ?>
                    <script>
                        $(document).ready(function() {
                            setInterval(() => {
                                confirm_lengkap(<?php echo $row->id_ps; ?>);
                            }, 1500);
                        });
                    </script>
                <?php } else {
                } ?>
            <?php } else if (empty($row->upload_ktm)) { ?>
                <script>
                    $(document).ready(function() {
                        setInterval(() => {
                            $('#ModalNotification').modal('show');
                            $('.text_title').text('Silahkan upload dokumen KTM pada Sertifikasi <?php echo $row->judul_skema; ?> !');
                        }, 10000);
                    });
                </script>
            <?php } else if (empty($row->upload_transkrip)) { ?>
                <script>
                    $(document).ready(function() {
                        setInterval(() => {
                            $('#ModalNotification').modal('show');
                            $('.text_title').text('Silahkan upload dokumen transkrip nilai Sertifikasi <?php echo $row->judul_skema; ?> !');
                        }, 10000);
                    });
                </script>
            <?php } else if (empty($row->upload_ktp_sim)) { ?>
                <script>
                    $(document).ready(function() {
                        setInterval(() => {
                            $('#ModalNotification').modal('show');
                            $('.text_title').text('Silahkan upload dokumen KTP/SIM Sertifikasi <?php echo $row->judul_skema; ?> !');
                        }, 10000);
                    });
                </script>
            <?php } else if (empty($row->tanda_tangan_asesi)) { ?>
                <script>
                    $(document).ready(function() {
                        setInterval(() => {
                            $('#ModalNotification').modal('show');
                            $('.text_title').text('Anda telah melengkapi dokumen penting, Silahkan tambahkan dokumen pendukung lainnya atau Verifikasi Lengkap apabila sudah lengkap menurut anda pada skema <?php echo $row->judul_skema; ?> !');
                        }, 10000);
                    });
                </script>
            <?php } ?>
            <div id="acct-password-row " class="span8 ">
                <div class="box pattern pattern-sandstone ">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5 style="font-size: 12px;">
                            <?php echo $row->judul_skema ?>
                        </h5>
                    </div>
                    <div class="box-content box-table scroll">
                        <table id="sample-table" class="table table-hover table-striped table-bordered tablesorter">
                            <tbody>
                                <tr>
                                    <td><i><strong>Tools</strong></i></td>
                                    <td colspan="3">
                                        <div style="text-align: right;">
                                            <!-- <button class="btn btn-info label" onclick="alert('Under Development')" style="font-size:11px"><i class="icon-pencil"></i> Cetak</button> -->
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) {  ?>
                                                <button class="btn btn-warning label" onclick="ubah(<?php echo ($row->id_ps); ?>)" style="font-size:11px" disabled><i class="icon-pencil"></i> Ubah</button>
                                                <button class="btn btn-danger label" onclick="hapus(<?php echo ($row->id_ps); ?>)" style="font-size:11px" disabled><i class="icon-trash"></i> Hapus</button>
                                            <?php } else { ?>
                                                <button class="btn btn-warning label" onclick="ubah(<?php echo ($row->id_ps); ?>)" style="font-size:11px"><i class="icon-pencil"></i> Ubah</button>
                                                <button class="btn btn-danger label" onclick="hapus(<?php echo ($row->id_ps); ?>)" style="font-size:11px"><i class="icon-trash"></i> Hapus</button>
                                            <?php } ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Judul Skema Sertifikasi</th>
                                    <td style="font-size: 11px;" colspan="3"><?php echo $row->judul_skema; ?></td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Tujuan Asesment</th>
                                    <td style="font-size: 11px;" colspan="3"><?php echo $row->tujuan_sertifikasi; ?></td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Asesmen Mandiri</th>
                                    <td style="font-size: 11px;" colspan="3"> <?php echo $row->status_selesai == "selesai" ? 'Telah Selesai' :  get_btn_confirm_selesai('confirm_selesai("' . $row->id_ps . '")'); ?> </td>
                                </tr>
                                <?php //if ((date('Y-m-d') > $row->tanggal_pelaksanaan)) { 
                                ?>
                                <!-- <script>
                                        setInterval(() => {
                                            confirm_selesai(<?php echo $row->id_ps; ?>);
                                        }, 1500);
                                    </script> -->
                                <?php //} 
                                ?>
                                <tr>
                                    <td colspan="4" style="background-color: blanchedalmond;">
                                        <div style="text-align: center;">
                                            <small style="font-size: 11px;"> Silahkan upload dokumen yang dibutuhkan untuk sertifikasi LSP. </small>
                                            <br> <small style="font-size: 11px;"> Document Upload <strong> Max Size 2 MB. </strong> </small>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Dokumen KTM*</th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_ktm)) { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:brown;">Tidak Memenuhi
                                                </label>
                                                <button class="badge btn btn-danger" onclick="upload_ktm(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                            </div>
                                        <?php } else if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue;">Memenuhi Syarat
                                                </label>
                                                <a href="<?php echo base_url() ?>g_ktm/<?php echo $row->upload_ktm ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue;">Memenuhi Syarat
                                                </label>
                                                <button class="badge btn btn-primary" onclick="upload_ktm(<?php echo $row->id_ps; ?>)" title="Update Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Update</i> </button>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <th style="font-size: 11px;">Dokumen Transkrip Nilai*</th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_transkrip)) { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:brown">Tidak Memenuhi</label>
                                                <button class="badge btn btn-danger" onclick="upload_transkrip(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                            </div>
                                        <?php } else if (($row->status_diterima == 1) || ($row->status_diterima == 2)) {  ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                <a href="<?php echo base_url() ?>g_transkrip_nilai/<?php echo $row->upload_transkrip; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                <button class="badge btn btn-primary" onclick="upload_transkrip(<?php echo $row->id_ps; ?>)" title="Update Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Update</i> </button>
                                            </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Dokumen KTP/SIM*</th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_ktp_sim)) { ?>

                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:brown">Tidak Memenuhi</label>
                                                <button class="badge btn btn-danger" onclick="upload_ktp_sim(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                            </div>
                                        <?php } else if (($row->status_diterima == 1) || ($row->status_diterima == 2)) {  ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                <a href="<?php echo base_url() ?>g_ktp_sim/<?php echo $row->upload_ktp_sim; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="" style="text-align: center;">
                                                <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                <button class="badge btn btn-primary" onclick="upload_ktp_sim(<?php echo $row->id_ps; ?>)" title="Update Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Update</i> </button>
                                            </div>
                                        <?php } ?>
                                    </td>
                                    <th style="font-size: 11px;">Sertifikat Pelatihan <small>(Optional)</small> <br> <small>(Diterbitkan oleh pcr)</small> </th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->sertifikat_pelatihan)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_sertifikat_pelatihan(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:brown">Tidak Memenuhi</label>
                                                    <button class="badge btn btn-danger" onclick="upload_sertifikat_pelatihan(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                    <a href="<?php echo base_url() ?>g_sertifikat_pelatihan/<?php echo $row->sertifikat_pelatihan; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                    <button class="badge btn btn-primary" onclick="upload_sertifikat_pelatihan(<?php echo $row->id_ps; ?>)" title="Update Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Update</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Pengalaman Kerja <small>(Optional)</small> </th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_pengalaman_kerja)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_pengalaman_kerja(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:brown">Tidak Memenuhi</label>
                                                    <button class="badge btn btn-danger" onclick="upload_pengalaman_kerja(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                    <a href="<?php echo base_url() ?>g_pengalaman_kerja/<?php echo $row->upload_pengalaman_kerja; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:blue">Memenuhi Syarat</label>
                                                    <button class="badge btn btn-success" onclick="upload_pengalaman_kerja(<?php echo $row->id_ps; ?>)" title="Update Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Update</i> </button>
                                                </div>
                                            <?php } ?>


                                        <?php } ?>
                                    </td>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 1 <br><small>(Optional)</small></th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_bukti_relevan_1)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_1(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_1(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:green">Ada</label>
                                                    <a href="<?php echo base_url() ?>g_kompetensi/<?php echo $row->upload_bukti_relevan_1; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_1(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 2<br><small>(Optional)</small></th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_bukti_relevan_2)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_2(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_2(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>

                                            <?php } ?>
                                        <?php } else { ?>

                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:green">Ada</label>
                                                    <a href="<?php echo base_url() ?>g_kompetensi/<?php echo $row->upload_bukti_relevan_2; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_2(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 3<br><small>(Optional)</small></th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_bukti_relevan_3)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_3(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_3(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>

                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:green">Ada</label>
                                                    <a href="<?php echo base_url() ?>g_kompetensi/<?php echo $row->upload_bukti_relevan_3; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_3(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 4<br><small>(Optional)</small></th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_bukti_relevan_4)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_4(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_4(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:green">Ada</label>
                                                    <a href="<?php echo base_url() ?>g_kompetensi/<?php echo $row->upload_bukti_relevan_4; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_4(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 5<br><small>(Optional)</small></th>
                                    <td style="font-size: 11px;">
                                        <?php if (empty($row->upload_bukti_relevan_5)) { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>

                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_5(<?php echo $row->id_ps; ?>)" title="Upload Dokumen" disabled><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_5(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php if (($row->status_diterima == 1) || ($row->status_diterima == 2)) { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:green">Ada</label>
                                                    <a href="<?php echo base_url() ?>g_kompetensi/<?php echo $row->upload_bukti_relevan_5; ?>" target="_blank" class="badge btn btn-info" style="font-size:10px;"><span class="fa fa-search"> </span> Lihat</a>
                                                </div>
                                            <?php } else { ?>
                                                <div class="" style="text-align: center;">
                                                    <label class="label" style="font-size: 9px;background-color:red">Tidak Ada</label>
                                                    <button class="badge btn btn-danger" onclick="upload_bukti_relevan_5(<?php echo $row->id_ps; ?>)" title="Upload Dokumen"><i class="icon-upload-alt" style="font-size: 10px;"> Upload</i> </button>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Tanda Tangan Asesi*</th>
                                    <td style="font-size: 11px;">
                                        <div class="" style="text-align: center;">
                                            <?php if ($row->tanda_tangan_asesi == '') { ?>
                                                <button class="label" style="background-color: red;" onclick="tanda_tangan_asesi(<?php echo $row->id_ps; ?>)"><i class="icon-check" style="font-size: 10px;"> Verifikasi Lengkap</i> </button>
                                            <?php } else { ?>
                                                <label class="label" style="font-size: 9px;background-color:green">Telah dikonfirmasi</label>
                                                <!-- <button class="label" style="background-color: green;" onclick="tanda_tangan_asesi(<?php echo $row->id_ps; ?>)"><i class="icon-check" style="font-size: 10px;"> Verifikasi Lengkap</i> </button> -->
                                            <?php } ?>
                                        </div>
                                    </td>
                                    <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                    <td style="font-size: 11px;">
                                        <?php echo tgl_indo($row->tanggal_pengajuan); ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;" colspan="2">Status Konfirmasi Data Pemohon</th>
                                    <td style="font-size: 11px;" colspan="2">
                                        <?php if ($row->status_diterima == 0) { ?>
                                            <label for="" class="label" style="background-color: orange;text-align: center;">Menunggu Konfirmasi...</label>
                                        <?php } else if ($row->status_diterima == 1) { ?>
                                            <label for="" class="label" style="background-color: green;text-align:center;">Diterima</label>
                                        <?php } else { ?>
                                            <label for="" class="label" style="background-color: red;text-align:center;">Ditolak</label>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;" colspan="2">Tanggal dikonfirmasi</th>
                                    <td style="font-size: 11px;" colspan="2">
                                        <span class="label badge btn-primary" style="background-color: blue;text-align: center;"><?php echo tgl_indo($row->tanggal_diterima); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-size:11px;">
                                        <label for="" style="font-size: 10px;"><b>Keterangan</b></label>
                                    </td>
                                    <td style="font-size:11px;" colspan="3">
                                        <p style="line-height: 12px;"><?php echo empty($row->keterangan_status) ? 'Belum ada keterangan yang ditambahkan' : $row->keterangan_status; ?> </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php }  ?>
    </div>
</section>
<!-- Modal Add Skema -->
<div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Skema Sertifikasi</h4>
                <label for=""><span>Pilih skema sertifikasi yang tersedia sesuai dengan jadwal.</span></label>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')) ?>
            <div class="modal-body">
                <br>
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span3 span16">Skema Sertifikasi<span class="required">*</span></label>
                        <div class="controls ">
                            <select name="id_skema" id="id_skema" class="span4">
                                <option value="">--Pilih Skema--</option>
                                <?php foreach ($getDataSkema as $row) { ?>
                                    <option value="<?php echo $row->id ?>"><?php echo $row->judul_skema; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Tujuan Assesment<span class="required">*</span></label>
                        <div class="controls">
                            <select name="tujuan_sertifikasi" id="tujuan_sertifikasi" class="span3">
                                <option value="">--Tujuan Sertifikasi--</option>
                                <option value="sertifikasi">Sertifikasi</option>
                                <option value="sertifikasi ulang">Sertifikasi Ulang</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <!-- <label class="control-label span3">Create Date<span class="required">*</span></label> -->
                        <div class="controls">
                            <input name="create_date" id="create_date" value="<?php echo date('Y-m-d') ?>" class="span4" type="hidden" readonly>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="reset" class="btn btn-warning">Reset</button>
            <button type="button" class="btn btn-primary" onclick="simpan()"><i class="icon-save"></i> Simpan</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- Modal Pemberitahuan-->
<div id="notifikasi">
    <div id="ModalNotification" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Information !</h4>
                </div>
                <div class="modal-body">
                    <p class="text_title"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="icon-check"></i> Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal No Empty-->
<div id="no_empty">
    <div id="ModalNoEmpty" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Information</h4>
                </div>
                <div class="modal-body">
                    <p class="text_title"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-dismiss="modal"><i class="icon-check"></i> Oke</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal  KTM -->
<div id="modal_ktm" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_ktm', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Upload Dokumen KTM<span class="required">*</span></label>
                        <div class="controls">
                            <input name="upload_ktm" id="upload_ktm" class="span3" type="file" autocomplete="false">
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
<!-- Modal  Transkrip-->
<div id="modal_transkrip" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_transkrip', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Upload Transkrip (SMT 3)<span class="required">*</span></label>
                        <div class="controls">
                            <input name="upload_transkrip" id="upload_transkrip" class="span3" type="file">
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

<!-- Modal  ktp_sim-->
<div id="modal_ktp_sim" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_ktp_sim', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Upload KTP/SIM<small class="required">*</small></label>
                        <div class="controls">
                            <input name="upload_ktp_sim" id="upload_ktp_sim" class="span3" type="file" autocomplete="false">
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

<!-- Modal  sertifikat-->
<div id="modal_sertifikat_pelatihan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_sertifikat_pelatihan', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Upload Sertifikat Pelatihan<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="sertifikat_pelatihan" id="sertifikat_pelatihan" class="span3" type="file" autocomplete="false">
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

<!-- Modal  pengalaman-->
<div id="modal_pengalaman_kerja" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_pengalaman_kerja', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Upload Pengalaman Kerja<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_pengalaman_kerja" id="upload_pengalaman_kerja" class="span3" type="file" autocomplete="false">
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

<!-- Modal  bukti relevan 1-->
<div id="modal_bukti_relevan_1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bukti Kompetensi 1</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_bukti_relevan_1', 'method' => 'post',  'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Bukti Kompetensi Relevan 1<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_bukti_relevan_1" id="upload_bukti_relevan_1" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Judul/Keterangan<small class="required">*</small></label>
                        <div class="controls">
                            <textarea name="keterangan_bukti_1" id="keterangan_bukti_1" class="span4" placeholder="Misal: Sertifikat Pelatihan CCNA" required></textarea>
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

<!-- Modal  bukti relevan 2-->
<div id="modal_bukti_relevan_2" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_bukti_relevan_2', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Bukti Kompetensi Relevan 2<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_bukti_relevan_2" id="upload_bukti_relevan_2" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Judul/Keterangan<small class="required">*</small></label>
                        <div class="controls">
                            <textarea name="keterangan_bukti_2" id="keterangan_bukti_2" class="span4" placeholder="Misal: Sertifikat Pelatihan CCNA" required></textarea>
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

<!-- Modal  bukti relevan 3-->
<div id="modal_bukti_relevan_3" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_bukti_relevan_3', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Bukti Kompetensi Relevan 3<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_bukti_relevan_3" id="upload_bukti_relevan_3" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Judul/Keterangan<small class="required">*</small></label>
                        <div class="controls">
                            <textarea name="keterangan_bukti_3" id="keterangan_bukti_3" class="span4" placeholder="Misal: Sertifikat Pelatihan CCNA" required></textarea>
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

<!-- Modal  bukti relevan 4-->
<div id="modal_bukti_relevan_4" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_bukti_relevan_4', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Bukti Kompetensi Relevan 4<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_bukti_relevan_4" id="upload_bukti_relevan_4" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Judul/Keterangan<small class="required">*</small></label>
                        <div class="controls">
                            <textarea name="keterangan_bukti_4" id="keterangan_bukti_4" class="span4" placeholder="Misal: Sertifikat Pelatihan CCNA" required></textarea>
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

<!-- Modal  bukti relevan 5-->
<div id="modal_bukti_relevan_5" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Dokumen Pendukung</h4>
            </div>
            <?php echo form_open('asesi/apl_01/uploadDokumen', array('id' => 'form_bukti_relevan_5', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <div class="control-group form-group">
                        <label class="control-label span4">Bukti Kompetensi Relevan 5<small class="required">(Optional)</small></label>
                        <div class="controls">
                            <input name="upload_bukti_relevan_5" id="upload_bukti_relevan_5" class="span3" type="file" autocomplete="false">
                        </div>
                    </div>
                    <div class="control-group form-group">
                        <label class="control-label span3">Judul/Keterangan<small class="required">*</small></label>
                        <div class="controls">
                            <textarea name="keterangan_bukti_5" id="keterangan_bukti_5" class="span4" placeholder="Misal: Sertifikat Pelatihan CCNA" required></textarea>
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

<!-- Modal  tanda tangan asesi-->
<div id="modal_tanda_tangan_asesi" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Verifikasi Dokumen Pemohon</h4>
            </div>
            <?php echo form_open('asesi/apl_01/verifikasiTandaTangan', array('id' => 'form_tanda_tangan_asesi', 'method' => 'post', 'enctype' => 'multipart/form-data')) ?>
            <div class="modal-body">
                <input type="hidden" id="id" name="id">
                <fieldset>
                    <p>Dengan mengupload tanda tangan pada bagian APL-01 berikut. Saya menyatakan bahwa seluruh dokumen yang saya berikan dapat dipertanggung jawabkan.</p>
                    <div class="control-group form-group">
                        <div class="controls">
                            <input name="tanda_tangan_asesi" id="tanda_tangan_asesi" class="span3" type="hidden" value="<?php echo $getByIdUser->dd_tanda_tangan_asesi; ?>" autocomplete="false">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="verifikasiTandaTangan()"><i class="icon-save"></i> Verifikasi</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>