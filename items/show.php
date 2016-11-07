<?php
queue_css_file('jquery.fancybox');
?>
<?php echo head(array('title' => dh_theme_get_display_title(),'bodyclass' => 'items show')); ?>
<div id="primary">
    <h1><?php echo dh_theme_get_display_title(); ?>
      <?php if ($itemTypeName = metadata('item','item_type_name')): ?>
        <span class="item-metadata">(<?php echo metadata('item', 'item_type_name'); ?>)</span>
      <?php endif; ?>
      </h1>

    <?php if ($itemAttribution = get_theme_option('Item Attribution')) { ?>
    <div id="item-attribution">
    <?php
      $itemOwnerName = dh_get_user_by_id($item['owner_id'])['name'];
      $itemAttrLabel = get_theme_option('Item Attribution Label');
      echo("$itemAttrLabel $itemOwnerName");
    ?>
    </div>
    <?php } ?>

    <div class="mfull t2of5">
        <!-- Items metadata -->
        <div id="item-metadata">
            <?php echo all_element_texts('item'); ?>

            <?php if(metadata('item','Collection Name')): ?>
              <table id="collection" class="element">
              <tr>
                <th><?php echo __('Collection:'); ?></th>
                <td class="element-text"><?php echo link_to_collection_for_item(); ?></td>
              </tr>
              </table>
            <?php endif; ?>

            <!-- The following prints a list of all tags associated with the item -->
            <?php if (metadata('item','has tags')): ?>
            <table id="item-tags" class="element">
            <tr>
                <th><?php echo __('Tags:'); ?></th>
                <td class="element-text"><?php echo tag_string('item'); ?></td>
            </tr>
            </table>
            <?php endif;?>
        </div>
    </div>

    <div class="mfull t3of5">
        <?php if (metadata('item','has files')): ?>
            <div id="item-images">
                <h3><?php echo __('Files'); ?></h3>
                <?php echo dh_files_for_item(array('imageSize' => 'fullsize', 'linkAttributes'=>array('data-lightbox'=>'file-gallery'))); ?>
            </div>
        <?php else: ?>
            <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
        <?php endif; ?>
    </div>

    <div class="mfull">
        <?php if (metadata('item','has files')): ?>
            <?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
        <?php endif; ?>
    </div>

    <script type="text/javascript">
        if (jQuery(".item-col-right").height()==0) {jQuery(".item-col-left").attr('style', "width:100%;")}
    </script>

    <!-- The following prints a citation for this item. -->
    <?php if ($citation = get_theme_option("Show Item Citation")): ?>
    <div id="item-citation" class="element">
        <h3><?php echo __('Citation'); ?></h3>
        <div class="element-text"><?php echo metadata('item','citation',array('no_escape'=>true)); ?></div>
    </div>
    <?php endif; ?>

    <ul class="item-pagination navigation">
        <?php custom_next_previous(); ?>
    </ul>

</div> <!-- End of Primary. -->

<?php echo js_tag("fancybox-display"); ?>
<script type="text/javascript">
if (!jQuery(".t3of5").height()) {
    jQuery(".t2of5").removeClass("t2of5");
}
</script>

 <?php echo foot(); ?>
