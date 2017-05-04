<!DOCTYPE html>
<html class="<?php echo get_theme_option('Style Sheet'); ?>" lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=yes" />
    <?php if ($description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />
    <?php endif; ?>

    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); ?>

    <?php fire_plugin_hook('public_head',array('view'=>$this)); ?>
    <!-- Stylesheets -->
    <?php
    queue_css_file(array('iconfonts', 'screen'));
    queue_css_file(array('jquery.fancybox'));

    echo head_css();
    ?>
    <!-- JavaScripts -->
    <?php queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)')); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('vendor/jquery-accessibleMegaMenu'); ?>
    <?php queue_js_file('vendor/jquery.fancybox.pack'); ?>
    <?php queue_js_file('berlin'); ?>
    <?php queue_js_file('globals'); ?>
    <?php queue_js_file('masonry.pkgd'); ?>
    <?php echo head_js(); ?>
    <?php
    # Have to reference the absolute path of the piwik file to include it
    # Found through var_dump(this->getAssetPaths())
    # $this->getAssetPaths()[0] has versions of the base path of the theme
    # $this->getAssetPaths()[0][1] is the base path of the theme in http, not local file system
    if (file_exists($this->getAssetPaths()[0][0] . "/common/piwik.php")) {
      include $this->getAssetPaths()[0][0] . "/common/piwik.php";
    }
    ?>
</head>
 <?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <a href="#content" id="skipnav"><?php echo __('Skip to main content'); ?></a>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="header-container"<?php if ($headerImage = dh_theme_header_image_url()) { echo "style=\"background: url($headerImage); background-size:cover;\";";} ?>>
        <header role="banner">
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
            <div id="site-title">
              <?php
              if (theme_logo()):
                echo link_to_home_page(theme_logo());
              else:
                if ($primaryTitleStyle = get_theme_option('Primary Page Title Style')) {
                } else {
                  $primaryTitleStyle = "font-size:18px; font-weight:normal;";
                }
                if ($secondaryTitleStyle = get_theme_option('Secondary Page Title Style')) {
                } else {
                  $secondaryTitleStyle = "font-size:40px;";
                }
                if ($tertiaryTitleStyle = get_theme_option('Tertiary Page Title Style')) {
                } else {
                  $tertiaryTitleStyle = "font-size:18px; font-weight: normal;";
                }
                if ($primaryTitle = get_theme_option('Primary Page Title')) {
                  $site_title_text = "<span style=\"$primaryTitleStyle\">$primaryTitle</span>";
                } else {
                  $site_title_text = "<span>".option('site_title')."</span>";
                }
                if ($secondaryTitle = get_theme_option('Secondary Page Title')) {
                  $site_title_text .= "<br/><span style=\"$secondaryTitleStyle\">$secondaryTitle</span>";
                }
                if ($tertiaryTitle = get_theme_option('Tertiary Page Title')) {
                  $site_title_text .= "<br/><span style=\"$tertiaryTitleStyle\">$tertiaryTitle</span>";
                }
                echo link_to_home_page($site_title_text);
              endif;
              ?>
            </div>

            <div id="search-container" role="search">
                <?php if (get_theme_option('use_advanced_search') === null || get_theme_option('use_advanced_search')): ?>
                <?php echo search_form(array('show_advanced' => true)); ?>
                <?php else: ?>
                <?php echo search_form(); ?>
                <?php endif; ?>
            </div>
        </header>
        <div id="nav-container">
             <div id="primary-nav" role="navigation">
                 <?php
                      echo public_nav_main();
                 ?>
             </div>
            <div id="mobile-nav" role="navigation" aria-label="<?php echo __('Mobile Navigation'); ?>">
                 <?php
                      echo public_nav_main();
                 ?>
             </div>
        </div>
    </div>

        <?php // echo theme_header_image(); ?>

    <div id="content" role="main" tabindex="-1">

<?php fire_plugin_hook('public_content_top', array('view'=>$this)); ?>
