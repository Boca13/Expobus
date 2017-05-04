<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
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

    <!-- Plugin Stuff -->

    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>


    <!-- Stylesheets -->
    <?php queue_css_file("estilo");
    echo head_css();
    ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
<?php
	$logo = get_theme_option('logo');
	fire_plugin_hook('public_body', array('view' => $this));
?>

<nav id="navegacion"><a href="/"><img src="<?php echo($logo);?>"></a><div id="biblioteca" class="dropdown"><span class="dropbtn">BIBLIOTECA</span><div class="dropdown-content">
 	<?php if(get_theme_option('textoenlace1',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace1'));?>"><?php echo (get_theme_option('textoenlace1'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace2',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace2'));?>"><?php echo (get_theme_option('textoenlace2'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace3',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace3'));?>"><?php echo (get_theme_option('textoenlace3'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace4',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace4'));?>"><?php echo (get_theme_option('textoenlace4'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace5',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace5'));?>"><?php echo (get_theme_option('textoenlace5'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace6',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace6'));?>"><?php echo (get_theme_option('textoenlace6'));?></a><?php endif;?>
</div></div></nav>

<div id="breadcrumbs"><a href="/">Expobus</a><ul id="secondary-nav"><li><a href="<?php echo(exhibit_builder_exhibit_uri($exhibit));?>"><?php echo (metadata('exhibit', 'title'));?></a></li></ul></div>