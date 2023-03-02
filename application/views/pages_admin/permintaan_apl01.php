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
            "bFilter": true,
            "bPaginate": true,
            // "dom": 'Bfrtip',
            // "buttons": [
            //     'excel', 'pdf', 'print'
            // ],
            "ajax": {
                "url": "<?php echo site_url('administrator/konfirmasi_apl01/getAllData') ?>",
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

    function ubah(id) {
        save_method = 'update';
        $('#form_inputan')[0].reset();
        $('#modal').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/konfirmasi_apl01/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                if ((data.id_asesor != '') && (data.id_user_admin != 0) && (data.nik_lsp != '') && (data.tanda_tangan_admin == '')) {
                    $('#form_1').hide();
                    $('#form_2').show();
                } else if (data.tanda_tangan_admin != '') {
                    $('#form_1').show();
                    $('#form_2').hide();
                } else {
                    $('#form_1').show();
                    $('#form_2').hide();
                }

                $('[name="id"]').val(data.id);
                $('[name="id_asesor"]').val(data.id_asesor);
                $('[name="id_user_admin"]').val(data.id_user_admin);
                $('[name="nik_lsp"]').val(data.nik_lsp);
                $('[name="tanda_tangan_admin"]').val(data.tanda_tangan_admin);
                $('[name="keterangan_status"]').val(data.keterangan_status);
                $('[name="status_diterima"]').val(data.status_diterima);
                $('.reset').hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function add_keterangan(id) {
        save_method = 'update';
        $('#form_inputan_keterangan')[0].reset();
        $('#modal_keterangan').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/konfirmasi_apl01/getById1/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="keterangan_status"]').val(data.keterangan_status);
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
                    url: "<?php echo site_url('administrator/konfirmasi_apl01/delete'); ?>/" + id,
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

    function accept(id) {
        swal({
                title: "Apakah Yakin Akan Menerima Konfirmasi?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('administrator/konfirmasi_apl01/terima_konfirmasi'); ?>/" + id,
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

    function terima() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/konfirmasi_apl01/terima_konfirmasi';
        swal({
                title: "Apakah anda ingin menerima ?",
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
                    data: $('#form_input').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_input input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_input")[0].reset();
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

    function tolak() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/konfirmasi_apl01/tolak_konfirmasi';
        swal({
                title: "Apakah anda ingin menolak ?",
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
                    data: $('#form_input').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_input input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_input")[0].reset();
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


    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/konfirmasi_apl01/update';
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
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            $('#form_1').hide();
                            $('#form_2').show();
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

    function simpan_keterangan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/konfirmasi_apl01/update_keterangan';
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
                    data: $('#form_inputan_keterangan').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_inputan input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            // updateAllTable();
                            window.location.reload();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan_keterangan")[0].reset();
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

    function upload_gambar() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>administrator/konfirmasi_apl01/update';
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
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_inputan")[0].reset();
                            $('#modal').modal('hide');
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

    function cekPermohonan(id) {
        save_method = 'update';
        $('#cekPermohonan').modal({
            show: true,
            backdrop: 'static',
            keyboard: false
        });
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('administrator/konfirmasi_apl01/cekDataByIdPilSkema/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data;
                console.log(data.id);
                var fotoProfil = new Image(120, 170);
                fotoProfil.src = '<?php echo base_url() ?>g_foto_asesi/' + data.dd_foto + '';
                x = document.getElementById("dd_foto");
                x.appendChild(fotoProfil);

                var tandaTangan = new Image(80, 60);
                tandaTangan.src = '<?php echo base_url() ?>g_ttd_asesi/' + data.dd_tanda_tangan_asesi + '';
                x = document.getElementById("dd_tanda_tangan_asesi");
                x.appendChild(tandaTangan);

                $('[id="id_ps"]').val(data.id);
                $('[id="dd_nama_lengkap"]').html(data.dd_nama_lengkap);
                $('[id="dd_nik"]').html(data.dd_nik);
                $('[id="dd_tempat_lahir"]').html(data.dd_tempat_lahir);
                $('[id="dd_tgl_lahir"]').html(data.dd_tgl_lahir);
                $('[id="dd_jenis_kelamin"]').html(data.dd_jenis_kelamin);
                $('[id="dd_kebangsaan"]').html(data.dd_kebangsaan);
                $('[id="dd_alamat_rumah"]').html(data.dd_alamat_rumah);
                $('[id="dd_no_hp"]').html(data.dd_no_hp);
                $('[id="dd_no_telp"]').html(data.dd_no_telp);
                $('[id="dd_email"]').html(data.dd_email);
                $('[id="dd_email1"]').val(data.dd_email);
                $('[id="dd_kode_pos"]').html(data.dd_kode_pos);
                $('[id="dd_kantor"]').html(data.dd_kantor);
                $('[id="dd_kantor"]').html(data.dd_kantor);
                $('[id="dd_pendidikan_terakhir"]').html(data.dd_pendidikan_terakhir);
                $('[id="k_lembaga"]').html(data.k_lembaga);
                $('[id="k_jabatan"]').html(data.k_jabatan);
                $('[id="k_alamat"]').html(data.k_alamat);
                $('[id="k_kode_pos"]').html(data.k_kode_pos);
                $('[id="k_fax"]').html(data.k_fax);
                $('[id="k_telp"]').html(data.k_telp);
                $('[id="k_email"]').html(data.k_email);
                $('[id="judul_skema"]').html(data.judul_skema);
                $('[id="tujuan_sertifikasi"]').html(data.tujuan_sertifikasi);
                $('[id="tanggal_pengajuan"]').html(data.tanggal_pengajuan);
                $('[id="nik_lsp"]').html(data.nik_lsp);
                $('[id="tanggal_diterima"]').html(data.tanggal_diterima);

                if (data.keterangan_status == '') {
                    tombol_ket = '<button type="button" style="font-size:11px;" onclick=add_keterangan(' + data.id + ') class="btn btn-warning btn-md"><li class="fa fa-pencil"></li>Add/Edit Catatan</button>';
                    $('#tombol_keterangan').html(tombol_ket);
                    $('#keterangan_status').show();
                    $('#tombol_keterangan').show();
                } else {
                    tombol_ket = '<button type="button" style="font-size:11px;" onclick=add_keterangan(' + data.id + ') class="btn btn-warning btn-md"><li class="fa fa-pencil"></li>Add/Edit Catatan</button>';
                    $('#tombol_keterangan').html(tombol_ket);
                    $('#keterangan_status').show();
                    $('#tombol_keterangan').show();

                    $('[id="keterangan_status"]').html(data.keterangan_status);
                }
                // Cek status diterima
                if (data.status_diterima == 0) {
                    $('[id="status_diterima"]').html('Sedang diajukan');
                } else if (data.status_diterima == 1) {
                    $('[id="status_diterima"]').html('<div style="color:green;">Telah diterima</div>');
                } else if (data.status_diterima == 2) {
                    $('[id="status_diterima"]').html('<div style="color:red;">Telah ditolak</div>');
                }
                //  Cek status dokumen
                if (data.status_dokumen == 0) {
                    $('[id="status_dokumen"]').html('<div style="color:red;">Belum lengkap</div>');
                } else if (data.status_dokumen == 1) {
                    $('[id="status_dokumen"]').html('<div style="color:green;">Telah lengkap</div>');
                }
                // Untuk link url
                $('#lihatKTM').html('<a href="<?php echo base_url("g_ktm/") ?>' + data.upload_ktm + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatTranskrip').html('<a href="<?php echo base_url("g_transkrip_nilai/") ?>' + data.upload_transkrip + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatKtpSim').html('<a href="<?php echo base_url("g_ktp_sim/") ?>' + data.upload_ktp_sim + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatSertifPelatihan').html('<a href="<?php echo base_url("g_sertifikat_pelatihan/") ?>' + data.sertifikat_pelatihan + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatPengalamanKerja').html('<a href="<?php echo base_url("g_pengalaman_kerja/") ?>' + data.upload_pengalaman_kerja + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatBukti1').html('<a href="<?php echo base_url("g_kompetensi/") ?>' + data.upload_bukti_relevan_1 + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatBukti2').html('<a href="<?php echo base_url("g_kompetensi/") ?>' + data.upload_bukti_relevan_2 + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatBukti3').html('<a href="<?php echo base_url("g_kompetensi/") ?>' + data.upload_bukti_relevan_3 + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatBukti4').html('<a href="<?php echo base_url("g_kompetensi/") ?>' + data.upload_bukti_relevan_4 + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');
                $('#lihatBukti5').html('<a href="<?php echo base_url("g_kompetensi/") ?>' + data.upload_bukti_relevan_5 + '" target="_blank" style="font-size: 11px;"><li class="fa fa-search"></li> Lihat</a>');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }
</script>


<style>
    .scroll {
        width: 100%;
        height: 440px;
        overflow-y: scroll;
    }
</style>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar Pemohon Asesi </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Settings 1</a>
                        <a class="dropdown-item" href="#">Settings 2</a>
                    </div>
                </li>
                <li><a class="close-link"><i class="fa fa-close"></i></a>
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="data" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th style="font-size: 11px;">No</th>
                                    <th style="font-size: 11px;">Nama Pemohon</th>
                                    <th style="font-size: 11px;">Judul Skema</th>
                                    <th style="font-size: 11px;">Tujuan Asesment</th>
                                    <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                    <th style="font-size: 11px;">Status Dokumen</th>
                                    <th style="font-size: 11px;">Keterangan</th>
                                    <th style="font-size: 11px;">Periksa Dokumen</th>
                                    <!-- <th style="font-size: 11px;">Status</th> -->
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="cekPermohonan" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <li class="fa fa-book"></li> Dokumen Permohonan Asesi
                </h5>
                <div class="text-right">
                    <button type="button" class="btn" data-dismiss="modal" onclick="window.location.reload()">
                        <li class="fa fa-close"> </li>
                    </button>
                </div>
            </div>
            <div class="modal-body scroll">
                <div class="row">
                    <div class="col-md-4">
                        <h6>
                            <li class="fa fa-user"></li> Data Diri
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <h6>
                            <li class="fa fa-briefcase"></li> Data Pekerjaan
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <h6>
                            <li class="fa fa-image"></li> Tanda Tangan dan Foto
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-4">
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Nama Lengkap</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_nama_lengkap" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">NIK</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_nik" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tempat Lahir</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_tempat_lahir" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanggal Lahir</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_tgl_lahir" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Jenis Kelamin</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_jenis_kelamin" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Kebangsaan</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_kebangsaan" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Alamat Rumah</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_alamat_rumah" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">No Hp</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_no_hp" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">No Telp</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_no_telp" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Email</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_email" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Kode Pos</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_kode_pos" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">No Telp Kantor</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_kantor" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Pend. Terakhir</label>
                            <span aria-hidden="true" style="font-size:11px;" id="dd_pendidikan_terakhir" class="col-md-8"></span>
                        </div>
                    </div>
                    <div class="col-md-4">

                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Perusahaan</label>
                            <span aria-hidden="true" id="k_lembaga" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Jabatan</label>
                            <span aria-hidden="true" id="k_jabatan" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Alamat</label>
                            <span aria-hidden="true" id="k_alamat" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Kode Pos</label>
                            <span aria-hidden="true" id="k_kode_pos" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">No. Fax</label>
                            <span aria-hidden="true" id="k_fax" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Telepon</label>
                            <span aria-hidden="true" id="k_telp" style="font-size:11px" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Email</label>
                            <span aria-hidden="true" id="k_email" style="font-size:11px" class="col-md-8"></span>
                        </div>

                    </div>
                    <div class="col-md-4">
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Pas Foto <br> <small>Maksimum file 2MB.</small></label>
                            <div style="text-align: right;">
                                <div id="dd_foto"></div>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanda Tangan <br> <small>Maksimum file 2MB.</small></label>
                            <div id="dd_tanda_tangan_asesi"></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <h6>
                            <li class="fa fa-briefcase"></li> Data Sertifikasi ( <span id="judul_skema" style="font-size: 12px;"></span>
                            <li class="fa fa-arrow-right"></li> <span aria-hidden="true" id="tujuan_sertifikasi" style="font-size: 12px;"></span> )
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-6">
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Dokumen KTM<span class="required">*</span></label>
                            <div id="lihatKTM"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Dokumen Transkrip<span class="required">*</span></label>
                            <div id="lihatTranskrip"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Dokumen KTP/SIM<span class="required">*</span></label>
                            <div id="lihatKtpSim"></div>

                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Sertifikat Pelatihan<span class="required">(Optional)</span></label>
                            <div id="lihatSertifPelatihan"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Dokumen Pengalaman Kerja<span class="required">(Optional)</span></label>
                            <div id="lihatPengalamanKerja"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Bukti Relevan 1<span class="required">(Optional)</span></label>
                            <div id="lihatBukti1"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Bukti Relevan 2<span class="required">(Optional)</span></label>
                            <div id="lihatBukti2"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Bukti Relevan 3<span class="required">(Optional)</span></label>
                            <div id="lihatBukti3"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Bukti Relevan 4<span class="required">(Optional)</span></label>
                            <div id="lihatBukti4"></div>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Bukti Relevan 5<span class="required">(Optional)</span></label>
                            <div id="lihatBukti5"></div>
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanggal Pengajuan<span class="required">*</span></label>
                            <span aria-hidden="true" id="tanggal_pengajuan" style="font-size: 11px;" class="col-md-8"></span>
                        </div>
                        <!-- <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">NIK LSP<span class="required">*</span></label>
                            <span aria-hidden="true" id="nik_lsp" style="font-size: 11px;" class="col-md-8"></span>
                        </div> -->
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanggal diverifikasi<span class="required">*</span></label>
                            <span aria-hidden="true" id="tanggal_diterima" style="font-size:11px;" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Status Diterima<span class="required">*</span></label>
                            <span aria-hidden="true" id="status_diterima" style="font-size:11px;" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Kelengkapan Dokumen<span class="required">*</span></label>
                            <span aria-hidden="true" id="status_dokumen" style="font-size:11px;" class="col-md-8"></span>
                        </div>
                        <div class="field item form-group">

                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Keterangan Status<span class="required">*</span>
                            </label>
                            <span aria-hidden="true" id="keterangan_status" style="font-size:11px;" class="col-md-8"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_open('', array('id' => 'form_input', 'method' => 'post')); ?>
            <input type="hidden" id="id_ps" name="id_ps">
            <div class="modal-footer">
                <div id="tombol_keterangan"></div>

                <!-- <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="window.location.reload()">
                    <li class="fa fa-"></li>Tutup
                </button> -->
                <input type="hidden" id="dd_email1" name="dd_email1">

                <button type="button" class="btn btn-danger btn-sm" onclick="tolak()">
                    <li class="fa fa-close"></li> Tolak Permintaan
                </button>
                <button type="button" class="btn btn-primary btn-sm" onclick="terima()">
                    <li class="fa fa-check"></li> Terima Permintaan
                </button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asesi Confirmation Form..</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- FOrm bagian Asesor -->
                    <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                    <div id="form_1">
                        <div class="col-md-12">
                            <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">Pilih Asesor<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <select name="id_asesor" id="id_asesor" class="form-control has-feedback-left">
                                        <option value="">Pilih Asesor</option>
                                        <?php foreach ($getAsesor as $row) { ?>
                                            <option value="<?php echo $row->id ?>"><?php echo $row->nama_asesor ?></option>
                                        <?php } ?>
                                        <option value="0" style="font-size: 11px;">(Batal Konfirmasi)</option>
                                    </select>
                                    <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">Admin Penerima<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" value="<?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') ?>" class="form-control has-feedback-left" disabled>
                                    <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">NIK LSP<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <input type="text" name="nik_lsp" id="nik_lsp" class="form-control has-feedback-left">
                                    <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">Keterangan<small class="required">(Optional)</small></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <textarea name="keterangan_status" id="keterangan_status" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">Tanggal Diterima<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <?php date_default_timezone_set('Asia/Jakarta'); ?>
                                    <input type="text" name="tanggal_diterima" id="tanggal_diterima" value="<?php echo date('Y-m-d')  ?>" class="form-control has-feedback-left" readonly>
                                    <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
                            <button type="button" onclick="simpan()" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Konfirmasi & Upload Tanda Tangan</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                    <!-- Apabila Telah mengisi form bagian asesor -->
                    <?php echo form_open('administrator/konfirmasi_apl01/upload_ttd', array('id' => 'form_upload', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                    <div id="form_2">
                        <div class="col-md-12">
                            <input type="hidden" id="id" name="id">
                            <!-- <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3"> Verifikasi<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <select name="status_diterima" id="status_diterima" class="form-control has-feedback-left">
                                        <option value="">--Status Verifikasi--</option>
                                        <option value="1">Diterima</option>
                                        <option value="2">Ditolak</option>
                                    </select>
                                    <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                                </div>
                            </div> -->
                            <div class="field item form-group">
                                <label class="col-form-label col-md-4 col-sm-3">Tanda Tangan Admin<span class="required">*</span></label>
                                <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                    <input type="file" name="tanda_tangan_admin" id="tanda_tangan_admin">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
                            <button type="submit" onclick="confirm('Apakah anda sudah yakin ?')" class="btn btn-success btn-sm"><span class="fa fa-save"> </span> Upload Tanda Tangan</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal Keterangan -->
<div id="modal_keterangan" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Keterangan Status</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- FOrm bagian Asesor -->
                    <?php echo form_open('', array('id' => 'form_inputan_keterangan', 'method' => 'post')); ?>
                    <div id="form_1">
                        <div class="col-md-12">
                            <small>Anda dapat menambahkan catatan terkait dari verifikasi dokumen permohonan asesi*</small> <br><br>
                            <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                            <div class="field item form-group">
                                <!-- <label class="col-form-label col-md-4 col-sm-3">Keterangan <small class="optional">(Optional)</small></label> -->
                                <div class="col-md-12 xdisplay_inputx form-group row has-feedback">
                                    <textarea name="keterangan_status" id="keterangan_status" placeholder="Tambahkan catatan verifikasi" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class=" modal-footer">
                            <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
                            <button type="button" onclick="simpan_keterangan()" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Simpan</button>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
            </div>

        </div>
    </div>
</div>