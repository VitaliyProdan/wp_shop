<?php
$host = "mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/";
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи и ABSPATH. Дополнительную информацию можно найти на странице
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется скриптом для создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения вручную.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'sumy');

/** Имя пользователя MySQL */
define('DB_USER', 'adminczKkaGL');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'v1W3ClQPXyNA');

/** Имя сервера MySQL */
define('DB_HOST', $host);

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

define('WP_ALLOW_MULTISITE', true);
define('WP_HOME','http://tiande.xyz');
define('WP_SITEURL','http://tiande.xyz');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=oO~~1f!P&w ^,Dke4aDXxb/J=jIfBE^2r~KM{vKHpYY^mq[6|w-@+9ur,jIx6pC');
define('SECURE_AUTH_KEY',  ';qh(fo;KfHM-S?]1<&>14Yb>Y[f}5 8]IT:.R8@r~gh^@wrxXHx5W=#833enbTg+');
define('LOGGED_IN_KEY',    'c-e2pG2s3p)wO5T&|{hXu+cFCVYn8.ikS|1P]8q/q-L/6`?ONp7TKXd]r$Jk.)(d');
define('NONCE_KEY',        'i#M}|higY[$;|F:88IIf!{4I!|lti,?T!zMi-%CTFr$Z%Cw]$Tk$|n)m:lm/%~N(');
define('AUTH_SALT',        '4<3@-{K6$O(T^dPHi55,]^MEm-*f&+a,4zI.l16VEYuoNpH2oy{krPw>PwXCAV<x');
define('SECURE_AUTH_SALT', ';z/eh_!L@Ra(FcsH]ST1lj616KucSSz.b1.XR6`ElHDg>-?-|=4(!n$r^MHaqkMu');
define('LOGGED_IN_SALT',   'u)h#:i_2}DwR0^3WhF|L#_^@SJ-c[mWTeVU0@Z+XN0Fpv-eu(0J+%9!!b4mstZ#;');
define('NONCE_SALT',       '~!mqzKkqkK,?liQY.=l=Ik2y.m_uD+b!-1J:B}#*X=-TfQU^5PM@d#?Lrn^(`nQ.');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
