<?php get_header(); ?>

<section id="busca">

  <div class="container ">
    <div class="row">

      <div class="col l12">

        <div class="tabela">
          <?php global $wp_query; ?>
          <div class="conteudo">

            <div class="row">
              <div class="col l12">
                <?php
                if (have_posts()) : ?>
                  <div id="result_search">
                    <ul class="noticia">
                      <?php
                      /* Start the Loop */
                      while (have_posts()) : the_post();
                      ?>
                          <a class="text-decoration-none" href="<?php the_permalink(); ?>">
                          <h1><?php the_title(); ?></h1>
                          <?php the_excerpt(); ?>
                        </a>
                      <?php endwhile; ?>
                    </ul>
                  </div>
                <?php
                  pagination();
                else :
                ?>
                  <div class="col l12">
                    <div class="card-panel  yellow darken-3">
                      <p class="white-text"><strong class="white-text">Ops! :(</strong><br /> Nada encontrado para o termo buscado. Tente novamente.</p>
                    </div>
                  </div>
                <?php endif; ?>

              </div>

            </div>
          </div>
        </div>
</section>


<?php get_footer(); ?>