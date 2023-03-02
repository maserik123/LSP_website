 <!-- Start Banner -->
 <div class="ulockd-home-slider">
     <div class="container-fluid">
         <div class="row">
             <div class="pogoSlider" id="js-main-slider">
                 <div class="pogoSlider-slide" style="background-image:url(<?php echo base_url('assets_front') ?>/images/main-banner.jpg);">
                     <div class="container">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="slide_text">
                                     <h3 style="color: black;"><span class="theme_color">LSP</span> Politeknik Caltex Riau</h3>
                                     <br><br>
                                     <h4 style="color: white;font-weight: bold;font-size:26px;">Kemudahan melakukan pendaftaran sertifikasi secara online.</h4>
                                     <h4 style="color: white;font-weight: bold;font-size:26px;">Lakukan Pendaftaran Sekarang.</h4>


                                     <a class="contact_bt" href="<?php echo base_url('auth') ?>">Daftar Disini >></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="pogoSlider-slide" style="background-image:url(<?php echo base_url('assets_front/') ?>images/slider-01.jpg);">
                     <div class="container">
                         <div class="row">
                             <div class="col-md-12">
                                 <div class="slide_text">
                                     <h3><span class="theme_color">Lembaga</span> Sertifikasi Profesi</h3>
                                     <br>
                                     <h4 style="font-size: 16px;">Buat akun anda apabila anda belum terdaftar sebagai pemohon sertifikasi LSP. <br> Silahkan daftar dengan memilih tombol berikut.</h4>
                                     <br>
                                     <h4 style="font-size: 16px;">Politeknik Caltex Riau merupakan salah satu lembaga terpercaya yang mewadahi bagi anda <br> yang ingin mendapatkan sertifikasi BNSP.</h4>
                                     <br>
                                     <a class="contact_bt" href="<?php echo base_url('auth') ?>">Daftar Disini >></a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- .pogoSlider -->
         </div>
     </div>
 </div>
 <!-- End Banner -->

 <!-- section -->
 <div class="section layout_padding theme_bg">
     <div class="container">
         <div class="row">
             <div class="col-lg-6 col-md-6 col-sm-12 text_align_center">
                 <div class="full">
                     <img class="img-responsive" src="<?php echo base_url('assets_front/') ?>images/resume_img.png" alt="#" />
                 </div>
             </div>

             <div class="col-lg-6 col-md-6 col-sm-12 white_fonts">
                 <h3 class="small_heading">Sertifikasi LSP Politeknik Caltex Riau</h3>
                 <div style="font-size: 12px;">
                     <?php echo cut_word($getData[0]->isi, 35); ?>
                 </div>
                 <a href="<?php echo base_url('dashboard/tentang') ?>" class="hvr-radial-out button-theme">Tentang LSP >></a>
             </div>
         </div>
     </div>
 </div>
 <!-- end section -->

 <div style="position:fixed;left:17px;bottom:40px;">
     <a style="background:blue;vertical-align:center;height:36px;border-radius:5px" class="btn btn-primary" href="<?php echo base_url('pintu_masuk') ?>" title="Contact Us" target="_top">
         <small style="font-size:12px;"> Daftar Sertifikasi Sekarang !</small>
     </a>
 </div>