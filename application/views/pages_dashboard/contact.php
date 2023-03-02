<!-- section -->
<div id="contact" class="contact-box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="full center margin-bottom_30">
                    <div class="heading_main text_align_center">
                        <h2><span class="theme_color">LSP</span> Politeknik Caltex Riau</h2>
                        <p class="large">Hubungi Kami</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-7 col-sm-7 col-xs-12">
                <?php if (($this->session->flashdata('pesan'))) {
                    $this->session->flashdata('pesan');
                } ?>
                <div class="contact">
                    <form action="<?php echo base_url('Dashboard/AddPesan') ?>" method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" style="display: none">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" style="background-color: gainsboro;" id="nama" name="nama" placeholder="Nama Lengkap" required data-error="Nama Wajib diisi !">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" placeholder="Valid Email" id="email" style="background-color: gainsboro;" class="form-control" name="email" required data-error="Email Wajib diisi !">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" id="isi_pesan" name="isi_pesan" style="background-color: gainsboro;" placeholder="Pesan Anda" rows="8" data-error="Tuliskan pesan anda" required></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                                <div class="submit-button text-center">
                                    <button class="btn btn-common" type="submit"><span class="fa fa-send"></span> Kirimkan </button>
                                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="col-lg-5 col-sm-5 col-xs-12">
                <div class="left-contact">
                    <div class="media cont-line">
                        <div class="media-left icon-b">
                            <i class="fa fa-location-arrow" aria-hidden="true"></i>
                        </div>
                        <div class="media-body dit-right">
                            <h4>Alamat</h4>
                            <p>Jl. Umbansari (Patin) No.1 Rumbai, Pekanbaru, Riau 28265</p>
                        </div>
                    </div>
                    <div class="media cont-line">
                        <div class="media-left icon-b">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <div class="media-body dit-right">
                            <h4>Email</h4>
                            <a href="#">lsp@pcr.ac.id</a>
                        </div>
                    </div>
                    <div class="media cont-line">
                        <div class="media-left icon-b">
                            <i class="fa fa-volume-control-phone" aria-hidden="true"></i>
                        </div>
                        <div class="media-body dit-right">
                            <h4>Phone Number</h4>
                            <a href="#">Telp : (0761) 53803</a><br>
                            <a href="#">Fax : (0761) 53803</a>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- end section -->
<!-- <div style="position:fixed;left:17px;bottom:40px;">
    <a style="background:blue;vertical-align:center;height:36px;border-radius:5px" class="btn btn-primary" href="<?php echo base_url('pintu_masuk') ?>" title="Contact Us" target="_top">
        <small style="font-size:12px;"> Daftar Sertifikasi Sekarang !</small>
    </a>
</div> -->