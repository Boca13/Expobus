<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<?php 
if ($targetPage = $exhibit->getFirstTopPage()) {
	$primera = exhibit_builder_exhibit_uri(null, $targetPage);
}
?>
<style>#site-title{ display: none;}#navegacion{ display: none;}
#portada {
	width: 100%;
}
.row {
	width: 100%;
	max-width: 100%;
}
.large-12{
	padding: 0;
}
.row, .large-12, #primary { height: 100%; }
html, body { height: 100%; overflow: hidden; }
html{background-color: <?php echo(get_theme_option('colorfondo'));?>;}
body {
	background-image: url('<?php echo(url('files/theme_uploads/'.get_theme_option('portada'))); ?>');
	background-size: contain;
	background-repeat: no-repeat;
	background-position: center;
}
</style>
<div id="primary">
<a style="display: block; height: 100%;" href="<?php echo $primera ?>"></a>
</div>
<script type="text/javascript">
		function timeout(){window.setTimeout("redirect()",3000);}
		function redirect(){ window.location=$('#primary>a').attr('href'); return;}
		window.onload=timeout;
</script>

</div>
</div>
</div>
