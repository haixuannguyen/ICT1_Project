<?php
$squery = get_search_query();
?>
<!-- SEARCH FORM -->
<div class="search">
	<form action="<?php print site_url(); ?>/" method="get" accept-charset="utf-8" class="search-form">
		<input type="text" class="input-text" name="s" value="<?php if(!empty($squery)){ print $squery; }else{ _e('SEARCH', 'princess'); } ?>" onfocus="if(this.value=='<?php _e('SEARCH', 'princess'); ?>'){this.value=''};" onblur="if(this.value==''){this.value='<?php _e('SEARCH', 'princess'); ?>'}" />
		<button type="submit"><i class="fa fa-search"></i></button>
	</form>
</div>