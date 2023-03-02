<script>
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
            // "dom": 'Bfrtip',
            // "buttons": [
            //     'excel', 'pdf', 'print'
            // ],
            "ajax": {
                "url": "<?php echo site_url('SuperAdmin/getDataPermohonanHome') ?>",
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
</script>

<!-- top tiles -->

<div class="col-md-12 col-sm-12">
    <div class="top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats bg-blue">
                <div class="count"><?php echo $getTotalSkema->jlh_skema; ?></div>
                <p>Jumlah Skema Seluruhnya</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats bg-green">
                <div class="count"><?php echo $totalAsesor->jlh_asesor ?></div>
                <p> Jumlah Asesor Seluruhnya</p>
            </div>
        </div>
        <!-- <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
             <div class="tile-stats bg-purple">
                 <div class="count"><?php echo $totalPermohonanAsesi->jumlah; ?></div>
                 <p>Total Permohonan Asesi</p>
             </div>
         </div> -->
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats bg-orange">
                <div class="count"><?php echo $totalAsesiDiterima->jumlah ?></div>
                <p>Permohonan Asesi diterima</p>
            </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
            <div class="tile-stats bg-red">
                <div class="count"><?php echo $totalAsesiDitolak->jumlah ?></div>
                <p>Permohonan Asesi ditolak</p>
            </div>
        </div>
    </div>
</div>
<!-- /top tiles -->

<div class="col-md-12 col-sm-12 ">
    <div class="dashboard_graph">

        <div class="row x_title">
            <div class="col-md-6">
                <h4>Home Management System </h4>
            </div>

        </div>

        <div class="col-md-9 col-sm-9 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2><span class="fa fa-table"></span> Daftar Permohonan </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="data" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 10px;">No</th>
                                            <th style="font-size: 10px;">Nama Pemohon</th>
                                            <th style="font-size: 10px;">Pilihan Skema</th>
                                            <th style="font-size: 10px;">Tujuan Sertifikasi</th>
                                            <th style="font-size: 10px;">Tanggal Pengajuan</th>
                                        </tr>
                                    </thead>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-3  bg-white">
            <div class="x_panel">
                <div class="x_title">
                    <h6> Pengguna Daring</h6>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="data" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="font-size: 10px;">Nama</th>
                                            <th style="font-size: 10px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($getAllOnlineUser as $row) { ?>
                                            <tr>
                                                <td style="font-size: 11px;"><?php echo $row->first_name; ?></td>
                                                <td style="font-size: 11px;"><?php echo count_time_since(strtotime($row->time_online)) < 7100 ? '<button class="bg-green"> Online</button>' : '<button class="bg-orange"> End Session</button>' ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>

<!-- Modal -->
<div id="cek_data_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">
                    Pemberitahuan !
                </h6>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Anda belum melengkapi data diri, silahkan lengkapi data diri terlebih dahulu. <br><br> Silahkan pilih Oke untuk melanjutkan ! </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" onclick="window.location='<?php echo base_url('administrator/dataDiri') ?>'" data-dismiss="modal"><span class="fa fa-thumbs-up"></span> Oke</button>
            </div>
        </div>
    </div>
</div>