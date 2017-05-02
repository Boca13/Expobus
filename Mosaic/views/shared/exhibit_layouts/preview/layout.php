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

$borderColor = (isset($options['borderColor'])&&(!empty($options['borderColor'])))
? html_escape($options['borderColor'])
: '#000000';

$max = (isset($options['max'])&&(!empty($options['max'])))
? html_escape($options['max'])
: '9';

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
}
.grid { opacity: 0; transition: opacity 200ms ease; overflow: hidden;}
</style>
<?php if(!empty($title)){?>
<h1 class="block-header"><?php echo $title;?></h1>
<?php }?>
<div class="texto"><?php echo $text; ?></div><div class="grid" id="grid">
<div class="gutter-sizer"></div>
    <?php $n=0;
    $hijos=exhibit_builder_child_pages(null);
    echo count($hijos); 
    foreach ($attachments as $attachment): ?>
    <div class="item-sizer">
    <div class="grid-item">
    <a href="<?php if(count($hijos)>=1) {
    	echo(exhibit_builder_exhibit_uri(null,$hijos[0])."#item".$n);
    }?>"><?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size, 'linkToFile' => false)); ?></a>
    </div>
    </div>
    <?php $n++;
    if($n==$max)
    	break;
    endforeach; ?>
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
	$('.grid').css('opacity','1');
	$('.exhibit-block.layout-preview').css('opacity','1');
	};
</script>