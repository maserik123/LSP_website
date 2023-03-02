<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        header {
            position: fixed;
        }

        body {
            margin-top: 3.5cm;
        }

        .page-number:after {
            content: counter(page);
        }
    </style>
    <style>
        table {
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</head>

<body>

    <header>
        <table border="0.1px" style="font-family: Arial, Helvetica, sans-serif;" width="100%">
            <tbody>
                <tr>
                    <td style="text-align: center;" rowspan="4" width="100px" height="50px"> <strong style="font-size:15px;">LSP P1 - <br> Politeknik <br> Caltex Riau </strong>
                        <br>
                        <img src="<?php echo 'assets_matrix/img/logo_pcr.png'; ?>" width="100px" height="15px" alt="">
                    </td>
                    <td style="text-align: center;" rowspan="4" width="160px" height="50px">
                        <span style="font-size: 20px; font-weight: bold;color: green;">FORMULIR</span>
                        <hr>
                        <span style="font-size: 13px; font-weight: bold;">PERMOHONAN <br> SERTIFIKASI <br> KOMPETENSI</span>
                    </td>
                    <td style="width: 80px;font-size: 12px;font-weight: bold;">No. Dokumen</td>
                    <td style="width: 5px;font-size: 12px;">:</td>
                    <td style="width: 120px;font-size: 12px;text-align: center;">FR-APL-02/I/2014</td>
                </tr>
                <tr>
                    <td style="width: 150px;font-size: 12px;font-weight: bold;" height="9px">Edisi/Revisi</td>
                    <td style="width: 5px;font-size: 12px;">:</td>
                    <td style="width: 150px;font-size: 12px;text-align:center">01/01</td>
                </tr>
                <tr>
                    <td style="width: 150px;font-size: 12px;font-weight: bold;" height="9px">Berlaku Sejak</td>
                    <td style="width: 5px;font-size: 12px;">:</td>
                    <td style="width: 150px;font-size: 12px;text-align: center;">September 2016</td>
                </tr>
                <tr>
                    <td style="width: 150px;font-size: 12px;font-weight: bold;" height="9px">Halaman</td>
                    <td style="width: 5px;font-size: 12px;">:</td>
                    <td style="width: 150px;font-size: 12px;text-align:center">
                        <?php $halaman = '<span class="page-number"> </span>';
                        echo $halaman;
                        ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
    </header>
    <table border="0.1px" style="font-family: Arial, Helvetica, sans-serif;font-size:13px" width="100%">
        <thead>
            <tr>
                <td>
                    <label for="">
                        <span style="font-weight: bold;">Hak Pemohon :</span>
                    </label>
                    <ol>
                        <li>Memperoleh penjelasan tentang gambaran proses sertifikasi sesuai dengan skema sertifikasi.</li>
                        <li>Mendapatkan hak bertanya berkaitan dengan kompetensi.</li>
                        <li>Memperoleh pemberitahuan tentang kesempatan untuk menyatakan, dengan alasan, permintaan untuk disediakan kebutuhan khusus sepaniang integritas asesmen tidak dilanggar, serta mempertimbangkan aturan yang bersifat Nasional.</li>
                        <li>Memperoleh hak banding terhadap keputusan Sertifikasi.</li>
                        <li>Memperoleh sertifikat kompetensi jika dinyatakan kompeten.</li>
                        <li>Menggunakan sertifikat untuk promosi diri sesuai kompetensi.</li>
                    </ol>
                </td>
            </tr>
        </thead>
    </table>
    <div style="font-family: Arial, Helvetica, sans-serif;font-size:13px">
        <h3>Bagian 1 : Rincian Data Pemohon Sertifikasi</h3>
        <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan anda saat ini.</p>
        <h4>a. Data Pribadi</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th style="padding:6px;width:160px;border-color: white;text-align:left">Nama Lengkap</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_nama_lengkap; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">NIK (No. KTP)</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_nik; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Tempat / Tgl. Lahir</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_tempat_lahir . ' / ' . tgl_indo($getDataDiri->dd_tgl_lahir); ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Jenis Kelamin</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_jenis_kelamin; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Kebangsaan</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_kebangsaan; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Alamat Rumah</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_alamat_rumah; ?> <small>(<strong>Kode Pos :</strong> <?php echo $getDataDiri->dd_kode_pos; ?>)</small></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Kontak (Telp/Email)</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="font-size:12px;height:50px;border-color: white;text-align:left"> (<strong>No Hp : </strong><?php echo $getDataDiri->dd_no_hp; ?>) / (<strong>Rumah : </strong><?php echo $getDataDiri->dd_no_telp; ?>) / (<strong>Kantor</strong> : <?php echo $getDataDiri->dd_kantor; ?>) / <strong>Email</strong> : <?php echo $getDataDiri->dd_email; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Pendidikan Terakhir</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->dd_pendidikan_terakhir; ?></td>
                </tr>
            </thead>
        </table>
    </div>
    <div style="font-family: Arial, Helvetica, sans-serif;font-size:13px">
        <h4>b. Data Pekerjaan Sekarang</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th style="padding:6px;width:160px;border-color: white;text-align:left">Nama Lembaga</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->k_lembaga; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Jabatan</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="border-color: white;text-align:left"><?php echo $getDataDiri->k_jabatan; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Alamat</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="font-size:12px;border-color: white;text-align:left"><strong>Alamat Perusahaan : </strong><?php echo $getDataDiri->k_alamat; ?> / <strong>Kode Pos : </strong><?php echo $getDataDiri->k_kode_pos; ?></td>
                </tr>
                <tr>
                    <th style="padding:6px;border-color: white;text-align:left">Kontak</th>
                    <th style="width:20px;border-color: white;text-align:left">:</th>
                    <td style="font-size:12px;border-color: white;text-align:left"><strong>Telepon : </strong> <?php echo $getDataDiri->k_telp ?> / <strong>No. Fax : </strong><?php echo $getDataDiri->k_fax; ?> / <strong>Email : </strong> <?php echo $getDataDiri->k_email; ?></td>
                </tr>

            </thead>
        </table>
    </div>
    <br>
    <div style="font-family: Arial, Helvetica, sans-serif;font-size:13px">
        <h3>Bagian 2 : Data Sertifikasi</h3>
        <p>Tuliskan Judul dan Nomor Sertifkasi, Tujuan Asesmen serta Daftar Unit Kompetensi sesuai kemasan pada skema sertifikasi yang diajukan untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan dan pengalaman kerja yang anda miliki.</p>
        <h4>a. Data Pribadi</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th style="padding:6px;width:160px;text-align:left" rowspan="2">Skema Sertifikasi / Klaster Asesmen</th>
                    <th style="width:30px;text-align:left">Judul</th>
                    <th style="width:10px;text-align:left">:</th>
                    <td style="text-align:left"><?php echo $getDataDiri->judul_skema; ?></td>

                </tr>
                <tr>
                    <th style="padding:6px;width:30px;text-align:left">Nomor</th>
                    <th style="width:10px;text-align:left">:</th>
                    <th style="width:20px;text-align:left"><?php echo $getDataDiri->no_skema ?></th>
                </tr>
                <tr>
                    <th style="padding:6px;width:160px;text-align:left" colspan="2">Tujuan Asesmen</th>
                    <th style="width:10px;text-align:left">:</th>
                    <th style="text-align:left"><?php echo $getDataDiri->tujuan_sertifikasi; ?></th>
                </tr>
            </thead>
        </table>

        <h4>Daftar Unit Kompetensi</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Unit</th>
                    <th>Judul Unit</th>
                    <th>Jenis standar (Standar Khusus / Standar Internasional / SKKNI) </th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 0;
                $getSkema = $this->M_unit_kompetensi->getDataByIdSkema($getDataDiri->id_skema); ?>
                <?php foreach ($getSkema as $r) { ?>
                    <tr>
                        <td style="text-align: center;"><?php echo ++$no; ?></td>
                        <td><?php echo $r->kode_unit; ?></td>
                        <td style="text-align: center;"><?php echo $r->judul_unit; ?></td>
                        <td style="text-align: center;"><?php echo $r->jenis_standar; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div style="font-family: Arial, Helvetica, sans-serif;font-size:13px">
        <h3>Bagian 3 : Bukti Kelengkapan Pemohon</h3>
        <h4>a. Bukti Kelengkapan Persyaratan dasar pemohon :</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Bukti Persyaratan</th>
                    <th colspan="2">Ada *)</th>
                    <th rowspan="2">Tidak Ada *)</th>
                </tr>
                <tr>
                    <th>Memenuhi Syarat</th>
                    <th>Tidak Memenuhi Syarat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td><label>Fotokopi :</label>
                        <ul>
                            <li>Kartu Tanda Mahasiswa (KTM)</li>
                            <li>Transkrip Nilai minimal Semester 3 Mahasiswa D-3 Teknik Komputer, D-4 Teknik Informatika, dan D-4 Sistem Informasi, atau</li>
                        </ul>
                    </td>
                    <td style="text-align: center;">
                        <?php echo (!empty($getDataDiri->upload_ktm) ? 'Ya' : '-') ?><br><br>
                        <?php echo (!empty($getDataDiri->upload_transkrip) ? 'Ya' : '-') ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo (empty($getDataDiri->upload_ktm) ? 'Ya' : '-') ?><br><br>
                        <?php echo (empty($getDataDiri->upload_transkrip) ? 'Ya' : '-') ?>
                    </td>
                    <td style="text-align: center;"></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td><label>Fotokopi :</label>
                        <ul>
                            <li>Kartu Tanda Penduduk (KTP) atau Surat Izin Mengemudi (SIM)</li>
                            <li>Sertifikat pelatihan programmer yang dikeluarkan oleh PCR, atau</li>
                            <li>Surat pengalaman kerja minimal 2 tahun pada jabatan programmer dari industri mitra PCR</li>
                        </ul>
                    </td>
                    <td style="text-align: center;">
                        <?php echo (!empty($getDataDiri->upload_ktp_sim) ? 'Ya' : '-') ?><br><br>
                        <?php echo (!empty($getDataDiri->sertifikat_pelatihan) ? 'Ya' : '-') ?><br><br>
                        <?php echo (!empty($getDataDiri->upload_pengalaman_kerja) ? 'Ya' : '-') ?>
                    </td>
                    <td style="text-align: center;">
                        <?php echo (empty($getDataDiri->upload_ktp_sim) ? 'Ya' : '-') ?><br><br>
                        <?php echo (empty($getDataDiri->sertifikat_pelatihan) ? 'Ya' : '-') ?><br><br>
                        <?php echo (empty($getDataDiri->upload_pengalaman_kerja) ? 'Ya' : '-') ?>
                    </td>
                    <td style="text-align: center;"></td>
                </tr>
            </tbody>
        </table>

        <h4>b. Bukti Kompetensi yang Relevan</h4>
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <thead>
                <tr>
                    <th rowspan="2">No</th>
                    <th rowspan="2">Rincian Bukti Pendidikan/Pelatihan, Pengalaman Kerja, Pengalaman Hidup</th>
                    <th colspan="2">Lampiran Bukti *)</th>
                </tr>
                <tr>
                    <th>Ada</th>
                    <th>Tidak Ada</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align: center;">1</td>
                    <td style="text-align: center;"><?php echo $getDataDiri->upload_bukti_relevan_1 ?></td>
                    <td style="text-align: center;"><?php echo !empty($getDataDiri->upload_bukti_relevan_1) ? 'Ya' : '-' ?></td>
                    <td style="text-align: center;"><?php echo empty($getDataDiri->upload_bukti_relevan_1) ? 'Ya' : '-' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">2</td>
                    <td style="text-align: center;"><?php echo $getDataDiri->upload_bukti_relevan_2 ?></td>
                    <td style="text-align: center;"><?php echo !empty($getDataDiri->upload_bukti_relevan_2) ? 'Ya' : '-' ?></td>
                    <td style="text-align: center;"><?php echo empty($getDataDiri->upload_bukti_relevan_2) ? 'Ya' : '-' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">3</td>
                    <td style="text-align: center;"><?php echo $getDataDiri->upload_bukti_relevan_3 ?></td>
                    <td style="text-align: center;"><?php echo !empty($getDataDiri->upload_bukti_relevan_3) ? 'Ya' : '-' ?></td>
                    <td style="text-align: center;"><?php echo empty($getDataDiri->upload_bukti_relevan_3) ? 'Ya' : '-' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">4</td>
                    <td style="text-align: center;"><?php echo $getDataDiri->upload_bukti_relevan_4 ?></td>
                    <td style="text-align: center;"><?php echo !empty($getDataDiri->upload_bukti_relevan_4) ? 'Ya' : '-' ?></td>
                    <td style="text-align: center;"><?php echo empty($getDataDiri->upload_bukti_relevan_4) ? 'Ya' : '-' ?></td>
                </tr>
                <tr>
                    <td style="text-align: center;">5</td>
                    <td style="text-align: center;"><?php echo $getDataDiri->upload_bukti_relevan_5; ?></td>
                    <td style="text-align: center;"><?php echo (!empty($getDataDiri->upload_bukti_relevan_5) ? 'Ya' : '-'); ?></td>
                    <td style="text-align: center;"><?php echo (empty($getDataDiri->upload_bukti_relevan_5) ? 'Ya' : '-'); ?></td>
                </tr>
            </tbody>
        </table>
        <h4>*) Diisi oleh LSP</h4>
        <p style="font-weight: bold;">"Saya menjamin bahwa seluruh pernyataan dan informasi yang diberikan adalah TERBARU, BENAR dan DAPAT DIPERTANGGUNG JAWABKAN."</p>
    </div>
    <div style="font-family: Arial, Helvetica, sans-serif;font-size:13px">
        <table style="font-family: Arial, Helvetica, sans-serif;font-size:14px" width="100%">
            <tr>
                <th style="text-align: left;" rowspan="3">Rekomendasi (diisi oleh LSP):
                    Berdasarkan ketentuan persyaratan dasar pemohon, pemohon:
                    Diterima / Tidak Diterima*) sebagai peserta sertifikasi
                    *) coret yang tidak sesuai</th>
                <th colspan="2">Pemohon</th>
            </tr>
            <tr>
                <th>
                    Nama
                </th>
                <th><?php echo $getDataDiri->dd_nama_lengkap; ?></th>
            </tr>
            <tr>
                <th>
                    Tanda Tangan / Tanggal
                </th>
                <th><img src="<?php echo 'g_ttd_asesi/' . $getDataDiri->tanda_tangan_asesi; ?>" width="100px" height="80px"><br><br><?php echo tgl_indo($getDataDiri->tanggal_pengajuan); ?></th>
            </tr>


            <tr>
                <th rowspan="4">Catatan : <br> <?php echo $getDataDiri->keterangan_status; ?></th>
                <th colspan="2">Admin LSP :</th>
            </tr>
            <tr>
                <th>
                    Nama
                </th>
                <?php $cekDataByIdUser = $this->M_data_admin->cekDataByIdUser($getDataDiri->id_user_admin); ?>
                <th><?php echo $cekDataByIdUser[0]->nama_lengkap; ?></th>
            </tr>
            <tr>
                <th>
                    NIK LSP
                </th>
                <th><?php echo $getDataDiri->nik_lsp; ?></th>
            </tr>
            <tr>
                <th>Tanda Tangan / Tanggal :</th>
                <th><img src="<?php echo 'g_ttd_admin/' . $getDataDiri->tanda_tangan_admin; ?>" width="100px" height="80px"><br><br><?php echo tgl_indo($getDataDiri->tanggal_pengajuan); ?></th>
            </tr>
        </table>
    </div>
    <br>
</body>

</html>