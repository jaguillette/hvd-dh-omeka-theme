<?php
/**
 * Get random featured collections (plural).
 *
 * @package Omeka\Function\View\Collection
 * @uses get_records()
 * @param integer $num The maximum number of recent items to return
 * @param boolean|null $hasImage
 * @return array|Collection
 */
function dh_get_random_featured_collections($num = 5, $hasImage = null)
{
    return get_records('Collection', array('featured' => 1,
                                     'sort_field' => 'random',
                                     'hasImage' => $hasImage), $num);
}
/**
 * Get HTML for random featured collections (plural).
 *
 * @package Omeka\Function\View\Collection
 * @uses dh_get_random_featured_collections()
 * @param int $count Maximum number of items to show.
 * @param boolean $withImage Whether or not the featured items must have
 * images associated. If null, as default, all featured items can appear,
 * whether or not they have files. If true, only items with files will appear,
 * and if false, only items without files will appear.
 * @return string
 */
function dh_random_featured_collections($count = 5, $hasImage = null)
{
    $collections = dh_get_random_featured_collections($count, $hasImage);
    if ($collections) {
        $html = '';
        foreach ($collections as $collection) {
            $html .= get_view()->partial('collections/single.php', array('collection' => $collection));
            release_object($collection);
        }
        $html .= '';
    } else {
        $html = '<p>' . __('No featured collections are available.') . '</p>';
    }
    return $html;
}
/**
 * Get random featured exhibits.
 *
 * @package Omeka\Function\View\Exhibit
 * @uses get_records()
 * @param integer $num The maximum number of recent exhibits to return
 * @param boolean|null $hasImage
 * @return array|Exhibit
 */
function dh_get_random_featured_exhibits($num = 5, $hasImage = null)
{
    return get_records('Exhibit', array('featured' => 1,
                                     'sort_field' => 'random',
                                     'hasImage' => $hasImage), $num);
}
/**
 * Return the HTML for summarizing a random featured exhibit
 *
 * @return string
 */
function dh_display_random_featured_exhibits($num = 5, $hasImage = null)
{
    $html = '<h2>' . __('Featured Exhibits') . '</h2>';
	$html .= '<div id="featured-exhibit" class="grid js-masonry" data-masonry-options=\'{ "itemSelector": ".record", "columWidth": 296.666666667, "transitionDuration": "0.2s" }\'>';
	$exhibits = dh_get_random_featured_exhibits($num, $hasImage);
	if ($exhibits) {
		foreach ($exhibits as $exhibit) {
			$html .= get_view()->partial('exhibits/single.php', array('exhibit' => $exhibit));
			release_object($exhibit);
		}
	} else {
		$html .= '<p>' . __('You have no featured exhibits.') . '</p>';
	}
    $html .= '</div>';
    $html = apply_filters('exhibit_builder_display_random_featured_exhibit', $html);
    return $html;
}
/**
 * Return the user for a given user_id
 *
 * @return user
 */
function dh_get_user_by_id($user_id)
{
  $table_user = get_db()->getTable('User');
  $select = $table_user->getSelectForFind($user_id);
  return $table_user->fetchObject($select);
  /*try {
    $user = $table_user->findActiveById($user_id);
  } finally {
    $user = null;
  }
  return $user;*/
}

/**
 * Get only the theme's header image URL.
 *
 * @package Omeka\Function\View\Head
 * @uses get_theme_option()
 * @return string|null
 */
function dh_theme_header_image_url()
{
    $headerImage = get_theme_option('Header Image');
    if ($headerImage) {
        $storage = Zend_Registry::get('storage');
        $headerImage = $storage->getUri($storage->getPathByType($headerImage, 'theme_uploads'));
        return $headerImage;
    }
}

/**
 * Get the set of values for item type elements, including element descriptions.
 *
 * @package Omeka\Function\View\ItemType
 * @uses Item::getItemTypeElements()
 * @param Item|null $item Check for this specific item record (current item if null).
 * @return array
 */
function detailed_item_type_elements($item = null)
{
    if (!$item) {
        $item = get_current_record('item');
    }
    $elements = $item->getItemTypeElements();
    foreach ($elements as $element) {
        $elementText[$element->name] = array();
        $elementText[$element->name]['text'] = metadata($item, array(ElementSet::ITEM_TYPE_NAME, $element->name));
        $elementText[$element->name]['element_description'] = $element->description;
    }
    return $elementText;
}

/**
 * Get the display title for an item. 
 * If there is an element in the Item Type Metadata called Display Title, the
 * element referenced there will be used. If not, the default Dublin Core 
 * title will be used.
 */
function dh_theme_get_display_title()
{
  $itemTypeElements = detailed_item_type_elements();
  foreach ($itemTypeElements as $element => $elementInfo) {
    if (strpos($elementInfo['element_description'], 'Display Title')!==false) {
      return $elementInfo['text'];
    }
  }
  return metadata('item', array('Dublin Core', 'Title'));
}

/**
 * Get the display description for an item. 
 * If there is an element in the Item Type Metadata called Display Description, the
 * element referenced there will be used. If not, the default Dublin Core 
 * description will be used.
 *
 * @param int|null $snippet Slice the description to desired length with trailing 
 * ellipsis.
 */
function dh_theme_get_display_description($snippet=false)
{
  $itemTypeElements = detailed_item_type_elements();
  foreach ($itemTypeElements as $element => $elementInfo) {
    if (strpos($elementInfo['element_description'], 'Display Description')!==false) {
      if ($snippet and strlen($elementInfo['text'] > $snippet)) {
        return substr($elementInfo['text'],0,$snippet)."...";
      } else {
        return $elementInfo['text'];
      }
    }
  }
  return metadata('item', array('Dublin Core', 'Description'),array('snippet'=>$snippet));
}
?>
