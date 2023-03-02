<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title><?php echo $title; ?></title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets_front/') ?>css/bootstrap.min.css">
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets_front/') ?>css/pogo-slider.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets_front/') ?>css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets_front/') ?>css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets_front/') ?>css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="home" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="<?php echo base_url('assets_front/') ?>images/loader2.gif" alt="#" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->

    <!-- Start header -->
    <header class="top-header">
        <nav class="navbar header-nav navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.html"><img src="<?php echo base_url('assets_front/') ?>images/logo_lsp1.png" alt="lsp politeknik caltex riau" width="80px auto;" height="50px auto"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-wd" aria-controls="navbar-wd" aria-expanded="false" aria-label="Toggle navigation">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbar-wd">
                    <ul class="navbar-nav">
                        <li><a class="nav-link active" href="<?php echo base_url('dashboard') ?>">Beranda</a></li>
                        <li><a class="nav-link" href="<?php echo base_url('dashboard/tentang') ?>">Tentang LSP</a></li>
                        <li><a class="nav-link" href="<?php echo base_url('dashboard/daftarSkema') ?>">Daftar Skema Sertifikasi</a></li>
                        <li><a class="nav-link" href="<?php echo base_url('dashboard/contact') ?>">Hubungi Kami</a></li>
                        <li><a class="nav-link active" style="background:white;color:#000;" href="<?php echo base_url('auth'); ?>"><span class="fa fa-user"></span> Masuk</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- End header -->

    <?php include 'pages_dashboard/' . $pageName . '.php'; ?>


    <!-- Start Footer -->
    <footer class="footer-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logo">
                        <!-- <a href="index.html"><img src="<?php echo base_url('assets_front/') ?>images/footer_logo.png" alt="#" /></a> -->
                    </div>
                </div>

                <div class="margin-top_30 col-md-8 offset-md-2 white_fonts">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="full icon text_align_center">
                                <img src="<?php echo base_url('assets_front/') ?>images/social1.png">
                            </div>
                            <div class="full white_fonts text_align_center">
                                <small>Jl. Umbansari (Patin) No.1 Rumbai, Pekanbaru, Riau 28265</small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="full icon text_align_center">
                                <img src="<?php echo base_url('assets_front/') ?>images/social2.png">
                            </div>
                            <div class="full white_fonts text_align_center">
                                <small>lsp@pcr.ac.id
                                </small>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="full icon text_align_center">
                                <img src="<?php echo base_url('assets_front/') ?>images/social3.png">
                            </div>
                            <div class="full white_fonts text_align_center">
                                <small>Telp : (0761) 53803
                                    <br>Fax : (0761) 53803
                                </small>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row white_fonts margin-top_30">
                <div class="col-lg-12">
                    <div class="full">
                        <div class="center">
                            <ul class="social_icon">
                                <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div class="footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="col-12" style="text-align: center;">
                        <p>© <?php echo date('Y') ?> Politeknik Caltex Riau . All Rights Reserved.</p>
                    </div>
                    <div class="col-12" style="text-align: center;">

                        Sekretariat LSP PCR, Jl. Umbansari (Patin) No.1 Rumbai, Pekanbaru, Riau 28265, Telp : (0761) 53803, Fax : (0761) 53803, Email: lsp@pcr.ac.id
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="<?php echo base_url('assets_front/') ?>js/jquery.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/popper.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="<?php echo base_url('assets_front/') ?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/jquery.pogo-slider.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/slider-index.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/smoothscroll.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/form-validator.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/contact-form-script.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/isotope.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/images-loded.min.js"></script>
    <script src="<?php echo base_url('assets_front/') ?>js/custom.js"></script>
</body>

</html>