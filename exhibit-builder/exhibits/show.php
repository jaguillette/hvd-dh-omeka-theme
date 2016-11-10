<?php queue_css_file('jquery.fancybox'); ?>
<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>

<nav id="exhibit-pages">
    <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
    <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
</nav>

<h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></h1>

<div id="exhibit-blocks">
<?php exhibit_builder_render_exhibit_page(); ?>
</div>

<!--<div id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
    <?php echo $prevLink; ?>
    </div>
    <?php endif; ?>
    <?php if ($nextLink = exhibit_builder_link_to_next_page()): ?>
    <div id="exhibit-nav-next">
    <?php echo $nextLink; ?>
    </div>
    <?php endif; ?>
    <div id="exhibit-nav-up">
    <?php echo exhibit_builder_page_trail(); ?>
    </div>
</div>-->

<?php if ($exhibitAttribution = get_theme_option('Exhibit Attribution')) { ?>
<div id="exhibit-attribution">
<?php
  $exhibitOwnerName = dh_get_user_by_id($exhibit['owner_id'])['name'];
  $exhibitAttrLabel = get_theme_option('Exhibit Attribution Label');
  echo("$exhibitAttrLabel $exhibitOwnerName");
?>
</div>
<?php } ?>

<?php echo foot(); ?>
