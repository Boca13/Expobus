<?php 
// Esto permite sobrescribir la función head_js
namespace jqueryFix {
function head_js($includeDefaults = true)
{
    $headScript = get_view()->headScript();

    if ($includeDefaults) {
        $dir = 'javascripts';
        $headScript	->prependScript('$=jQuery;')
        			->prependScript('jQuery.noConflict();')
                   ->prependScript('window.jQuery.ui || document.write(' . js_escape(js_tag('vendor/jquery-ui')) . ')')
                   ->prependFile('//ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js')
                   ->prependScript('window.jQuery || document.write(' . js_escape(js_tag('vendor/jquery')) . ')')
                   ->prependFile('//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js');
    }
    return $headScript;
}
?>

<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if ( $description = option('description')): ?>
    <meta name="description" content="<?php echo $description; ?>" />

    <?php endif; ?>
	<link rel="icon" href="/favicon.png" type="image/png" />
    <?php
    if (isset($title)) {
        $titleParts[] = strip_formatting($title);
    }
    $titleParts[] = option('site_title');
    ?>
    <title><?php echo implode(' &middot; ', $titleParts); ?></title>

    <?php echo auto_discovery_link_tags(); 
    
    // Plugin Stuff
    fire_plugin_hook('public_head', array('view'=>$this));
    ?>

	


    <!-- Stylesheets -->
    <?php queue_css_file("estilo");
    
    queue_css_file('jquery.fancybox');
    //queue_css_file('jquery.jqzoom');
    echo theme_header_background();
    echo head_css();
    ?>

    <?php if(@$bodyclass!="exhibits browse"):
    ($backgroundColor = get_theme_option('background_color')) || ($backgroundColor = "#FFFFFF");
    ($textColor = get_theme_option('text_color')) || ($textColor = "#444444");
    ($linkColor = get_theme_option('link_color')) || ($linkColor = "#888888");
    ($buttonColor = get_theme_option('button_color')) || ($buttonColor = "#000000");
    ($buttonTextColor = get_theme_option('button_text_color')) || ($buttonTextColor = "#FFFFFF");
    ($titleColor = get_theme_option('header_title_color')) || ($titleColor = "#000000");
    ?>
    <style>
        body {
            background-color: <?php echo $backgroundColor; ?>;
            color: <?php echo $textColor; ?>;
            <?php if(get_theme_option('background')):?>background-image: url('<?php echo(url('files/theme_uploads/'.get_theme_option('background')));?>');<?php endif;?>
        }
        #site-title a:link, #site-title a:visited,
        #site-title a:active, #site-title a:hover {
            color: <?php echo $titleColor; ?>;
            <?php if (get_theme_option('header_background')): ?>
            text-shadow: 0px 0px 20px #000;
            <?php endif; ?>
        }
        a:link {
            color: <?php echo $linkColor; ?>;
        }
        
        .button, button,
        input[type="reset"],
        input[type="submit"],
        input[type="button"],
        .pagination_next a, 
        .pagination_previous a {
          background-color: <?php echo $buttonColor; ?>;
          color: <?php echo $buttonTextColor; ?> !important;
        }
        
        #search-form input[type="text"] {
            border-color: <?php echo $buttonColor; ?>
        }

        }
    </style>
    <!-- JavaScripts -->
    <?php 
    endif;
    queue_js_file('vendor/modernizr');
    queue_js_file('vendor/selectivizr', 'javascripts', array('conditional' => '(gte IE 6)&(lte IE 8)'));
    queue_js_file('vendor/respond');
    queue_js_file('vendor/waypoints/jquery.waypoints.min');
    queue_js_file('vendor/jquery-accessibleMegaMenu');
    //queue_js_file('jquery.jqzoom-core-pack');
    queue_js_url('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js');
    queue_css_url('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
    queue_js_file('fancybox/source/jquery.fancybox.pack');
    
    queue_js_file('globals');
    queue_js_file('default');
    
    
    echo head_js(); 
    
    $logo = get_theme_option('logo');
    
    ?>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
  <?php
fire_plugin_hook('public_body', array(
    'view' => $this
));
?>
<?php if(@$bodyclass!="exhibits browse"):?>
 <nav id="navegacion"><a href="/"><img src="<?php echo($logo);?>"></a><div id="biblioteca" class="dropdown"><span class="dropbtn">BIBLIOTECA</span><div class="dropdown-content">
 	<?php if(get_theme_option('textoenlace1',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace1'));?>"><?php echo (get_theme_option('textoenlace1'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace2',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace2'));?>"><?php echo (get_theme_option('textoenlace2'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace3',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace3'));?>"><?php echo (get_theme_option('textoenlace3'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace4',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace4'));?>"><?php echo (get_theme_option('textoenlace4'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace5',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace5'));?>"><?php echo (get_theme_option('textoenlace5'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace6',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace6'));?>"><?php echo (get_theme_option('textoenlace6'));?></a><?php endif;?>
</div></div></nav>
<?php endif;
}?>