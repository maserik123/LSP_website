<style>
    .scroll {
        display: block;
        /* border: 1px solid red; */
        padding: 5px;
        /* width: 300px; */
        height: 300px;
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
                    Daftar Skema <br>
                    <small>Skema Sertifikasi yang tersedia di LSP Politeknik Caltex Riau.</small>
                </legend>

            </div>
        </div>
    </div>
    <?php if (empty($getDataSkema)) { ?>
        <div class="row">
            <div id="acct-password-row" class="span16">
                <h5>Belum ada data skema yang ditambahkan !</h5>
            </div>
        </div>
    <?php } else { ?>
        <div class="row">
            <?php foreach ($getDataSkema as $row) { ?>
                <?php $getIdSkema = $this->M_unit_kompetensi->getDataByIdSkema($row->id) ?>
                <div id="acct-password-row" class="span5">
                    <div class="box pattern pattern-sandstone">
                        <div class="box-header">
                            <i class="icon-certificate" style="color: green;"></i>
                            <h5 style="font-size: 12px;">
                                <?php echo str_cut($row->judul_skema, 2); ?>
                            </h5>
                        </div>
                        <div class="box-content box-table scroll">
                            <table id="sample-table" class="table table-hover table-bordered tablesorter">
                                <thead>
                                    <tr>
                                        <th style="font-size: 11px;">Skema</th>
                                        <td style="font-size: 11px;" colspan="3"><?php echo str_cut($row->judul_skema, 5); ?></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th style="font-size: 11px;">No</th>
                                        <th style="font-size: 11px;">Kode Unit</th>
                                        <th style="font-size: 11px;">Judul Unit</th>
                                        <th style="font-size: 11px;">Standar</th>
                                    </tr>
                                    <?php $no = 0;
                                    foreach ($getIdSkema as $r) { ?>
                                        <tr>
                                            <td style="font-size: 11px;">
                                                <?php
                                                echo ++$no; ?>
                                            </td>
                                            <td style="font-size: 11px;">
                                                <?php echo $r->kode_unit; ?>
                                            </td>
                                            <td style="font-size: 11px;">
                                                <?php echo $r->judul_unit; ?>
                                            </td>
                                            <td style="font-size: 11px;">
                                                <?php echo $r->jenis_standar; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</section>