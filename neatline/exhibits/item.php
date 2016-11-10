<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<!-- Files. -->
<?php if (metadata('item', 'has files')): ?>
  <h3><?php echo __('Files'); ?></h3>
  <?php if (get_theme_option('Show Item File Gallery') == 0): ?>
    <?php echo dh_files_for_item(array('imageSize' => 'fullsize', 'linkAttributes'=>array('data-lightbox'=>'file-gallery'))); ?>
  <?php else: ?>
    <?php echo dh_files_for_item(
      array(
        'imageSize' => 'square_thumbnail',
        'linkAttributes'=>array('data-lightbox'=>'file-gallery')
      ),
      array(
        'class'=>'gallery-item item-file'
      )
    ); ?>
  <?php endif; ?>
<?php endif; ?>

<hr />

<!-- Texts. -->
<?php echo all_element_texts('item'); ?>

<!-- Link. -->
<?php echo link_to(
  get_current_record('item'), 'show', 'View the item in Omeka'
); ?>
