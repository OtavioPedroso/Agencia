<?php

// funções default do tema ademesmo
include_once('functions-theme.php');

// funcções customizadas por cliente
//adicioca suporte a miniaturas destacadas
add_theme_support('post-thumbnails');

function search_filter($query)
{
	if (!is_admin() && $query->is_main_query()) {
		if ($query->is_search) {
			$query->set('paged', (get_query_var('paged')) ? get_query_var('paged') : 1);
			$query->set('posts_per_page', 6);
		}
	}
}
function gpi_find_image_id($post_id)
{
	if (!$img_id = get_post_thumbnail_id($post_id)) {
		$attachments = get_children(array(
			'post_parent' => $post_id,
			'post_type' => 'attachment',
			'numberposts' => 1,
			'post_mime_type' => 'image'
		));
		if (is_array($attachments)) foreach ($attachments as $a)
			$img_id = $a->ID;
	}
	if ($img_id)
		return $img_id;
	return false;
}
function find_img_src($post)
{
	if (!$img = gpi_find_image_id($post->ID))
		if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches))
			$img = $matches[1][0];
	if (is_int($img)) {
		$img = wp_get_attachment_image_src($img);
		$img = $img[0];
	}
	return $img;
}
function pagination()
{
	$prev_arrow = is_rtl() ? '→' : '←';
	$next_arrow = is_rtl() ? '←' : '→';

	global $wp_query;
	$total = $wp_query->max_num_pages;
	$big = 999999999; // need an unlikely integer
	if ($total > 1) {
		if (!$current_page = get_query_var('paged'))
			$current_page = 1;
		if (get_option('permalink_structure')) {
			$format = 'page/%#%/';
		} else {
			$format = '&paged=%#%';
		}
		echo paginate_links(array(
			'base'			=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
			'format'		=> $format,
			'current'		=> max(1, get_query_var('paged')),
			'total' 		=> $total,
			'mid_size'		=> 3,
			'type' 			=> 'list',
			'prev_text'		=> $prev_arrow,
			'next_text'		=> $next_arrow,
		));
	}
}


/**
 * Exemplo de como registrar o custom post type notícia externa
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
/*class posts_externos {

	function __construct() {
		add_action('init',array($this,'create_post_type'));
	}

	function create_post_type() {
		$labels = array(
		    'name' => 'Posts externos',
		    'singular_name' => 'Diário Oficial',
		    'add_new' => 'Add Novo',
		    'all_items' => 'Todos os posts',
		    'add_new_item' => 'Adicionar novo post externo',
		    'edit_item' => 'Editar post externo',
		    'new_item' => 'Novo post externo',
		    'view_item' => 'Ver post externo',
		    'search_items' => 'Buscar post externo',
		    'not_found' =>  'Nenhum post externo encontrado',
		    'not_found_in_trash' => 'Nenhum post externo encontrado',
		    'parent_item_colon' => '',
		    'menu_name' => 'Posts externos'
		);
		$args = array(
			'labels' => $labels,
			'description' => "Cadastro de post externo",
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_nav_menus' => true,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 20,
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports' => array('title'),
			'has_archive' => true,
			'rewrite' => array('slug' => 'post_externo'),
			'query_var' => true,
			'can_export' => true
		);
		register_post_type('post_externo',$args);
	}
}
$diario = new posts_externos();
*/

/**
 * Registrar o menu
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
if (function_exists('register_nav_menu')) {
	register_nav_menu('menu_principal', 'Menu Principal');
}

/**
 * Configura o moment.js
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
function time_ago()
{

	global $post;

	$date = get_post_time('G', true, $post);
	$chunks = array(
		array(60 * 60 * 24 * 365, __('ano', 'ademesmo'), __('anos', 'ademesmo')),
		array(60 * 60 * 24 * 30, __('mês', 'ademesmo'), __('meses', 'ademesmo')),
		array(60 * 60 * 24 * 7, __('semana', 'ademesmo'), __('semanas', 'ademesmo')),
		array(60 * 60 * 24, __('dia', 'ademesmo'), __('dias', 'ademesmo')),
		array(60 * 60, __('hora', 'ademesmo'), __('horas', 'ademesmo')),
		array(60, __('minuto', 'ademesmo'), __('minutos', 'ademesmo')),
		array(1, __('segundo', 'ademesmo'), __('segundos', 'ademesmo'))
	);

	if (!is_numeric($date)) {
		$time_chunks = explode(':', str_replace(' ', ':', $date));
		$date_chunks = explode('-', str_replace(' ', '-', $date));
		$date = gmmktime((int)$time_chunks[1], (int)$time_chunks[2], (int)$time_chunks[3], (int)$date_chunks[1], (int)$date_chunks[2], (int)$date_chunks[0]);
	}

	$current_time = current_time('mysql', $gmt = 0);
	$newer_date = strtotime($current_time);
	$since = $newer_date - $date;

	if (0 > $since)
		return __('hoje', 'ademesmo');

	for ($i = 0, $j = count($chunks); $i < $j; $i++) {
		$seconds = $chunks[$i][0];

		if (($count = floor($since / $seconds)) != 0)
			break;
	}

	$output = (1 == $count) ? '1 ' . $chunks[$i][1] : $count . ' ' . $chunks[$i][2];

	if (!(int)trim($output)) {
		$output = '0 ' . __('segundos', 'ademesmo');
	}

	$output .= __(' atrás', 'ademesmo');

	return $output;
}

/**
 * Configura o nr de views por post
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
function wpb_set_post_views($postID)
{
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		$count = 0;
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
	} else {
		$count++;
		update_post_meta($postID, $count_key, $count);
	}
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
function wpb_track_post_views($post_id)
{
	if (!is_single()) return;
	if (empty($post_id)) {
		global $post;
		$post_id = $post->ID;
	}
	wpb_set_post_views($post_id);
}
add_action('wp_head', 'wpb_track_post_views');
function wpb_get_post_views($postID)
{
	$count_key = 'wpb_post_views_count';
	$count = get_post_meta($postID, $count_key, true);
	if ($count == '') {
		delete_post_meta($postID, $count_key);
		add_post_meta($postID, $count_key, '0');
		return "0 View";
	}
	return $count;
}


/**
 * Paginação com números
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
function wpbeginner_numeric_posts_nav()
{

	if (is_singular())
		return;

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ($wp_query->max_num_pages <= 1)
		return;

	$paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
	$max   = intval($wp_query->max_num_pages);

	/**	Add current page to the array */
	if ($paged >= 1)
		$links[] = $paged;

	/**	Add the pages around the current page to the array */
	if ($paged >= 3) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if (($paged + 2) <= $max) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<div class="pagination"><ul>' . "\n";

	/**	Previous Post Link */
	if (get_previous_posts_link())
		printf('<li>%s</li>' . "\n", get_previous_posts_link());

	/**	Link to first page, plus ellipses if necessary */
	if (!in_array(1, $links)) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

		if (!in_array(2, $links))
			echo '<li>…</li>';
	}

	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort($links);
	foreach ((array) $links as $link) {
		$class = $paged == $link ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
	}

	/**	Link to last page, plus ellipses if necessary */
	if (!in_array($max, $links)) {
		if (!in_array($max - 1, $links))
			echo '<li>…</li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
	}

	/**	Next Post Link */
	if (get_next_posts_link())
		printf('<li>%s</li>' . "\n", get_next_posts_link());

	echo '</ul></div>' . "\n";
}

function wp_get_menu_array($current_menu)
{

	$array_menu = wp_get_nav_menu_items($current_menu);
	$menu = array();
	foreach ($array_menu as $m) {
		if (empty($m->menu_item_parent)) {
			$menu[$m->ID] = array();
			$menu[$m->ID]['ID'] = $m->ID;
			$menu[$m->ID]['title'] = $m->title;
			$menu[$m->ID]['url'] = $m->url;
			$menu[$m->ID]['children'] = array();
		}
	}
	$submenu = array();
	foreach ($array_menu as $m) {
		if ($m->menu_item_parent) {
			$submenu[$m->ID] = array();
			$submenu[$m->ID]['ID'] = $m->ID;
			$submenu[$m->ID]['title'] = $m->title;
			$submenu[$m->ID]['url'] = $m->url;
			$menu[$m->menu_item_parent]['children'][$m->ID] = $submenu[$m->ID];
		}
	}
	return $menu;
}

class CSS_Menu_Walker extends Walker
{

	var $db_fields = array('parent' => 'menu_item_parent', 'id' => 'db_id');

	function start_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul>\n";
	}

	function end_lvl(&$output, $depth = 0, $args = array())
	{
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{

		global $wp_query;
		$indent = ($depth) ? str_repeat("\t", $depth) : '';
		$class_names = $value = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;

		/* Add active class */
		if (in_array('current-menu-item', $classes)) {
			$classes[] = 'active';
			unset($classes['current-menu-item']);
		}

		/* Check for children */
		$children = get_posts(array('post_type' => 'nav_menu_item', 'nopaging' => true, 'numberposts' => 1, 'meta_key' => '_menu_item_menu_item_parent', 'meta_value' => $item->ID));
		if (!empty($children)) {
			$classes[] = 'has-sub';
		}

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li' . $id . $value . $class_names . '>';

		$attributes  = !empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target)     ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn) . '"' : '';
		$attributes .= !empty($item->url)        ? ' href="'   . esc_attr($item->url) . '"' : '';

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '><span>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
		$item_output .= '</span></a>';
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}

	function end_el(&$output, $item, $depth = 0, $args = array())
	{
		$output .= "</li>\n";
	}
}
