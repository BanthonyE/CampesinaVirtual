<?php headerAdmin($data); ?>

<head>
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/main.css">
  <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/style.css">
</head>
<main class="app-content2">
  <div class="app-title">
    <div>
      <h1><i class="fa fa-dashboard"></i><?= $data['page_title'] ?></h1>
    </div>
    <ul class="app-breadcrumb breadcrumb">
      <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
      <li class="breadcrumb-item"><a href="<?= base_url(); ?>/dashboard">Eventos Recientes</a></li>
    </ul>
  </div>
  <section id="contentbody">
    <div class="container">
      <div class="row">
        <div class=" col-sm-12 col-md-6 col-lg-8">
          <div class="row">
            <div class="leftbar_content">
              <div class="single_stuff wow fadeInDown">
                <div class="single_stuff_img" align="center"> <a href="pages/single.html"><img src="Assets\images\evento.jpg" alt=""></a> </div>
                <div class="single_stuff_article">
                  <div class="single_sarticle_inner"> <a class="stuff_category" href="#">Technology</a>
                    <div class="stuff_article_inner"> <span class="stuff_date">Setiem <strong>20</strong></span>
                      <h2><a href="pages/single.html">¡Participa en la conferencia!</a></h2>
                      <p>En ese sentido, La Vía Campesina también llama la atención del Ministro del empleo e inserción profesional, y también del Ministro de Agricultura, de la pesca marítima y del desarrollo....</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="single_stuff wow fadeInDown">
                <div class="single_stuff_img" align="center"> <a href="#"><img src="Assets\images\lucha.jpg" alt=""></a> </div>
                <div class="single_stuff_article">
                  <div class="single_sarticle_inner"> <a class="stuff_category" href="#">Technology</a>
                    <div class="stuff_article_inner"> <span class="stuff_date">Julio <strong>23</strong></span>
                      <h2><a href="#">¡Veinticinco años de Luchas Campesinas para hacer realidad la Soberanía Alimentaria!</a></h2>
                      <p>En la Cumbre Mundial de la Alimentación de 1996, La Vía Campesina, planteó su propuesta de “Soberanía Alimentaria” para oponerse al destructivo modelo industrial capitalista que sigue causando hambre, desigualdad ,....</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="single_stuff wow fadeInDown">
                <div class="single_stuff_img" align="center"> <a href="#"><img src="Assets\images\rondas.jpg" alt=""></a> </div>
                <div class="single_stuff_article">
                  <div class="single_sarticle_inner"> <a class="stuff_category" href="#">Technology</a>
                    <div class="stuff_article_inner"> <span class="stuff_date">Agosto <strong>19</strong></span>
                      <h2><a href="#">La Vía Campesina se solidariza con FNSA, exige igualdad y reconocimiento de los derechos de los trabajadores agrícolas</a></h2>
                      <p>La Via Campesina se solidariza con lxs trabajadorxs del sector agrícola que trabajan en las empresas agrícolas, las estaciones de empaquetado así como las industrias alimentarias y de transformación de los productos agrícolas. Ellxs luchan por una vida digna y la justicia social....</p>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="stuffpost_paginatinonarea wow slideInLeft">
              <ul class="newstuff_pagnav">
                <li><a class="active_page" href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">8</a></li>
              </ul>
            </div>
          </div>

        </div>
        <div class="col-sm-6 col-md-6 col-lg-4">
          <div class="row">
            <div class="rightbar_content">
              <div class="single_blog_sidebar wow fadeInUp">
                <h2>Otras Noticias</h2>
                <ul class="featured_nav">
                  <li> <a class="featured_img" href="#"><img src="Assets\images\reunion.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Reunion de Campesinos - Acuerdos Personales</a> </div>
                  </li>
                  <li> <a class="featured_img" href="#"><img src="Assets\images\pandemia.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Pandemia Covid-19 - Noticia Alerta</a> </div>
                  </li>
                  <li> <a class="featured_img" href="#"><img src="Assets\images\problemas.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Pobreza Aumenta en las personas de provincia</a> </div>
                  </li>
                  <li> <a class="featured_img" href="#"><img src="Assets\images\rondas.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Reunion de Campesinos - Acuerdos Personales</a> </div>
                  </li>
                  <li> <a class="featured_img" href="#"><img src="Assets\images\problemas.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Pobreza Aumenta en las personas de provincia</a> </div>
                  </li>
                  <li> <a class="featured_img" href="#"><img src="Assets\images\pandemia.jpg" alt=""></a>
                    <div class="featured_title"> <a class="" href="#">Pandemia Covid-19 - Noticia de Contagiados</a> </div>
                  </li>

                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </section>
</main>
<?php footerAdmin($data); ?>
