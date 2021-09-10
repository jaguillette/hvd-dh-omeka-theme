<?php
$pageTitle = __('404 Page Not Found');
echo head(array('title'=>$pageTitle));
?>
<h1><?php echo $pageTitle; ?></h1>
<p><?php echo __('%s could not be found.', html_escape($badUri)); ?></p>
<p><?php echo __('It is possible that you are trying to access a private page. If that is the case, you may need to <a href="%s">log in</a>.',admin_url('/')); ?></p>
<?php echo foot(); ?>
