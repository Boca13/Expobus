<?php
// Función que genera un elemento del select desplegable del menú de navegación 
function renderPageOption($page, $currentPage, $exhibit)
{
	if ($currentPage && $page->id === $currentPage->id) {
		$html = '<option selected="selected" ';
	}else{
		$html = '<option ';
	}

	$html .= 'value="' . exhibit_builder_exhibit_uri($exhibit, $page) . '">'
			. metadata($page, 'title') .'</option>';
	
	return $html;
}
// Función que genera el menú de navegación como un select desplegable
function dropdown_tree($exhibit, $exhibit_page)
{
	if (!$exhibit) {
		$exhibit = get_current_record('exhibit');
	}
	
	$pages = $exhibit->PagesByParent;
	if (!($pages && isset($pages[0]))) {
		return '';
	}

	$html = '<select onchange="onSelect(this.value)">';//$this->_renderListOpening();
	foreach ($pages[0] as $topPage) {
		$html .= renderPageOption($topPage, $exhibit_page, $exhibit);
	}
	$html .= '</select>';
	return $html;
}
?>
<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>
<?php 
$indice=-1;
if(($parent=$exhibit_page->getParent())):
	$indice = $parent->order+1;
else:
	$indice = $exhibit_page->order+1;
endif;
?>
<?php 
$fL = get_theme_option('footerl');
$fR = get_theme_option('footerr');
$lfL = get_theme_option('linkfooterl');
$lfR = get_theme_option('linkfooterr');
$logosSiempre = get_theme_option('logossiempre');
$poslogos = get_theme_option('poslogos');
$clogotipos = get_theme_option('clogotipos');
$posnav = get_theme_option('posnav');
$colornav = get_theme_option('colornav');
$colorblock = get_theme_option('colorblock');
$shadowblock = get_theme_option('shadowblock');
$colorfondo = get_theme_option('colorfondo');
$colornavhover = get_theme_option('colornavhover');
$colornavcurrent = get_theme_option('colornavcurrent');
$header_image = get_theme_option('header_image');
$dropdownmenu = get_theme_option('dropdownmenu');
$niveles = get_theme_option('niveles');
?>
  <meta name="viewport" content="width=device-width">
	<?php if($dropdownmenu==true){?>
	<script type="text/javascript">
		function onSelect(l){
			window.location = l;
		}
	</script>
	<?php }?>
  <style>
   	/* Fondos */
	body {background-size: <?php
	if(($indice!=-1) and ((get_theme_option('fondo'.$indice)))):
		echo((get_theme_option('tfondo'.$indice)==true)?'cover':'contain; background-position: center');
	else:
		echo((get_theme_option('tfondo1')==true)?'cover':'contain; background-position: center');
	endif;
	?>; background-repeat: no-repeat; background-attachment: fixed;
	background-image: url('<?php
	if(($indice!=-1) and ((get_theme_option('fondo'.$indice)))):
		echo(url('/files/theme_uploads/'.get_theme_option('fondo'.$indice)));
	else:
		echo(url('/files/theme_uploads/'.get_theme_option('fondo1')));
	endif;
	?>');
	background-color: <?php echo($colorfondo);?>; }
	/* Opciones de tema*/
	#titulo > a.entrada, #menu, #menu>ul>li>a {color: <?php echo($colornav)?>;}
	#titulo > a.entrada:hover, #menu a:hover{color: <?php echo($colornavhover)?>;}
	.current>a{color: <?php echo($colornavcurrent)?>;}
	#menu ul li:hover>ul:nth-of-type(<?php echo $niveles; ?>)>* { display: none; }
}
	.exhibit-block{background-color: rgba(<?php echo($colorblock);?>); box-shadow: 0px 0px 30px 0px rgba(<?php echo($shadowblock);?>);
	<?php if(($poslogos!="t")&&($posnav!="t")) echo("margin-top: 6em;");?>}
	#nav>select{
		color: <?php echo $colornav;?>;
		border-color: <?php echo $colornav;?>; 
	}
  </style>
  <?php if($header_image) {?>
  <img id="header" src="<?php echo(url('files/theme_uploads/'.$header_image));?>">
  <?php }?>
<?php if($posnav=="t"){?>
<nav id="nav">
	<div id="titulo">
	<a href="<?php echo url('exhibits/show/' . metadata('exhibit', 'slug'));?>" class="entrada"><?php echo metadata('exhibit', 'title'); ?></a>
	</div><?php if($dropdownmenu==true){echo dropdown_tree($exhibit, $exhibit_page);}else{?><div id="menu"><?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?></div><?php }?>
</nav>
<?php }?>
<?php if($poslogos=="t"){?>
<?php if(($logosSiempre==true)||($indice==1)):?>
<div class="footer-images">
<?php if(!empty($fL)):?>
<a style="display: inline-block;<?php if(!$clogotipos) echo (" float:left;")?>" href="<?php echo($lfL)?>" target="_blank"><img src="<?php echo(url('files/theme_uploads/'.$fL));?>"></a>
<?php endif; ?>
<?php if(!empty($fR)):?>
<a style="display: inline-block;<?php if(!$clogotipos) echo (" float:right;")?>" href="<?php echo($lfR)?>" target="_blank"><img src="<?php echo(url('files/theme_uploads/'.$fR));?>"></a>
<?php endif; ?>
</div>
<?php endif;}?>

<div id="contenido">
<?php exhibit_builder_render_exhibit_page(); ?>
</div>
<?php if($posnav=="b"){?>
<nav id="nav">
	<div id="titulo">
	<a href="<?php echo url('exhibits/show/' . metadata('exhibit', 'slug'));?>" class="entrada"><?php echo metadata('exhibit', 'title'); ?></a>
	</div><?php if($dropdownmenu==true){echo dropdown_tree($exhibit, $exhibit_page);}else{?><div id="menu"><?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?></div><?php }?>
</nav>
<?php }?>
<?php if($poslogos=="b"){?>
<?php if(($logosSiempre==true)||($indice==1)):?>
<div class="footer-images">
<?php if(!empty($fL)):?>
<a style="display: inline-block;<?php if(!$clogotipos) echo (" float:left;")?>" href="<?php echo($lfL)?>" target="_blank"><img src="<?php echo(url('files/theme_uploads/'.$fL));?>"></a>
<?php endif; ?>
<?php if(!empty($fR)):?>
<a style="display: inline-block;<?php if(!$clogotipos) echo (" float:right;")?>" href="<?php echo($lfR)?>" target="_blank"><img src="<?php echo(url('files/theme_uploads/'.$fR));?>"></a>
<?php endif; ?>
</div>
<?php endif;}?>
<div>

</div>
<?php echo foot(); ?>
