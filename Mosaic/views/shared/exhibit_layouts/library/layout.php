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
: '20';

$bgcolor = (isset($options['bgcolor'])&&(!empty($options['bgcolor'])))
? html_escape($options['bgcolor'])
: '#FFFFFF';

$borderColor = (isset($options['borderColor'])&&(!empty($options['borderColor'])))
? html_escape($options['borderColor'])
: '#000000';

$alpha = (isset($options['alpha'])&&(!empty($options['alpha'])))
? html_escape($options['alpha'])
: '1';

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
	border: 2px solid <?php echo($borderColor)?>;
	background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>);
}
ul.hardcover_front { border: 2px solid <?php echo($borderColor)?>; }
.book {
	position: relative;
	width: <?php echo $percentwidth; ?>%;
	min-width: <?php echo $width; ?>px;
 	min-height: <?php echo $height; ?>px;
	margin-bottom: 5%;
}
.book_spine, .book_spine>li { background-color: <?php echo($borderColor)?>; }
.hardcover_front, .hardcover_front>li { background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>); }
</style>
<script>
function expand(i) {
	$(i).css('clear','both').css('width','45%').css('perspective','10000px').css('display','block').css('margin-left', '50%').css('height','86vh');
	$('html, body').animate({ scrollTop: $(i).offset().top-35}, 500);
	setTimeout(endExpand,750,i);
	$(i).css('cursor', 'zoom-out');
	$(i).attr('onclick','cerrar(this)');
	$(i).find('a').click(function(event){event.stopPropagation()});
}
function endExpand(i) {
	$(i).css('height',$(i).find('.hardcover_front').find('img').height());
	$(i).css('width',$(i).find('.hardcover_front').find('img').width());
	$(i).find('.page').find('li').css('overflow','auto');
	$(i).find('.close').css('display','block');
	$(i).find('.close').css('opacity','0.75');
}
function cerrar(i){
	var b = $(i).parents('.book');
	if(b.length==0) b=i;
	$(b).find('.close').css('display','none');
	$(b).find('.close').css('opacity','0');

	$(b).css('clear','none');
	$(b).css('display','');
	$(b).css('margin','');
	
	$(b).css('height','auto');
	$(b).css('width',$('.book').width());

	$(b).find('.page').find('li').css('overflow','hidden');
	$('html, body').animate({ scrollTop: $(b).offset().top-35}, 500);

	$(b).removeAttr('style');

	$(i).css('cursor', 'zoom-in');

	$(i).attr('onclick','expand(this); return false;');
	return false;
}
</script>

<?php foreach ($attachments as $attachment): ?>
<figure class="book" onclick="expand(this); return false;">
	<ul class="hardcover_front">
		<li>
			<div class="coverDesign" style="background-image: url('<?php $file=$attachment->getFile(); echo metadata($file, 'thumbnail_uri');?>')">
			</div>
		</li>
		<li></li>
	</ul>
	<ul class="page">
		<li></li>
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
		<li></li>
		<li></li>
		<li></li>
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
<?php endforeach; ?>
