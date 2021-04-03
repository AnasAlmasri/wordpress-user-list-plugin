<?php
global $user;
?>
      
<tr>
	<td>
		<?php 
			do_action('tpcul_before_user_loop_author', $user);
			do_action('tpcul_before_user_loop_author_title', $user); 
		?>
	</td>
	<td>
		<?php 
			do_action('tpcul_user_loop_author_title', $user); 
			do_action('tpcul_after_user_loop_author_title', $user);
			do_action('tpcul_after_user_loop_author', $user);
		?>
	</td>
	<td><?php echo $user->posts_count; ?></td>
	<td><?php echo $user->groups_count; ?></td>
	<td><?php echo $user->friends_count; ?></td>
</tr>
