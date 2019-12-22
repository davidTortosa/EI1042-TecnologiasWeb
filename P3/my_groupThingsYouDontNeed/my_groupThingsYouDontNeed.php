<?php
/*
Plugin Name: my_groupThingsYouDontNeed
Description: Register group of persons.
Author URI: Caterina Alarcón Marín, David Tortosa Escudero
Author Email: al364403@uji.es, al361904@uji.es
Version: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/



//Al activar el plugin quiero que se cree una tabla en la BD, que creará la función my_group_install.



//Añado action hook, de forma que cuando se realice la acción de una petición a la URL: wp-admin/admin-post.php?action=my_datos 
//se llame a mi controlador definido en la función my_datos definido en el fichero include/functions.php

//Solo activado el hook para usuarios autentificados,  



//La siguiente sentencia activaria la acción para todos los usuarios.
//add_action('admin_post_nopriv_my_datos', 'my_datos');
$table="A_GrupoCliente000";
include(plugin_dir_path( __FILE__ ).'include/functions.php');

register_activation_hook( __FILE__, 'TYDN_Ejecutar_crearT');

//add_action( 'plugins_loaded', 'Ejecutar_crearT' ); // esto se ejecuta siempre que se llama al plugin
function TYDN_Ejecutar_crearT(){
    TYDN_CrearT("A_GrupoCliente000");
}

function mostrarfoto(){
    $deps = array();
    wp_enqueue_script( 'mostrarFoto' ,"/wp-content/plugins/my_groupThingsYouDontNeed/js/mostrarFoto.js",$deps, true, true );
}

function alertRegistro(){
    $deps = array();
    wp_enqueue_script( 'alertRegistro' ,"/wp-content/plugins/my_groupThingsYouDontNeed/js/registro.js",$deps, true, true );
}

//add_action('admin_post_nopriv_my_datos', 'MP_my_datos'); //no autentificados
//add_action('wp_head', 'hook_css');
add_action('admin_post_my_datosTYDN', "TYDN_my_datos"); 
add_action("wp_enqueue_scripts","mostrarfoto");
add_action("wp_enqueue_scripts","alertRegistro");

?>
