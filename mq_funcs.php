<<<<<<< .mine
<?php
/*
Plugin Name: Minequery Widget
Plugin URI: http://sablednah.dnydns.org/
Description: Display information about a minecraft server.
Version: 1.1
Author: Darren Douglas - darren.douglas@gmail.com
Author URI: http://sablednah.dnydns.org/
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

if (!class_exists('Minequery')) {
	require('minequery.class.php');
}

defined('ABSPATH') or die("Cannot access pages directly.");

add_action( 'widgets_init', create_function( '', 'register_widget("MineQueryWidget");' ) );

class MineQueryWidget extends WP_Widget
{
	function MineQueryWidget() {
		$widget_ops = array( 
			'classname' => 'MineQueryWidget', 
			'description' => 'Display information about a minecraft server.' 
		);
		$this->WP_Widget( 'MineQueryWidget', 'MineQuery Widget', $widget_ops );
	}
	
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$mq_ip = $instance['mq_ip'];
		$mq_port = $instance['mq_port'];

		echo $before_widget;
		
	    if ( $title ) echo $before_title . $title . $after_title;
		
		$thisarray = Minequery::query($mq_ip,$mq_port);
		if (!$thisarray) {
			echo("<div style='color:red;'>Offline</div>");
		} else {
			echo("<div style='color:green;'>Online</div>");
			echo("<div>$thisarray[playerCount] / $thisarray[maxPlayers] Players</div>");
				$players=$thisarray[playerList];
			echo("<div>");
			foreach ($players as $player) {
				echo ("$player ");
			}
				echo("</div>");
			echo("<div>");
			$latency=number_format($thisarray[latency],3);
			echo($latency);
			echo(" Latency</div>");
		}
		echo $after_widget;
	}
	

	function form( $instance ) {
		$defaults = array( 'title' => 'Server Status', 'mq_ip' => 'localhost', 'mq_port' => '25566' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_ip' ); ?>">Server IP</label>
			<input id="<?php echo $this->get_field_id( 'mq_ip' ); ?>" name="<?php echo $this->get_field_name( 'mq_ip' ); ?>" value="<?php echo $instance['mq_ip']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_port' ); ?>">Server Port</label>
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
}=======
<?php
/*
Plugin Name: Minequery Widget
Plugin URI: http://sablednah.dnydns.org/
Description: Display information about a minecraft server.
Version: 1.0
Author: Darren Douglas - darren.douglas@gmail.com
Author URI: http://sablednah.dnydns.org/
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

require('minequery.class.php');

defined('ABSPATH') or die("Cannot access pages directly.");

add_action( 'widgets_init', create_function( '', 'register_widget("MineQueryWidget");' ) );

class MineQueryWidget extends WP_Widget
{
	function MineQueryWidget() {
		$widget_ops = array( 
			'classname' => 'MineQueryWidget', 
			'description' => 'Display information about a minecraft server.' 
		);
		$this->WP_Widget( 'MineQueryWidget', 'MineQuery Widget', $widget_ops );
	}
	
	function widget($args, $instance) {
		extract( $args );

		$title = apply_filters('widget_title', $instance['title'] );
		$mq_ip = $instance['mq_ip'];
		$mq_port = $instance['mq_port'];

		echo $before_widget;
		
	    if ( $title ) echo $before_title . $title . $after_title;
		
		$thisarray = Minequery::query($mq_ip,$mq_port);
		if (!$thisarray) {
			echo("<div style='color:red;'>Offline</div>");
		} else {
			echo("<div style='color:green;'>Online</div>");
			echo("<div>$thisarray[playerCount] / $thisarray[maxPlayers] Players</div>");
				$players=$thisarray[playerList];
			echo("<div>");
			foreach ($players as $player) {
				echo ("$player ");
			}
				echo("</div>");
			echo("<div>");
			$latency=number_format($thisarray[latency],3);
			echo($latency);
			echo(" Latency</div>");
		}
		echo $after_widget;
	}
	

	function form( $instance ) {
		$defaults = array( 'title' => 'Server Status', 'mq_ip' => 'localhost', 'mq_port' => '25566' );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title</label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_ip' ); ?>">Server IP</label>
			<input id="<?php echo $this->get_field_id( 'mq_ip' ); ?>" name="<?php echo $this->get_field_name( 'mq_ip' ); ?>" value="<?php echo $instance['mq_ip']; ?>" style="width:100%;" />
		</p>
	
		<p>
			<label for="<?php echo $this->get_field_id( 'mq_port' ); ?>">Server Port</label>
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
}>>>>>>> .r531535
