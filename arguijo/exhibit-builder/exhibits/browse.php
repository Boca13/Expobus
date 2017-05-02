<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<?php // Propiedades
$colorfondo = get_theme_option('colorfondo');
$header_image = get_theme_option('header_image');
$colorblock = get_theme_option('colorblock');
$shadowblock = get_theme_option('shadowblock');
?>
<style>
html{height:100%;}
body{height:100%;}
body { background-color: <?php echo($colorfondo);?>; }
.exhibit{ background-color: rgba(<?php echo($colorblock);?>); box-shadow: 0px 0px 30px 0px rgba(<?php echo($shadowblock);?>); }
</style>

<div id="header-full" style="background-image: url('<?php echo(url('files/theme_uploads/'.$header_image));?>');"></div>

<div id="expos">
<h1>Exposiciones</h1>
<?php if (count($exhibits) > 0): ?>

<?php echo pagination_links(); ?>

<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php $exhibitCount++; ?>
    <div class="exhibit" style="background-image: url('<?php echo "http://expobus.us.es/omeka/files/fullsize/126f58fcb21ccd21dae6d4c46b2a428b.jpg";?>');">
        
        <?php $exhibitImage = record_image($exhibit, 'fullsize') ?>
               
        	<?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
        	<div class="description">
        		<h2><?php echo link_to_exhibit(); ?></h2>
        		<?php echo $exhibitDescription; ?>
        	</div>
        	<?php endif;?>
            <?php //echo exhibit_builder_link_to_exhibit($exhibit, $exhibitImage, array('class' => 'image')); ?>
       
        <?php if ($exhibitTags = tag_string('exhibit', 'exhibits')): ?>
        <p class="tags"><?php echo __('Tags: ') . $exhibitTags; ?></p>
        <?php endif; ?>
        
        
    </div>
<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php else: ?>
<p><?php echo __('There are no exhibits available yet.'); ?></p>
<?php endif; ?>
</div>
<?php echo foot(); ?>
