<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php echo head(array(
  'title' => nl_getExhibitField('title'),
  'bodyclass' => 'neatline show'
)); ?>

<!-- Exhibit title: -->
<h1><?php echo nl_getExhibitField('title'); ?></h1>

<!-- "View Fullscreen" link: -->
<?php echo nl_getExhibitLink(
  null, 'fullscreen', __('View Fullscreen'), array('class' => 'nl-fullscreen')
); ?>

<!-- Exhibit and description : -->
<?php echo nl_getExhibitMarkup(); ?>
<?php if (nl_getExhibitField('narrative')): ?>
<!-- Narrative -->
<div id="minimize-button">&lt;</div>
<div id="neatline-narrative" class="narrative">
  <!-- Content. -->
  <h1><?php echo nl_getExhibitField('title'); ?></h1>
  <?php echo nl_getExhibitField('narrative'); ?>
</div>
<?php endif; ?>

<?php echo foot(); ?>
