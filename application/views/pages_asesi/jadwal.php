<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        margin-top: 5px;
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
<section class="page container" id="page">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Jadwal Pendaftaran <br>
                    <small>Jadwal Pendaftaran dari masing-masing skema</small>
                </legend>
            </div>
        </div>
    </div>
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <div class="row">
        <?php foreach ($getJadwal as $row) { ?>
            <div id="acct-password-row" class="span8">
                <div class="box pattern pattern-sandstone ">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5>
                            Jadwal Pendaftaran
                        </h5>
                    </div>
                    <div class="box-content box-table scroll">
                        <table id="sample-table" class="table table-hover table-bordered tablesorter ">
                            <tbody>
                                <tr>
                                    <th style="font-size: 11px;">Judul Skema</th>
                                    <td style="font-size: 11px;">
                                        <label for="" class="label" style="background-color: cadetblue;text-align: center;color:black"> <?php echo $row->judul_skema ?></label>
                                    </td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Pendaftaran dibuka</th>
                                    <td style="font-size: 11px;"><?php echo tgl_indo($row->mulai_daftar); ?></td>
                                </tr>
                                <tr>
                                    <th style="font-size: 11px;">Pendaftaran ditutup</th>
                                    <td style="font-size: 11px;"><?php echo tgl_indo($row->akhir_daftar); ?></td>
                                </tr>
                                <?php
                                $tgl1 = new DateTime(date('Y-m-d'));
                                $tgl2 = new DateTime($row->akhir_daftar);
                                $d = $tgl2->diff($tgl1)->days; ?>
                                <tr>
                                    <th style="font-size: 11px;">Sisa Waktu Pendaftaran</th>
                                    <td style="font-size: 11px;"><?php echo date('Y-m-d') <= $row->akhir_daftar ? $d . ' Hari Lagi' : '<div style="color:red;">Telah Berakhir</div>'; ?> </td>
                                </tr>
                                <!-- <tr>
                                    <th style="font-size: 11px;">Tanggal Pelaksanaan</th>
                                    <td style="font-size: 11px;"><?php echo tgl_indo($row->tanggal_pelaksanaan); ?></td>
                                </tr> -->

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</section>