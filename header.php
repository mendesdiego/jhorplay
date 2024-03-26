<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php wp_title() ?></title>
    <?php wp_head(); ?>
</head>
<body>    
    
<header class="main-header">
    <div class="main-header__container">
        <nav class="menu-principal">
            <div class="main-header__logo">
                <img src="<?php echo get_template_directory_uri() ?>/assets/images/logoJhorPlay.svg" alt="">
            </div>

            <div class="main-header__assine-agora">
                botao assine
            </div>
        </nav>
    </div>
</header>

<nav class="" style="display: none;">
    <div class="body-menu-responsive">
        <div class="close-menu">
            <span>&times;</span>
        </div>
        <ul class="lista-menu">
            <li><a href="#sobre" class="navbar-site__link rolagem-suave">Estratégia dos 4 tempos Bernoulli</a> </li>
            <!-- menu ajustado -->
            <li><a href="#infoCurso" class="navbar-site__link rolagem-suave">Cursos e Informações</a></li>
            <li><a href="#bolsa" class="navbar-site__link rolagem-suave">Bolsas</a></li>
            <li><a href="#depoimento" class="navbar-site__link rolagem-suave">Depoimentos</a></li>
            <!-- <li><a href="#contato" class="navbar-site__link rolagem-suave">Contato</a></li> -->
        </ul>
    </div>
</nav>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>