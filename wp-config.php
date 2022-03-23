<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'agencia' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '_i<#KZ*!`Pn|$2`M(0zV^+bb-@su,uV!sLwV9<]F?O$`A3k<SA@#&EN[A9KhF9bB' );
define( 'SECURE_AUTH_KEY',  'ZV4#UQn?OID3tYWLxlNj/WZs]!QkJ`+t{~Lb4ozf ,K`W]MEy!>^f,iSojlwie`1' );
define( 'LOGGED_IN_KEY',    '`=9.gft`EnYUcXUk$Q.&5kQmX(*OrsWYY=<m8ho$8/xK4ZxA-;k`5 B6*vXguVZC' );
define( 'NONCE_KEY',        '*NZGBUjU0#HuSQ|$^q2Fb2HO%<k+LtAN-,T^d4b.rs80K+C`PD<M$+kUO)KW=M9I' );
define( 'AUTH_SALT',        '#^pimOC,0%Q<<-Blvrb:S|bU@+*C^sUMn~~eO7NPFVA(X9#X>jm#$lSV!<,x{qY+' );
define( 'SECURE_AUTH_SALT', '0}QTW)]6r~Sx &NnZa_tPF!K-zzE}0!UA!84aFh0[!{+m$`;1mNN&:kp3Wo>jN{M' );
define( 'LOGGED_IN_SALT',   '`]8i!lm(JZJysUNvZ@mTSWnL@!rPCeflaA&1o#$9D]oSD|,y,cMAHd4(vA|Ap<d6' );
define( 'NONCE_SALT',       ')<utNzMnowsU>*SitY/06WR70F79(6e686[2+OccY0wF,R/Qwqm<Z !;/L1(N]N?' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'wp_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Adicione valores personalizados entre esta linha até "Isto é tudo". */



/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
