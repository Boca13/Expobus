<?php queue_js_url('/parallax.js/parallax.min.js');?>
<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>

<div id="portada">
<div class="fondo parallax-window" data-parallax="scroll" data-image-src="<?php echo(url('files/theme_uploads/'.get_theme_option('portada')));?>">
      <h2><?php echo metadata('exhibit', 'title'); ?></h2>
      <?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
    	<?php echo $exhibitDescription; ?>
	<?php endif; ?>
</div>
</div>

<?php echo exhibit_builder_page_nav(); ?>


<nav id="exhibit-pages">
<?php
	$exhibit = get_current_record('exhibit');
	$pages = $exhibit->getPages();
	foreach ($pages as $page){
		$attachments = $page->getAllAttachments();
		$attachment = $attachments[0];
		if($attachment!=null){
			$portada = $attachment->getFile()->getProperty("thumbnail_uri");
		}else{
			$portada = "";
		}
		?>
		<a class="miniatura" href="<?php echo($page->getRecordUrl());?>" title="<?php echo($page->title);?>" <?php if ($portada != ""){?>style="background-image: url('<?php echo($portada);?>');"<?php }?>>
		<div class="sombra"></div>
		<div class="info"><h3><?php echo($page->title);?></h3></div>
		</a>

<?php }?>
</nav>

<?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
<div class="exhibit-credits">
    <h3><?php echo __('Credits'); ?></h3>
    <p><?php echo $exhibitCredits; ?></p>
</div>
<?php endif; ?>

<?php echo foot(); ?>
