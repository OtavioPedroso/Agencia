<?php get_header(); ?>

<section id="lista" class="interna lista">

	<div class="header container">
		<h1 class="titulo"><?php the_title(); ?></h1>
		<div class="conteudo">
			<?php the_post(); the_content(); ?>
		</div>
	</div>

</section>


<?php get_footer(); ?>
