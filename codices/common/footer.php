<footer role="contentinfo" id="footerexpo">
	<div id="logos"><?php if(get_theme_option('footer_imagenlogo1')):?><a href="<?php echo get_theme_option('footer_enlacelogo1');?>"><img src="<?php echo url('files/theme_uploads/'.get_theme_option('footer_imagenlogo1'));?>"></a><?php endif;?><?php if(get_theme_option('footer_imagenlogo2')):?><a href="<?php echo get_theme_option('footer_enlacelogo2');?>"><img src="<?php echo url('files/theme_uploads/'.get_theme_option('footer_imagenlogo2'));?>"></a><?php endif;?><?php if(get_theme_option('footer_imagenlogo3')):?><a href="<?php echo get_theme_option('footer_enlacelogo3');?>"><img src="<?php echo url('files/theme_uploads/'.get_theme_option('footer_imagenlogo3'));?>"></a><?php endif;?></div>
	
	<div class="social">
	<?php if(get_theme_option('red_fb')):?><a title="Facebook" href="<?php echo(get_theme_option('red_fb'));?>" class="icono facebook"></a><?php endif;?>
	<?php if(get_theme_option('red_twitter')):?><a title="Twitter" href="<?php echo(get_theme_option('red_twitter'));?>" class="icono twitter"></a><?php endif;?>
	<?php if(get_theme_option('red_flickr')):?><a title="Flickr" href="<?php echo(get_theme_option('red_flickr'));?>" class="icono flickr"></a><?php endif;?>
	<?php if(get_theme_option('red_email')):?><a title="Email" href="<?php echo(get_theme_option('red_email'));?>" class="icono email"></a><?php endif;?>
	<?php if(get_theme_option('red_youtube')):?><a title="Youtube" href="<?php echo(get_theme_option('red_youtube'));?>" class="icono youtube"></a><?php endif;?>
	<?php if(get_theme_option('red_rss')):?><a title="RSS" href="<?php echo(get_theme_option('red_rss'));?>" class="icono rss"></a><?php endif;?>
	</div>
	<div id="footer-text">
		<?php if ((get_theme_option('Display Footer Copyright') == 1) && $copyright = option('copyright')): ?>
			<p><?php echo $copyright; ?></p>
		<?php endif; ?>
		<div><a href="http://creativecommons.org/licenses/by/4.0/" rel="license" target="_blank"><img alt="Licencia de Creative Commons" src="https://i.creativecommons.org/l/by/4.0/80x15.png"></a></div>
		<?php echo get_theme_option('Footer Text'); ?>
	</div>
	<?php fire_plugin_hook('public_footer', array('view' => $this)); ?>
</footer>
</body>
</html>
