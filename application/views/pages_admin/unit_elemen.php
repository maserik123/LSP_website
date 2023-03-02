<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

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

            "ajax": {
                "url": "<?php echo site_url('administrator/unit_elemen/getAllData') ?>",
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
            url: "<?php echo site_url('administrator/unit_elemen/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                console.log(data.id_unit_kompetensi)
                $('[name="id"]').val(data.id);
                $('[name="elemen_kompetensi"]').val(data.elemen_kompetensi);
                $('[name="id_unit_kompetensi"]').val(data.id_unit_kompetensi);

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
                    url: "<?php echo site_url('administrator/unit_elemen/delete'); ?>/" + id,
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
        if (save_method == 'add') {
            url = '<?php echo base_url() ?>administrator/unit_elemen/addData';
        } else {
            url = '<?php echo base_url() ?>administrator/unit_elemen/update';
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

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2><span class="fa fa-table"></span> Data Unit Elemen </h2>
            <ul class="nav navbar-right panel_toolbox">
                <button type="button" onclick="window.location='<?php echo base_url('skema') ?>'" class="btn btn-danger btn-sm"><span></span> Back</button>

                <button type="button" onclick="tambah()" class="btn btn-primary btn-sm"><span></span> Tambah Data</button>
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
                                    <th style="font-size: 11px;">Element Kompetensi</th>
                                    <th style="font-size: 11px;">Judul Unit Kompetensi</th>
                                    <th style="font-size: 11px;">Create/Modified Date</th>
                                    <th style="font-size: 11px;width:70px;">Tools</th>
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
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Formulir Skema Sertifikasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <dv class="row">
                    <?php echo form_open('', array('id' => 'form_inputan', 'method' => 'post')); ?>
                    <div class="col-md-12">
                        <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Elemen Kompetensi<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <input type="text" name="elemen_kompetensi" id="elemen_kompetensi" class="form-control has-feedback-left">
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>
                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Judul Skema<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <select name="id_skema" id="id_skema" class="form-control has-feedback-left">
                                    <option value="">--Pilih Skema--</option>
                                    <?php foreach ($getSkema as $row) { ?>
                                        <option value="<?php echo $row->id ?>"><?php echo $row->judul_skema; ?></option>
                                    <?php } ?>
                                </select>
                                <span class="fa fa-file form-control-feedback left" aria-hidden="true"></span>

                            </div>
                        </div>
                        <div class="field item form-group">
                            <label class="col-form-label col-md-4 col-sm-3">Judul Unit Kompetensi<span class="required">*</span></label>
                            <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                                <select name="id_unit_kompetensi" id="id_unit_kompetensi" class="form-control unit_kompetensi theSelect">
                                    <option value="">Pilih Unit Kompetensi</option>

                                </select>


                            </div>
                        </div>
                    </div>
                    <div class=" modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><span class="fa fa-close"></span> Batal</button>
                        <button type="button" onclick="simpan()" class="btn btn-primary btn-sm"><span class="fa fa-save"></span> Simpan</button>
                    </div>
                    <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
<script>
    $(".theSelect").select2({
        placeholder: "Pilih Unit",
        width: 500,
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#id_skema').change(function() {
            var token_name = '<?php echo $this->security->get_csrf_token_name(); ?>'
            var csrf_hash = ''
            var id = $(this).val();
            $.ajax({
                url: "<?php echo base_url(); ?>administrator/unit_elemen/getJSONskema",
                method: "POST",
                data: {
                    id: id,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                async: false,
                dataType: 'JSON',
                success: function(resp) {
                    data = resp.result
                    var html = '';
                    var i;
                    html += '<option>--Pilih Unit Kompetensi--</option>';
                    for (i = 0; i < data.length; i++) {
                        html += '<option value="' + data[i].id + '">' + data[i].judul_unit + '</option>';
                    }
                    $('#id_unit_kompetensi').html(html);

                }
            });
        });
    });
</script>