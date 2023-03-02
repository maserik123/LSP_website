<script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    var save_method;

    function asesor_v(id) {
        // swal({
        //         title: "Apakah Anda Sudah yakin ?",
        //         type: "warning",
        //         showCancelButton: true,
        //         showLoaderOnConfirm: false,
        //         confirmButtonText: "Ya",
        //         closeOnConfirm: false
        //     },
        //     function() {
        $.ajax({
            url: "<?php echo site_url('asesor/penilaian_v_a_t_m/asesor_v'); ?>/" + id,
            type: "POST",
            dataType: "JSON",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(resp) {
                setInterval(() => {
                    window.location.reload();
                }, 8000);
                data = resp.result;
                // return swal({
                //     html: true,
                //     timer: 300,
                //     showConfirmButton: false,
                //     title: data['msg'],
                //     type: data['status']
                // });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Deleting Data');
            }
        });
        // });
    }

    function asesor_a(id) {
        // swal({
        //         title: "Apakah Anda Sudah yakin ?",
        //         type: "warning",
        //         showCancelButton: false,
        //         showLoaderOnConfirm: false,
        //         confirmButtonText: "Ya",
        //         closeOnConfirm: true
        //     },
        //     function() {
        $.ajax({
            url: "<?php echo site_url('asesor/penilaian_v_a_t_m/asesor_a'); ?>/" + id,
            type: "POST",
            dataType: "JSON",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(resp) {
                setInterval(() => {
                    window.location.reload();
                }, 8000);
                data = resp.result;
                // return swal({
                //     html: true,
                //     timer: 300,
                //     showConfirmButton: false,
                //     title: data['msg'],
                //     type: data['status']
                // });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Deleting Data');
            }
        });
        // });
    }

    function asesor_t(id) {
        // swal({
        //         title: "Apakah Anda Sudah yakin ?",
        //         type: "warning",
        //         showCancelButton: true,
        //         showLoaderOnConfirm: true,
        //         confirmButtonText: "Ya",
        //         closeOnConfirm: false
        //     },
        //     function() {
        $.ajax({
            url: "<?php echo site_url('asesor/penilaian_v_a_t_m/asesor_t'); ?>/" + id,
            type: "POST",
            dataType: "JSON",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(resp) {
                setInterval(() => {
                    window.location.reload();
                }, 8000);
                data = resp.result;
                // return swal({
                //     html: true,
                //     timer: 900,
                //     showConfirmButton: false,
                //     title: data['msg'],
                //     type: data['status']
                // });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Deleting Data');
            }
        });
        // });
    }

    function asesor_m(id) {
        // swal({
        //         title: "Apakah Anda Sudah yakin ?",
        //         type: "warning",
        //         showCancelButton: false,
        //         showLoaderOnConfirm: false,
        //         confirmButtonText: "Ya",
        //         closeOnConfirm: false
        //     },
        // function() {
        $.ajax({
            url: "<?php echo site_url('asesor/penilaian_v_a_t_m/asesor_m'); ?>/" + id,
            type: "POST",
            dataType: "JSON",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(resp) {
                setInterval(() => {
                    window.location.reload();
                }, 8000);
                data = resp.result;
                // return swal({
                //     html: true,
                //     timer: 300,
                //     showConfirmButton: false,
                //     title: data['msg'],
                //     type: data['status']
                // });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Deleting Data');
            }
        });
        // });
    }

    function simpan() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/apl_02_finish/add_catatan_asesmen_portofolio';
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
                    data: $('#form_portofolio').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_portofolio input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_portofolio")[0].reset();

                            $('#asesmenPortofolio').modal('hide');
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

    function simpan1() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/apl_02_finish/add_catatan_uji_kompetensi';
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
                    data: $('#form_kompetensi').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_kompetensi input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
                            $("#form_kompetensi")[0].reset();

                            $('#asesmenKompetensi').modal('hide');
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

    function terimaKonfirmasi() {
        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesor/apl_02_finish/terimaKonfirmasi';
        swal({
                title: "Anda ingin mengkonfirmasi ?",
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
                    data: $('#form_terima_konfirmasi').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_terima_konfirmasi input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            setInterval(() => {
                                window.location.reload();
                            }, 1500);
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
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
<style type='text/css'>
    #top {
        display: block;
        cursor: pointer;
        position: fixed !important;
        position: absolute;
        bottom: -50px;
        right: 10px;
        z-index: 999;
    }

    #bottom {
        display: block;
        cursor: pointer;
        position: fixed !important;
        position: absolute;
        top: 50px;
        right: 10px;
        z-index: 999;
    }

    #top:focus,
    #bottom:focus {
        outline: none;
    }

    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        /* width: 300px; */
        /* height: 700px; */
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

<div class="container-fluid">
    <!--Chart-box-->

    <div class="row-fluid">
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><button type="button" class="btn btn-danger btn-mini" onclick="history.back(-1)"><span class="icon-arrow-left"></span> Kembali</button></span>
                    <h5>Detail Data Diri</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span style="font-weight: bold;">Nama Lengkap</span></td>
                                <td class="auto_lebar"><?php echo $cekDataAsesi->dd_nama_lengkap; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">NIK</span></td>
                                <td class="auto_lebar"><?php echo $cekDataAsesi->dd_nik; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Tempat Lahir</span></td>
                                <td class="auto_lebar"><?php echo $cekDataAsesi->dd_tempat_lahir; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Tanggal Lahir</span></td>
                                <td><?php echo $cekDataAsesi->dd_tgl_lahir; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Jenis Kelamin</span></td>
                                <td><?php echo $cekDataAsesi->dd_jenis_kelamin; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Kebangsaan</span></td>
                                <td><?php echo $cekDataAsesi->dd_kebangsaan; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Alamat Rumah</span></td>
                                <td><?php echo $cekDataAsesi->dd_alamat_rumah; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Nomor HP</span></td>
                                <td><?php echo $cekDataAsesi->dd_no_hp; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Nomor Telepon</span></td>
                                <td><?php echo $cekDataAsesi->dd_no_telp; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Email</span></td>
                                <td><?php echo $cekDataAsesi->dd_email; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Kode Pos</span></td>
                                <td><?php echo $cekDataAsesi->dd_kode_pos; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Nomor Kantor</span></td>
                                <td><?php echo $cekDataAsesi->dd_kantor; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Pendidikan Terakhir</span></td>
                                <td><?php echo $cekDataAsesi->dd_pendidikan_terakhir; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="span6">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><span class="icon-picture"></span></span>
                    <h5>Detail Data Pekerjaan</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span style="font-weight: bold;">Pas Foto Asesi <small>(Max. File 2 MB.)</small></span></td>
                                <td><img src="<?php echo base_url('g_foto_asesi/') . $cekDataAsesi->dd_foto; ?>" width="100px" height="100px"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><span class="icon-suitcase"></span> </span>
                    <h5>Detail Data Pekerjaan</h5>
                </div>
                <div class="widget-content nopadding">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><span style="font-weight: bold;">Nama Perusahaan/Lembaga</span></td>
                                <td><?php echo $cekDataAsesi->k_lembaga; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Jabatan</span></td>
                                <td><?php echo $cekDataAsesi->k_jabatan; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Alamat</span></td>
                                <td><?php echo $cekDataAsesi->k_alamat; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Kode Pos</span></td>
                                <td><?php echo $cekDataAsesi->k_kode_pos; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">No Fax</span></td>
                                <td><?php echo $cekDataAsesi->k_fax; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">No Telp</span></td>
                                <td><?php echo $cekDataAsesi->k_telp; ?></td>
                            </tr>
                            <tr>
                                <td><span style="font-weight: bold;">Email</span></td>
                                <td><?php echo $cekDataAsesi->k_email; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid">
        <div class="span12">
            <div class="widget-box">
                <div class="widget-title"> <span class="icon"><span class="icon-picture"></span></span>
                    <h5>Data Sertifikasi</h5>
                </div>
                <div class="widget-content nopadding">
                    <div class="span6" style="background-color:#F8F8FF ;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span style="font-weight: bold;">Pilihan Skema </span></td>
                                    <td class="auto_lebar"><?php echo $cekDataAsesi->judul_skema; ?></td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Tujuan Sertifikasi </span></td>
                                    <td class="auto_lebar"><?php echo $cekDataAsesi->tujuan_sertifikasi; ?></td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Dokumen KTM </span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_ktm/') . $cekDataAsesi->upload_ktm; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Dokumen Transkrip </span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_transkrip_nilai/') . $cekDataAsesi->upload_transkrip; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Dokumen KTP/SIM </span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_ktp_sim/') . $cekDataAsesi->upload_ktp_sim; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Sertifikat Pelatihan </span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_sertifikat_pelatihan/') . $cekDataAsesi->sertifikat_pelatihan; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Pengalaman Kerja </span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_pengalaman_kerja/') . $cekDataAsesi->upload_pengalaman_kerja; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="span6" style="background-color:#F8F8FF ;">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><span style="font-weight: bold;">Bukti Kompetensi Yang Relevan 1</span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_kompetensi/') . $cekDataAsesi->upload_bukti_relevan_1; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Bukti Kompetensi Yang Relevan 2</span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_kompetensi/') . $cekDataAsesi->upload_bukti_relevan_2; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Bukti Kompetensi Yang Relevan 3</span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_kompetensi/') . $cekDataAsesi->upload_bukti_relevan_3; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Bukti Kompetensi Yang Relevan 4</span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_kompetensi/') . $cekDataAsesi->upload_bukti_relevan_4; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="font-weight: bold;">Bukti Kompetensi Yang Relevan 5</span></td>
                                    <td class="auto_lebar">
                                        <a href="<?php echo base_url('g_kompetensi/') . $cekDataAsesi->upload_bukti_relevan_5; ?>" target="_blank">
                                            <li class="icon-search"></li> Lihat
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>