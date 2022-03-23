<?php /* Template Name: Notícias */ ?>

<?php get_header(); ?>

<section id="lista" class="interna lista">

	<div class="header container">
		<h1 class="titulo"><?php the_title(); ?></h1>
		<hr/>
		<div class="conteudo">
			<?php the_post(); the_content(); ?>
		</div>
	</div>

		<?php
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			query_posts(array(
				'post_type' => 'post', // You can add a custom post type if you like
				'paged' => $paged,
				'posts_per_page' => 10 // limit of posts
			));
			//$wpb_all_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>1, 'paged'=>$paged)); ?>
		 <ul class="noticia">
			<?php if ( have_posts() ) :  while ( have_posts() ) : the_post(); ?>
			<?php $imagem_destaque = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' ); ?>
				<li class="noticia">
					<a href="<?php the_permalink(); ?>">
						<img src="<?=$imagem_destaque?>" width="150"/>
						<h1><?php the_title(); ?></h1>
						<i>Em <?php the_date() ?></i>
						<?php the_excerpt(); ?>
					</a>
				</li>
			<?php endwhile; ?>
		 </ul>
			<div class="pagination">
				<div class="nav-previous alignleft"><?php previous_posts_link( 'Notícias anteriores' ); ?></div>
				<div class="nav-next alignleft"><?php next_posts_link( 'Mais notícias' ); ?></div>
			</div>
			<?php
				/*
			the_posts_pagination( array(
				'mid_size'  => 2,
				'prev_text' => __( 'Próximo', 'textdomain' ),
				'next_text' => __( 'Anterior', 'textdomain' ),
			) );
			the_posts_pagination( array( 'mid_size'  => 2 ) );
			*/
			?>
		 <?php else : ?>
			<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
		<?php endif; ?>
</section>

<?php get_footer(); ?>