<?php if (!$subjectRelations && !$objectRelations): ?>
    <?php #If there aren't relations, don't show anything ?>
<?php else: ?>
<div class="item-relations-display-browse">
    <h3><?php echo __('Item Relations'); ?></h3>
    <?php $relation_display_limit = 3; #Set number of relations to display on browse page here.
    $relations_counter = 0;
    $relation_limit_reached = False;
    ?>
    <table>
        <?php foreach ($subjectRelations as $subjectRelation): ?>
            <?php if ($relations_counter < $relation_display_limit): ?>
            <tr>
                <td><?php echo __('This Item'); ?></td>
                <td><span title="<?php echo html_escape($subjectRelation['relation_description']); ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
                <td>Item: <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
            </tr>
            <?php $relations_counter += 1; ?>
            <?php else: ?>
                <?php $relation_limit_reached = True; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php foreach ($objectRelations as $objectRelation): ?>
            <?php if ($relations_counter < $relation_display_limit): ?>
            <tr>
                <td>Item: <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
                <td><span title="<?php echo html_escape($objectRelation['relation_description']); ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
                <td><?php echo __('This Item'); ?></td>
            </tr>
            <?php $relations_counter += 1; ?>
            <?php else: ?>
                <?php $relation_limit_reached = True; ?>
            <?php endif; ?>
        <?php endforeach; ?>
        <?php if ($relation_limit_reached): ?>
            <tr><td>...</td></tr>
        <?php endif; ?>
    </table>
</div>
<?php endif; ?>
