<?php
  add_filter("the_content", "mfp_Fix_Text_Spacing");
  // Automatically correct double spaces from any post
  function mfp_Fix_Text_Spacing($the_Post)
  {
  $the_New_Post = str_replace("otaku", "OTAKU", $the_Post);
  return $the_New_Post;
  }

/*
Plugin Name: my_Plugin_Widget1
Description: Este plugin añade un widget que pone un título y una descripción.
Author: dllido
Author Email: dllido@uji.es
Version: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
// Registramos el widget
function load_my_widget() {
	register_widget( 'my_widget1' );
}
add_action( 'widgets_init', 'load_my_widget' );
// Creamos el widget 
class my_widget1 extends WP_Widget {
public function __construct() {
		$widget_ops = array( 
			'classname' => 'my_widget',
			'description' => 'My Widget is awesome',
		);
		parent::__construct( 'my_widget1', 'My Widget1', $widget_ops );
	}	
// Creamos la parte pública del widget
public function widget( $args, $instance ) {
$name = apply_filters( 'widget_name', $instance['name']);
$addr = apply_filters( 'widget_addr', $instance['addr']);
// los argumentos del antes y después del widget vienen definidos por el tema
echo $args['before_widget'];
if ( ! empty( $name ) && ! empty( $addr ) )
echo $args['before_title'] . $name . $args['after_title'];
echo $addr;
// Aquí es donde debemos introducir el código que queremos que se ejecute
echo $args['after_widget'];
}
		
// Backend  del widget
public function form( $instance ) {
if ( isset( $instance[ 'name' ] ) ) {
$name = $instance[ 'name' ];
}
else {
$name = __( 'Titulo', 'shop' );
}
if ( isset( $instance[ 'addr' ] ) ) {
$addr = $instance[ 'addr' ];
}
else {
$addr = __( 'Direccsion', 'HACIENDA SOMOS TODOS' );
}
// Formulario del backend
 ?>
<p>
<label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e( 'Nombre de la tienda:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo esc_attr( $name ); ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( 'addr' ); ?>"><?php _e( 'Dirección física:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'addr' ); ?>" name="<?php echo $this->get_field_name( 'addr' ); ?>" type="text" value="<?php echo esc_attr( $addr ); ?>" />
</p>
<?php	
}
// Actualizamos el widget reemplazando las viejas instancias con las nuevas
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? strip_tags( $new_instance['name'] ) : '';
$instance['addr'] = ( ! empty( $new_instance['addr'] ) ) ? strip_tags( $new_instance['addr'] ) : '';
return $instance;
}
} // La clase wp_widget termina aquí

function add_scripto(){
    $deps = array();
    wp_enqueue_script('squareface', get_stylesheet_directory_uri().'/js/square_face.js', $deps, true,true);
}

//Juego cuadrados JavaScript 
//wp_register_script('squareface',get_stylesheet_directory_uri().'/js/square_face.js' );
function squares_shortcode() {
  //wp_enqueue_script('squareface'); 
  return '<canvas id="sketchpad" width="300" height="300" style="background-color: #BBA6D4;"></canvas>';
  

}
add_shortcode('game', 'squares_shortcode');
add_action('wp_enqueue_scripts', 'add_scripto');
?>
