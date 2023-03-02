 <!-- section -->
 <div class="section layout_padding">
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <div class="full center margin-bottom_30">
                     <div class="heading_main text_align_center">
                         <h2><span class="theme_color">LSP</span> Politeknik Caltex Riau</h2>
                         <p class="large">Daftar Skema Sertifikasi</p>
                     </div>
                 </div>
             </div>
         </div>


         <div class="row">
             <?php foreach ($getSkema as $row) { ?>
                 <div class="col-lg-4 col-md-4 col-sm-12">
                     <div class="full">
                         <div class="center">
                             <img src="<?php echo base_url('assets_front/') ?>images/icon1.png" alt="#" />
                         </div>
                         <div class="center">
                             <h4 style="font-size: 14px;text-align: center;"><?php echo $row->judul_skema; ?></h4>
                         </div>
                     </div>
                 </div>
             <?php } ?>

         </div>
     </div>
 </div>
 <!-- end section -->
 <div style="position:fixed;left:17px;bottom:40px;">
     <a style="background:blue;vertical-align:center;height:36px;border-radius:5px" class="btn btn-primary" href="<?php echo base_url('pintu_masuk') ?>" title="Contact Us" target="_top">
         <small style="font-size:12px;"> Daftar Sertifikasi Sekarang !</small>
     </a>
 </div>