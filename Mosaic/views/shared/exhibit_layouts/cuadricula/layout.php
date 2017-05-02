<?php
//Check whether each option is set and save it in a variable
$width = (isset($options['width'])&&(!empty($options['width'])))
? html_escape($options['width'])
: '100';

$title = (isset($options['title'])&&(!empty($options['title'])))
? html_escape($options['title'])
: '';

$size = (isset($options['file-size'])&&(!empty($options['file-size'])))
? html_escape($options['file-size'])
: 'fullsize';

$percentwidth = (isset($options['percentwidth'])&&(!empty($options['percentwidth'])))
? html_escape($options['percentwidth'])
: '15';

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
<style>
.grid-item {
	min-width: <?php echo $width; ?>px;
	width: <?php echo $percentwidth; ?>%;
}
.grid-item>a{border: 1px solid <?php echo($borderColor)?>;}
.grid { opacity: 0; transition: opacity 200ms ease; }
.fancybox-nav{
	width: 20%;
    min-width: 100px;
}
</style>
<script type="text/javascript" src="/omeka/plugins/Mosaic/javascripts/fancybox/source/jquery.fancybox.pack.js"></script>
<script>
$(document).ready(function() {
	$(".fancybox")
    .attr('rel', 'gallery')
    .fancybox();
});
</script>
<script>$('.contenido').css('height',$('.highslide-html').css('height'));</script>
<div class="grid" id="grid">
<h1 class="block-header"><?php echo $title;?></h1>
    <?php $n=0;
    foreach ($attachments as $attachment): ?>
    <div class="grid-item">
    <?php $item = $attachment->getItem();?>
    <h3><?php echo (metadata($item, array('Dublin Core', 'Date')));?></h3>
    <a class="fancybox" data-fancybox-title="<?php echo(metadata($item, array('Dublin Core', 'Title')));?>" href="#item<?php echo($n);?>"><?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size, 'linkToFile' => false)); ?></a>

    <div style="display:none;" id="item<?php echo($n);?>" >
		<div class="contenido">
			<img class="imagen" src="<?php echo ($attachment->getFile()->getProperty("fullsize_uri"));?>">
    		<div class="metadatos">
			<?php 
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
			<div class="caption"><?php echo($attachment->caption);?></div>
			</div>
    	</div>
    </div>
    </div>
    <?php $n++;
    endforeach; ?>
</div>
<script>
window.onload=function() {
	$('.grid').css('opacity','1');
	};
</script>