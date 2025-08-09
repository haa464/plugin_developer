<?php 
/**
 *
 */
namespace TSW\Base;

/**
* 
*/
class Enqueue
{
	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
	}
	
	function enqueue() {
		// enqueue all our scripts
		wp_enqueue_style( 'tswstyle', TSW_PLUGIN_URL . 'assets/mystyle.css' );
		wp_enqueue_script( 'tswscript', TSW_PLUGIN_URL . 'assets/myscript.js' );
	}
}