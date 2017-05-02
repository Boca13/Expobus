<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
    $exhibitNavOption = get_theme_option('exhibits_nav');
    $exhibit = get_current_record('exhibit');
?>
<?php
if (get_theme_option('tiemposcroll')):
	$tiemposcroll = get_theme_option('tiemposcroll');
else:
	$tiemposcroll=750;
endif;
	?>
<div id="breadcrumbs"><a href="/">Expobus</a><?php echo exhibit_builder_page_nav();?></div>

<div id="exhibit-show">
<?php if ($exhibitNavOption == 'full'): ?>
<nav id="exhibit-pages" class="full">
    <?php echo exhibit_builder_page_nav(); ?>
</nav>
<?php endif; ?>

<h1><span class="exhibit-page"><?php echo metadata('exhibit_page', 'title'); ?></span></h1>

<?php if (count(exhibit_builder_child_pages()) > 0 && $exhibitNavOption == 'full'): ?>
<nav id="exhibit-child-pages" class="secondary-nav">
    <?php echo exhibit_builder_child_page_nav(); ?>
</nav>
<?php endif; ?>

<div role="main" id="exhibit-blocks">
<?php exhibit_builder_render_exhibit_page(); ?>
</div>

<div id="exhibit-page-navigation">
    <?php if ($prevLink = exhibit_builder_link_to_previous_page()): ?>
    <div id="exhibit-nav-prev">
    	<?php echo $prevLink; ?>
    </div><?php endif; ?><div id="exhibit-nav-up">
    	<?php echo exhibit_builder_page_trail(); ?>
    </div><?php if ($nextLink = exhibit_builder_link_to_next_page()): ?><div id="exhibit-nav-next">
    	<?php echo $nextLink; ?>
    </div>
    <?php endif; ?>
</div>

<?php if ($exhibitNavOption == 'side'): ?>
<nav id="exhibit-pages" class="side">
    <h4><?php echo exhibit_builder_link_to_exhibit($exhibit); ?></h4>
    <?php echo exhibit_builder_page_tree($exhibit, $exhibit_page); ?>
</nav>
<?php endif; ?>
</div>

<div id="marcador"></div>
<div id="navegador">


<?php if ($p = $exhibit_page->previous()){ ?>
<a href="<?php echo $p->getRecordUrl();?>" class="flechita izquierda" title="Página anterior">←</a><?php }?>

<?php if ($exhibit->use_summary_page==1) {?>
<a href="." class="flechita mosaico" title="Página de inicio"></a><?php }?>

<?php if ($p = $exhibit_page->next()) {?>
<a href="<?php echo $p->getRecordUrl(); ?>" class="flechita derecha" title="Página siguiente">→</a><?php }?>

</div>
<script>
function scroll(e){
	$('body,html').animate({scrollTop: $(e).offset().top}, <?php echo($tiemposcroll);?>);
	return false;
}

$(function(){
	// Resaltar pastillas cuando se hace scroll
	$(window).scroll(function(){
		$('#marcador,#navegador').css('opacity', '0.9');
		evento=setTimeout(function(){clearTimeout(evento); $('#marcador,#navegador').css('opacity', '');}, 1000); 
	});
	// Bolitas
	$("#exhibit-blocks").children().each(function(i,e){
		if(i==0){
			$('<a class="bolita" href="" title="Ir a la imagen"></a>').appendTo('#marcador').click(function(){
				scroll($("body"));
				return false;
			});
		} else {
			$('<a class="bolita" href="" title="Ir a la imagen"></a>').appendTo('#marcador').click(function(){
				scroll($(e));
				return false;
			});
		}
	});

	// Fancybox para las imágenes
	$('a.download-file').addClass('fancybox').attr('rel','gallery').each(function(n,e){
		$(e).attr('href',$(e).children('img').attr('src'));
	}).fancybox();
});

$(".exhibit-block").each(function(i,e){
	new Waypoint({
		  element: e,
		  handler: function() {
			  var indice = $("#exhibit-blocks").children().index($(this.element));
			  $("#marcador").children().each(function(i,e){
				  $(e).css('border','3px solid grey');
				});
			  $($("#marcador").children().get(indice)).css('border','4px solid #d8ae2e');
		  },
		  offset: '20'
		});
});
</script>
<?php echo foot(); ?>
