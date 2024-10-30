<?php
/*
Plugin Name: Manuscript
Plugin URI: http://www.vjcatkick.com/?page_id=7313
Description: brabrabra
Version: 0.0.1
Author: V.J.Catkick
Author URI: http://www.vjcatkick.com/
*/

/*
License: GPL
Compatibility: WordPress 2.6 with Widget-plugin.

Installation:
Place the widget_single_photo folder in your /wp-content/plugins/ directory
and activate through the administration panel, and then go to the widget panel and
drag it to where you would like to have it!
*/

/*  Copyright V.J.Catkick - http://www.vjcatkick.com/

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
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
*/


/* Changelog
* Feb 07 2009 - v0.0.1
- Initial release
*/


function manuscript_init() {
	add_action( 'admin_menu', 'manuscript_config_page');
} /* manuscript_init() */
add_action('init', 'manuscript_init');

function manuscript_config_page() {
	if ( function_exists('add_options_page') )
		add_options_page( 'Manuscript Configuration', 'Manuscript',  8, 'manuscript_options_page', 'manuscript_conf' );
} /* manuscript_config_page */

function manuscript_conf() {
	$options = $newoptions = get_option('manuscript_options');

	if ( $_POST["manuscript_options_submit"] ) {
		$newoptions['manuscript_options_color_border'] = $_POST["manuscript_options_color_border"];
		$newoptions['manuscript_options_box_size'] = (int)$_POST["manuscript_options_box_size"];
		$newoptions['manuscript_options_font_size'] = $_POST["manuscript_options_font_size"];
//		$newoptions['manuscript_options_outer_width'] = $_POST["manuscript_options_outer_width"];
		$newoptions['manuscript_options_num_char'] = (int) $_POST["manuscript_options_num_char"];

		$newoptions['manuscript_options_disp_shop_name'] = (boolean) $_POST["manuscript_options_disp_shop_name"];
		$newoptions['manuscript_options_shop_name'] = $_POST["manuscript_options_shop_name"];
		$newoptions['manuscript_options_disp_is_paging'] = (boolean) $_POST["manuscript_options_disp_is_paging"];
		$newoptions['manuscript_options_img_paging_lines'] = (int) $_POST["manuscript_options_img_paging_lines"];
	} /* if */
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('manuscript_options', $options);
	} /* if */

	// those are default value
	if ( !$options['manuscript_options_color_border'] ) $options['manuscript_options_color_border'] = '#66FFCC';
	if ( !$options['manuscript_options_box_size'] ) (int)$options['manuscript_options_box_size'] = '20';	// '20px'
	if ( !$options['manuscript_options_font_size'] ) $options['manuscript_options_font_size'] = '0.9em';
//	if ( !$options['manuscript_options_outer_width'] ) $options['manuscript_options_outer_width'] = '420px';
	if ( !$options['manuscript_options_num_char'] ) $options['manuscript_options_num_char'] = 20;
	if ( $options['manuscript_options_disp_shop_name'] !== false && $options['manuscript_options_disp_shop_name'] !== true ) $options['manuscript_options_disp_shop_name'] = true;
	if ( !$options['manuscript_options_shop_name'] ) $options['manuscript_options_shop_name'] = '猫蹴文具堂';
	if ( $options['manuscript_options_disp_is_paging'] !== false && $options['manuscript_options_disp_is_paging'] !== true ) $options['manuscript_options_disp_is_paging'] = true;
	if ( !$options['manuscript_options_img_paging_lines'] ) $options['manuscript_options_img_paging_lines'] = 20;

	// for option page
	$_color_border = $options['manuscript_options_color_border'];
	$_box_size = (int)$options['manuscript_options_box_size'];
	$_font_size = $options['manuscript_options_font_size'];
//	$_outer_width = $options['manuscript_options_outer_width'];
	$_num_char = $options['manuscript_options_num_char'];
	$_disp_shop_name = $options['manuscript_options_disp_shop_name'];
	$_shop_name = $options['manuscript_options_shop_name'];
	$_is_paging = $options['manuscript_options_disp_is_paging'];
	$_paging_lines = $options['manuscript_options_img_paging_lines'];

?>
<?php if ( !empty($_POST ) ) : ?>
<div id="message" class="updated fade"><p><strong><?php _e('Options saved.') ?></strong></p></div>
<?php endif; ?>
<div class="wrap"><div class='narrow' >
<h2><?php _e('Manuscript Configuration','manuscript'); ?></h2>
<form action="" method="post" id="manuscript-conf" style="margin: auto; width: 400px; ">

	<h3><?php _e( 'Style','manuscript'); ?></h3>
<p>
	<div style="width:120px; float:left;" ><?php _e('Border color:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_color_border" name="manuscript_options_color_border" type="text" value="<?php echo $_color_border; ?>" /><br clear="left" />

	<div style="width:120px; float:left;" ><?php _e('Font size:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_font_size" name="manuscript_options_font_size" type="text" value="<?php echo $_font_size; ?>" /><br clear="left" />

	<div style="width:120px; float:left;" ><?php _e('Box size:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_box_size" name="manuscript_options_box_size" type="text" value="<?php echo $_box_size; ?>" />px<br clear="left"/>

	<div style="width:120px; float:left;" ><?php _e('Characters:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_num_char" name="manuscript_options_num_char" type="text" value="<?php echo $_num_char; ?>" /><br clear="left" />

<!--
	<div style="width:120px; float:left;" ><?php _e('Outbox width:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_outer_width" name="manuscript_options_outer_width" type="text" value="<?php echo $_outer_width; ?>" /><br clear="left" />
-->
</p>

<hr />

	<h3><?php _e( 'Other options','manuscript'); ?></h3>
<p>
	<input id="manuscript_options_disp_shop_name" name="manuscript_options_disp_shop_name" type="checkbox" value="1" <?php if( $_disp_shop_name == 1 ) echo 'checked';?>/><?php _e(' Display shop name at bottom','manuscript'); ?><br />

	<div style="width:120px; float:left;" ><?php _e('Shop name:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_shop_name" name="manuscript_options_shop_name" type="text" value="<?php echo $_shop_name; ?>" /><br clear="all" />
</p>

<p>
	<input id="manuscript_options_disp_is_paging" name="manuscript_options_disp_is_paging" type="checkbox" value="1" <?php if( $_is_paging == 1 ) echo 'checked';?>/><?php _e(' Use paging at specific number of lines','manuscript'); ?><br />

	<div style="width:120px; float:left;" ><?php _e('Paging lines:','manuscript'); ?></div><input style="width: 100px;" id="manuscript_options_img_paging_lines" name="manuscript_options_img_paging_lines" type="text" value="<?php echo $_paging_lines; ?>" /><br clear="all" />
</p>

<hr />

	<h3><?php _e( 'Documents','manuscript'); ?></h3>
<p>
	<?php _e( 'Plugin page: ','manuscript'); ?><br />
	&nbsp;&bull;<a href="http://www.vjcatkick.com/?page_id=5930" target="_blank" >http://www.vjcatkick.com/?page_id=0000</a><br /><br />
	<?php _e( 'Manuscript Documentation: (in Japanese)','manuscript'); ?><br />
	&nbsp;&bull;<a href="http://www.vjcatkick.com/" target="_blank" >http://www.vjcatkick.com/......</a><br />
	<div style="width:100%;text-align:right;"><a href="http://www.vjcatkick.com/" target="_blank"><img src='http://www.vjcatkick.com/logo_vjck.png' border='0'/></a></div>
</p>

	<p class="submit"><input type="submit" name="manuscript_options_submit" value="<?php _e('Update options &raquo;','manuscript'); ?>" /></p>
</form>
</div>
</div> <!-- wrap -->
<?php
} /* manuscript_conf() */


function make_manuscript_callback( $matches ) {
	$src_text = $matches[0];
	$output = '';

//	$src_text = ereg_replace( array( "\n", "\r", "\t", "\0", "\x0B" ), "", $src_text );
	$src_text =  preg_replace( "/<\/p>(.+?)<p>/s", "<br /><br />", $src_text );
	$src_text = preg_replace( array( '/\n/s', '/\r/s' ), "", $src_text );

	//	option <manuscript col="10" >
	// other '/width((.+?)=(.+?)|(.+?)=|=(.+?)|=)(\"|\')[0-9]+(.+?)(\"|\')/'
	$arg_col_num = null;
	$arg_paging_num = null;
	$arg_fsize_str = null;
	$arg_bcolor_str = null;
	$arg_vertical = null;

	$is_col_str = preg_match( "/col((.+?)=(.+?)|(.+?)=|=(.+?)|=)(\"|\')[0-9]+(\"|\')/s", $src_text, $col_str );
	if( $is_col_str ) {
		$is_col_str = preg_match( "/(\"|\')[0-9]+(\"|\')/s", $col_str[0], $col_num );
		if( $is_col_str ) {
			$arg_col_num = (int) preg_replace( '/(\"|\')/', '', $col_num[0] );
		} /* if */
	} /* if */

	$is_paging_str = preg_match( "/paging((.+?)=(.+?)|(.+?)=|=(.+?)|=)(\"|\')[0-9]+(\"|\')/s", $src_text, $paging_str );
	if( $is_paging_str ) {
		$is_paging_str = preg_match( "/(\"|\')[0-9]+(\"|\')/s", $paging_str[0], $paging_num );
		if( $is_paging_str ) {
			$arg_paging_num = (int) preg_replace( '/(\"|\')/', '', $paging_num[0] );
		} /* if */
	} /* if */

	$is_fsize_str = preg_match( "/fsize((.+?)=(.+?)|(.+?)=|=(.+?)|=)(\"|\')[0-9]+(.+?)(\"|\')/", $src_text, $fsize_str );
	if( $is_fsize_str ) {
		$is_fsize_str = preg_match( "/(\"|\')[0-9]+(.+?)(\"|\')/s", $fsize_str[0], $fsize_the_str );
		if( $is_fsize_str ) {
			$arg_fsize_str = preg_replace( '/(\"|\')/', '', $fsize_the_str[0] );
		} /* if */
	} /* if */

	$is_bcolor_str = preg_match( "/bcolor((.+?)=(.+?)|(.+?)=|=(.+?)|=)(\"|\')(.+?)(\"|\')/", $src_text, $bcolor_str );
	if( $is_bcolor_str ) {
		$is_bcolor_str = preg_match( "/(\"|\')(.+?)(\"|\')/s", $bcolor_str[0], $bcolor_the_str );
		if( $is_bcolor_str ) {
			$arg_bcolor_str = preg_replace( '/(\"|\')/', '', $bcolor_the_str[0] );
		} /* if */
	} /* if */

	$is_vertical_str = preg_match( "/vertical/", $src_text, $vartical_str );
	if( $is_vertical_str ) {
		$arg_vertical = true;
	} /* if */

	$src_text = preg_replace( "/^(<manuscript?>|<manuscript(.+?)>)/s", "", $src_text );
	$src_text = preg_replace( "/<\/manuscript>/s", "", $src_text );

	// possible options
	$options = get_option('manuscript_options');
	$_box_size = (int)$options['manuscript_options_box_size'];
	if( $arg_bcolor_str ) $_color_border = $arg_bcolor_str;
	else $_color_border = $options['manuscript_options_color_border'];
	if( $arg_fsize_str ) $_font_size = $arg_fsize_str;
	else $_font_size = $options['manuscript_options_font_size'];
	if( $arg_col_num ) $_num_char = $arg_col_num;
	else $_num_char = $options['manuscript_options_num_char'];

	$_outer_width = ( ($_num_char * ($_box_size + ($arg_vertical ? 5 : 1))) + 1 ) . 'px';
	$_box_size = $_box_size . 'px';

	$_disp_shop_name = $options['manuscript_options_disp_shop_name'];
	$_shop_name = $options['manuscript_options_shop_name'];
	$_is_paging = $options['manuscript_options_disp_is_paging'];
	if( $arg_paging_num ) $_paging_lines = $arg_paging_num;
	else $_paging_lines = $options['manuscript_options_img_paging_lines'];


	// box definitions
	$vert_css = $arg_vertical ? 'writing-mode: tb-rl; ' : '';

	$outmost = '<div id="manuscript_outmost" style="width: ' . $_outer_width . '; float:left; margin-top:1em; font-size: ' . $_font_size . ';" >';

	if( $arg_vertical ) {
		$outerbox = '<div id="manuscript_outer" style="width: ' . $_outer_width . '; border: 2px solid ' . $_color_border . ';padding-left:4px; float:left;" >';

		$div_line = '<div class="manuscript_line" style="width:100%; float:left; ; height:' . $_box_size . '; " >';
		$div_box = '<div class="manuscript_box" style="text-align:center; vertical-align: middle; ' . $vert_css . 'width:' . $_box_size . ';height:' . $_box_size . '; border-bottom:1px solid ' . $_color_border . '; border-left:1px solid ' . $_color_border . '; border-right:1px solid ' . $_color_border . '; float:left; margin-right: 3px;">';
		$div_box_R = '<div class="manuscript_box" style="text-align:center;' . $vert_css . 'width:' . $_box_size . ';height:' . $_box_size . '; border-bottom:1px solid ' . $_color_border . '; border-left:1px solid ' . $_color_border . '; border-right:1px solid ' . $_color_border . '; float:left;">';

	}else{
		$outerbox = '<div id="manuscript_outer" style="width: ' . $_outer_width . '; border: 2px solid ' . $_color_border . ';padding-top:0.25em; float:left;" >';

		$div_line = '<div class="manuscript_line" style="width:100%; float:left; border-top: 1px solid ' . $_color_border . '; border-bottom:1px solid ' . $_color_border . '; height:' . $_box_size . '; margin-bottom: 0.25em;" >';
		$div_box = '<div class="manuscript_box" style="text-align:center; vertical-align: middle; width:' . $_box_size . ';height:' . $_box_size . '; border-right:1px solid ' . $_color_border . '; float:left;">';
		$div_box_R = '<div class="manuscript_box" style="text-align:center;width:' . $_box_size . ';height:' . $_box_size . '; float:left;">';
	} /* if else */

	$closediv = '</div>';

	// code
	$paras = array();

	$crlf_html = '<br />';
	do {
		$spos = mb_strpos( $src_text, $crlf_html );
		if( $spos !== false ) {
			if( $spos > 0 ) {
				$paras[] = mb_substr( $src_text, 0, $spos );
			}else{
				$paras[] = '';
			} /* else */
			$src_text = mb_substr( $src_text, $spos + strlen( $crlf_html ) );
		}else{
			$paras[] = $src_text;
			break;
		} /* if else */
	} while( $spos !== false );
//print_r( $paras );
//echo '<br />----------<br />';

	$para = array();

	if( $arg_vertical ) {
		$total_lines = count( $para );
		$_is_paging = true; // force paging

		foreach( $paras as $p ) {
			if( strlen( $p ) ) $src_str .= $p;
			else {
				// those are for blank lines
				$src_str .= 0;
				$src_str .= 0;
			} /* if else */
		} /* foreach */
//print_r( $src_str );
//echo '<br />----------<br />';

		$new_para = array();
		$blocks = 0;
		$i = 0;
		$safebelt = 0;
		do {
			if( mb_strlen( $src_str ) <= $i ) break;
			for( $n = 0; $n < $_num_char; $n++ ) {
				for( $z = 0; $z < $_paging_lines; $z++ ) {
					$theChar = mb_substr( $src_str, $i++, 1 );
					if( $theChar != false ) $new_para[ $z + $blocks ] = $theChar . $new_para[ $z + $blocks ];
					else {
						for( $s = $z; $s < $_paging_lines; $s++, $z++ ) {
							$new_para[ $z + $blocks ] = ' ' . $new_para[ $z + $blocks ];
						} /* for */
					} /* else */
				} /* for */
			} /* for */
			$blocks += $_paging_lines;
		} while( $safebelt < 10000 );

//print_r( $new_para );
		$para = array_merge( $para, $new_para );

	}else{
		foreach( $paras as $p ) {
			if( !$p ) {
				$blankline = '';
				for( $i = 0; $i < $_num_char; $i++ ) $blankline .= ' ';
				$para[] = $blankline;
			}else{
				$len = mb_strlen( $p );
				$_lines = floor( $len / $_num_char );
				for( $i = 0; $i < $_lines; $i++ ) {
					$para[] = mb_substr( $p, 0, $_num_char );
					$p = mb_substr( $p, $_num_char );
				} /* for */
				$len = mb_strlen( $p );
				if( $len > 0 ) {
					$_restline = $p;
					for( $i = 0; $i < $_num_char - $len; $i++ ) $_restline .= ' ';
					$para[] = $_restline;
				} /* if */
			} /* if else */
		} /* foreach */
	} /* if else */

	// output section
	$output = $outmost . $outerbox;

		$line_num = 0;
		foreach( $para as $line ) {
			$output .= $div_line;
			for( $i = 0; $i < mb_strlen( $line ); $i++ ) {
				$output .= $i == mb_strlen( $line ) - 1 ? $div_box_R : $div_box;
				$output .= mb_substr( $line, $i, 1 );
				$output .= $closediv;	// div_box
			} /* for */
			$output .= $closediv;	// div_line
			if( $_is_paging && (++$line_num) % $_paging_lines == 0 ) {
				if( $line_num >= count( $para ) ) break;
				$output .= $closediv;	// outerbox
				if( $_disp_shop_name ) {
					$output .= '<div style="float:left;width:' . $_outer_width . ';text-align:center;font-size:9px;color:' . $_color_border . ';">' . $_shop_name. '謹製' . $_num_char . '字詰原稿用紙</div>';
				} /* if */
				$output .= $closediv; // outmost
				$output .= $outmost . $outerbox;
			} /* if */
		} /* foreach */

	$output .= $closediv;	// outerbox
	if( $_disp_shop_name ) {
		$output .= '<div style="float:left;width:' . $_outer_width . ';text-align:center;font-size:9px;color:' . $_color_border . ';">' . $_shop_name. '謹製' . $_num_char . '字詰原稿用紙</div>';
	} /* if */
	$output .= $closediv; // outmost

	$output .= '<br clear="left" />';

	return( $output );
} /* make_manuscript_callback() */

function filter_manuscript_block( $content ) {
	$content =  preg_replace_callback( "/<manuscript(.+?)<\/manuscript>/s", "make_manuscript_callback", $content );
	return( $content );
} /* filter_manuscript_block() */

add_filter('the_content','filter_manuscript_block');

?>