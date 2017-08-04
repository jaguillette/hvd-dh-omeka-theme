<?php if (!$subjectRelations && !$objectRelations): ?>
    <?php #If there aren't relations, don't show anything ?>
<?php else: ?>
  <div id="item-relations-display-item-relations">
      <h2><?php
        if (get_option('item_relations_display_title')) {
          echo __(get_option('item_relations_display_title'));
        } else {
          echo __('Item Relations');
        }
        ?></h2>
      <?php if (!$subjectRelations && !$objectRelations): ?>
      <p><?php echo __('This item has no relations.'); ?></p>
      <?php else: ?>
      <table>
          <?php foreach ($subjectRelations as $subjectRelation): ?>
          <tr>
              <td><?php echo __('This Item'); ?></td>
              <td><span title="<?php echo html_escape($subjectRelation['relation_description']); ?>"><?php echo $subjectRelation['relation_text']; ?></span></td>
              <?php if (array_key_exists("object_item_type",$subjectRelation)): ?>
                <td>Item: <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title'].$subjectRelation['object_item_type']; ?></a></td>
              <?php else: ?>
                <td>Item: <a href="<?php echo url('items/show/' . $subjectRelation['object_item_id']); ?>"><?php echo $subjectRelation['object_item_title']; ?></a></td>
              <?php endif; ?>
          </tr>
          <?php endforeach; ?>
          <?php foreach ($objectRelations as $objectRelation): ?>
          <tr>
            <?php if (array_key_exists('subject_item_type',$objectRelation)): ?>
              <td>Item: <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title'].$objectRelation['subject_item_type']; ?></a></td>
            <?php else: ?>
              <td>Item: <a href="<?php echo url('items/show/' . $objectRelation['subject_item_id']); ?>"><?php echo $objectRelation['subject_item_title']; ?></a></td>
            <?php endif; ?>
              <td><span title="<?php echo html_escape($objectRelation['relation_description']); ?>"><?php echo $objectRelation['relation_text']; ?></span></td>
              <td><?php echo __('This Item'); ?></td>
          </tr>
          <?php endforeach; ?>
      </table>
      <?php endif; ?>
  </div>

<?php endif; ?>
