<?php get_header(); ?>

<section id="busca" class="interna texto">

  <div class="container">

    <h1 class="titulo">Notícias</h1>

    <div class="row">
      <div class="col l8">
        <div class="conteudo">
          <div class="row">
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <div class="col l6">
              <div class="noticinha">
                <a href="<?php the_permalink(); ?>" class="imagem" style="background-image:url('<?php echo $imagem_destaque; ?>')">
                  <?php
                    if (get_post_type() == 'post') :
                    $imagem_destaque = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'thumbnail' );
                  ?>
                  <div class="legenda">
                    <?php $category = get_the_category(); ?>
      							<div class="categoria"><?php echo $category[0]->cat_name; ?></div>
                    <br /><br />
                    <span class="timeago"><i class="material-icons">access_time</i> <?php echo time_ago(); ?></span>
                    <br />
                    <span class="leituras"><i class="material-icons">remove_red_eye</i> <?php echo wpb_get_post_views(get_the_ID()); ?> leitura(s)</span>
                  </div>
                  <?php endif; ?>
                </a>
                <a href="<?php the_permalink(); ?>">
                  <h5><?php the_title(); ?></h5>
                </a>
              </div>
            </div>

            <?php endwhile; else : ?>
            <div class="col l12">
              <div class="card-panel  yellow darken-3">
                <p class="white-text"><strong class="white-text">Ops! :(</strong><br /> Nada encontrado para o termo buscado. Tente novamente.</p>
              </div>
            </div>
            <?php endif; ?>
          </div>

    		</div>
        <?php wpbeginner_numeric_posts_nav(); ?>
    	</div>

      <div id="sidebar" class="col s12 m4 l4">
        <?php get_sidebar(); ?>
      </div>

    </div>
  </div>
</section>


<?php get_footer(); ?>
