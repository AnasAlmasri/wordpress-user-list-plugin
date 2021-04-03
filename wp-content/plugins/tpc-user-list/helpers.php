<?php 

function tpcul_get_template_part($slug, $name = '') {
	$tpcul = TPC_User_List::get_instance();
	$template = '';
	if ($name) {
		$template = locate_template(array("{$slug}-{$name}.php", "{$tpcul->template_url()}{$slug}-{$name}.php"));
	}
	if (!$template && $name && file_exists($tpcul->plugin_path() . "/templates/{$slug}-{$name}.php")){
		$template = $tpcul->plugin_path() . "/templates/{$slug}-{$name}.php";
	}
	if ($template) load_template($template, false);
}

function tpcul_template_loop_author_avatar($user) {
	echo get_avatar($user->ID, 25);
}

function tpcul_template_loop_author_name( $user ) {
	$num_posts = count_user_posts( $user->ID );
	$user_info = get_userdata( $user->ID );
	$display_name =$user_info->display_name;
	echo '<h6>'. $display_name . '</h6>';
}
