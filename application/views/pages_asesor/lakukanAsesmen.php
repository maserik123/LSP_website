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
</style>
<script type='text/javascript'>
    //<![CDATA[
    $(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $("#top").stop().animate({
                    bottom: "50",
                    right: "10"
                }, {
                    duration: 1000,
                    queue: false
                })
            } else {
                $("#top").stop().animate({
                    bottom: "-50",
                    right: "10"
                }, {
                    duration: 1000,
                    queue: false
                })
            };
            if ($(this).scrollTop() > 100) {
                $("#bottom").stop().animate({
                    top: "-50",
                    right: "10"
                }, {
                    duration: 1000,
                    queue: false
                })
            } else {
                $("#bottom").stop().animate({
                    top: "50",
                    right: "10"
                }, {
                    duration: 1000,
                    queue: false
                })
            }
        });
        $("#top").removeAttr('href').on("click", function() {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            return false
        });
        $("#bottom").removeAttr('href').on("click", function() {
            $("html, body").animate({
                scrollTop: $('#footer').offset().top
            }, 970);
            return false
        })
    });
    //]]>
</script>
<div class="container-fluid">
    <!--Chart-box-->
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><button type="button" class="btn btn-danger btn-mini" onclick="history.back(-1)"><span class="icon-arrow-left"></span> Kembali</button></span>
                <h5>Asesmen Mandiri</h5>
            </div>
            <div class="widget-content nopadding">
                <div id="tampil">
                    <table class="table table-bordered " id="asesmenTabel">
                        <thead>
                            <tr>
                                <th style="font-size:11px;">#</th>
                                <th style="font-size:11px;">Daftar Pertanyaan</th>
                                <th style="font-size:11px;">Penilaian Kompeten</th>
                                <th style="font-size:11px;">Bukti Kompetensi</th>
                                <th style="font-size:11px;">V</th>
                                <th style="font-size:11px;">A</th>
                                <th style="font-size:11px;">T</th>
                                <th style="font-size:11px;">M</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0;
                            foreach ($getDataByIdPilihanSkema as $row) { ?>
                                <tr>
                                    <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                    <td style="font-size: 11px;"><?php echo $row->daftar_pertanyaan; ?></td>
                                    <td style="font-size: 11px;"><?php echo $row->penilaian_kompeten; ?></td>
                                    <td style="font-size: 11px;text-align: center;">
                                        <?php if (empty($row->bukti_kompeten)) {
                                            echo 'Tidak ada';
                                        } else { ?>
                                            <a href="<?php echo base_url() ?>/g_kompetensi/<?php echo $row->bukti_kompeten; ?>" target="_blank"><span class="btn btn-info btn-mini">File</span></a>
                                        <?php } ?>
                                    </td>
                                    <td style="font-size: 11px;"><?php if ($row->asesor_v != '') { ?>
                                            <!-- <button class="btn btn-mini btn-default" disabled><span class="icon-check"></span></button> -->
                                            <input type="checkbox" checked disabled>

                                        <?php } else { ?>
                                            <input type="checkbox" onclick="asesor_v(<?php echo $row->id; ?>)">
                                            <!-- <button class="btn btn-mini btn-primary" onclick="asesor_v(<?php echo $row->id; ?>)"><span class="icon-check-empty"></span></button> -->
                                        <?php } ?>
                                    </td>
                                    <td style="font-size: 11px;"><?php if ($row->asesor_a != '') { ?>
                                            <!-- <button class="btn btn-mini btn-default" disabled><span class="icon-check"></span></button> -->
                                            <input type="checkbox" checked disabled>

                                        <?php } else { ?>
                                            <input type="checkbox" onclick="asesor_a(<?php echo $row->id; ?>)">
                                            <!-- <button class="btn btn-mini btn-danger" onclick="asesor_a(<?php echo $row->id; ?>)"><span class="icon-check-empty"></span></button> -->
                                        <?php } ?>
                                    </td>
                                    <td style="font-size: 11px;"><?php if ($row->asesor_t != '') { ?>
                                            <!-- <button class="btn btn-mini btn-default" disabled><span class="icon-check"></span></button> -->
                                            <input type="checkbox" checked disabled>
                                        <?php } else { ?>
                                            <!-- <button class="btn btn-mini btn-info" onclick="asesor_t(<?php echo $row->id; ?>)"><span class="icon-check-empty"></span></button> -->
                                            <input type="checkbox" onclick="asesor_t(<?php echo $row->id; ?>)">
                                        <?php } ?>
                                    </td>
                                    <td style="font-size: 11px;"><?php if ($row->asesor_m != '') { ?>
                                            <!-- <button class="btn btn-mini btn-default" disabled><span class="icon-check"></span></button> -->
                                            <input type="checkbox" checked disabled>
                                        <?php } else { ?>
                                            <!-- <button class="btn btn-mini btn-warning" onclick="asesor_m(<?php echo $row->id; ?>)"><span class="icon-check-empty"></span></button> -->
                                            <input type="checkbox" onclick="asesor_m(<?php echo $row->id; ?>)">
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span6">
                <span style="color:black;font-size:11px;">
                    Rekomendasi Asesor :
                    <ol>
                        <li>
                            Peserta TELAH / BELUM menyatakan dirinya kompeten untuk seluruh Pertanyaan Assesmen Mandiri. Bila BELUM, lanjut ke no 4
                        </li>
                        <li>
                            Penilaian atas bukti-bukti kompetensi yang diajukan peserta yang menyatakan dirinya kompeten teridentifikasi TELAH/BELUM memenuhi Aturan bukti
                        </li>
                        <li>
                            Proses Asesmen dapat dilanjutkan melalui :
                            <ul>
                                <li>
                                    Asesmen Portofolio
                                </li>
                                <li>
                                    Uji Kompetensi
                                </li>
                            </ul>
                        </li>
                        <li>
                            Agar peserta dipanggil kembali oleh Sekretariat LSP untuk diminta penjelasan
                        </li>
                    </ol>
                </span><br>
            </div>
            <div class="span6">
                <small>Berdasarkan Data Asesmen yang telah diberikan oleh asesi. Asesi telah menyetujui bahwa seluruh data yang diberikan telah sesuai dengan ketentuan yang berlaku.</small>
            </div>
            <br>
            <hr>
            <div class="span6">
                <small class="span6" style="font-weight: bold;">Nama Asesi </small> <small class="span6">: <?php echo $getDataByIdPilSkema->nama_asesi; ?></small>
            </div>

            <div class="span6">
                <small class="span6" style="font-weight: bold;">Tanggal konfirmasi oleh asesi</small> <small class="span6">: <?php echo tgl_indo($getDataByIdPilSkema->tanggal_tanda_tangan_asesi); ?></small>
            </div>
        </div>
        <hr>
        <div class="row-fluid">
            <div class="span6">
                <span style="color:black;">Catatan :</span><br>
                <span style="color:black;">ASESMEN PORTOFOLIO :</span><br>
                <span style="color:black;">Pada unit kompetensi :

                </span><br>
                <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5><button class="btn btn-primary btn-mini" data-toggle="modal" data-target="#asesmenPortofolio">
                                    <p class="icon-pencil"></p> Edit Catatan
                                </button></h5>
                        </div>
                        <div class="widget-content">

                            <div>
                                <small style="color: black;"><?php echo $getDataByIdPilSkema->catatan_asesmen_portofolio; ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <span style="color:black;">Catatan :</span><br>
                <span style="color:black;">UJI KOMPETENSI :</span><br>
                <span style="color:black;">Pada unit kompetensi :
                </span>
                <div class="row-fluid">
                    <div class="widget-box">
                        <div class="widget-title">
                            <h5><button class="btn btn-primary btn-mini" data-toggle="modal" data-target="#asesmenKompetensi">
                                    <p class="icon-pencil"></p> Edit Catatan
                                </button></h5>
                        </div>
                        <div class="widget-content">
                            <div>
                                <small style="color: black;"><?php echo $getDataByIdPilSkema->catatan_uji_kompetensi; ?></small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <br>
            <hr>

        </div>
        <br>
        <div class="row-fluid">
            <div class="span6 " style="background-color:brown;color:white">
                <?php echo form_open('', array('id' => 'form_terima_konfirmasi', 'method' => 'post')); ?>
                <div style="padding-left: 15px;padding-top: 15px;padding-right: 15px;padding-bottom:15px;text-align: center;">
                    <small style="font-weight: bold;">Berdasarkan asesmen yang telah dilakukan kepada asesi yang bersangkutan. Maka, dinyatakan bahwa asesi siap untuk mengikuti Ujian LSP sesuai dengan syarat dan ketentuan yang berlaku.</small>
                    <br><br><br>
                    <div style="text-align: left;">
                        <input type="hidden" value="<?php echo $getDataByIdPilSkema->id_pilihan_skema; ?>" id="id" name="id">

                        <span style="font-size: 11px;">Nama Asesor</span> <span style="font-size: 11px;">: <strong><?php echo $checkUserOnAsesor->nama_asesor; ?></strong></span><br>
                        <input type="hidden" name="no_reg" value="<?php echo $checkUserOnAsesor->no_reg; ?>" id="no_reg">
                        <input type="hidden" name="tanda_tangan_asesor" value="<?php echo $checkUserOnAsesor->tanda_tangan; ?>" id="tanda_tangan_asesor">

                        <span style="font-size: 11px;">Tanggal Konfirmasi</span> <span style="font-size: 11px;">: <strong><?php echo tgl_indo(date('Y-m-d')); ?></strong></span><br>
                        <input type="hidden" name="tanggal_tanda_tangan_asesor" id="tanggal_tanda_tangan_asesor" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                    <div style="text-align:right;">
                        <span>
                            <?php if (empty($getDataByIdPilSkema->tanda_tangan_asesor)) { ?>
                                <button type="button" class="btn btn-success btn-mini" style="font-size: 13px;" onclick="terimaKonfirmasi()">
                                    <li class="icon-check"></li> Terima Konfirmasi
                                </button>
                            <?php } else { ?>
                                <small>Terimakasih, anda berhasil mengkonfirmasi !</small>
                            <?php } ?>
                        </span>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
            <div class="span6" style="text-align: center;">

            </div>
        </div>
    </div>
    <a href='#top' id='top'>
        <img src='https://lh4.googleusercontent.com/-ATXblBp4CMo/Uh1cEqIohbI/AAAAAAAACvE/8nPNipj7fk4/h120/dhfscrolltop.png' title='Atas!' />
    </a>
    <a href='#footer' id='bottom' class="btn btn-primary btn-mini">
        <!-- <img src='http://2.bp.blogspot.com/-CxnRWxTZJ8Q/Uh1bBWB3QyI/AAAAAAAACus/TnrK8sS7afY/s1600/dhfscroll.png' title='Scroll ke paling Bawah!' /> -->
        <span class="icon-circle-arrow-down"></span> Konfirmasi Asesmen Mandiri
    </a>
    <!--End-Chart-box-->
    <hr />

</div>


<!-- Modal -->
<div id="asesmenPortofolio" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Catatan Asesmen Portofolio</h4>
            </div>
            <?php echo form_open('', array('id' => 'form_portofolio', 'method' => 'post', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-content nopadding">
                            <input type="hidden" value="<?php echo $getDataByIdPilSkema->id_pilihan_skema; ?>" id="id" name="id">
                            <div class="control-group">
                                <textarea name="catatan_asesmen_portofolio" id="catatan_asesmen_portofolio" class="span12" rows="5" placeholder="Tambahkan catatan.."><?php echo $getDataByIdPilSkema->catatan_asesmen_portofolio; ?></textarea>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon-close"></span> Close</button>
                <button type="button" class="btn btn-primary" onclick="simpan()"><span class="icon-save"></span> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>

<!-- Modal catatan uji kompetensi-->
<div id="asesmenKompetensi" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Catatan Asesmen Portofolio</h4>
            </div>
            <?php echo form_open('', array('id' => 'form_kompetensi', 'method' => 'post', 'class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <div class="row-fluid">
                    <div class="span12">
                        <div class="widget-content nopadding">
                            <input type="hidden" value="<?php echo $getDataByIdPilSkema->id_pilihan_skema; ?>" id="id" name="id">
                            <div class="control-group">
                                <textarea name="catatan_uji_kompetensi" id="catatan_uji_kompetensi" class="span12" rows="5" placeholder="Tambahkan catatan.."><?php echo $getDataByIdPilSkema->catatan_uji_kompetensi; ?></textarea>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="icon-close"></span> Close</button>
                <button type="button" class="btn btn-primary" onclick="simpan1()"><span class="icon-save"></span> Simpan</button>
            </div>
            <?php echo form_close(); ?>
        </div>

    </div>
</div>