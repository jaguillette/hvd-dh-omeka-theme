<?php
if ($pageTitle = __(get_theme_option("Browse Item Title"))) {
  #$browseNeatlineTitle is set
 } else {
  $pageTitle = __("Browse Items");
 }
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="navigation items-nav secondary-nav">
    <?php echo public_nav_items(); ?>
</nav>

<div class="page-meta">
	<p>Click on tags to find items with that tag, or check the boxes and click "Find selected tags" to search for items with all tags selected.</p>
</div>

<?php uasort($tags, function($a, $b) { return strcasecmp($a['name'],$b['name']); }); ?>

<div id="multi-tag">
  <form class="" action="browse" method="get">
    <?php echo dh_tag_cloud($tags, null); ?>
    <div id="multi-tag-submit">
      <button type="button" name="find-selected-tags">Find items with selected tags</button>
    </div>
  </form>
</div>

<script type="text/javascript">

  jQuery('#multi-tag-submit').click(function() {
    var tags = [];
    jQuery(".multi-tag:checked").each(function() {
      tags.push(jQuery(this).attr('value'));
    });
    window.location.href = "browse?tags=" + tags.join(",");
  });

	// insert_checkboxes(".hTagcloud li");

</script>

<?php echo foot(); ?>
