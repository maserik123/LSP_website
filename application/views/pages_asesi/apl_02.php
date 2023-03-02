   <script>
       function addAPL02(id) {
           $.ajax({
               url: "<?php echo site_url('asesi/apl_01/getByIdOnAPL02/'); ?>/" + id,
               type: "GET",
               dataType: "JSON",
               success: function(resp) {
                   data = resp.data
                   $('[name="id"]').val(data.id_ps);
                   $('[name="judul_skema"]').html(data.judul_skema);
                   $('[name="no_skema"]').html(data.no_skema);
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
                   $('.tombol_lanjut').hide();
                   $('.btn_pertanyaan').hide();
                   $('.apl02_kosong').show();
                   $('#modalAsesmenMandiri').modal({
                       show: true,
                       backdrop: 'static',
                       keyboard: false
                   });

                   $.ajax({
                       url: "<?php echo site_url('asesi/apl_02_finish/getTukByIdPilSkema/'); ?>/" + data.id_ps,
                       type: "GET",
                       dataType: "JSON",
                       success: function(resp) {
                           preg = resp.preg;
                           console.log(preg.tuk);
                           $('[name="tuk"]').val(preg.tuk);
                           $('.tuk1').hide();
                           $('.tuk2').show();
                           $('.tombol_aksi').hide();
                           $('.tombol_lanjut').show();
                           $('.btn_pertanyaan').show();
                           $('.apl02_kosong').hide();
                           setInterval(() => {
                               $('#modalAsesmenMandiri').modal('hide');
                           }, 3000);

                       }
                   });
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
           url = '<?php echo base_url() ?>asesi/apl_02_finish/addData_apl02_finish';
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
                       data: $('#form_inputan_asesmen').serialize(),
                       dataType: "JSON",
                       success: function(resp) {
                           data = resp.result
                           csrf_hash = resp.csrf['token'];
                           $('#form_inputan_asesmen input[name=' + token_name + ']').val(csrf_hash);
                           if (data['status'] == 'success') {
                               $('.form-group').removeClass('has-error')
                                   .removeClass('has-success')
                                   .find('#text-error').remove();
                               $("#form_inputan_asesmen")[0].reset();
                               window.location.reload();
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
                           });
                       }
                   });
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
           /* width: 300px; */
           /* height: 50px; */
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
   <section class="page container" id="page">
       <div class="row">
           <div class="span16">
               <div class="">
                   <legend class="lead">
                       Dokumen Sertifikasi APL-02 <br>
                       <small>Lengkapi data berikut untuk melengkapi dokumen APL-02</small>
                   </legend>
               </div>
           </div>
       </div>
       <?php if (empty($getPilihanSkema)) { ?>
           <div class="row">
               <div id="acct-password-row" class="span16">
                   <h5>Anda belum menentukan skema sertifikasi. Silahkan tambahkan skema sertifikasi terlebih dahulu !</h5>
                   <button class="btn btn-warning" onclick="window.location = '<?php echo base_url('apl_01'); ?>'">
                       <i class="icon-plus"></i> Tambah Skema Sertifikasi
                   </button>
               </div>
           </div>
       <?php } else { ?>
           <div class="row" id="tabel">
               <?php foreach ($getPilihanSkema as $row) { ?>
                   <?php
                    // if ($row->tanggal_pelaksanaan >= date('Y-m-d')) {
                    ?>
                   <div id="acct-password-row" class="span8">
                       <div class="box pattern pattern-sandstone">
                           <div class="box-header">
                               <i class="icon-certificate" style="color: green;"></i>
                               <h5 style="font-size: 13px;">
                                   <?php echo $row->judul_skema ?>
                               </h5>
                           </div>
                           <div class="box-content box-table scroll">
                               <table id="sample-table" class="table table-hover table-bordered tablesorter ">
                                   <tbody>
                                       <tr>
                                           <td colspan="4">
                                               <div>
                                                   <button onclick="window.location = '<?php echo base_url('apl_01'); ?>'" class="btn btn-danger" style="font-size:12px;"><i class="icon-pencil"></i> Data Pemohon</button>
                                                   <?php if ($row->status_diterima == 1) { ?>
                                                       <button class="btn btn-primary" onclick="addAPL02(<?php echo $row->id_ps; ?>)" style="font-size:12px;"><i class="icon-list-alt"></i> Asesmen Mandiri</button>
                                                   <?php } else { ?>
                                                       <button class="btn btn-primary" style="font-size:12px;" disabled title="Anda tidak dapat melengkapi APL 02 karena dokumen APL 01 belum dikonfirmasi oleh Administrator LSP."><i class="icon-list-alt"></i> Asesmen Mandiri</button>
                                                   <?php } ?>
                                               </div>
                                           </td>
                                       </tr>
                                       <tr>
                                           <th style="font-size: 11px;">Nama Asesor</th>
                                           <td style="font-size: 11px;" colspan="3"><?php echo empty($row->nama_asesor) ? '<label style="color:red;font-size:11px;">Belum ditetapkan</label>' : $row->nama_asesor; ?></td>
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
                                           <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                           <td style="font-size: 11px;" colspan="3"><?php echo tgl_indo($row->tanggal_pengajuan); ?></td>
                                       </tr>
                                       <!-- <tr>
                                           <th style="font-size: 11px;">Tanggal Pelaksanaan Ujian</th>
                                           <td style="font-size: 11px;" colspan="3"><?php echo tgl_indo($row->tanggal_pelaksanaan); ?></td>
                                       </tr> -->
                                       <tr>
                                           <th style="font-size: 11px;">Status Konfirmasi APL-01</th>
                                           <td style="font-size: 11px;" colspan="3">
                                               <?php if ($row->status_diterima == 0) { ?>
                                                   <label for="" class="label" style="background-color: orange;text-align: center;">Menunggu Konfirmasi...</label>
                                               <?php } else if ($row->status_diterima == 1) { ?>
                                                   <label for="" class="label" style="background-color: green;text-align:center;">Diterima</label>
                                               <?php } else { ?>
                                                   <label for="" class="label" style="background-color: red;text-align:center;">Ditolak</label>
                                               <?php } ?>
                                           </td>
                                       </tr>
                                       <?php
                                        $cekAsesmen = $this->M_apl_02_finish->getDataByIdPilSkema($row->id_ps);
                                        $cekByIdPilihanSkema = $this->M_apl_02->cekByIdPilihanSkema($row->id_ps);
                                        ?>
                                       <tr>
                                           <th style="font-size: 11px;">Status Asesmen</th>
                                           <td style="font-size: 11px;" colspan="3">
                                               <?php echo empty($cekByIdPilihanSkema[0]->id_pilihan_skema) ? '<div class="btn btn-danger badge btn-sm" style="font-size:10px">Belum asesmen mandiri</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (!empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-info badge btn-sm" style="font-size:10px">Asesmen telah diases asesor</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-warning badge btn-sm" style="font-size:10px">Belum diases oleh asesor</div>' : '')); ?>
                                           </td>
                                       </tr>
                                   </tbody>
                               </table>
                           </div>
                       </div>
                   </div>
                   <?php
                    // } else {  } 
                    ?>
               <?php } ?>
           </div>

           <!-- Form APL 02 -->
           <div class="row" id="form_apl_02">
               <div style="text-align: right;">
                   <button class="btn btn-danger" onclick="hide_form()"> <i class="icon-arrow-left"></i> Batal</button>
               </div>
               <br>
               <!-- <div id="acct-password-row" class="span7">
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
               </div> -->

               <!-- Modal -->
               <div id="modalAsesmenMandiri" class="modal fade" role="dialog">
                   <div class="modal-dialog">
                       <!-- Modal content-->
                       <div class="modal-content">
                           <div class="modal-header">
                               <div class="box-header">
                                   <h5 style="font-size: 13px;">
                                       <i class="icon-certificate" style="color: green;"></i>
                                       Kelengkapan Dokumen APL-02
                                   </h5>
                               </div>
                           </div>
                           <div class="modal-body">
                               <div class="box pattern pattern-sandstone">

                                   <div class="box-content box-table">
                                       <!-- <div class="row"> -->
                                       <div id="acct-password-row" class="span7">
                                           <br>
                                           <?php echo form_open('', array('id' => 'form_inputan_asesmen', 'method' => 'post')); ?>
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

                                           </fieldset>
                                       </div>
                                       <!-- </div> -->
                                   </div>
                               </div>
                           </div>
                           <div class="modal-footer tombol_aksi">
                               <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">
                                   <li class="fa fa-close"></li> Batal
                               </button> -->
                               <button class="btn btn-danger" onclick="hide_form()"> <i class="fa fa-close"></i> Batal</button>
                               <button type="button" class="btn btn-primary simpan" onclick="simpan()">
                                   <li class="fa fa-save"></li> Simpan
                               </button>
                           </div>

                           <div class="modal-footer tombol_lanjut">
                               <button type="button" class="btn btn-primary simpan" data-dismiss="modal">
                                   <li class="fa fa-thumbs-up"></li> Oke
                               </button>
                           </div>
                           <?php echo form_close(); ?>
                       </div>

                   </div>
               </div>

               <div id="acct-password-row" class="span16 ">
                   <div class="box pattern pattern-sandstone ">
                       <div class="box-header ">
                           <!-- <i class="icon-certificate" style="color: green;"></i> -->
                           FORM APL-02 (<span name="judul_skema"></span>) (<span name="no_skema"></span>)
                       </div>
                       <div class="box-content box-table ">
                           <div class="row">
                               <div id="acct-password-row" class="span16">
                                   <br>
                                   <fieldset class="btn_pertanyaan">
                                       <h5 class="span16" style="text-align: center;">Silahkan klik lanjutkan untuk Melakukan Asessment Mandiri</h5>
                                       <div class="controls form-group span16">
                                           <div class="control-group form-group" style="text-align: center;">
                                               <?php echo form_open('asesmenMandiri', array('id' => 'form_apl02', 'method' => 'post')); ?>
                                               <input type="hidden" name="id" id="id" readonly>
                                               <button type="submit" class="btn btn-primary">
                                                   <li class="fa fa-list-alt"></li> Asesmen Mandiri
                                               </button>
                                               <?php echo form_close(); ?>
                                           </div>
                                       </div>
                                   </fieldset>
                                   <fieldset class="apl02_kosong">
                                       <h6 class="span7" style="color:red">Anda belum melengkapi data APL-02, Silahkan lengkapi data APL-02 terlebih dahulu.</h6>
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
   <script type="text/javascript">
       $(function() {
           $('.datepicker').datepicker({
               format: "yyyy-mm-dd",
               autoclose: true
           });
       });
   </script>