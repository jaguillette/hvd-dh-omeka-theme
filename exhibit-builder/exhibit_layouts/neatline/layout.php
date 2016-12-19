<?php
if (!array_key_exists('neatline-id', $options)) {
    return;
}

$neatline = get_record_by_id('NeatlineExhibit', $options['neatline-id']);
if (!$neatline) {
    return;
}

set_current_record('neatline_exhibit', $neatline);

?>
<iframe src="<?php echo nl_getExhibitUrl($neatline, "fullscreen"); ?>" height="500" style="height:500px;">
</iframe>

<a href="<?php echo url('neatline/fullscreen/'.$neatline['slug']); ?>" target="_blank">View fullscreen</a>
