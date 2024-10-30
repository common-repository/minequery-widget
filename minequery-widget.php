<?php
/*
Plugin Name: Minequery Widget
Plugin URI: http://www.sabletopia.co.uk/minequery-widget/
Description: Display information about a minecraft server.
Version: 2.0
Author: Darren Douglas - darren.douglas@gmail.com
Author URI: http://www.sabletopia.co.uk/
License: GPL3
*/

/*
 * Minequery Widget
 * Copyright (C) 2012 Sable Designs - darren.douglas@gmail.com
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */


define('MINEQUERY_WIDGET_VERSION', '2.0');
define('MINEQUERY_WIDGET_DIR', plugin_dir_path(__FILE__));
$mq_file = dirname(__FILE__) . '/minequery-widget.php';
define('MINEQUERY_WIDGET_URI', plugin_dir_url($mq_file));



if (!class_exists('Minequery')) {
	require_once(MINEQUERY_WIDGET_DIR.'minequery.class.php');
}

defined('ABSPATH') or die("Cannot access pages directly.");

add_action( 'widgets_init', create_function( '', 'register_widget("MineQueryWidget");' ) );

class MineQueryWidget extends WP_Widget
{
	function MineQueryWidget() {
		$widget_ops = array( 
			'classname' => 'MineQueryWidget', 
			'description' => __('Display information about a minecraft server.','minequery-widget') 
		);
		$this->WP_Widget( 'MineQueryWidget', __('MineQuery Widget','minequery-widget') , $widget_ops );
		
		if ( is_active_widget(false, false, $this->id_base) ) {
            add_action( 'wp_head', array(&$this, 'add_javascript'), 0 );
		}
		
	}
	
	public function add_javascript() {
		wp_enqueue_script('jquery');
		wp_register_script( 'minequery-js', MINEQUERY_WIDGET_URI.'assets/js/minequery.js', array('jquery'), '1.0', true );
		wp_enqueue_script('minequery-js');
	}
	
	function widget($args, $instance) {
		extract( $args );
		
		$title = apply_filters('widget_title', $instance['title'] );
		$mq_ip = $instance['mq_ip'];
		$mq_port = $instance['mq_port'];
		
		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		echo '<div class="minequery-widget">'."\n";
		echo '<div class="minequery-widget-data" data-mq_ip="'.$mq_ip.'" data-mq_port="'.$mq_port.'"></div>'."\n";
		echo '<div class="minequery-widget-lang" data-online="'.__('Online','minequery-widget').'" data-latency="'.__('Latency','minequery-widget').'"  data-offline="'.__('Offline','minequery-widget').'" data-players="'.__('Players','minequery-widget').'"></div>'."\n";
		echo '<div class="minequery-widget-url" data-url="'.MINEQUERY_WIDGET_URI.'"></div>'."\n";
		echo '<div class="minequery-widget-result"></div>'."\n";
		echo '</div>'."\n";
		
		echo $after_widget;
	}
	

	function form( $instance ) {
		$deftitle = __('Server Status','minequery-widget');
		
		$defaults = array( 'title' => $deftitle, 'mq_ip' => 'localhost', 'mq_port' => '25566' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','minequery-widget') ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_ip' ); ?>"><?php _e('Server IP','minequery-widget') ?></label>
			<input id="<?php echo $this->get_field_id( 'mq_ip' ); ?>" name="<?php echo $this->get_field_name( 'mq_ip' ); ?>" value="<?php echo $instance['mq_ip']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_port' ); ?>"><?php _e('Server Port','minequery-widget') ?></label>
			<input id="<?php echo $this->get_field_id( 'mq_port' ); ?>" name="<?php echo $this->get_field_name( 'mq_port' ); ?>" value="<?php echo $instance['mq_port']; ?>" style="width:100%;" />
		</p>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['mq_ip'] = strip_tags( $new_instance['mq_ip'] );
		$instance['mq_port'] = strip_tags( $new_instance['mq_port'] );
		return $instance;
	}
}

