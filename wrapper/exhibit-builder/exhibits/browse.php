<?php
echo head();
?>

<div id="breadcrumbs"><a href="/">Expobus</a><?php echo exhibit_builder_page_nav();?></div>

<object type="text/html" id="exhibit-show" data="<?php echo(get_theme_option('url'));?>"></object>

<?php echo foot(); ?>
