<?php

/**

 * @package Disable Plugin Updates
 * @author Websiteguy

 * @version 0.5
*/

/*

Plugin Name: Disable Plugin Updates

Plugin URI: http://wordpress.org/plugins/disable-plugin-updates/
Version: 0.5
Description: A simple WordPress plugin that disables all the updating of plugins.
Author: <a href="http://profiles.wordpress.org/kidsguide">Websiteguy</a>
Author URL: http://profiles.wordpress.org/kidsguide
Compatible with WordPress 2.3+.


*/


/*

Copyright 2013 Websiteguy (email : mpsparrow@cogeco.ca)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



// Hides all upgrade notices
add_action('admin_menu','hide_admin_notices');
function hide_admin_notices() {
    remove_action( 'admin_notices', 'update_nag', 3 );
}

// Disable plugin updates
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

