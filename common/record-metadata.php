<?php foreach ($elementsForDisplay as $setName => $setElements): ?>
<div class="element-set">
    <?php if ($showElementSetHeadings): ?>
    <h2><?php echo html_escape(__($setName)); ?></h2>
    <?php endif; ?>
    <table class="item-metadata">
    <?php foreach ($setElements as $elementName => $elementInfo): ?>
    <tr id="<?php echo text_to_id(html_escape("$setName $elementName")); ?>" class="element">
        <th><?php echo html_escape(__($elementName)); ?>:</th>
        <?php foreach ($elementInfo['texts'] as $text): ?>
            <td class="element-text"><?php echo $text; ?></td>
        <?php endforeach; ?>
    </tr><!-- end element -->
    <?php endforeach; ?>
    </table>
</div><!-- end element-set -->
<?php endforeach;
