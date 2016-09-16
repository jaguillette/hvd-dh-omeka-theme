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

<?php
  $collectionMaxDisplay = intval(get_theme_option('Browse Collection Max Items'));
  if (metadata('collection', 'total_items') > $collectionMaxDisplay):
  # If we have more than the maximum number of items we want to display,
  # Get the maximum number of items we'll display, and only show that many.
  # This item display is abbreviated.
?>
<div id="collection-items">
    <?php foreach (get_records('Item', array('collection'=>metadata('collection','id')), $collectionMaxDisplay) as $item): ?>
    <?php $itemTitle = strip_formatting(dh_theme_get_display_title($item)); ?>
    <div class="hentry">

        <?php if (metadata($item, 'has thumbnail')): ?>
        <div class="item-img">
            <?php echo dh_link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle),0,$item),array(),'show',$item,array('collection'=>metadata('collection','id'))); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
<?php
  elseif (metadata('collection', 'total_items') > 0):
  # Otherwise, if there are fewer items than the maximum but still some items,
  # Just display all of them, including descriptions.
?>
<div id="collection-items" class = "two-col">
    <?php foreach (get_records('Item', array('collection'=>metadata('collection','id')), $collectionMaxDisplay) as $item): ?>
    <?php $itemTitle = strip_formatting(dh_theme_get_display_title($item)); ?>
    <div class="item hentry">
        <h3><?php echo dh_link_to_item($itemTitle, array('class'=>'permalink'),'show',$item,array('collection'=>metadata('collection','id'))); ?></h3>

        <?php if (metadata($item, 'has thumbnail')): ?>
        <div class="item-img">
            <?php echo dh_link_to_item(item_image('square_thumbnail', array('alt' => $itemTitle),0,$item),array(),'show',$item,array('collection'=>metadata('collection','id'))); ?>
        </div>
        <?php endif; ?>

        <?php if ($description = dh_theme_get_display_description(250, $item)): ?>
        <div class="item-description">
            <p><?php echo $description; ?></p>
        </div>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
<?php else: # Let folks know that there aren't any items here?>
<div id="collection-items">
    <p><?php echo __("There are currently no items within this collection."); ?></p>
<?php endif; ?>
</div><!-- end collection-items -->

<?php if (metadata('collection', 'total_items') > 10): ?>
    <div id="collection-browse-link"><?php echo link_to_items_browse(__('View items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></div>
<?php endif; ?>

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
