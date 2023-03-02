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
    <!-- Table untuk menampilkan data dan pilihan skema asesi -->
    <table border="0.1px" style="font-family: Arial, Helvetica, sans-serif;" width="100%">
        <tbody>
            <tr>
                <td rowspan="2" style="width: 150px;font-size: 14px;font-weight: bold;">Skema Sertifikasi/ <br> Klaster Asesmen</td>
                <td style="width: 70px;font-size: 14px;font-weight: bold;">Judul</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo $getSkemaAsesi->judul_skema; ?></td>
            </tr>
            <tr>
                <td style="width: 70px;font-size: 14px;font-weight: bold;">Nomor</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo $getSkemaAsesi->no_skema; ?></td>

            </tr>
            <tr>
                <td colspan="2" style="width: 150px;font-size: 14px;font-weight: bold;">TUK</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo $getSkemaAsesi->tuk; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 150px;font-size: 14px;font-weight: bold;">Nama Asesor</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo $getSkemaAsesi->nama_asesor; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 150px;font-size: 14px;font-weight: bold;">Nama Peserta</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo $getSkemaAsesi->nama_asesi; ?></td>
            </tr>
            <tr>
                <td colspan="2" style="width: 150px;font-size: 14px;font-weight: bold;">Tanggal</td>
                <td style="width: 5px;font-size: 13px;text-align:center;">:</td>
                <td style="width: 250px;font-size: 13px;text-align:center"><?php echo tgl_indo($getSkemaAsesi->tanggal); ?></td>
            </tr>
        </tbody>
    </table>
    <label for=""><small style="font-size: 12px;">*Coret yang tidak perlu</small></label>
    <br>
    <ul style="font-size: 15px;">
        <label for="" style="font-weight: bold;">Peserta diminta untuk :</label>
        <li>Mempelajari Kriteria Unjuk Kerja (KUK), Batasan Variabel, Panduan Penilaian, dan Aspek Kritis seluruh Unit Kompetensi yang diminta untuk di Ases.</li>
        <li>Melaksanakan Penilaian Mandiri secara obyektif atas sejumlah pertanyaan yang diajukan, bilamana Anda menilai diri sudah kompeten atas pertanyaan tersebut, tuliskan tanda √ pada kolom (K), dan bilamana Anda menilai diri belum kompeten tuliskan tanda √ pada kolom (BK). </li>
        <li>Mengisi bukti-bukti kompetensi yang relevan atas sejumlah pertanyaan yang dinyatakan kompeten (bila ada).</li>
        <li>Menandatangani form Asesmen Mandiri.</li>
    </ul>

    <?php
    $i = 0;
    $j = 0;
    foreach ($getDataByIdPilihanSkema as $row) { ?>

        <?php
        if (empty($row->judul_unit_kompetensi)) {
        } else { ?>
            <br>
            <!-- Tabel untuk menampilkan unit kompetensi -->
            <table border="0.1" style="font-family: Arial, Helvetica, sans-serif;font-size: 14px;" width="100%">
                <tr>
                    <th style="text-align: center;" rowspan="2">Unit Kompetensi <br> No. <?php echo ++$j; ?></th>
                    <td>Kode Unit</td>
                    <td>:</td>
                    <td style="text-align: left;font-weight:bold;"><?php echo $row->kode_unit; ?></td>
                </tr>
                <tr>
                    <td>Judul Unit</td>
                    <td>:</td>
                    <td style="text-align: left;font-weight:bold;"><?php echo $row->judul_unit_kompetensi; ?></td>
                </tr>
            </table>

        <?php } ?>

        <!-- Tabel untuk menampilkan elemen kompetensi dan pertanyaan -->

        <table border="0.1" style="font-family: Arial, Helvetica, sans-serif;font-size: 13px;" width="100%">
            <thead>
                <?php if (empty($row->judul_unit_elemen)) {
                } else { ?>
                    <tr>
                        <th colspan="2" style="font-weight: bold;height: 40px;">Elemen Kompetensi</th>
                        <th style="font-weight: bold;">:</th>
                        <th style="font-weight: bold;text-align: left;" colspan="6"><?php echo ++$i . '. ' . $row->judul_unit_elemen; ?></th>
                    </tr>
                <?php } ?>
                <tr>
                    <th rowspan="2" style="background-color: #B0C4DE;" width="50px">Nomor KUK</th>
                    <td rowspan="2" style="background-color: #B0C4DE;" style="text-align: center;"><strong>Daftar Pertanyaan</strong> <br> <small>(Asesmen Mandiri/Self Assesment)</small></td>
                    <th colspan="2" style="background-color: #B0C4DE;">Penilaian</th>
                    <th rowspan="2" style="background-color: #B0C4DE;">Bukti-bukti Kompetensi</th>
                    <th colspan="4" style="background-color: #B0C4DE;">Diisi Asesor</th>
                </tr>
                <tr>
                    <th style="background-color: #B0C4DE;" width="30px">K</th>
                    <th style="background-color: #B0C4DE;" width="30px">BK</th>
                    <th style="background-color: #B0C4DE;" width="30px">V</th>
                    <th style="background-color: #B0C4DE;" width="30px">A</th>
                    <th style="background-color: #B0C4DE;" width="30px">T</th>
                    <th style="background-color: #B0C4DE;" width="30px">M</th>
                </tr>
            </thead>
            <tbody>
                <?php $getPertanyaanByUnitElemen = $this->M_apl_02->getPertanyaanByUnitElemen($row->id_unit_elemen); ?>
                <?php $no = 0;
                foreach ($getPertanyaanByUnitElemen as $r) { ?>
                    <tr>
                        <td style="text-align: center;font-weight:bold;"><?php echo $i . '.' . ++$no; ?></td>
                        <td><?php echo $r->daftar_pertanyaan; ?></td>
                        <td style="text-align: center;font-size: 12px;"><?php echo $r->penilaian_kompeten == 'Kompeten' ? 'Ya' : '' ?></td>
                        <td style="text-align: center;font-size: 12px;"><?php echo $r->penilaian_kompeten == 'Belum Kompeten' ? 'Ya' : '' ?></td>
                        <td><?php echo $r->bukti_kompeten; ?></td>
                        <td style="text-align: center;font-size:12px;"><?php echo $r->asesor_v == 1 ? 'Ya' : ''; ?></td>
                        <td style="text-align: center;font-size:12px;"><?php echo $r->asesor_a == 1 ? 'Ya' : ''; ?></td>
                        <td style="text-align: center;font-size:12px;"><?php echo $r->asesor_t == 1 ? 'Ya' : ''; ?></td>
                        <td style="text-align: center;font-size:12px;"><?php echo $r->asesor_m == 1 ? 'Ya' : ''; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <br>
    <?php } ?>
    <br>
    <table style="font-family: Arial, Helvetica, sans-serif;font-size: 13px;" width="100%">
        <tr>
            <th rowspan="3" style="width: 350px;text-align: left;font-size:14px">
                <label for="">Rekomendasi Asesor :</label>
                <ol>
                    <li>
                        Peserta TELAH / BELUM menyatakan dirinya kompeten untuk seluruh Pertanyaan Assesmen Mandiri. Bila BELUM, lanjut ke no 4.
                    </li>
                    <li>
                        Penilaian atas bukti-bukti kompetensi yang diajukan peserta yang menyatakan dirinya kompeten teridentifikasi TELAH/BELUM memenuhi Aturan bukti
                    </li>
                    <li>
                        Proses Asesmen dapat dilanjutkan melalui : <br>
                        <ul>
                            <li>Asesmen Portofolio</li>
                            <li>Uji Kompetensi</li>
                        </ul>
                    </li>
                    <li>
                        Agar peserta dipanggil kembali oleh Sekretariat LSP untuk diminta penjelasan
                    </li>
                </ol>
            </th>
            <th colspan="2" style="font-size: 15px;">Peserta : </th>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo $getSkemaAsesi->nama_asesi; ?></td>
        </tr>
        <tr>
            <th>Tanda Tangan</th>
            <td style="text-align: center;"><img src="<?php echo 'g_ttd_asesi/' . $getSkemaAsesi->tanda_tangan_asesi; ?>" width="100px" height="80px"><br><br><?php echo tgl_indo($getSkemaAsesi->tanggal_tanda_tangan_asesi); ?></td>
        </tr>
        <tr>
            <th></th>
            <th colspan="2">Asesor : </th>
        </tr>
        <tr>
            <th style="text-align: left;" rowspan="3">
                <label for="">Catatan :</label>
                <p>ASESMEN PORTOFOLIO</p>
                <p>Pada Unit Kompetensi : <?php echo empty($getSkemaAsesi->catatan_asesmen_portofolio) ? '........................' : $getSkemaAsesi->catatan_asesmen_portofolio; ?></p>
                <br>
                <p>UJI KOMPETENSI :</p>
                <p>Pada unit kompetensi : <?php echo empty($getSkemaAsesi->catatan_uji_kompetensi) ? '........................' : $getSkemaAsesi->catatan_uji_kompetensi; ?></p>
            </th>
            <th>Nama </th>
            <td style="text-align: center;"><?php echo $getSkemaAsesi->nama_asesor; ?></td>
        </tr>
        <tr>
            <th>No. Reg.</th>
            <td style="text-align: center;"><?php echo $getSkemaAsesi->no_reg; ?></td>
        </tr>
        <tr>
            <th>Tanda Tangan / Tanggal</th>
            <td style="text-align: center;"><img src="<?php echo 'g_ttd_asesor/' . $getSkemaAsesi->tanda_tangan_asesor; ?>" width="100px" height="80px"><br><br><?php echo tgl_indo($getSkemaAsesi->tanggal_tanda_tangan_asesor); ?></td>
        </tr>
    </table>


</body>

</html>