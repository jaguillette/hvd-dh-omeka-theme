<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<?php if ($collectionAttribution = get_theme_option('Collection Attribution')): ?>
<div id="collection-attribution">
<?php
  $collectionOwnerName = dh_get_user_by_id($collection['owner_id'])['name'];
  $collectionAttrLabel = get_theme_option('Collection Attribution Label');
  echo("$collectionAttrLabel $collectionOwnerName");
?>
</div>
<?php endif; ?>

<?php 
    $description =  metadata('collection', array('Dublin Core','Description'));
    if ($description) {
        echo("<p>$description</p>");
    }
?>

<div id="collection-items">
    <?php if (metadata('collection', 'total_items') > 0): ?>
        <?php foreach (loop('items') as $item): ?>
        <?php $itemTitle = strip_formatting(metadata('item', array('Dublin Core', 'Title'))); ?>
        <div class="hentry">

            <?php if (metadata('item', 'has thumbnail')): ?>
            <div class="item-img">
                <?php echo link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle))); ?>
            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p><?php echo __("There are currently no items within this collection."); ?></p>
    <?php endif; ?>
</div><!-- end collection-items -->


<div id="collection-browse-link"><?php echo link_to_items_browse(__('View items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></div>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
