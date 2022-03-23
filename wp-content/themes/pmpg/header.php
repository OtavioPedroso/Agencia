<!doctype html>
<html <?php language_attributes(); ?>>

<head>

  <title>Agência de Inovação e Desenvolvimento de Ponta Grossa</title>
  
  <!-- metas -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/assets/ico/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/assets/ico/favicon-32x32.png">
  
  <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/assets/ico/favicon-16x16.png">
  <link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/ico/site.webmanifest">
  <link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/ico/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="theme-color" content="#ffffff">

  <!-- seo -->
  <meta name="description" content="Agência de Inovação e Desenvolvimento de Ponta Grossa" />
  <meta name="keywords" content="inovação, desenvolvimento" />
  <meta name="author" content="Otávio Augusto" />
  <meta name="copyright" content="Prefeitura Municipal de Ponta Grossa" />
  <meta property="fb:app_id" content="642882000479028" />

  <!-- css -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Montserrat:thin,extra-light,light,100,200,300,400,500,600,700,800" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.css" /> 
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/index.css" />

  <!-- wordpress -->
  <?php wp_head(); ?>

  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.cycle2.min.js" charset="utf-8"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-HT2S8DB0ZZ"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-HT2S8DB0ZZ');
	</script>

</head>

<body <?php body_class(); ?>>

  <script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=642882000479028";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script>
  <script>
    window.onload = function() {
      var progress = jQuery('#banner-loading-div'),
        slideshow = jQuery('.cycle-slideshow');

      slideshow.on('cycle-initialized cycle-before', function(e, opts) {
        progress.stop(true).css('width', 0);
      });

      slideshow.on('cycle-initialized cycle-after', function(e, opts) {
        if (!slideshow.is('.cycle-paused'))
          progress.animate({
            width: '100%'
          }, opts.timeout, 'linear');
      });

      slideshow.on('cycle-paused', function(e, opts) {
        progress.stop();
      });

      slideshow.on('cycle-resumed', function(e, opts, timeoutRemaining) {
        progress.animate({
          width: '100%'
        }, timeoutRemaining, 'linear');
      });
    };
  </script>

  <section id="topo">
    <div class="container p-1">
      <div class="row d-flex align-items-center">
        <div class="col">
          <div id="time"></div>
        </div>
        <div class="col d-flex align-items-center justify-content-end">
          <a class="d-flex text-decoration-none  " href="https://www.pontagrossa.pr.gov.br" target="_blank" ><i class="material-icons">house</i> Portal da Prefeitura de Ponta Grossa</a>
        </div>
      </div>
    </div>
  </section>

  <section id="header" class="border-top border-primary">
    <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col mt-2 mb-3">
            <a class="logo" href="<?php echo site_url(); ?>/">
              <img id="logo" src="<?php echo get_template_directory_uri(); ?>/assets/img/logo-horizontal.png" />
            </a>
          </div>
          <div id="form-buscar" class="col">
            <form autocomplete="off" role="search" class="d-flex float-end" method="get" action="<?php echo site_url(); ?>/">
              <input name="s" type="text" class="validate form-control me-1" placeholder="Pesquisa no site">
              <button class="btn btn-primary" type="submit">Buscar</button>
            </form>
          </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-primary">
          <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
              <span class="navbar-toggler-icon"></span>
          </button>
          <div class="container justify-content-center">
              <div class="navbar-nav fs-4">
                  <a href="<?php echo site_url(); ?>/#inicio" class="nav-item nav-link text-decoration-none pe-2">Início</a>
                  <a href="<?php echo site_url(); ?>/#programas" class="nav-item nav-link text-decoration-none">Programas</a>
                  <a href="<?php echo site_url(); ?>/#sobre" class="nav-item nav-link text-decoration-none">Sobre nós</a>
              </div>
          </div>
    </nav>
  </section>
