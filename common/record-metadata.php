<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php if ($showElementSetHeadings): ?>
    <h2><?php echo html_escape(__($setName)); ?></h2>
    <?php endif; ?>
    <div class="item-metadata">
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <h2><?php echo html_escape(__($elementName)); ?>:</h2>
        <div class="element-text">
            <?php foreach ($elementInfo['texts'] as $text): ?>
                <p><?php echo $text; ?></p>
            <?php endforeach; ?>
        </div>
    </div><!-- end element -->
    <?php endforeach; ?>
  </div>
</div><!-- end element-set -->
<?php endforeach;
