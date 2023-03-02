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
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Persetujuan Asesmen Mandiri</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table ">
                    <thead>
                        <tr>
                            <th style="font-size:11px;">#</th>
                            <th style="font-size:11px;">Nama Asesi</th>
                            <th style="font-size:11px;">Skema</th>
                            <th style="font-size:11px;">Tujuan Sertifikasi</th>
                            <th style="font-size:11px;">Tgl Pengajuan</th>
                            <th style="font-size:11px;">Tgl Pelaksanaan</th>
                            <th style="font-size:11px;">Permohonan Admin</th>
                            <th style="font-size:11px;">Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($getAllDataForAsesor as $row) { ?>
                            <tr>
                                <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                <td style="font-size: 11px;"><?php echo $row->dd_nama_lengkap; ?></td>
                                <td style="font-size: 11px;"><?php echo $row->judul_skema; ?> </td>
                                <td style="font-size: 11px;"><?php echo $row->tujuan_sertifikasi; ?></td>
                                <td style="font-size: 11px;"><?php echo tgl_indo($row->tanggal_pengajuan); ?></td>
                                <td style="font-size: 11px;"><?php echo ($row->tanggal_pelaksanaan == 0) ? '<span style="font-size:11px;color:red;">Tanggal Belum diset</span>' : tgl_indo($row->tanggal_pelaksanaan); ?></td>
                                <td style="font-size: 11px;"><?php echo $row->status_diterima == 1 ? '<span style="font-size:11px;color:blue;">Permohonan Diterima</span>' : 'Belum diterima'; ?></td>
                                <td style="font-size: 11px;"><?php echo btnSetTanggalPelaksanaan('ubah("' . encrypt($row->id) . '")'); ?></td>
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
                            <small>Tentukan tanggal pelaksanaan Ujian Sertifikasi BNSP</small>
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