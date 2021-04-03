<?php
$search = (get_query_var('as')) ? get_query_var('as') : '';
?>

<div class="author-search">
	<form method="get" id="sul-searchform" action="">
		<input type="text" class="field" name="as" id="sul-s" placeholder="<?php _e("\tSearch Users" ,'tpc-user-list');?>" value="<?php echo $search; ?>" size="64"/>
		<input type="submit" class="submit" id="sul-searchsubmit" value="<?php _e('Search' ,'tpc-user-list');?>" />
	</form>
	<?php
	if ($search){ ?>
		<u><a href="<?php the_permalink(); ?>"><?php _e('Back To User List' ,'tpc-user-list');?></a></u>
	<?php } ?>
</div>
<hr>