<?php get_header(); ?>

	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<section id="post-individual" class="border-top border-primary">
		<div class="d-flex container mt-2">
			<div class="alert alert-primary">
				<h1><?php the_title();?></h1>
			</div>
		</div>
		<div class="container">
			<div class="card shadow-lg">
				<div class="card-body">
					<?php the_content();?>
				</div>
			</div>
		</div>
		
	</section>
	<?php endwhile; endif; ?>

<?php get_footer(); ?>
