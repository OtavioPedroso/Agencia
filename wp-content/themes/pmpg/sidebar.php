<div class="box box-amarelo">
	<h3><i class="material-icons">category</i> Categorias</h3>
	<hr />
	<ul class="categorias">
    <?php wp_list_categories( array(
				'title_li' => '',
        'orderby' => 'name',
				'hide_empty' => 0,
				'show_count' => 1
    ) ); ?>
</ul>
</div>

<!--<div class="ad valign-wrapper no-print">
	<div class="valign">publicidade<br />350x220</div>
	<button class="btn grey lighten-2 btn-fechar"><i class="material-icons">close</i></button>
</div>
-->

<div class="box no-print">
	<h3><i class="material-icons">list</i> Últimas Notícias</h3>
	<hr />
	<ul class="collection">
	<?php
		$query = new WP_Query('posts_per_page=6&orderby=most_recent');
		while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="collection-item">
			<time class="timeago"><?php echo time_ago(); ?></time>
			<br />
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</li>
		<?php endwhile;	wp_reset_query();	?>
	</ul>
</div>

<!--
<div class="ad valign-wrapper no-print">
	<div class="valign">publicidade<br />350x220</div>
	<button class="btn grey lighten-2 btn-fechar"><i class="material-icons">close</i></button>
</div>
-->

<div class="box box-amarelo">
	<h3><i class="material-icons">read_more</i> Notícias Mais Lidas</h3>
	<hr />
	<ul class="collection">
	<?php
		$query = new WP_Query( array(
			'posts_per_page' => 6,
			'meta_key' => 'wpb_post_views_count',
			'orderby' => 'meta_value_num',
			'order' => 'DESC'
		));
		while ( $query->have_posts() ) : $query->the_post(); ?>
		<li class="collection-item">
			<span class="leituras"><?php echo wpb_get_post_views(get_the_ID()); ?> leitura(s)</span>
			<br />
			<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
			</a>
		</li>
		<?php endwhile;	wp_reset_query();	?>
	</ul>
</div>

<!--
<div class="ad valign-wrapper">
	<div class="valign">publicidade<br />350x220</div>
	<button class="btn grey lighten-2 btn-fechar"><i class="material-icons">close</i></button>
</div>
-->
