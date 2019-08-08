<?php
//Check whether each option is set and save it in a variable
$width = (isset($options['width'])&&(!empty($options['width'])))
? html_escape($options['width'])
: '100';

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
: '0';

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
<script src="http://masonry.desandro.com/masonry.pkgd.min.js"></script>
<style>
.item-sizer { min-width: <?php echo $width; ?>px; margin-bottom: 5px; width: <?php echo $percentwidth; ?>%; }
.grid-item {
	border: 2px solid <?php echo($borderColor)?>;
	background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>);
}
.highslide-html { background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>); }
</style>
<script>
sel=undefined;
n=-1;
function expand() {
	$(sel).find('.contenido>img').css('max-height', 0.75*$(window).height()-10);
	var h=0.8*$(window).height();
	var calculado = $(sel).find('img').height()/$(sel).find('img').width()*0.25*$(window).width();
	calculado = (calculado>$(sel).find('.exhibit-item-caption').height())? calculado:$(sel).find('.exhibit-item-caption').height()*1.25;
	if(h<calculado)
		h=calculado+20;
	return hs.htmlExpand(sel, { contentId: 'item'+n, wrapperClassName: 'highslide-white', outlineType: 'outer-glow', width: 0.75*$(window).width(), height: h, objectWidth: 0.75*$(window).width(), objectHeight: 0.9*$(window).height(), transitions: ['fade'] } );
}</script>
<script>
$('.contenido').css('height',$('.highslide-html').css('height'));
function preview(item) {
	a=$('.preview').offset().top
	b=$('#item'+n).offset().top
	
	if(b-a<0){
		
		$('#imgpreview').css("padding-top","10px")
	}else{
		
		$('#imgpreview').css("padding-top",b-a+"px")
	}

	$('#imgpreview').css("position","")	

	$("#imgpreview img").css("width",$(".preview").css("width"))


	$('#imgpreview img').attr('src', $(item).find('img').attr('src'));
	$('#imgpreview img').css('opacity','1');
}
function show(item,n) {
	a=$('.preview').offset().top
	b=$('#item'+n).offset().top

	if(b-a<0){
		
		$('#imgpreview').css("padding-top","10px")
	}else{
		
		$('#imgpreview').css("padding-top",b-a+15+"px")
	}

    $("#imgpreview img").css("width",$(".preview").css("width"))

	if($('#imgpreview img').attr('src')!=$(item).find('img').attr('src')){
		$('#imgpreview img').css('opacity','0');
		setTimeout(preview, 200, item);
	}
	return false;
}
</script>
<div class="preview" onclick="return expand();"><div id="imgpreview" style="position:relative;"><img/></div></div><div class="grid-container">
<div class="grid" id="grid">
<div class="gutter-sizer"></div>
    <?php $n=0; foreach ($attachments as $attachment): ?>
    <div class="item-sizer">
    <div class="grid-item" onclick="sel=this; n=<?php echo $n;?>; return show(this,n);">
    <?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size, 'linkToFile' => false)); ?>
    
    <div class="highslide-html-content" id="item<?php echo ($n++);?>">
    	<div style="height:20px; padding: 2px; text-align: right;">
			<a href="#" onclick="return hs.close(this);" class="control">x</a>
		</div>
		<div class="contenido">
    		<img class="imagen" src="<?php echo ($attachment->getFile()->getProperty("fullsize_uri"));?>">
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
    </div>
    
    </div>
    </div>
    <?php endforeach; ?>
</div>
</div>

<script>
window.onload=function() {
	var elem = document.querySelector('.grid');
	msnry = new Masonry( elem, {
		itemSelector: '.item-sizer',
		  columnWidth: '.item-sizer',
		  percentPosition: true,
		  gutter: '.gutter-sizer'
		});
	msnry.layout();
	};

jQuery(document).ready(function() {
$('#imgpreview').css("position","relative")
$("#imgpreview img").css("width",$(".preview").css("width"))
       
})
</script>
