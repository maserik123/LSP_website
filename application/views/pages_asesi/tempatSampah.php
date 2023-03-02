<script>
    function hapus(id) {
        swal({
                title: "Apakah ingin menghapus secara permanen?",
                text: "Data yang telah hapus tidak akan dapat dipulihkan",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('asesi/tempat_sampah/delete'); ?>/" + id,
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

    function pulihkan(id) {
        swal({
                title: "Anda yakin ingin memulihkan ?",
                type: "warning",
                showCancelButton: true,
                showLoaderOnConfirm: true,
                confirmButtonText: "Ya",
                closeOnConfirm: false
            },
            function() {
                $.ajax({
                    url: "<?php echo site_url('asesi/tempat_sampah/pulihkan'); ?>/" + id,
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
<section class="page container " id="page">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Daftar Skema Saya yang dihapus<br>
                </legend>
            </div>
        </div>
    </div>

    <div class="row">
        <div id="acct-password-row" class="span16 ">
            <div class="box pattern pattern-sandstone ">
                <div class="box-header">
                    <i class="icon-certificate" style="color: green;"></i>
                    <h5>
                        Riwayat Transaksi anda
                    </h5>
                </div>
                <div class="box-content box-table scroll">
                    <table id="sample-table" class="table table-hover table-bordered tablesorter">
                        <thead>
                            <tr>
                                <th style="font-size: 11px;">No</th>
                                <th style="font-size: 11px;">Judul Skema</th>
                                <th style="font-size: 11px;">Tujuan Asesmen</th>
                                <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                <th style="font-size: 11px;">Status Verifikasi</th>
                                <th style="font-size: 11px;">Status Sertifikasi</th>
                                <th style="font-size: 11px;">Tools</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($getPilihanSkema)) { ?>
                                <tr>
                                    <td colspan="7" style="font-size: 11px;text-align: center;">Belum ada data yang ditampilkan</td>
                                </tr>
                            <?php } else { ?>
                                <?php $no = 0;
                                foreach ($getPilihanSkema as $row) { ?>
                                    <tr>
                                        <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                        <td style="font-size: 11px;"><?php echo $row->judul_skema; ?></td>
                                        <td style="font-size: 11px;"><?php echo $row->tujuan_sertifikasi; ?></td>
                                        <td style="font-size: 11px;"><?php echo tgl_indo($row->tanggal_pengajuan); ?></td>
                                        <td style="font-size: 11px;">
                                            <?php if ($row->status_diterima == 0) { ?>
                                                <label for="" class="badge" style="background-color: orange;text-align: center;">Diajukan</label>
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
                                        <td>
                                            <button class="btn btn-info label" onclick="pulihkan(<?php echo $row->id_ps; ?>)"><span class="icon-undo"></span> Pulihkan Data</button>
                                            <button class="btn btn-danger label" style="background-color:red" onclick="hapus(<?php echo $row->id_ps; ?>)"><span class="icon-trash"></span> Hapus Permanen</button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>