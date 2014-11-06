<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'turismecomunitatvalenciana');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'turismecomunitat');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'ALXYKbDCcLBVYRdW');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', ':NT,pIL=pi0t.]+J2Vuq-B#(5EoK.mc?+U85(K}?Prqb7fF+*](^]DvXULfk7~(d'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', '7wDUL.,.E^Q`>O1v.flK?-}TPq3p/=|xA5vY.}D%h|ySHi{{IJN>$)}{Xfv%}mrz'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', '{gH3([*@cA@-S08+dUXH$|lI&5XeQ%h=i8Dw0h[;DYQj82+Z$rc6>H(keLP,%+!c'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', 'xNP))clBIcDM/NB+_MhVU!e9tH?e>0EU{n9#!d`MCJ/0`}P_|:FH|Qd[`FT$ZJ[='); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'w0Bji;Kk/&4ksM+$Wp17|M^ne//Uf{&r--Q9t$0|E1/Y^x5?O(#Iqq+4jZS~)id-'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', '2|)?+~q4p7KkIu-2d %a4r_5)k[X:(6fteCZO2VY*qQ5%ZICE:1!4LqA;_cLOT<B'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'K=,J*Ea|4gr`1`9}|+sJq<*^6DGF%Ew6`+(^4)R|=# f>g/C;H|-5LhsB:tr]K8v'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', 'dLK]QK{.iT*NBB+^jR9N2K7[,kIcd&$,7CEyTN3+ jA_9;- 2I3rDGFvOlB|g(]!'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


