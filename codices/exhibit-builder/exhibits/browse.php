<?php
$title = __('Expobus - Espacio Virtual de Exposiciones - Biblioteca Universidad de Sevilla');
queue_css_file('estilo');
//queue_js_string("");
queue_js_file("slidejs/jquery.slides.min");
queue_js_file("parallax.js/parallax.min");
if(get_theme_option('img_feder')):
	queue_css_string("
	.slidesjs-navigation{display: none;}
	.logos{
		background-image: url('".url('files/theme_uploads/'.get_theme_option('img_feder'))."');
	");
endif;
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>


<script>
function scroll(e){
	$('body,html').animate({scrollTop: $(e).offset().top}, 500);
	return false;
}
$(document).ready(function(){
	$('.scroll').click(function(e){return scroll($(e.target).attr('href'));});
	
	var num = Math.floor((Math.random() * 3));
	var bgs = [
			<?php if(get_theme_option('bg_intro1')): ?>'<?php echo(url('files/theme_uploads/'.get_theme_option('bg_intro1')));?>'<?php endif;?>
			<?php if(get_theme_option('bg_intro2')): ?>,'<?php echo(url('files/theme_uploads/'.get_theme_option('bg_intro2')));?>'<?php endif;?>
			<?php if(get_theme_option('bg_intro3')): ?>,'<?php echo(url('files/theme_uploads/'.get_theme_option('bg_intro3')));?>'<?php endif;?>];
	if(num>bgs.length)
		num=0;
	$('#intro').css('background-image',"url('"+bgs[num]+"')")
	
});
</script>

<script>
$(function(){
	$("#slides").slidesjs({
		pagination: {active: false},
		play: {
		      active: false,
		      effect: "slide",
		      interval: 10000,
		      auto: true,
		      pauseOnHover: true,
		      restartDelay: 10000
		},
		navigation: {active: true},
		width: 940,
		height: 528
	});
	
	$('#lista>.botones>.atras').click(function(){$('#slides>.slidesjs-previous').click();});
	$('#lista>.botones>.adelante').click(function(){$('#slides>.slidesjs-next').click();});

	$('#otras>.botones>.atras').click(function(){$('#otras>.slides>.slidesjs-previous').click();});
	$('#otras>.botones>.adelante').click(function(){$('#otras>.slides>.slidesjs-next').click();});

	otrasDesplegadas = false;
	$('#botonOtras').click(function(){
		if(otrasDesplegadas){ // Plegar
			$('#otras').css('border','none');
			$('#otras').css('height','0');
			$('#otras').css('padding','0');
			scroll('#lista');
		}else{ // Desplegar
			$('#otras').css('border-top','solid 2px black');
			$('#otras').css('height','350px');
			$('#otras').css('padding','4em 3em 2em');
			scroll('#botonOtras');
		}
		otrasDesplegadas = !otrasDesplegadas;
	});

	$('#plegar').click(function(){
		if(otrasDesplegadas){ // Plegar
			$('#otras').css('border','none');
			$('#otras').css('height','0');
			$('#otras').css('padding','0');
			scroll('#lista');
		}
	});
});
</script>

<nav><a href="#">INICIO</a><a class="scroll" href="#sExposiciones" id="aExposiciones">EXPOSICIONES</a><a class="scroll" href="#sFondoantiguo" id="aFondoantiguo">FONDO ANTIGUO</a><a class="scroll" href="#sExpobus" id="aExpobus">EXPOBUS</a><a class="scroll" href="#sContacto" id="aContacto">CONTACTO</a><div id="biblioteca" class="dropdown"><span class="dropbtn">BIBLIOTECA</span><div class="dropdown-content">
	<?php if(get_theme_option('textoenlace1',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace1'));?>"><?php echo (get_theme_option('textoenlace1'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace2',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace2'));?>"><?php echo (get_theme_option('textoenlace2'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace3',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace3'));?>"><?php echo (get_theme_option('textoenlace3'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace4',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace4'));?>"><?php echo (get_theme_option('textoenlace4'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace5',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace5'));?>"><?php echo (get_theme_option('textoenlace5'));?></a><?php endif;?>
	<?php if(get_theme_option('textoenlace6',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace6'));?>"><?php echo (get_theme_option('textoenlace6'));?></a><?php endif;?>
</div></div></nav>
<header>
<?php if(get_theme_option('cabecera_izquierda')): ?><div class="banner" id="banner1" style="background-image: url('<?php echo(url('files/theme_uploads/'.get_theme_option('cabecera_izquierda')));?>')"></div><?php endif;?>

<?php if(get_theme_option('cabecera_logo1')): ?><div class="logobanner" id="logogrande"><a href="<?php echo(get_theme_option('cabecera_enlace1'));?>"><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('cabecera_logo1')));?>"></a></div><?php endif;?>
<?php if(get_theme_option('footer_imagenlogo1')): ?><div class="logobanner"><a target="_blank" href="<?php echo(get_theme_option('footer_enlacelogo1'));?>"><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('footer_imagenlogo1')));?>"></a></div><?php endif;?>
<?php if(get_theme_option('footer_imagenlogo2')): ?><div class="logobanner"><a target="_blank" href="<?php echo(get_theme_option('footer_enlacelogo2'));?>"><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('footer_imagenlogo2')));?>"></a></div><?php endif;?>
<?php if(get_theme_option('footer_imagenlogo3')): ?><div class="logobanner final"><a target="_blank" href="<?php echo(get_theme_option('footer_enlacelogo3'));?>"><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('footer_imagenlogo3')));?>"></a></div><?php endif;?>

<?php if(get_theme_option('cabecera_derecha')): ?><div class="banner" id="banner2" style="background-image: url('<?php echo(url('files/theme_uploads/'.get_theme_option('cabecera_derecha')));?>')"></div><?php endif;?>
</header>
<section id="intro"><article><?php echo(get_theme_option('texto_intro'));?></article>
<!-- <form id="buscador">
<?php echo search_form(); ?>

<input class="caja" placeholder="Buscador de exposiciones" type="text"><a class="boton" href="#">&#x1f50d;</a></form> -->
</section>
<div class="separador negro" id="sExposiciones"><h1>EXPOSICIONES</h1><div></div></div>
<section id="ultima" class="parallax-window" data-parallax="scroll" data-image-src="<?php echo(url('files/theme_uploads/'.get_theme_option('bg_expo_destacada')));?>"><article><h2><a target="_blank" href="<?php echo(get_theme_option('enlace_expo_destacada'));?>"><?php echo(get_theme_option('titulo_expo_destacada'));?></a></h2><h3><?php echo(get_theme_option('subtitulo_expo_destacada'));?></h3><p><?php echo(get_theme_option('texto_expo_destacada'));?></p><span class="recuadrado"><a target="_blank" href="<?php echo(get_theme_option('enlace_expo_destacada'));?>">ENTRAR</a></span></article></section>
<section id="lista">
<?php //print_r(str_getcsv(get_theme_option('exposiciones'),";"));?>
<div id="slides">
<?php	// Parsear como CSV la entrada de usuario puesta en las opciones
if(get_theme_option('exposiciones')):
$exhibitCount = 0;
$exposiciones = preg_split("/\\r\\n|\\r|\\n/", get_theme_option('exposiciones'));

foreach ($exposiciones as $linea):
$exposicion = str_getcsv($linea , ";");
if((isset($exposicion))&&($exposicion[0]))
{
	// Si no se ha proporcionado una imagen en el CSV, usar la de miniatura de la exposición
	if(!isset($exposicion[3])){
		$exhibits = loop('exhibit');
		foreach ($exhibits as $exhibit):
			if($exhibit->slug==$exposicion[2]){
				if($exhibit->getFile()){
					$exposicion[3] = $exhibit->getFile()->getProperty("thumbnail_uri");
					break;
				}
			}
		endforeach;
	}
	if ($exhibitCount%6==0):
?>
<div class="pagina">
<?php endif;?>
	<a target="_blank" href="<?php echo(url("/exhibits/show/".$exposicion[2]));?>"><div class="miniatura" style="background-image: url('<?php echo($exposicion[3]);?>');"><div class="sombra"></div><div class="info"><h3><?php echo html_escape($exposicion[0]);?></h3><p><?php echo html_escape($exposicion[1]);?></p></div></div></a>
<?php if (($exhibitCount+1)%6==0):?>
</div>
<?php
endif;
$exhibitCount++;
}
endforeach; ?>
<?php if (($exhibitCount)%6!=0):?>
</div>
<?php endif; 
endif;?>
</div>
<span id="botonOtras" class="recuadrado">OTRAS COLECCIONES</span><div class="botones"><div class="atras">&lt;</div><div class="adelante">&gt;</div></div>
</section>
<section id="otras">
<div class="slides">
<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit):
	if($exhibit->featured&&$exhibit->public)
	{
		if (($exhibitCount)%4==0): //Grupos de 4?>
		<div class="grupoOtras">
		<?php endif;?>
		<a target="_blank" href="<?php echo exhibit_builder_exhibit_uri($exhibit);?>"><div class="miniatura chica" style="background-image: url('<?php if($exhibit->getFile()){print_r($exhibit->getFile()->getProperty("thumbnail_uri"));}?>');">
			<div class="sombra"></div>
			<div class="info"><p><?php echo html_escape($exhibit->title); ?></p></div>
		</div></a>
	    <?php if (($exhibitCount+1)%4==0): //Grupos de 4?>
	    	</div>
	    <?php endif;
	    $exhibitCount++;
	}
endforeach;
if (($exhibitCount)%4!=0): //Terminar grupo?>
    	</div>
<?php endif; ?>
</div>
<?php if($exhibitCount>4){?>
<div class="botones" style="margin: 0 auto;"><div class="atras">&lt;</div><div class="adelante">&gt;</div></div>
<?php }?>
<a id="plegar" class="gotop">x</a>
</section>
<div class="separador amarillo" id="sFondoantiguo"><h1>FONDO ANTIGUO</h1><div></div></div>
<section id="fondoantiguo"><div class="texto"><?php echo(get_theme_option('texto_fa'));?></div><div class="imagen"><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('img_fa')));?>"><span class="pieimagen"><?php echo(get_theme_option('leyenda_fa'));?></span></section>
<div class="separador grisoscuro" id="sExpobus"><h1>EXPOBUS</h1><div></div></div>
<section id="expobus"><div class="texto"><?php echo(get_theme_option('texto_expobus'));?></div><div class="imagen"><?php if(get_theme_option('enlace_expobus')){?><a target="_blank" href="<?php echo get_theme_option('enlace_expobus');?>"><?php }?><img src="<?php echo(url('files/theme_uploads/'.get_theme_option('img_expobus')));?>"><?php if(get_theme_option('enlace_expobus')) echo("</a>");?></section>
<div class="separador gris" id="sContacto"><h1>CONTACTO</h1><div></div></div>
<section id="contacto">
	<div>
		<div class="columna cuarto"><h5>LINKS WEB</h5>
			<?php if(get_theme_option('textoenlace1',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace1'));?>"><?php echo (get_theme_option('textoenlace1'));?></a><?php endif;?>
			<?php if(get_theme_option('textoenlace2',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace2'));?>"><?php echo (get_theme_option('textoenlace2'));?></a><?php endif;?>
			<?php if(get_theme_option('textoenlace3',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace3'));?>"><?php echo (get_theme_option('textoenlace3'));?></a><?php endif;?>
			<?php if(get_theme_option('textoenlace4',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace4'));?>"><?php echo (get_theme_option('textoenlace4'));?></a><?php endif;?>
			<?php if(get_theme_option('textoenlace5',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace5'));?>"><?php echo (get_theme_option('textoenlace5'));?></a><?php endif;?>
			<?php if(get_theme_option('textoenlace6',null)):?><a target="_blank" href="<?php echo (get_theme_option('urlenlace6'));?>"><?php echo (get_theme_option('textoenlace6'));?></a><?php endif;?>
		</div><div class="columna mitad"><!-- <h5>BUSCADOR</h5><div class="buscar"><input type="text"><a href="">&#x1f50d;</a></div> --><div class="logos"></div><?php if(get_theme_option('footer_text')): ?><p><?php echo(get_theme_option('footer_text'));?></p><?php endif;?></div><div class="columna cuarto"><h5>CONTACTO</h5><?php echo(get_theme_option('contacto'));?><div class="social">
	<?php if(get_theme_option('red_fb')):?><a target="_blank" title="Facebook" href="<?php echo(get_theme_option('red_fb'));?>" class="icono facebook"></a><?php endif;?>
	<?php if(get_theme_option('red_twitter')):?><a target="_blank" title="Twitter" href="<?php echo(get_theme_option('red_twitter'));?>" class="icono twitter"></a><?php endif;?>
	<?php if(get_theme_option('red_flickr')):?><a target="_blank" title="Flickr" href="<?php echo(get_theme_option('red_flickr'));?>" class="icono flickr"></a><?php endif;?>
	<?php if(get_theme_option('red_email')):?><a target="_blank" title="Email" href="<?php echo(get_theme_option('red_email'));?>" class="icono email"></a><?php endif;?>
	<?php if(get_theme_option('red_youtube')):?><a target="_blank" title="Youtube" href="<?php echo(get_theme_option('red_youtube'));?>" class="icono youtube"></a><?php endif;?>
	<?php if(get_theme_option('red_rss')):?><a target="_blank" title="RSS" href="<?php echo(get_theme_option('red_rss'));?>" class="icono rss"></a><?php endif;?>
	</div></div>
	</div>
</section>
<footer>
<div>
<div class="columna cuarto"></div><?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')):
echo "<div class=\"columna mitad\">$copyright";
?><a target="_blank" href="http://creativecommons.org/licenses/by/4.0/" rel="license" target="_blank"><img alt="Licencia de Creative Commons" src="https://i.creativecommons.org/l/by/4.0/80x15.png"></a></div><?php
endif;?><a class="columna cuarto" href="https://bib.us.es/conocenos/estrategia/calidad" target="_blank"><img alt="Sello 500+ Excelencia Europea" src="https://bib.us.es/sites/bib3.us.es/files/logo_pie_unificado.png" style="width: 150px; height: 86px;"></a><a class="gotop" href="#" onclick="scroll('nav');">↑</a></footer>
</div>
<?php if($exhibitCount>4){?>
<script>
$(function(){
	$("#otras>.slides").slidesjs({
		pagination: {active: false},
		play: {
		      active: false,
		      auto: false,
		},
		callback: {
            loaded: function() {
                $("#otras>.slides>.slidesjs-container,#otras>.slides>.slidesjs-container>slidesjs-control").css("height", "300px");
            }
        },
		navigation: {active: true},
		width: 940,
		height: 200
	});
});
</script>
<?php }?>
</body>
</html>
