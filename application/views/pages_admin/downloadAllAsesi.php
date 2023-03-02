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
            "dom": "Bfrtip",
            "buttons": [{
                extend: 'excel',
                text: '<li class="fa fa-download"></li> Download File Excel',
                className: 'btn-primary btn-sm'
            }],
            "ajax": {
                "url": "<?php echo site_url('administrator/downloadDataAsesi/getAllData') ?>",
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

<style>
    .scroll {
        width: 100%;
        height: 500px;
        overflow-y: scroll;
    }
</style>

<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>Daftar Permintaan Pemohon Sertifikasi APL-01 </h2>
            <ul class="nav navbar-right panel_toolbox">
                <li><button class="btn btn-sm btn-danger" onclick="history.back(-1)" style="font-size: 12px;">
                        <span class="fa fa-arrow-left"></span> Kembali</button></li>
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
                                    <th style="font-size: 11px;">Nama Lengkap</th>
                                    <th style="font-size: 11px;">NIK</th>
                                    <th style="font-size: 11px;">Tempat Lahir</th>
                                    <th style="font-size: 11px;">Tanggal Lahir</th>
                                    <th style="font-size: 11px;">Jenis Kelamin</th>
                                    <th style="font-size: 11px;">Kebangsaan</th>
                                    <th style="font-size: 11px;">Alamat Rumah</th>
                                    <th style="font-size: 11px;">No Hp</th>
                                    <th style="font-size: 11px;">No Telp</th>
                                    <th style="font-size: 11px;">Email</th>
                                    <th style="font-size: 11px;">Kode Pos</th>
                                    <th style="font-size: 11px;">No Telp Kantor</th>
                                    <th style="font-size: 11px;">Pendidikan Terakhir</th>
                                    <th style="font-size: 11px;">Perusahaan</th>
                                    <th style="font-size: 11px;">Jabatan</th>
                                    <th style="font-size: 11px;">Alamat Pekerjaan</th>
                                    <th style="font-size: 11px;">Kode Pos Perusahaan</th>
                                    <th style="font-size: 11px;">No Fax Perusahaan</th>
                                    <th style="font-size: 11px;">No Kantor Pekerjaan</th>
                                    <th style="font-size: 11px;">Email Perusahaan</th>
                                    <!-- <th style="font-size: 11px;">Pas Foto</th> -->
                                    <!-- <th style="font-size: 11px;">Tanda Tangan</th> -->
                                    <th style="font-size: 11px;">Pilihan Skema</th>
                                    <th style="font-size: 11px;">Tujuan Sertifikasi</th>
                                    <!-- <th style="font-size: 11px;">KTM</th>
                                    <th style="font-size: 11px;">Transkrip Nilai</th>
                                    <th style="font-size: 11px;">KTP/SIM</th>
                                    <th style="font-size: 11px;">Sertifikat Pelatihan</th>
                                    <th style="font-size: 11px;">Pengalaman Kerja</th>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 1</th>
                                    <th style="font-size: 11px;">Keterangan Dokumen Relevan 1</th>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 2</th>
                                    <th style="font-size: 11px;">Keterangan Dokumen Relevan 2</th>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 3</th>
                                    <th style="font-size: 11px;">Keterangan Dokumen Relevan 3</th>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 4</th>
                                    <th style="font-size: 11px;">Keterangan Dokumen Relevan 4</th>
                                    <th style="font-size: 11px;">Bukti Kompetensi Relevan 5</th>
                                    <th style="font-size: 11px;">Keterangan Dokumen Relevan 5</th> -->
                                    <th style="font-size: 11px;">Tanggal Pengajuan</th>
                                    <th style="font-size: 11px;">Tanggal Diterima</th>
                                    <!-- <th style="font-size: 11px;">Kelengkapan Dokumen</th> -->
                                    <!-- <th style="font-size: 11px;">Status Diterima</th> -->
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>