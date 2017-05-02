<?php $exhibit_page=get_current_record('exhibit_page');?>
<?php
// Check whether each option is set and save it in a variable
$size = isset ( $options ['file-size'] ) ? html_escape ( $options ['file-size'] ) : 'thumbnail';
?>
<style>
/* Fondos */
.right {
	background-image: url(<?php echo(url('/plugins/Mosaic/javascripts/slidejs/flecha.png'));?>);
	margin-right: -2em;
}
.left {
	background-image: url(<?php echo(url('/plugins/Mosaic/javascripts/slidejs/flecha2.png'));?>);
	margin-left: -2em;
}
</style>
<script>
if (typeof jQuery == 'undefined') {
	  document.write('<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"><\/script>');
	}
$('body').keydown(function(e){
	if(e.which==37)
		$('.left').click();
	else if(e.which==39)
		$('.right').click();
});
</script>
	<div class="left" onclick="sentido=0; $('.slidesjs-previous').click();"></div>
	<div class="swipe"><img class="swipe-left" src="<?php echo(url('/plugins/Mosaic/views/shared/exhibit_layouts/slides/swipe-left.png'));?>"><img class="swipe-right" src="<?php echo(url('/plugins/Mosaic/views/shared/exhibit_layouts/slides/swipe-right.png'));?>"></div>
	<div id="diapositivas">
		<?php $n=0; foreach ($attachments as $attachment): ?>
		<div id="item<?php echo $n;?>">
			<?php $file = $attachment->getFile(); ?>
			<a href="<?php if($file){echo ($file->getProperty("fullsize_uri"));}?>" onclick="return hs.expand(this);"><img class="imagen" src="<?php if($file){echo ($file->getProperty("${size}_uri"));}?>"></a>
			<div class="metadatos">
			<?php 
			$item = $attachment->getItem();
			if($item!=NULL){
				$autor=metadata($item, array('Dublin Core', 'Creator'));
				$titulo=metadata($item, array('Dublin Core', 'Title'));
				$editor=metadata($item, array('Dublin Core', 'Publisher'));
				$fecha=metadata($item, array('Dublin Core', 'Date'));
				$identificador=metadata($item, array('Dublin Core', 'Identifier'));	// Signatura
				$fuente=metadata($item, array('Dublin Core', 'Source'));			// Enlace a FAMA
				$cobertura=metadata($item, array('Dublin Core', 'Coverage'));		// Enlace a comentario
				$relacion=metadata($item, array('Dublin Core', 'Relation'));		// Enlace al libro completo
			}
			
			if(!empty($autor))
				echo "<p class=\"metadato autor\">".$autor."</p>";
			if(!empty($titulo))
				echo "<p class=\"metadato titulo\">".$titulo."</p>";
			if(!empty($editor))
				echo "<p class=\"metadato editor\">".$editor."</p>";
			if(!empty($fecha))
				echo "<p class=\"metadato fecha\">".$fecha."</p>";
				
			
			if((!empty($fuente))&&(!empty($identificador)))
				echo "<p class=\"metadato signatura\"><a href=\"".$fuente."\" target=\"_blank\">".$identificador."</a></p>";
			elseif(!empty($identificador))
				echo "<p class=\"metadato signatura\">".$identificador."</p>";
			
			if(!empty($cobertura))
				echo "<p class=\"metadato comentario\"><a href=\"".$cobertura."\" target=\"_blank\">Comentario</a></p>";
			if(!empty($relacion))
				echo "<p class=\"metadato completo\"><a href=\"".$relacion."\" target=\"_blank\">Libro completo</a></p>";
			?>
			<span class="adjunto"><?php echo $attachment->caption; ?></span>
			</div>
		
		</div>
		<?php $n++; endforeach; ?>
	</div>
	<div class="right" onclick="sentido=1; $('.slidesjs-next').click();"></div>

</div>

<script type="text/javascript" src="<?php echo(url('/plugins/'.'Mosaic'.'/javascripts/slidejs/jquery.slides.min.js'));?>"></script>
<a id="prev" style="display: none" href="<?php echo(exhibit_builder_exhibit_uri(null,$exhibit_page->previousOrParent()));?>"></a>
<a id="sig" style="display: none" href="<?php echo(exhibit_builder_exhibit_uri(null,$exhibit_page->firstChildOrNext()));?>"></a>
<script>
function actualizarH(i){
	var altura = 720;
	if($(window).width()>480){
		altura = Math.max(($('#item'+(i+(sentido*2-1))).find('.metadatos').outerHeight(true)),($('#item'+(i+(sentido*2-1))).find('.imagen').outerHeight(true)))+8;
	}else{
		altura = ($('#item'+(i+(sentido*2-1))).find('.metadatos').outerHeight(true))+($('#item'+(i+(sentido*2-1))).find('.imagen').outerHeight(true))+8;
	}
	$('#diapositivas').css('height',altura);
	$('.slidesjs-container').css('height',altura);
	$('.slidesjs-control').css('height',altura);
	$('.slidesjs-slide').css('height',altura);
	return false;
}
// Inicializa slide
var sentido=0.5; // Atrás: 0 | Adelante: 1
num=0;
var pos = window.location.href.search('#item');
if(pos>0) {
	if(window.location.href.substring(pos+5)=='last')
		num=<?php echo($n-1);?>;
	else
		num = window.location.href.substring(pos+5);
}
actual=parseInt(num);
$(window).resize(function(e){sentido=0.5; e.stopImmediatePropagation(); return actualizarH(actual);});
$(function() {
	<?php if($n>1) {?>

	$('#diapositivas').slidesjs({
		start: actual+1,
		pagination: { active: false },
		callback: { loaded: function(n){actualizarH(actual); $('#diapositivas').css('opacity','1');},
			start: function(i) {
			if(sentido==1) {	// Adelante
				if(actual==<?php echo($n-1);?>) {
					$('#diapositivas').css('opacity','0');
					$('#item0').css('opacity','0');
					window.location=$('#sig').attr('href');
					return false;
			  	}
			}
			else {			// Atrás
				if(actual==0) {
					$('#diapositivas').css('opacity','0');
					$('#item<?php echo($n-1);?>').css('opacity','0');
				  window.location=$('#prev').attr('href');
				  return false;
			  	}
			}
			actualizarH(actual);
		},
		complete: function(n){
			actual=n-1;
		}
	}});
		<?php } else {?>
			$('.right').click(function(){
				window.location=$('#sig').attr('href');
				return false;
			});
			$('.left').click(function(){
				window.location==$('#prev').attr('href');
				return false;
			});
		<?php } ?>
    });
</script>
