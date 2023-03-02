<!-- Style scroll -->
<style>
    .scroll {
        height: 350px;
        /* background: orange; */
        /* padding: 10px; */
        overflow: scroll;

        /*script tambahan khusus untuk IE */
        /* scrollbar-face-color: #CE7E00;
        scrollbar-shadow-color: #FFFFFF;
        scrollbar-highlight-color: #6F4709;
        scrollbar-3dlight-color: #11111;
        scrollbar-darkshadow-color: #6F4709;
        scrollbar-track-color: #FFE8C1;
        scrollbar-arrow-color: #6F4709; */
    }
</style>

<script>
    function simpan() {

        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesi/apl_02/addData';
        swal({
                title: "Apakah anda sudah yakin ?",
                text: "Dengan memilih Ya, Kami menganggap seluruh jawaban yang anda berikan pada Asessment Mandiri telah sesuai dan seluruh jawaban yang telah dikirimkan tidak akan dapat diubah atau dimodifikasi.",
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
                            }, 1000);
                            // updateAllTable();

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
                            timer: 1300,
                            showConfirmButton: false,
                            title: data['msg'],
                            type: data['status']
                        });
                    }

                });
            });
    }

    function uploadTTD() {

        var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
        var csrf_hash = ''
        var url;
        url = '<?php echo base_url() ?>asesi/apl_02_finish/uploadTTD';
        swal({

                title: "Anda ingin menandatangani ?",
                text: "Apabila anda memilih Ya, kami menganggap bahwa anda telah setuju dengan seluruh ketentuan yang berlaku, dokumen yang sudah terkirim tidak dapat diubah kembali.",
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
                            }, 1000);
                            // updateAllTable();
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
<script>
    $(document).ready(function() {
        $('#section_1').show();
        $('#section_2').hide();
    });

    function show_section_2() {
        $('#section_1').hide();
        $('#section_2').show();
    }

    function show_section_1() {
        $('#section_1').show();
        $('#section_2').hide();
    }
</script>

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

<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        /* width: 300px; */
        /* height: 50px; */
        overflow: auto;
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
<!-- Form APL 02 -->
<section class="page container" id="section_1">
    <div class="row" id="form_apl_02">
        <div style="text-align: right;">
            <button class="btn btn-danger" onclick="window.location='<?php echo base_url('apl_02') ?>'"> <i class="icon-arrow-left"></i> Batal</button>
        </div>
        <br>
        <div id="acct-password-row" class="span16">
            <div class="box pattern pattern-sandstone ">
                <div class="box-header ">
                    <i class="icon-certificate" style="color: green;"></i>
                    <h5 style="font-size: 12px;">
                        APL-02 (<?php echo $getPilihanSkemaById->judul_skema; ?>) (<?php echo $getPilihanSkemaById->no_skema; ?>)
                    </h5>
                </div>
                <?php if (!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) { ?>
                    <div class="box-content box-table">
                        <div class="row">
                            <div id="acct-password-row" class="span16">
                                <br>
                                <div class="row span10">
                                    <strong>Rekomendasi Asesor : </strong>
                                    <p style="font-weight: bold;">
                                    <ol style="font-weight: bold;">
                                        <li>
                                            Peserta TELAH/BELUM menyatakan dirinya kompeten untuk seluruh Pertanyaan Asesmen Mandiri. Bila BELUM, lanjut ke no 4.
                                        </li>
                                        <li>Penilaian atas bukti-bukti kompetensi yang diajukan peserta yang menyatakan dirinya kompeten teridentifikasi TELAH/BELUM memenuhi Aturan bukti</li>
                                        <li>Proses Asesmen dapat dilanjutkan melalui :
                                            • Asesmen Portofolio
                                            • Uji Kompetensi</li>
                                        <li>Agar peserta dipanggil kembali oleh Sekretariat LSP untuk diminta penjelasan</li>
                                    </ol>
                                    </p>

                                </div>
                                <?php $getDataByIdPilSkema = $this->M_apl_02_finish->getDataByIdPilSkema($cekByIdPilihanSkema[0]->id_pilihan_skema); ?>

                                <?php if (!$getDataByIdPilSkema->tanda_tangan_asesi) { ?>
                                    <script>
                                        setInterval(() => {
                                            $('#myModalku').modal({
                                                show: true,
                                                backdrop: 'static',
                                                keyboard: false
                                            });
                                        }, 1500);
                                    </script>
                                <?php } ?>
                                <!-- Modal -->
                                <div id="myModalku" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" onclick="window.location.reload()" class="close" data-dismiss="modal">&times;</button>
                                                <h5 class="modal-title">Konfirmasi Asesmen Mandiri</h5>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('', array('id' => 'form_inputan1', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                                                <fieldset>
                                                    <input type="hidden" id="id_pilihan_skema" value="<?php echo $cekByIdPilihanSkema[0]->id_pilihan_skema; ?>" name="id_pilihan_skema">
                                                    <div class="control-group form-group">
                                                        <div class="controls form-group">

                                                            <div class="span2">
                                                                <input type="hidden" value="<?php echo $getPilihanSkemaById->tanda_tangan_asesi; ?>" class="span3" name="tanda_tangan_asesi" id="tanda_tangan_asesi">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <div class="controls form-group">
                                                            <div class="span2">
                                                                <input type="hidden" value="<?php echo date('Y-m-d') ?>" class="span2" name="tanggal_tanda_tangan_asesi" id="tanggal_tanda_tangan_asesi" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <div class="modal-footer">
                                                    <div class="controls form-group">
                                                        <?php if ($getDataByIdPilSkema->tanda_tangan_asesi) { ?>
                                                            <div class="span4" style="text-align: center;">
                                                                <img src="<?php echo 'g_ttd_asesi/' . $getPilihanSkemaById->tanda_tangan_asesi; ?>" width="100px" height="80px">
                                                            </div>
                                                            <p style="font-size: 11px;color:blue">Asesmen Mandiri telah disimpan ! <br> Anda dapat melihat hasil asesmen melalui menu berikut.</p>
                                                            <button type="button" class="btn btn-info btn-sm" onclick="show_section_2()">
                                                                <li class="fa fa-list"></li> Hasil Asesmen
                                                            </button>
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('.add_btn').hide();
                                                                });

                                                                function show_simpan() {
                                                                    $('.add_btn').show();
                                                                }
                                                            </script>
                                                        <?php } else { ?>
                                                            <div style="text-align: center;">
                                                                <small>Silahkan konfirmasi dokumen asesmen mandiri untuk melanjutkan. (Konfirmasi bersifat wajib)</small><br><br>
                                                                <button type="button" onclick="uploadTTD()" class="btn btn-primary btn-sm">
                                                                    <li class="fa fa-check"></li> Konfirmasi Asesmen Mandiri
                                                                </button>
                                                            </div>
                                                        <?php }  ?>

                                                    </div>
                                                </div>
                                                <?php echo form_close(); ?>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row span5">
                                    <?php echo form_open('', array('id' => 'form_inputan1', 'method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                                    <fieldset>
                                        <input type="hidden" id="id_pilihan_skema" value="<?php echo $cekByIdPilihanSkema[0]->id_pilihan_skema; ?>" name="id_pilihan_skema">
                                        <div class="control-group form-group">
                                            <div class="controls form-group">
                                                <div style="text-align: center;">
                                                    <h5>Konfirmasi Asesmen Mandiri</h5>
                                                </div>
                                                <div class="span2">
                                                    <input type="hidden" value="<?php echo $getPilihanSkemaById->tanda_tangan_asesi; ?>" class="span3" name="tanda_tangan_asesi" id="tanda_tangan_asesi">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <div class="controls form-group">
                                                <div class="span2">
                                                    <input type="hidden" value="<?php echo date('Y-m-d') ?>" class="span2" name="tanggal_tanda_tangan_asesi" id="tanggal_tanda_tangan_asesi" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="modal-footer">
                                        <div class="controls form-group">
                                            <?php if ($getDataByIdPilSkema->tanda_tangan_asesi) { ?>
                                                <div class="span4" style="text-align: center;">
                                                    <img src="<?php echo 'g_ttd_asesi/' . $getPilihanSkemaById->tanda_tangan_asesi; ?>" width="100px" height="80px">
                                                </div>
                                                <p style="font-size: 11px;color:blue">Asesmen Mandiri telah disimpan ! <br> Anda dapat melihat hasil asesmen melalui menu berikut.</p>
                                                <button type="button" class="btn btn-info btn-sm" onclick="show_section_2()">
                                                    <li class="fa fa-list"></li> Hasil Asesmen
                                                </button>
                                                <script>
                                                    $(document).ready(function() {
                                                        $('.add_btn').hide();
                                                    });

                                                    function show_simpan() {
                                                        $('.add_btn').show();
                                                    }
                                                </script>
                                            <?php } else { ?>
                                                <small style="color:orangered">Belum dikonfirmasi ! Silahkan konfirmasi terlebih dahulu.</small>
                                                <!-- <button type="button" onclick="uploadTTD()" class="btn btn-primary btn-sm">
                                                    <li class="fa fa-check"></li> Konfirmasi Asesmen Mandiri
                                                </button> -->
                                            <?php }  ?>

                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php   } else { ?>
                    <div class="span15">
                        <br>
                        <strong>Peserta diminta untuk:</strong>
                        <ol style="font-size: 12px;">
                            <li>
                                Mempelajari Kriteria Unjuk Kerja (KUK), Batasan Variabel, Panduan Penilaian, dan Aspek Kritis seluruh Unit Kompetensi yang diminta untuk di Ases.
                            </li>
                            <li>
                                Melaksanakan Penilaian Mandiri secara obyektif atas sejumlah pertanyaan yang diajukan, bilamana Anda menilai diri sudah kompeten atas pertanyaan tersebut, tuliskan tanda √ pada kolom (K), dan bilamana Anda menilai diri belum kompeten tuliskan tanda √ pada kolom (BK).
                            </li>
                            <li>
                                Mengisi bukti-bukti kompetensi yang relevan atas sejumlah pertanyaan yang dinyatakan kompeten (bila ada).
                            </li>
                            <li>
                                Menandatangani form Asesmen Mandiri
                            </li>
                        </ol>
                    </div>
                    <div class="box-content box-table ">
                        <div class="row">
                            <div id="acct-password-row" class="span16 ">
                                <br>
                                <div class="row span15">
                                    <div class="span2" style="font-weight: bold;font-size:11px">Unit Kompetensi*</div>
                                    <div class="span2" style="font-weight: bold;font-size:11px">Unit Elemen*</div>
                                    <div class="span4" style="font-weight: bold;font-size:11px">Daftar Pertanyaan*</div>
                                    <div class="span3" style="font-weight: bold;font-size:11px">Penilaian Kompeten*</div>
                                    <div class="span3" style="font-weight: bold;font-size:11px">Bukti Kompeten<small>(Optional)</small></div>
                                </div>
                                <br>
                                <?php
                                $no = 0;
                                // $groupByPertanyaanByIdSkema = $this->M_unit_pertanyaan->groupByPertanyaanByIdSkema($getPilihanById[0]->id_skema);
                                $getPertanyaanByIdSkema = $this->M_unit_pertanyaan->getPertanyaanByIdSkema($getPilihanById[0]->id_skema);
                                if ($getPertanyaanByIdSkema) { ?>
                                    <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                                    <div class="row span15">
                                        <br>
                                        <div class="scroll">
                                            <?php foreach ($getPertanyaanByIdSkema as $row) { ?>
                                                <fieldset>
                                                    <input type="hidden" name="id" id="id">
                                                    <input type="hidden" name="id_pilihan_skema" value="<?php echo $getPilihanSkemaById->id_ps; ?>" id="id_pilihan_skema">
                                                    <input type="hidden" name="id_unit_kompetensi[<?php echo $row->id; ?>]" value="<?php echo $row->id_unit_kompetensi; ?>" id="id_unit_kompetensi[<?php echo $row->id; ?>]">
                                                    <input type="hidden" name="id_skema" value="<?php echo $getPilihanSkemaById->id_skema; ?>" id="id_skema">
                                                    <input type="hidden" name="judul_skema[<?php echo $row->id; ?>]" value="<?php echo $row->skema_judul; ?>" id="judul_skema[<?php echo $row->id; ?>]">
                                                    <input type="hidden" name="judul_unit_kompetensi[<?php echo $row->id; ?>]" value="<?php echo $row->judul_unit_kompetensi; ?>" id="judul_unit_kompetensi[<?php echo $row->id; ?>]">
                                                    <input type="hidden" name="judul_unit_elemen[<?php echo $row->id; ?>]" value="<?php echo $row->judul_unit_elemen; ?>" id="judul_unit_elemen[<?php echo $row->id; ?>]">
                                                    <input type="hidden" name="id_unit_elemen[<?php echo $row->id; ?>]" value="<?php echo $row->id_unit_elemen; ?>" id="id_unit_elemen[<?php echo $row->id; ?>]">
                                                    <input type="hidden" name="id_unit_pertanyaan_elemen[<?php echo $row->id; ?>]" value="<?php echo $row->id; ?>" id="id_unit_pertanyaan_elemen[<?php echo $row->id; ?>]">
                                                    <div class="control-group form-group">
                                                        <label class="control-label span2" title="judul unit kompetensi"><?php echo $row->judul_unit_kompetensi; ?></label>
                                                        <label class="control-label span2" title="elemen kompetensi"><?php echo $row->judul_unit_elemen; ?></label>
                                                        <label class="control-label span4" style="text-align: justify;"><?php echo $row->daftar_pertanyaan ?></label>
                                                        <div class="controls form-group">
                                                            <input id="daftar_pertanyaan[<?php echo $row->id; ?>]" value="<?php echo $row->daftar_pertanyaan ?>" name="daftar_pertanyaan[<?php echo $row->id; ?>]" type="hidden">
                                                            <span style="font-size: 12px;" class="span3">
                                                                <input type="radio" name="penilaian_kompeten[<?php echo $row->id; ?>]" id="penilaian_kompeten[<?php echo $row->id; ?>]" value="Kompeten"> Kompeten
                                                                <input type="radio" name="penilaian_kompeten[<?php echo $row->id; ?>]" id="penilaian_kompeten[<?php echo $row->id; ?>]" value="Belum Kompeten"> Belum Kompeten
                                                            </span>
                                                            <select name="bukti_kompeten[<?php echo $row->id; ?>]" id="bukti_kompeten[<?php echo $row->id; ?>]" class="span3" style="font-size: 12px;">
                                                                <option value="">Bukti Kompeten yang relevan</option>
                                                                <option value="<?php echo empty($getPilihanSkemaById->upload_bukti_relevan_1) ? '' : $getPilihanSkemaById->upload_bukti_relevan_1; ?>"><?php echo ($getPilihanSkemaById->keterangan_bukti_1 == '') ? '' : $getPilihanSkemaById->keterangan_bukti_1; ?></option>
                                                                <option value="<?php echo empty($getPilihanSkemaById->upload_bukti_relevan_2) ? '' : $getPilihanSkemaById->upload_bukti_relevan_2; ?>"><?php echo ($getPilihanSkemaById->keterangan_bukti_2 == '') ? '' : $getPilihanSkemaById->keterangan_bukti_2; ?></option>
                                                                <option value="<?php echo empty($getPilihanSkemaById->upload_bukti_relevan_3) ? '' : $getPilihanSkemaById->upload_bukti_relevan_3; ?>"><?php echo ($getPilihanSkemaById->keterangan_bukti_3 == '') ? '' : $getPilihanSkemaById->keterangan_bukti_3; ?></option>
                                                                <option value="<?php echo empty($getPilihanSkemaById->upload_bukti_relevan_4) ? '' : $getPilihanSkemaById->upload_bukti_relevan_4; ?>"><?php echo ($getPilihanSkemaById->keterangan_bukti_4 == '') ? '' : $getPilihanSkemaById->keterangan_bukti_4; ?></option>
                                                                <option value="<?php echo empty($getPilihanSkemaById->upload_bukti_relevan_5) ? '' : $getPilihanSkemaById->upload_bukti_relevan_5; ?>"><?php echo ($getPilihanSkemaById->keterangan_bukti_5 == '') ? '' : $getPilihanSkemaById->keterangan_bukti_5; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            <?php } ?>
                                        </div>
                                        <br>

                                        <div class="row span15">
                                            <strong style="font-size: 12px;">Rekomendasi Asesor : </strong>
                                            <p style="font-weight: bold;">
                                            <ol style="font-weight: bold; font-size:12px">
                                                <li>
                                                    Peserta TELAH/BELUM menyatakan dirinya kompeten untuk seluruh Pertanyaan Asesmen Mandiri. Bila BELUM, lanjut ke no 4.
                                                </li>
                                                <li>Penilaian atas bukti-bukti kompetensi yang diajukan peserta yang menyatakan dirinya kompeten teridentifikasi TELAH/BELUM memenuhi Aturan bukti</li>
                                                <li>Proses Asesmen dapat dilanjutkan melalui :
                                                    • Asesmen Portofolio
                                                    • Uji Kompetensi</li>
                                                <li>Agar peserta dipanggil kembali oleh Sekretariat LSP untuk diminta penjelasan</li>
                                            </ol>
                                            </p>

                                        </div>
                                        <div class="span15">
                                            <div class="span8">
                                                <small style="color:red">*Disclaimer : Silahkan pastikan jawaban asessment mandiri yang anda berikan sudah benar. <br> *Note: Jawaban yang telah dikirimkan tidak dapat diubah kembali</small>
                                            </div>
                                            <div class="span6">
                                                <div class="modal-footer">

                                                    <button type="reset" class="btn btn-warning">
                                                        <li class="fa fa-undo"></li> Reset
                                                    </button>
                                                    <button type="button" onclick="simpan()" class="btn btn-primary">
                                                        <li class="fa fa-save"></li> Simpan
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo form_close(); ?>
                                <?php } else { ?>
                                    <div class="control-group form-group">
                                        <div class="controls form-group">
                                            <h5 class="span15" style="text-align: center;color:red;font-size:12px;">Belum ada pertanyaan yang ditambahkan untuk skema ini.</h5>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php  } ?>

            </div>
        </div>
    </div>
</section>

<section class="page container" id="section_2">
    <div class="row" id="form_apl_02">
        <div style="text-align: right;">
            <button class="btn btn-warning" onclick="show_section_1()"> <i class="icon-arrow-left"></i> Back</button>
        </div>
        <br>
        <div id="acct-password-row" class="span16">
            <div class="box pattern pattern-sandstone">
                <div class="box-header">
                    <i class="icon-certificate" style="color: green;"></i>
                    <h5 style="font-size: 13px;">
                        Riwayat Pengisian Dokumen APL-02
                    </h5>
                </div>
                <div class="box-content box-table scroll">
                    <div class="row">
                        <div id="acct-password-row" class="span7">
                            <br>
                            <?php $getDataByIdPilSkema = $this->M_apl_02_finish->getDataByIdPilSkema($cekByIdPilihanSkema[0]->id_pilihan_skema); ?>
                            <fieldset class="span15 ">
                                <div class="box-content box-table ">
                                    <table id="sample-table" class="table table-hover table-bordered tablesorter ">
                                        <thead>
                                            <tr>
                                                <th style="font-size: 11px;">No</th>
                                                <th style="font-size: 11px;">Pertanyaan</th>
                                                <th style="font-size: 11px;">Penilaian Kompeten</th>
                                                <th style="font-size: 11px;">Bukti Kompeten</th>
                                                <th style="font-size: 11px;">V</th>
                                                <th style="font-size: 11px;">A</th>
                                                <th style="font-size: 11px;">T</th>
                                                <th style="font-size: 11px;">M</th>
                                                <!-- <th style="font-size: 11px;">Tools</th> -->

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 0;
                                            foreach ($cekByIdPilihanSkema as $row) {
                                            ?>
                                                <tr>
                                                    <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                                    <td style="font-size: 11px;"><?php echo $row->daftar_pertanyaan; ?></td>
                                                    <td style="font-size: 11px;"><?php echo $row->penilaian_kompeten; ?></td>
                                                    <td style="font-size: 11px;"><?php if (empty($row->bukti_kompeten)) {
                                                                                        echo 'Tidak ada';
                                                                                    } else { ?>
                                                            <a href="g_kompetensi/<?php echo $row->bukti_kompeten; ?>" target="_blank">Lihat File</a>
                                                        <?php } ?>
                                                    </td>
                                                    <td style="font-size: 11px;"><?php echo $row->asesor_v == 1 ? '<span class="icon-check"></span>' : '<span class="icon-check-empty"></span>'; ?></td>
                                                    <td style="font-size: 11px;"><?php echo $row->asesor_a == 1 ? '<span class="icon-check"></span>' : '<span class="icon-check-empty"></span>'; ?></td>
                                                    <td style="font-size: 11px;"><?php echo $row->asesor_t == 1 ? '<span class="icon-check"></span>' : '<span class="icon-check-empty"></span>'; ?></td>
                                                    <td style="font-size: 11px;"><?php echo $row->asesor_m == 1 ? '<span class="icon-check"></span>' : '<span class="icon-check-empty"></span>'; ?></td>
                                                    <!-- <td style="font-size: 11px;"><?php echo get_btn_update('', 'Update'); ?></td> -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                                <div class="box-content box-table">
                                    <strong>Catatan : </strong><br>
                                    ASESMEN PORTOFOLIO : <br>
                                    Pada Unit Kompetensi: <?php echo empty($getDataByIdPilSkema->catatan_asesmen_portofolio) ? '........................' : $getDataByIdPilSkema->catatan_asesmen_portofolio; ?>
                                </div>
                                <br>
                                <div class="box-content box-table">
                                    <strong>UJI KOMPETENSI : </strong><br>
                                    Pada Unit Kompetensi: <?php echo empty($getDataByIdPilSkema->catatan_uji_kompetensi) ? '........................' : $getDataByIdPilSkema->catatan_uji_kompetensi; ?>
                                </div>
                                <br>
                                <br>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>