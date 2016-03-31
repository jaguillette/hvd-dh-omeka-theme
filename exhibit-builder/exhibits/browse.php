<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1>
<?php 
if (array_key_exists('tags', $_GET)) {
    $space_replace = array('-', '_');
    $tag_title = ucwords(str_replace($space_replace, ' ', $_GET['tags']));
    echo($tag_title);
} else {
    echo $title;
}

?>
<?php if ($browseCount = get_theme_option('Browse Exhibit Show Count')): ?>
    <?php echo __('(%s total)', $total_results); ?>
<?php endif; ?></h1>

<?php if (count($exhibits) > 0): ?>

<?php if ($browseOptions = get_theme_option('Browse Exhibit Show Browse Options')): ?>
<nav class="navigation secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        ),
        array(
            'label' => __('Browse by Tag'),
            'uri' => url('exhibits/tags')
        )
    )); ?>
</nav>
<?php endif; ?>

<?php echo pagination_links(); ?>
<?php if ($browseDescription = get_theme_option('Browse Exhibit Description')): ?>
    <div class="browse-exhibit-description"><p><?php echo $browseDescription; ?></p></div>
<?php endif; ?>

<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php $exhibitCount++; ?>
    <div class="exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
        <h2><?php echo link_to_exhibit(); ?></h2>
        <?php if ($exhibitAttribution = get_theme_option('Exhibit Attribution')) { ?>
        <div class="browse-attribution">
        <?php
          $exhibitOwnerName = dh_get_user_by_id($exhibit['owner_id'])['name'];
          $exhibitAttrLabel = get_theme_option('Exhibit Attribution Label');
          echo("$exhibitAttrLabel $exhibitOwnerName");
        ?>
        </div>
        <?php } ?>
        <?php if ($exhibitImage = record_image($exhibit, 'square_thumbnail')): ?>
            <?php echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
        <?php endif; ?>
        <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true, 'snippet' => 1000))): ?>
        <div class="description"><?php echo $exhibitDescription; ?></div>
        <?php endif; ?>
        <?php 
        // Turned off exhibit tag display
        if ($exhibitTags = tag_string('exhibit', 'exhibits') and !array_key_exists('tags', $_GET)): ?>
        <p class="tags"><?php echo $exhibitTags; ?></p>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>

<?php echo foot(); ?>
