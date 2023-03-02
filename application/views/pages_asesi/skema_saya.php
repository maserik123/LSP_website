<script>
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
                    url: "<?php echo site_url('asesi/skema_saya/delete'); ?>/" + id,
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
                        alert('Error Deleting Data');
                    }
                });
            });
    }

    function tempat_sampah() {
        window.location = '<?php echo base_url('asesi/tempat_sampah') ?>';
    }

    function addAPL02(id) {
        $.ajax({
            url: "<?php echo site_url('asesi/apl_01/getByIdOnAPL02/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                console.log(data.id_ps)
                $('[name="id"]').val(data.id_ps);
                $('[name="judul_skema"]').html(data.judul_skema);
                $('[name="id_asesi"]').val(data.id_dd);
                $('[name="id_asesor"]').val(data.id_a);
                $('[name="nama_asesor"]').val(data.nama_asesor);
                $('[name="nama_asesi"]').val(data.dd_nama_lengkap);
                $('[name="id_ps"]').val(data.id_ps);
                $('[name="judul_skema"]').val(data.judul_skema);
                $('[name="id_skema"]').val(data.id_skema);
                $('#form_apl_02').show();
                $('#tabel').hide();
                $('.tuk1').show();
                $('.tuk2').hide();
                $('.tombol_aksi').show();
                $('.btn_pertanyaan').hide();
                $('.apl02_kosong').show();
                $.ajax({
                    url: "<?php echo site_url('asesi/apl_02_finish/getTukByIdPilSkema/'); ?>/" + data.id_ps,
                    type: "GET",
                    dataType: "JSON",
                    success: function(resp) {
                        preg = resp.preg
                        console.log(preg.tuk);
                        $('[name="tuk"]').val(preg.tuk);
                        $('.tuk1').hide();
                        $('.tuk2').show();
                        $('.tombol_aksi').hide();
                        $('.btn_pertanyaan').show();
                        $('.apl02_kosong').hide();

                    }
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error Get Data From Ajax');
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#form_apl_02').hide();
    });

    function show_form() {
        $('#form_apl_02').show();
        $('#tabel').hide();
    }

    function hide_form() {
        $('#form_apl_02').hide();
        $('#tabel').show();
    }
</script>

<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        margin-top: 5px;
        /* width: 300px; */
        /* height: 50px; */
        overflow-x: scroll;
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
<section class="page container" id="page">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Daftar Skema Saya <br>
                    <small>Skema Sertifikasi yang telah diikuti.</small>
                </legend>
                <div style="text-align: right;"><?php echo get_btn_delete('tempat_sampah()', 'Tempat Sampah'); ?></div> <br>
            </div>
        </div>
    </div>

    <?php if (empty($getPilihanSkema)) { ?>
        <tr>
            <td colspan="7" style="font-size: 11px;text-align: center;">Belum ada data yang ditampilkan</td>
        </tr>
    <?php } else { ?>
        <div class="row" id="tabel">
            <div id="acct-password-row" class="span16">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5>
                            Riwayat Pengajuan Skema Saya
                        </h5>

                    </div>
                    <div class="box-content box-table scroll">
                        <table id="sample-table" class="table table-hover table-bordered tablesorter ">
                            <thead>
                                <tr>
                                    <th style="font-size: 11px;">No</th>
                                    <th style="font-size: 11px;">Judul Skema</th>
                                    <th style="font-size: 11px;">Tujuan Asesmen</th>
                                    <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                    <th style="font-size: 11px;">Status Verifikasi</th>
                                    <th style="font-size: 11px;">Status Sertifikasi</th>
                                    <!-- <th style="font-size: 11px;">Permohonan</th> -->
                                    <!-- <th style="font-size: 11px;">Tools</th> -->
                                </tr>
                            </thead>
                            <tbody>

                                <?php $no = 0;
                                foreach ($getPilihanSkema as $row) { ?>
                                    <tr>
                                        <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                        <td style="font-size: 11px;"><?php echo $row->judul_skema; ?></td>
                                        <td style="font-size: 11px;"><?php echo $row->tujuan_sertifikasi; ?></td>
                                        <td style="font-size: 11px;"><?php echo tgl_indo($row->tanggal_pengajuan); ?></td>
                                        <td style="font-size: 11px;">
                                            <?php if ($row->status_diterima == 0) { ?>
                                                <label for="" class="badge" style="background-color: orange;text-align: center;">Menunggu Konfirmasi...</label>
                                            <?php } else if ($row->status_diterima == 1) { ?>
                                                <label for="" class="badge" style="background-color: green;text-align:center;">Diterima</label>
                                            <?php } else { ?>
                                                <label for="" class="badge" style="background-color: red;text-align:center;">Ditolak</label>
                                            <?php } ?>
                                        </td>
                                        <td style="font-size: 11px;">
                                            <?php if ($row->status_selesai == 'on_progres') { ?>
                                                <label for="" class="badge" style="background-color: orangered;text-align: center;">Sedang Berlangsung..</label>
                                            <?php } else { ?>
                                                <label for="" class="badge" style="background-color: blue;text-align:center;">Telah Selesai</label>
                                            <?php } ?>
                                        </td>
                                        <!-- <td>
                                            <?php if ($row->status_diterima != 1) { ?>
                                                <button class="btn btn-info badge" style="font-size: 10px;" onclick="addAPL02(<?php echo $row->id_ps; ?>)" disabled><i class="icon-list-alt"></i> APL-01</button>
                                            <?php } else { ?>
                                                <button class="btn btn-info badge" style="font-size: 10px;" onclick="addAPL02(<?php echo $row->id_ps; ?>)"><i class="icon-list-alt"></i> APL-01</button>
                                            <?php } ?>

                                            <?php if ($row->status_diterima != 1) { ?>
                                                <button class="btn btn-primary badge" style="font-size: 10px;" onclick="addAPL02(<?php echo $row->id_ps; ?>)" disabled><i class="icon-list-alt"></i> APL-02</button>
                                            <?php } else { ?>
                                                <button class="btn btn-primary badge" style="font-size: 10px;" onclick="addAPL02(<?php echo $row->id_ps; ?>)"><i class="icon-list-alt"></i> APL-02</button>
                                            <?php } ?>
                                        </td> -->
                                        <!-- <td><button class="btn btn-danger label" style="background-color:red" onclick="hapus(<?php echo $row->id_ps; ?>)"><span class="icon-trash"></span> Hapus</button></td> -->
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form APL 02 -->
        <div class="row" id="form_apl_02">
            <div style="text-align: right;">
                <button class="btn btn-danger" onclick="hide_form()"> <i class="icon-arrow-left"></i> Batal</button>
            </div>
            <br>
            <div id="acct-password-row" class="span7">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5 style="font-size: 13px;">
                            Kelengkapan Dokumen APL-02
                        </h5>
                    </div>
                    <div class="box-content box-table">
                        <div class="row">
                            <div id="acct-password-row" class="span7">
                                <br>
                                <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                                <fieldset>
                                    <input type="hidden" name="id" id="id">
                                    <div class="control-group form-group">
                                        <div class="controls form-group">
                                            <input class="span" id="id_asesi" name="id_asesi" type="hidden">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <div class="controls form-group">
                                            <input class="span3" id="id_asesor" name="id_asesor" type="hidden">
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">TUK<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <select name="tuk" id="tuk" class="span4 tuk1">
                                                <option value="">--Pilih TUK--</option>
                                                <option value="Sewaktu">Sewaktu </option>
                                                <option value="Tempat Kerja">Tempat Kerja </option>
                                                <option value="Mandiri">Mandiri </option>
                                            </select>
                                            <input type="text" name="tuk" id="tuk" class="tuk2 span4" disabled>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Nama Asesor<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input class="span4" id="nama_asesor" name="nama_asesor" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Nama Peserta<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input class="span4" id="nama_asesi" name="nama_asesi" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Tanggal<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input class="span4" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d') ?>" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <!-- <label class="control-label span2">Tanggal<span class="required">*</span></label> -->
                                        <div class="controls form-group">
                                            <input class="span4" id="id_ps" name="id_ps" type="hidden" readonly>
                                        </div>
                                    </div>
                                    <div class="control-group form-group">
                                        <label class="control-label span2">Skema Pilihan<span class="required">*</span></label>
                                        <div class="controls form-group">
                                            <input class="span4" id="judul_skema" name="judul_skema" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="control-group form-group tombol_aksi" style="text-align: right;">
                                        <div class="controls form-group span6">
                                            <button class="btn btn-danger">
                                                <li class="fa fa-save"></li> Batal
                                            </button>
                                            <button type="button" class="btn btn-primary" onclick="simpan()">
                                                <li class="fa fa-save"></li> Simpan
                                            </button>
                                        </div>
                                    </div>
                                </fieldset>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="acct-password-row" class="span9">
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5>
                            FORM APL-02 (<span name="judul_skema"></span>)
                        </h5>
                    </div>
                    <div class="box-content box-table">
                        <div class="row">
                            <div id="acct-password-row" class="span5">
                                <br>
                                <fieldset class="btn_pertanyaan">
                                    <h5 class="span9" style="text-align: center;">Silahkan klik lanjutkan untuk mengisi APL-02</h5>
                                    <div class="controls form-group span9">
                                        <div class="control-group form-group" style="text-align: center;">
                                            <?php echo form_open('asesmenMandiri', array('id' => 'form_apl02', 'method' => 'post')); ?>
                                            <input type="hidden" name="id" id="id" readonly>
                                            <button type="submit" class="btn btn-primary">
                                                <li class="fa fa-list-alt"></li> Daftar Pertanyaan Kompetensi APL-02
                                            </button>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="apl02_kosong">
                                    <h6 class="span7" style="color:red">Anda belum melengkapi data APL-02, Silahkan lengkapi data APL-02 sebelah kiri terlebih dahulu.</h6>
                                </fieldset>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</section>