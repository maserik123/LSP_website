<script src="<?php echo base_url('assets_matrix/') ?>js/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="container-fluid">
    <div class="row-fluid">
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Jadwal Pendaftaran</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table ">
                    <thead>
                        <tr>
                            <th style="font-size: 11px;">No</th>
                            <th style="font-size: 11px;">Judul Skema</th>
                            <th style="font-size: 11px;">Mulai Pendaftaran</th>
                            <th style="font-size: 11px;">Tutup Pendaftaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0;
                        foreach ($getDataJadwal as $row) { ?>
                            <tr>
                                <td style="font-size: 11px;"><?php echo ++$no; ?></td>
                                <td style="font-size: 11px;"><?php echo $row->judul_skema; ?></td>
                                <td style="font-size: 11px;"><?php echo tgl_indo($row->mulai_daftar); ?></td>
                                <td style="font-size: 11px;"><?php echo ($row->akhir_daftar < date('Y-m-d') ? 'Pendaftaran sudah ditutup' : tgl_indo($row->akhir_daftar)); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>