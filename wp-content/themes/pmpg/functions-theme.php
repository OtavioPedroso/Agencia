<?php

/**
 * Adiciona o suporte ao title-tag
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
function theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'theme_slug_setup' );

/**
 * Limpeza do wp_head
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');

/**
 * Modificar a logomarca de login e do admin
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
add_action('login_head', 'custom_login_logo');
function custom_login_logo() {
  echo '<style type="text/css">
          body {
            background: #fff;
          }
          #login h1 a {
            background: url("' . get_template_directory_uri() . '/assets/img/logo-horizontal.svg") no-repeat scroll center 0 transparent;
            width: 100%;
            background-size: contain;
          }
          #loginform {
            background-color: rgba(24, 89, 169, 0.06);
          }
          #nav, #backtoblog {
            display: none;
          }
       </style>';
}
add_action('admin_head', 'my_custom_logo');
function my_custom_logo() {
  echo '<style type="text/css">
  				#wp-admin-bar-wp-logo {display:none}
  			</style>';
}

// changing the logo link from wordpress.org to your site
function mb_login_url() {  return home_url('/wp-admin'); }
add_filter( 'login_headerurl', 'mb_login_url' );

// changing the alt text on the logo to show your site name
function mb_login_title() { return get_option( 'blogname' ); }
add_filter( 'login_headertitle', 'mb_login_title' );

/**
 * Remove permissão de criar novas páginas
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
function permissions_admin_redirect() {
  $result = stripos($_SERVER['REQUEST_URI'], 'post-new.php?post_type=page');
  if ($result!==false && !current_user_can('publish_pages')) {
    wp_redirect(get_option('siteurl') . '/wp-admin/edit.php?post_type=page&permissions_error=true');
  }
}
add_action('admin_menu','permissions_admin_redirect');

function permissions_admin_notice() {
  echo "<div id='permissions-warning' class='error fade'><p><strong>".__('Você não tem permissão para criar novas páginas.')."</strong></p></div>";
}

function permissions_show_notice() {
  if(isset($_GET['permissions_error'])) {
    add_action('admin_notices', 'permissions_admin_notice');
  }
}
add_action('admin_init','permissions_show_notice');


/**
 * Remove alerta de atualizar wordpress
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
add_action('admin_menu','wphidenag');
function wphidenag() {
	if(!current_user_can('publish_pages')) {
  	remove_action( 'admin_notices', 'update_nag', 3 );
  }
}

/**
 * Remove a toolbar chata que aparece no site quando está logado no admin
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
//add_filter('show_admin_bar', '__return_false');

/**
 * Exemplo adicionando e removendo tipos de usuários (roles)
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
*/

//add_role( 'jornalista', 'Jornalista');
//add_role( 'pregoeiro', 'Pregoeiro');
//add_role( 'rh', 'Gestor RH');
//add_role( 'orgaos', 'Editor Órgãos');

//remove_role('editor');
//remove_role('pregoeiro');
//remove_role('rh');
//remove_role('orgaos');

//remove_role('file_uploader');
//remove_role('author');
//remove_role('contributor');
//remove_role('subscriber');

global $wp_roles;
//$role = get_role('jornalista');
//$role->add_cap( 'read' );
//$role->add_cap( 'edit_files' );                     //upload de arquivos
//$role->add_cap( 'upload_files' );                   //upload de arquivos
//$role->add_cap( 'remove_upload_files' );            //upload de arquivos
//$role->add_cap( 'delete_posts' );                   //upload de arquivos
//$role->add_cap( 'edit_pages' );                     //edicao de paginas
//$role->add_cap( 'edit_others_pages' );              //edicao de paginas
//$role->add_cap( 'edit_published_pages' );           //edicao de paginas
//$role->add_cap( 'edit_others_posts' );              //edicao de paginas
//$role->add_cap( 'edit_posts' );                     //edicao de posts
//$role->add_cap( 'edit_published_posts' );           //edicao de posts
//$role->add_cap( 'publish_posts' );                  //edicao de posts
//$role->add_cap( 'delete_others_posts' );            //upload de posts
//$role->add_cap( 'delete_published_posts' );         //upload de posts

/**
 * Rodapé customizado no Painel Admin
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
 */
add_filter('admin_footer_text', 'custom_admin_footer');
function custom_admin_footer() {
  echo '';
}

/**
 * Remove links da adminbar
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
*/
function remove_admin_bar_links() {
  global $wp_admin_bar, $current_user;
  $wp_admin_bar->remove_menu('updates');
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('new-content');
}
add_action( 'wp_before_admin_bar_render', 'remove_admin_bar_links' );

function remove_links_menu() {
  global $menu;
  //remove_menu_page('upload.php');
  remove_menu_page('link-manager.php');
  //remove_menu_page('tools.php');
  remove_menu_page('edit-comments.php');

  if(!current_user_can('publish_pages')) {
    remove_menu_page('profile.php');
  }
}
add_action( 'admin_menu', 'remove_links_menu' );

/**
 * Remove widgets da dashboard
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
*/
function disable_default_dashboard_widgets() {
  remove_action('welcome_panel', 'wp_welcome_panel');
  remove_meta_box('dashboard_right_now', 'dashboard', 'core');
  remove_meta_box('dashboard_activity', 'dashboard', 'core');
  remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
  remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
  remove_meta_box('dashboard_plugins', 'dashboard', 'core');
  remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
  remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
  remove_meta_box('dashboard_primary', 'dashboard', 'core');
  remove_meta_box('dashboard_secondary', 'dashboard', 'core');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

/**
 * Corrige problema na acentuação das imagens
 * @author Fábio Luiz Palhano
 * @date 02/02/2021
*/
add_filter('wp_get_attachment_image_attributes', 'ck_image_attrs');
function ck_image_attrs($attrs) {
  foreach ($attrs as $name => $value) {
    if ('src' != $name) {
      break;
    }
    $attrs[$name] = ck_fix_image_url($value);
  }
  return $attrs;
}

function ck_fix_image_url($url) {
  $parts = parse_url($url);
  $path = explode('/', $parts['path']);
  $path = array_map('rawurlencode', $path);
  $path = implode('/', $path);
  return str_replace($parts['path'], $path, $url);
}


/**
 * Desabilita API que permite publicar posts e comentários através de aplicativos externos,incluindo o app oficial do WordPress para Android e iOS. As requisições salvas pelo log ficam com o user agent em branco o que possibilita que vários bot spammers tentem injetar conteúdo duvidoso.
 * @author Fábio Luiz Palhano
 * @date 06/06/2017
 */
add_filter('xmlrpc_enabled', '__return_false');

function connect_another_db() {
  global $documentos;
  $documentos = new wpdb('ci_documentos', 'YQgekJnbw2CiQpWQ', 'ci_documentos', 'localhost');
}
add_action('init', 'connect_another_db');