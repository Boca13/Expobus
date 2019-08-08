<!DOCTYPE html>
<html lang="<?php
echo get_html_lang();
?>">
<head>
	<meta charset="utf-8">
  <?php
if ($description = option('description')):
?>
  <meta name="description" content="<?php
    echo $description;
?>" />
  <?php
endif;
?>
  
  <title><?php
echo option('site_title');
echo isset($title) ? ' - ' . strip_formatting($title) : '';
?></title>

  <!-- Plugin Stuff -->

  <?php
fire_plugin_hook('public_head', array(
    'view' => $this
));
?>

  <!-- Stylesheets -->
  <!-- Código añadido para dar la posibilidad de elegir la fuente deseada -->
  <!-- Para la fuente del Menú de Salas-->
<?php if(get_theme_option('fuente1',null))
{
	$fuenteMenu = get_theme_option('fuente1',null);
}
else
{
	$fuenteMenu = '"Sakkal Majalla", "Helvetica Neue", Helvetica';
}
?>

<!-- Para la fuente del Contenido de las Salas-->
<?php if(get_theme_option('fuente2',null))
{
	$fuenteCont = get_theme_option('fuente2',null);
}
else
{
	$fuenteCont = '"Sakkal Majalla", "Helvetica Neue", Helvetica';
}
?>

  <?php
queue_css_url('http://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700,300italic,400italic,500italic,700italic');
queue_css_file('foundation');
queue_css_file('app');
queue_css_file('estilo');

// Añadido para la fuente de la exposición completa (ahora fuente del contenido)
queue_css_string(".exhibit-block *, .exhibit-block{font-family: $fuenteCont;}");
// Añadido para la fuente del menú y título de le exposición.
queue_css_string("#nav *, #nav{font-family: $fuenteMenu;}");
if(get_theme_option('oficial')==0){
	queue_css_string("html{min-height:100%;}body{min-height:100vh;}");
}
echo head_css();
?>

  <!-- JavaScripts -->
  <?php
queue_js_file('app');
?>
  <?php
queue_js_file('foundation/foundation');
?>
  <?php
queue_js_file('foundation/foundation.orbit');
?>
  <?php
queue_js_file('vendor/jquery');
?>
  <?php
queue_js_file('vendor/custom.modernizr');
?>

  <?php
queue_js_file('foundation/foundation.forms');
?>




  <?php
echo head_js();
?>




</head>

<?php
echo body_tag(array(
    'id' => @$bodyid,
    'class' => @$bodyclass
));
$logo = get_theme_option('logo');
?>
  <?php
fire_plugin_hook('public_body', array(
    'view' => $this
));
if(get_theme_option('oficial')){
?>
 <nav id="navegacion"><a href="/"><img src="<?php echo($logo);?>"></a><div id="biblioteca" class="dropdown"><span class="dropbtn">BIBLIOTECA</span><div class="dropdown-content">
 	<?php if(get_theme_option('textoenlace1',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace1'));?>"><?php echo (get_theme_option('textoenlace1'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace2',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace2'));?>"><?php echo (get_theme_option('textoenlace2'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace3',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace3'));?>"><?php echo (get_theme_option('textoenlace3'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace4',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace4'));?>"><?php echo (get_theme_option('textoenlace4'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace5',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace5'));?>"><?php echo (get_theme_option('textoenlace5'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace6',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace6'));?>"><?php echo (get_theme_option('textoenlace6'));?></a><?php endif;?>
</div></div></nav>
<?php }?>

	<div class="row">
		
		<div class="large-12 columns">
	

      


