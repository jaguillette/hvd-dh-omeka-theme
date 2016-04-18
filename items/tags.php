<?php
$pageTitle = __('Browse Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="navigation items-nav secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<?php uasort($tags, function($a, $b) { return strcasecmp($a['name'],$b['name']); }); ?>
<?php echo tag_cloud($tags, 'items/browse'); ?>

<div id="multi-tag"></div>

<script type="text/javascript">
	function insert_checkboxes(element_selector, form_selector) {
		var items = jQuery(element_selector);
		items.each( function() {
			jQuery(this).before('<input type="checkbox" class="multi-tag" value="'+jQuery(this).text()+'">');
		})
	}

	insert_checkboxes(".hTagcloud li a");

	var selected_tags = [];

	jQuery('#multi-tag').append('<div id="multi-tag-submit"><a href="#" >Find selected tags</a></div>')

	jQuery(".multi-tag").on('click', function() {
		if (jQuery(this).is(":checked")) {
			selected_tags.push(jQuery(this).attr("value"));
		} else {
			var index = selected_tags.indexOf(jQuery(this).attr("value"));
			if (index > -1) {
				selected_tags.splice(index, 1);
			}
		}
		jQuery("#multi-tag-submit a").attr("href", "browse?tags="+selected_tags.join(","));
	})
</script>

<?php echo foot(); ?>
