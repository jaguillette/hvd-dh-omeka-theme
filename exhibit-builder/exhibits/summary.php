<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>

<h1><?php echo metadata('exhibit', 'title'); ?></h1>
<?php echo exhibit_builder_page_nav(); ?>

<div id="primary">
<?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
<div class="exhibit-description">
    <?php echo $exhibitDescription; ?>
</div>
<?php endif; ?>

<?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
<div class="exhibit-credits">
    <h3><?php echo __('Credits'); ?></h3>
    <p><?php echo $exhibitCredits; ?></p>
</div>
<?php endif; ?>
</div>

<?php
$pageTree = exhibit_builder_page_tree();
if ($pageTree):
?>
<nav id="exhibit-pages">
    <?php echo $pageTree; ?>
</nav>
<?php endif; ?>

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
