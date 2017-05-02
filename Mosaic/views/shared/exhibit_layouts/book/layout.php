<?php
//Check whether each option is set and save it in a variable
$width = (isset($options['width'])&&(!empty($options['width'])))
? html_escape($options['width'])
: '150';

$height = (isset($options['height'])&&(!empty($options['height'])))
? html_escape($options['height'])
: '300';

$size = (isset($options['file-size'])&&(!empty($options['file-size'])))
? html_escape($options['file-size'])
: 'fullsize';

$percentwidth = (isset($options['percentwidth'])&&(!empty($options['percentwidth'])))
? html_escape($options['percentwidth'])
: '33';

$bgcolor = (isset($options['bgcolor'])&&(!empty($options['bgcolor'])))
? html_escape($options['bgcolor'])
: '#FFFFFF';

$borderColor = (isset($options['borderColor'])&&(!empty($options['borderColor'])))
? html_escape($options['borderColor'])
: '#000000';

$alpha = (isset($options['alpha'])&&(!empty($options['alpha'])))
? html_escape($options['alpha'])
: '1';

if(isset($options['cover']))
	$cover = html_escape($options['cover']);

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
}
?>
<script>
if (typeof jQuery == 'undefined') {  
	  document.write('<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"><\/script>');
	}
</script>
<style>
.hardcover_back li {
	border: 1px solid <?php echo($borderColor)?>;
	background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>);
}
ul.hardcover_front { border: 2px solid <?php echo($borderColor)?>; }
.book {
	position: relative;
	width: <?php echo $percentwidth; ?>%;
	min-width: <?php echo $width; ?>px;
 	min-height: <?php echo $height; ?>px;
 	height: 66vh;
	margin-bottom: 8%;
	margin-top: 5%;
	margin-right: -29%;
	opacity: 0;
	transition: opacity 0.5s ease 0.7s;
}
.coverDesign {
	background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>);
	background: url('<?php echo $cover?>') cover;
}
.book_spine, .book_spine>li { background-color: <?php echo($borderColor)?>; }
.hardcover_front, .hardcover_front>li { background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>); }
</style>
<script>
n=0;
abierto=false;
function sort() {
	$('.page').find('li').each(function(i,e){
		$(e).css('transition-duration',Math.min(0.8+(N-i)*0.1, 2)+'s');
		$(e).css('transform', 'rotateY(-'+Math.min(70,10+(N-i)*paso)+'deg)');
	});
}
function portada() {
	$('.hardcover_front').css('transform', 'rotateY(-175deg) translateZ(0)');
	$('.hardcover_front').css('z-index', '0');
	abierto=true;
}
function cerrar() {
	$('.hardcover_front').removeAttr('style');
	$('.hardcover_front').css('transform', 'rotateY(-'+Math.min(75,10+(N)*paso)+'deg) translateZ(0)');
}
function next(i) {
	if(abierto) {
		if(n<N) {
			n++;
			$(i).find('.page').find('li:nth-child('+n+')').css('transform', 'rotateY(-'+((N-n)*paso+110)+'deg)').find('.content, img').css('opacity', '0');
		} else {
			n=0;
			sort();
			$('.page').find('.content, img').removeAttr('style');
			setTimeout(cerrar, Math.min(0.8+N*0.1, 2)*500);
			abierto=false;
		}
	} else {
		portada();
	}
}
</script>


<figure class="book" onclick="next(this); return false;">
	<ul class="hardcover_front">
		<li>
			<div class="coverDesign" style="background-image: url('<?php $file=$attachments[0]->getFile(); echo metadata($file, 'thumbnail_uri');?>')">
			<h1><?php echo metadata('exhibit_page', 'title'); ?></h1></div>
		</li>
		<li></li>
	</ul>
	<ul class="page">
	
		<?php foreach ($attachments as $attachment): ?>
		<li><?php echo file_image($size, array(), $attachment->getFile()); ?></li>
		<li>
		<div class="content">
			<div class="metadatos">
			<?php 
			$item = $attachment->getItem();
			
			$autor=metadata($item, array('Dublin Core', 'Creator'));
			$titulo=metadata($item, array('Dublin Core', 'Title'));
			$editor=metadata($item, array('Dublin Core', 'Publisher'));
			$fecha=metadata($item, array('Dublin Core', 'Date'));
			$identificador=metadata($item, array('Dublin Core', 'Identifier'));	// Signatura
			$fuente=metadata($item, array('Dublin Core', 'Source'));			// Enlace a FAMA
			$cobertura=metadata($item, array('Dublin Core', 'Coverage'));		// Enlace a comentario
			$relacion=metadata($item, array('Dublin Core', 'Relation'));		// Enlace al libro completo
				
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
		</li>

		<?php endforeach; ?>
	</ul>
	<ul class="hardcover_back">
		<li></li>
		<li></li>
	</ul>
	<ul class="book_spine">
		<li></li>
		<li></li>
	</ul>
</figure>

<script>
//Transiciones
N=$('.page').find('li').length;
paso=30/N;
sort();
$('.hardcover_front').css('transform', 'rotateY(-'+Math.min(75,10+(N)*paso)+'deg) translateZ(0)');
$(window).ready(function(){$('.book').css('opacity','1');});
</script>
