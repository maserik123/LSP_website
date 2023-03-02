<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        table = $('#datatable1').DataTable({
            "processing": true,
            "serverSide": true,
            "lengthMenu": [
                [5, 25, 50, -1],
                [5, 25, 50, "All"]
            ],
            "responsive": true,
            "dataType": 'JSON',
            "ajax": {
                "url": "<?php echo site_url('superAdmin/kelolaUser/getAllData') ?>",
                "type": "POST",
                "data": {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                }
            },
            "order": [
                [0, "asc"]
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
        $('.form-group').removeClass('has-error')
            .removeClass('has-success')
            .find('#text-error').remove();
        $('#pwd').hide();
        $.ajax({
            url: "<?php echo site_url('SuperAdmin/kelolaUser/getById/'); ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(resp) {
                data = resp.data
                $('[name="id"]').val(data.id);
                $('[name="first_name"]').val(data.first_name);
                $('[name="last_name"]').val(data.last_name);
                $('[name="email"]').val(data.email);
                // $('[name="password"]').val(data.password);
                $('[name="address"]').val(data.address);
                $('[name="phone_number"]').val(data.phone_number);
                $('[name="role"]').val(data.role);
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
                    url: "<?php echo site_url('SuperAdmin/kelolaUser/delete'); ?>/" + id,
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
        if (save_method == 'update') {
            url = '<?php echo base_url() ?>SuperAdmin/kelolaUser/update';
        } else {
            url = '<?php echo base_url() ?>SuperAdmin/kelolaUser/addData';
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
                    data: $('#form_regis').serialize(),
                    dataType: "JSON",
                    success: function(resp) {
                        data = resp.result
                        csrf_hash = resp.csrf['token'];
                        $('#form_regis input[name=' + token_name + ']').val(csrf_hash);
                        if (data['status'] == 'success') {
                            updateAllTable();
                            $('.form-group').removeClass('has-error')
                                .removeClass('has-success')
                                .find('#text-error').remove();
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
</script>



<!-- page content -->
<div class="col-md-8 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Users List </h2>
            <ul class="nav navbar-right panel_toolbox">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="window.location.reload()"><i class="fa fa-plus"></i> New Registration</button>
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Address</th>
                                    <th>Phone Number</th>
                                    <th>Role</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>User Managements Form</h2>
            <ul class="nav navbar-right panel_toolbox">
                <!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" onclick="tambah()"><i class="fa fa-plus"></i> Tambah Data Unit</button> -->
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div class="row">
                <?php echo form_open('', array('id' => 'form_regis', 'method' => 'POST')); ?>
                <?php echo form_input(array('id' => 'id', 'name' => 'id', 'type' => 'hidden')); ?>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">First Name<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="text" name="first_name" id="first_name" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">Last Name<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="text" name="last_name" id="last_name" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">Email<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="text" name="email" id="email" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group" id="pwd">
                    <label class="col-form-label col-md-4 col-sm-3">Password<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="password" name="password" id="password" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">Address<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="text" name="address" id="address" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">Phone Number<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <input type="text" name="phone_number" id="phone_number" class="form-control ">
                    </div>
                </div>
                <div class="field item form-group">
                    <label class="col-form-label col-md-4 col-sm-3">User Role<span class="required">*</span></label>
                    <div class="col-md-8 xdisplay_inputx form-group row has-feedback">
                        <select name="role" id="role" class="form-control">
                            <option value="">-- Jenis Hak Akses --</option>
                            <option value="administrator">Administrator</option>
                            <option value="asesi">Asesi</option>
                            <option value="asesor">Asesor</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                    <button type="button" class="btn btn-info btn-sm" onclick="simpan()">Simpan</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>