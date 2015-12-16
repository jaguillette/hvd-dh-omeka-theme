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
?>
