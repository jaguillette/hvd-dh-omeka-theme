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
    if (!isset($elementText)) {
      $elementText = array();
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
function dh_theme_get_display_title($item = null)
{
  $itemTypeElements = detailed_item_type_elements($item);
  foreach ($itemTypeElements as $element => $elementInfo) {
    if (strpos($elementInfo['element_description'], 'Display Title')!==false) {
      return $elementInfo['text'];
    }
  }
  if (!$item) {
    return metadata('item', array('Dublin Core', 'Title'));
  } else {
    return metadata($item, array('Dublin Core', 'Title'));
  }
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
function dh_theme_get_display_description($snippet=false, $item=null)
{
  $itemTypeElements = detailed_item_type_elements($item);
  foreach ($itemTypeElements as $element => $elementInfo) {
    if (strpos($elementInfo['element_description'], 'Display Description')!==false) {
      if ($snippet and strlen($elementInfo['text']) > $snippet) {
        return substr($elementInfo['text'],0,$snippet)."...";
      } else {
        return $elementInfo['text'];
      }
    }
  }
  if (!$item) {
    return metadata('item', array('Dublin Core', 'Description'),array('snippet'=>$snippet));
  } else {
    return metadata($item, array('Dublin Core', 'Description'),array('snippet'=>$snippet));
  }
}

/**
 * Get a link to an item.
 *
 * The only differences from link_to are that this function will automatically
 * use the "current" item, and will use the item's title as the link text.
 * This custom version of link_to_item allows for passing queryParams
 *
 * @package Omeka\Function\View\Navigation
 * @uses link_to()
 * @param string $text HTML for the text of the link.
 * @param array $props Properties for the <a> tag.
 * @param string $action The page to link to (this will be the 'show' page almost always
 * within the public theme).
 * @param Item $item Used for dependency injection testing or to use this function
 * outside the context of a loop.
 * @return string HTML
 */
function dh_link_to_item($text = null, $props = array(), $action = 'show', $item = null, $queryParams = array())
{
    if (!$item) {
        $item = get_current_record('item');
    }
    $text = (!empty($text) ? $text : strip_formatting(metadata($item, array('Dublin Core', 'Title'))));
    return link_to($item, $action, $text, $props, $queryParams);
}

/**
 * Change the behavior of previous/next buttons on items/show
 * Written by Valdeva Crema (https://github.com/ives1227)
 */
function custom_next_previous()
{
  //Starts a conditional statement that determines a search has been run
  if (isset($_SERVER['QUERY_STRING'])) {

    // Sets the current item ID to the variable $current
    $current = metadata('item', 'id');

    //Break the query into an array
    parse_str($_SERVER['QUERY_STRING'], $queryarray);

    //Items don't need the page level
    unset($queryarray['page']);

    $itemIds = array();
    $list = array();
    if (isset($queryarray['query'])) {
      //We only want to browse previous and next for Items
      $queryarray['record_types'] = array('Item');
      //Get an array of the texts from the query.
      $textlist = get_db()->getTable('SearchText')->findBy($queryarray);
      //Loop through the texts and populate the ids and records.
      foreach ($textlist as $value) {
        $itemIds[] = $value->record_id;
        $record = get_record_by_id($value['record_type'], $value['record_id']);
        $list[] = $record;
      }
    }
    elseif (isset($queryarray['advanced'])) {
      if (!array_key_exists('sort_field', $queryarray)) {
        $queryarray['sort_field'] = 'added';
        $queryarray['sort_dir'] = 'd';
      }
      //Get an array of the items from the query.
      $list = get_db()->getTable('Item')->findBy($queryarray);
      foreach ($list as $value) {
        $itemIds[] = $value->id;
        $list[] = $value;
      }
    }
    //Browsing all items in general
    else {
      if (!array_key_exists('sort_field', $queryarray)) {
        $queryarray['sort_field'] = 'added';
        $queryarray['sort_dir'] = 'd';
      }
      $list = get_db()->getTable('Item')->findBy($queryarray);
        foreach ($list as $value) {
          $itemIds[] = $value->id;
        }
      }

      //Update the query string without the page and with the sort_fields
      $updatedquery = http_build_query($queryarray);
      $updatedquery = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $updatedquery);

      // Find where we currently are in the result set
      $key = array_search($current, $itemIds);

      // If we aren't at the beginning, print a Previous link
      if ($key > 0) {
        $previousItem = $list[$key - 1];
        $previousUrl = record_url($previousItem, 'show') . '?' . $updatedquery;
        $text = __('&larr; Previous Item');
        echo '<li id="previous-item" class="previous"><a href="' . html_escape($previousUrl) . '">' . $text . '</a></li>';
      }

      // If we aren't at the end, print a Next link
      if ($key >= 0 && $key < (count($list) - 1)) {
        $nextItem = $list[$key + 1];
        $nextUrl = record_url($nextItem, 'show') . '?' . $updatedquery;
        $text = __("Next Item &rarr;");
        echo '<li id="next-item" class="next"><a href="' . html_escape($nextUrl) . '">' . $text . '</a></li>';
      }
    } else {
      // If a search was not run, then the normal next/previous navigation is displayed.
      echo '<li id="previous-item" class="previous">'.link_to_previous_item_show().'</li>';
      echo '<li id="next-item" class="next">'.link_to_next_item_show().'</li>';
    }
}

?>
