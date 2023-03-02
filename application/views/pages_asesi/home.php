<?php if (!$checkUserOnAsesi) { ?>

    <script type="text/javascript">
        $(document).ready(function() {
            setInterval(() => {
                swal({
                    title: "Hallo <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>",
                    type: "info",
                    // imageUrl: "<?php echo base_url() ?>assets/images/user.png",
                    text: "Silahkan lengkapi data diri anda terlebih dahulu pada bagian menu data diri. Pesan ini akan otomatis hilang apabila anda telah melengkapi data diri anda.",
                    showCancelButton: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Oke",
                    closeOnConfirm: false
                });
            }, 3500);

            setInterval(() => {

                window.location = '<?php echo base_url('data_diri'); ?>'
            }, 8500);
        });
    </script>

<?php } else {
} ?>
<section class="page container">
    <div class="row">
        <div class="span16">
            <div class="">
                <legend class="lead">
                    Hello, <?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name'); ?>
                </legend>
                <p>
                    Sistem informasi LSP Politeknik Caltex Riau merupakan aplikasi yang digunakan untuk mendukung proses berjalannya sertifikasi profesi di Politeknik Caltex Riau.
                </p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="span4">
            <div class="box pattern pattern-sandstone">
                <div class="box-header">
                    <i class="fa fa-user"></i>
                    <h5>Cek Data Diri</h5>
                </div>
                <div class="box-content box-list collapse in">
                    <ul>
                        <?php if (!$checkUserOnAsesi) { ?>
                            <li>
                                <div>
                                    <a href="#" class="news-item-title badge" style="background-color: red;">Anda belum mengisi data diri !</a>
                                    <br><small class="news-item-preview">Silahkan lengkapi data diri anda terlebih dahulu.</small>
                                </div>
                            </li>
                        <?php } else { ?>

                            <li>
                                <div>
                                    <a href="#" class="news-item-title badge" style="background-color: blue;">Anda menyelesaikan seluruh task !</a><br>
                                    <small class="news-item-preview">Terimakasih, anda sudah melengkapi data diri.</small>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="span7">
            <div class="box pattern pattern-sandstone">
                <div class="box-header">
                    <i class="icon-list"></i>
                    <h5>Daftar skema yang diikuti</h5>

                </div>
                <div class="box-content box-list collapse in">
                    <?php if (empty($getPilihanSkema)) { ?>
                        <ul>
                            <li>
                                <div>
                                    <!-- <a href="#" class="news-item-title">Anda belum mengisi data diri !</a> -->
                                    <p class="news-item-preview" style="color:red;">Belum ada sertifikasi aktif yang sedang diikuti ! </p>
                                </div>
                            </li>
                        </ul>
                    <?php } else { ?>
                        <ul>
                            <?php foreach ($getPilihanSkema as $row) { ?>
                                <li>
                                    <?php
                                    $cekAsesmen = $this->M_apl_02_finish->getDataByIdPilSkema($row->id_ps);
                                    $cekByIdPilihanSkema = $this->M_apl_02->cekByIdPilihanSkema($row->id_ps);
                                    ?>
                                    <div>
                                        <!-- <a href="#" class="news-item-title">Anda belum mengisi data diri !</a> -->
                                        <a href="<?php echo base_url('apl_02'); ?>" class="news-item-preview" style="color:green;"><?php echo $row->judul_skema; ?>
                                            <br> <small>
                                                <?php echo empty($cekByIdPilihanSkema[0]->id_pilihan_skema) ? '<div class="btn btn-danger badge btn-sm" style="font-size:10px">Belum asesmen mandiri</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (!empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-info badge btn-sm" style="font-size:10px">Asesmen telah diases asesor</div>' : ((!empty($cekByIdPilihanSkema[0]->id_pilihan_skema)) && (empty($cekAsesmen->tanda_tangan_asesor)) ? '<div class="btn btn-warning badge btn-sm" style="font-size:10px">Belum diases oleh asesor</div>' : '')); ?>
                                            </small>
                                        </a>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="span5">
            <div class="box">
                <div class="box-header">
                    <i class="icon-book"></i>
                    <h5>Pemberitahuan</h5>
                </div>
                <div class="box-content">
                    <?php if (empty($getPemberitahuan)) {
                        echo "Belum ada pemberitahuan..";
                    } else { ?>
                    <?php foreach ($getPemberitahuan as $r) {
                            echo $r->pemberitahuan;
                        }
                    } ?>
                </div>

            </div>
        </div>
    </div>
</section>
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
                <div class="box pattern pattern-sandstone">
                    <div class="box-header">
                        <i class="icon-certificate" style="color: green;"></i>
                        <h5>
                            Jadwal Pendaftaran
                        </h5>
                    </div>
                    <div class="box-content box-table">
                        <table id="sample-table" class="table table-hover table-bordered tablesorter">
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