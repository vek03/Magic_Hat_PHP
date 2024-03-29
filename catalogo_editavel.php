<?php
require_once("controller/controller.php");
require_once("model/banco.php");

class produtos
{

  private $cod_admin;
  private $logado;

  public function __construct()
  {
    session_start();

    if (isset($_SESSION['id_admin']) && $_SESSION['id_admin'] > 0) {
      $cod_admin = $_SESSION['id_admin'];
      $logado = true;
      $controller = new controller();
      $banco = new Banco();
      $admin = $banco->getAdmin($cod_admin);
      $script = "javascript:document.location='carrinho.php'";
    } else {
      $script = "javascript:alert('Entre na sua conta para visualizar os itens do seu carrinho...');";
      $logado = false;
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title>Magic Hat</title>
      <meta content="" name="description">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="img/magichat/icone.ico" rel="icon">
      <link href="img/magichat/icone.ico" rel="apple-touch-icon">
      <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" rel="stylesheet">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"/>
      <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css"/>

      <!-- Template Main CSS File -->
      <link href="css/style.css" rel="stylesheet">


    </head>

    <body>

      <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
          <div class="vw-plugin-top-wrapper"></div>
        </div>
      </div>
      <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
      <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
      </script>

      <!-- ======= Header ======= -->
      <header id="header" class="d-flex">
        <div class="container d-flex align-items-center justify-content-between">

          <div class="logo">
            <h1><img src="img/magichat/logo.png">
              <a href="index_gerente.php">Magic Hat</a></img>
            </h1>
          </div>

          <nav id="navbar" class="navbar">
            <ul>
              <li><a class="nav-link scrollto" href="index_gerente.php">Home</a></li>
              <li><a class="nav-link scrollto" href="cadastro_produto.php">Cadastrar produtos</a></li>
              <li><a class="nav-link scrollto" href="catalogo_editavel.php">Catálogo de produtos</a></li>
              <li class="dropdown"><a href="#"><span>
                    <ion-icon id="person" name="person"></ion-icon>
                  </span> </a>
                <ul>
                  <li><a href="model/destroy.php?id=1">Sair da conta</a></li>
                </ul>
              </li>
            </ul>

            <i class="bi bi-list mobile-nav-toggle"></i>


          </nav><!-- .navbar -->

        </div>
      </header><!-- End Header -->

      <main id="main">

        


        <!-- ======= Container Section ======= -->
        <section id="cta" class="cta">
          <div class="container">
            <div class="section-title" data-aos="zoom-out">
              <p>Produtos</p>
              <h2>VEJA NOSSO CATÁLOGO DE PRODUTOS</h2>
              <h2>APERTE CRTL + F5 PARA ATUALIZAR O CATÁLOGO APÓS UMA EDIÇÃO</h2>
            </div>
          </div>
        </section>
        <!-- End Cta Section -->


        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
          <div class="container">

            <ul id="portfolio-flters" class="d-flex justify-content-end" data-aos="fade-up">
              <ul>
                <li data-filter="*">Todos</li>
                <li data-filter=".Bonecas">Bonecas</li>
                <li data-filter=".Bonecos">Bonecos</li>
                <li data-filter=".Jogos">Jogos</li>
              </ul>
              <ul style="margin-left: -20px;">
                <li data-filter=".Carrinhos">Carrinhos</li>
                <li data-filter=".Heróis">Heróis</li>
                <li data-filter=".Princesas">Princesas</li>
              </ul>
            </ul>
            <br>
            <br>
            <br>

            <div class="row portfolio-container pricing" data-aos="fade-up">
              <div class="row">

                <?php
                $controller = new controller();
                $produtos = $controller->pesquisar("", 0);

                for ($i = 0; $i < count($produtos); $i++) {
                  if ($logado != 0) {
                    $qttd = "var btn = document.getElementById('btnValue" . $produtos[$i]['id'] . "').innerHTML.toString();";
                    $script = "javascript:" . $qttd . "var result = confirm('Deseja adicionar ao carrinho?'); if(result == true){document.location='cart.php?produto=" . $produtos[$i]['id'] . "&qttd=' + btn}";
                  }
                ?>

                  <div class="col-lg-3 col-md-6 mt-4 mt-md-0 portfolio-item <?php echo $produtos[$i]['categoria']; ?>">
                    <div class="box " data-aos="zoom-in" data-aos-delay="100">
                      <h3 style="height: 105px;"><?php echo $produtos[$i]['nome']; ?></h3>
                      <div><img style="height: 250px; width: 250px;" src="<?php echo $produtos[$i]['img1']; ?>"></div>
                      <h4><sup>R$</sup><?php echo $produtos[$i]['preco']; ?></h4>

                      <div class="btn-wrap">
                        <button type="button" class="btn btn-buy" style="border: 0px;" href="editar_produto.php" onclick="location.href='editar_produto.php?id=<?php echo $produtos[$i]['id']; ?>'">
                          Editar
                        </button>
                      </div>
                      <div class="btn-wrap" style="margin-top: -10px;">
                        <button type="button" class="btn btn-buy" onclick="javascript:var result = confirm('Deseja excluir este produto do site?'); if(result == true){document.location='model/destroy.php?id=3&id_produto=<?php echo $produtos[$i]['id']; ?>'}" style="border: 0px;">
                          Excluir
                        </button>
                      </div>
                    </div>
                  </div>

                <?php
                }
                ?>

              </div>
            </div>

          </div>
        </section><!-- End Portfolio Section -->

      </main>

      <!-- End #main -->


      <!-- ======= Footer ======= -->
      <svg class="hero-waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28 " preserveAspectRatio="none">
        <defs>
          <path id="wave-path" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z">
        </defs>
        <g class="wave1">
          <use xlink:href="#wave-path" x="50" y="4" fill="rgba(161,30,29, .1)">
        </g>
        <g class="wave2">
          <use xlink:href="#wave-path" x="70" y="0" fill="rgba(161,30,29, .2)">
        </g>
        <g class="wave3">
          <use xlink:href="#wave-path" x="50" y="7" fill="#A11E1D">
        </g>
      </svg>


      <footer>

        <!-- Seção de Mídias Sociais -->
          <ul class="social_icon">
            <li><a href="https://twitter.com/MagicHatOficial">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>
            <li><a href="https://www.instagram.com/magic.hat.of/">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>
            <li><a href="https://www.linkedin.com/in/magic-hat-45bb81257">
                <ion-icon name="logo-linkedin"></ion-icon>
              </a>
            </li>
            <li><a href="https://www.facebook.com/profile.php?id=100088264081232">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>
          </ul>


        <div class="container text-center text-md-start mt-5">
          <div class="row mt-3">
            <!-- 1° Coluna -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

              <!-- Conteúdo sobre o Site -->

              <h3 class="fw-bold">
                Magic Hat
              </h3>

              <p>
                A Magic Hat é uma loja virtual de brinquedos que visa atender seus clientes de forma rápida, interativa, com qualidade em seu atendimento e produtos e, principalmente, com segurança.
              </p>
            </div>

            <!-- 3° Coluna -->
            <div class="fundador col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <!-- Links Desenvolvedores -->
              <h3 class="fw-bold">
                Desenvolvedores
              </h3>

              <p class="txtCenter">
                <a class="nav-link scrollto" href="https://github.com/joaopedro2602" target="_blank">João Pedro Cabral</a>
              </p>

              <p class="txtCenter">
                <a class="nav-link scrollto" href="https://github.com/MarianeBS" target="_blank">Mariane Souza</a>
              </p>

              <p class="txtCenter">
                <a class="nav-link scrollto" href="https://github.com/TamirisRC" target="_blank">Tamiris Carvalho</a>
              </p>

              <p class="txtCenter">
                <a class="nav-link scrollto" href="https://github.com/vek03" target="_blank">Victor Cardoso</a>
              </p>

              <p class="txtCenter">
                <a class="nav-link scrollto" href="https://github.com/VictordRoma" target="_blank">Victor Roma</a>
              </p>

            </div>

            <!-- 3° Coluna -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
              <!-- Links Contato -->
              <h3 class="fw-bold">
                Contato
              </h3>
              <p>
                Endereço: Av. Águia de Haia, 2633 - Cidade Antônio Estêvão de Carvalho, São Paulo
              </p>

              <p>
                CEP: 01311-000
              </p>

              <p>
                Atendimento por: magichat@outlook.com
              </p>

              <p>
                Contato: (11) 69318-8308
              </p>

            </div>

          </div>

        </div>

        <p>©2022 Copyright <b>Magic Hat</b> | Todos os Direitos Reservados</p>
      </footer>

      <!-- End Footer -->

      <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

      <!-- Vendor JS Files -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

      <!-- Template Main JS File -->
      <script src="js/main.js"></script>

    </body>

    </html>
<?php
  }
}
new produtos();
?>