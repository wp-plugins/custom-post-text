<?php
/*
Plugin Name: Custom Post Text
Plugin URI: http://www.jjtcomputing.co.uk/blog/
Description: Include custom text before or after every post.
Version: 2.0
Author: Jonathan Ellse
Author URI: http://www.jjtcomputing.co.uk/blog/
*/
/*  Copyright 2009  Custom Post Text  (email : webmaster@jjtcomputing.co.uk)
    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_filter('the_content', 'add_customposttext');
function add_customposttext($content)
{
$postfooter= '<p>'.get_option(customposttext_postfooter).'</p>';
$postheader= '<p>'.get_option(customposttext_postheader).'</p>';
return $postheader.$content.$postfooter;	
}
?>
<?php
function customposttext_option()
{
?>
<div class="wrap">
<h2>Custom Post Text</h2>
<form method="post" action="options.php">
<?php wp_nonce_field('update-options'); ?>
<table class="form-table"

<tr valign="top">
<th scope="row">Post Header</th>
<td><input type="text" name="customposttext_postheader" value="<?php echo get_option('customposttext_postheader'); ?>" /></td>
</tr>

<tr valign="top">
<th scope="row">Post Footer</th>
<td><input type="text" name="customposttext_postfooter" value="<?php echo get_option('customposttext_postfooter'); ?>" /></td>
</tr>

</table>

<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="customposttext_postfooter, customposttext_postheader" />
<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
</div>
<?php 
}

function customposttext_add_admin()
{
	add_options_page('Custom Post Text', 'Custom Post Text', 7, 'customposttext', 'customposttext_option');
}

function customposttext_install()
{ 
	add_option('customposttext_postfooter', "");
}


add_action('admin_menu', 'customposttext_add_admin');
register_activation_hook(__FILE__,"customposttext_install");
        
?>