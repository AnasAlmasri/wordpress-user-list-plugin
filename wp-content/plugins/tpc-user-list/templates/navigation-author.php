<?php
global $tpc_user_list, $sul_users;

if (function_exists('wp_pagenavi')):
	wp_pagenavi(
		array(
			'query' => $sul_users,
			'type' => 'users'
		) 
	);
elseif (TPC_User_List::get_instance()->get_total_user_pages() > 1) : ?>
	<nav id="nav-single">
		<div class="row" style="text-align: center;">
		<?php if ($previous_url = TPC_User_List::get_instance()->get_previous_users_url()) : ?>
			<div class="col">
			<span class="nav-previous"><a rel="prev" href="<?php esc_attr_e($previous_url); ?>"><?php _e('<span class="meta-nav">&larr;</span> Previous', 'tpc-user-list');?></a></span>
			</div>
		<?php endif; ?>
		<?php if ($next_url = TPC_User_List::get_instance()->get_next_users_url()) : ?>
			<div class="col" style="text-align: center;">
			<span class="nav-next"><a rel="next" href="<?php esc_attr_e($next_url); ?>"><?php _e('Next <span class="meta-nav">&rarr;</span>', 'tpc-user-list');?></a></span>
		</div>
		<?php endif; ?>
		</div>
	</nav>
<?php endif; ?>