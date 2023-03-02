<script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var save_method;

    function updateAllTable() {
        table.ajax.reload();
        $('#tabel_permintaan').reload();
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
        // $('#form_inputan')[0].reset();
        $('#modalPermintaan').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesor/permintaanAPL02/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data

                $('[name="id"]').val(data.id);
                $('[name="tanggal_pelaksanaan"]').val(data.tanggal_pelaksanaan);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });

    }

    function detail(id) {
        save_method = 'update';
        // $('#form_inputan')[0].reset();
        $('#modalDetail').modal('show');
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $.ajax({
            url: "<?php echo site_url('asesor/permintaanAPL02/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data

                $('[name="id"]').val(data.id);
                $('[name="tanggal_pelaksanaan"]').val(data.tanggal_pelaksanaan);
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
                    url: "<?php echo site_url('administrator/skema/delete'); ?>/" + id,
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
                fotoProfil.src = 'g_foto_asesi/' + data.dd_foto + '';
                x = document.getElementById("dd_foto");
                x.appendChild(fotoProfil);

                var tandaTangan = new Image(80, 60);
                tandaTangan.src = 'g_ttd_asesi/' + data.dd_tanda_tangan_asesi + '';
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

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/permintaanAPL02/update';
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
        <div class="widget-box ">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Asesmen Mandiri</h5>
            </div>
            <div class="widget-content nopadding ">
                <table class="table table-stripted table-bordered data-table">
                    <thead>
                        <tr>
                            <th style="font-size:11px;">#</th>
                            <th style="font-size:11px;">Nama Asesi</th>
                            <th style="font-size:11px;">Skema</th>
                            <th style="font-size:11px;">Tujuan Sertifikasi</th>
                            <!-- <th style="font-size:11px;">Tgl Pengajuan</th> -->
                            <!-- <th style="font-size:11px;">Tgl Pelaksanaan</th> -->
                            <!-- <th style="font-size:11px;">Status Permohonan</th> -->
                            <th style="font-size:11px;">Status</th>
                            <th style="font-size:11px;">Asesmen Mandiri</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($getAllDataForAsesor as $row) { ?>
                            <?php $id_encrypt = encrypt($row->id); ?>
                            <tr>
                                <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                <td style="font-size: 11px;"><?php echo $row->dd_nama_lengkap; ?></td>
                                <td style="font-size: 11px;"><?php echo $row->judul_skema; ?> </td>
                                <td style="font-size: 11px;"><?php echo $row->tujuan_sertifikasi; ?></td>
                                <!-- <td style="font-size: 11px;"><?php echo tgl_indo($row->tanggal_pengajuan); ?></td> -->
                                <!-- <td style="font-size: 11px;"><?php echo $row->tanggal_pelaksanaan == 0 ? '<span style="font-size:11px;color:red;">Tanggal Belum diset</span>' : tgl_indo($row->tanggal_pelaksanaan); ?></td> -->
                                <!-- <td style="font-size: 11px;"><?php echo $row->status_diterima == 1 ? '<span style="font-size:11px;color:blue;">Permohonan Diterima</span>' : 'Belum diterima'; ?></td> -->
                                <?php $getDataByIdPilSkema = $this->M_apl_02_finish->getDataByIdPilSkema($row->id); ?>
                                <?php $cekAsesmen          = $this->M_apl_02_finish->getDataByIdPilSkema($row->id);
                                $cekByIdPilihanSkema = $this->M_apl_02->cekByIdPilihanSkema($row->id);
                                ?>
                                <td style="font-size: 10px;text-align:center;"><?php echo empty($cekByIdPilihanSkema[0]->id_pilihan_skema) ? '<div class="btn btn-danger btn-mini" style="font-size:10px">Belum asesmen mandiri</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (!empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-primary btn-mini" style="font-size:10px">Sudah diases asesor</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-warning btn-mini" style="font-size:10px">Belum diases oleh asesor</div>' : '')); ?> </td>
                                <td style="font-size: 11px;text-align:center;">
                                    <?php if (empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) { ?>
                                        <a class="btn btn-success btn-mini" href="#" title="Asesi belum melakukan asesmen mandiri, anda belum dapat mengases !" disabled><span class="icon-list-alt"></span> Lakukan Asesmen</a> <a class="btn btn-danger btn-mini" href="<?php echo base_url('asesor/detailAsesi/') . $id_encrypt ?>"><span class="icon-search"></span> Detail</a> <a class="btn btn-info btn-mini" disabled><span class="icon-print"></span> Cetak</a>
                                    <?php } else { ?>
                                        <a class="btn btn-success btn-mini" title="Lakukan asesmen" href="<?php echo base_url('asesor/lakukanAsesmen/') . $id_encrypt; ?>"><span class="icon-list-alt"></span> Lakukan Asesmen</a> <a class="btn btn-danger btn-mini" href="<?php echo base_url('asesor/detailAsesi/') . $id_encrypt ?>"><span class="icon-search"></span> Detail</a> <a class="btn btn-info btn-mini" target="_blank" href="<?php echo base_url('asesor/cetakAsesmenMandiri/') . $row->id ?>"><span class="icon-print"></span> Cetak</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!--End-Chart-box-->
    <hr />

</div>

<!-- Modal -->
<div id="cekPermohonan" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <li class="fa fa-book"></li> Dokumen Permohonan Asesi
                </h5>
                <button type="button" class="close" data-dismiss="modal" onclick="window.location.reload()">&times;</button>
            </div>
            <div class="modal-body scroll">
                <div class="row">
                    <div class="col-md-4">
                        <h6>
                            <li class="fa fa-user"></li> Data Diri
                        </h6>
                        <hr>
                    </div>
                    <div class="col-md-8">
                        <h6>
                            <li class="fa fa-briefcase"></li> Data Pekerjaan
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
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanda Tangan</label>
                            <div id="dd_tanda_tangan_asesi" style="border-width:2px;border-style: solid;border-color: black;"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="field item form-group">
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Pas Foto</label>
                            <div style="text-align: right;">
                                <div id="dd_foto" style="border-width:2px;border-style: solid;border-color: black;"></div>
                            </div>
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
                            <label class=" col-md-4 col-sm-3" style="font-size: 11px;font-weight: bold;">Tanggal Diterima<span class="required">*</span></label>
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
                    </div>
                </div>
            </div>
            <?php echo form_open('', array('id' => 'form_input', 'method' => 'post')); ?>
            <input type="hidden" id="id_ps" name="id_ps">
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal" onclick="window.location.reload()">Close</button>
                <button type="button" class="btn btn-warning btn-sm" onclick="tolak()">Tolak</button>
                <button type="button" class="btn btn-primary btn-sm" onclick="terima()">Terima</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="modalDetail" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
                <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="modalPermintaan" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
            </div>
            <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-content nopadding">
                            <input type="hidden" id="id" name="id">
                            <div class="control-group">
                                <label class="control-label">Tanggal Pelaksanaan</label>
                                <div class="controls">
                                    <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" class="span11" placeholder="Tanggal Pelaksanaan" />
                                </div>
                            </div>
                            <br>
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