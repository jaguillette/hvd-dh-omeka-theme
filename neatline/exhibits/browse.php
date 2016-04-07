<?php

/**
 * @package     omeka
 * @subpackage  neatline
 * @copyright   2014 Rector and Board of Visitors, University of Virginia
 * @license     http://www.apache.org/licenses/LICENSE-2.0.html
 */

?>

<?php 
if ($pageTitle = get_theme_option("Browse Neatline Title")) {
 #$pageTitle is set
} else {
 $pageTitle = "Neatline | Browse Exhibits";
}
echo head(array(
  'title' => __($pageTitle),
  'content_class' => 'neatline'
)); ?>

<div id="primary">

  <?php echo flash(); ?>
  <h1><?php echo __($pageTitle); ?></h1>

  <?php if (nl_exhibitsHaveBeenCreated()): ?>

    <div class="pagination"><?php echo pagination_links(); ?></div>

      <?php foreach (loop('NeatlineExhibit') as $e): ?>
        <h2>
          <?php echo nl_getExhibitLink(
            $e, 'show', nl_getExhibitField('title'),
            array('class' => 'neatline'), true
          );?>
        </h2>
        <?php 
        if ($browseNeatlineNarrative = get_theme_option("Browse Neatline Narrative")) {
           echo(nl_getExhibitField('narrative'));
         } ?>
      <?php endforeach; ?>

    <div class="pagination"><?php echo pagination_links(); ?></div>

  <?php endif; ?>

</div>

<?php echo foot(); ?>
