<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php if ($showElementSetHeadings): ?>
    <h2><?php echo html_escape(__($setName)); ?></h2>
    <?php endif; ?>
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <div id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <div>
        <strong><?php echo html_escape(__($elementName)); ?>:</strong>
        <?php foreach ($elementInfo['texts'] as $text): ?>
            <span class="element-text"><?php echo $text; ?></span>
        <?php endforeach; ?>
        </div>
    </div><!-- end element -->
    <?php endforeach; ?>
</div><!-- end element-set -->
<?php endforeach;
