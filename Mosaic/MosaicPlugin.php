<?php
class MosaicPlugin extends Omeka_Plugin_AbstractPlugin {
	const PLUGIN_NAME = 'Mosaic';
	
	protected $_hooks = array ('exhibit_builder_page_head');
	protected $_filters = array ('exhibit_layouts');
	public function filterExhibitLayouts($layouts) {
		$layouts ['mosaic'] = array (
				'name' => __ ( 'Mosaic' ),
				'description' => __ ( 'Show elements tiled as a mosaic.' ) 
		);
		$layouts ['slides'] = array (
				'name' => __ ( 'Slides' ),
				'description' => __ ( 'Show elements as slides.' )
		);
		$layouts ['detail'] = array (
				'name' => __ ( 'Detail' ),
				'description' => __ ( 'Elements are tiled in a grid and a preview is shown on mouse hover.' )
		);
		$layouts ['library'] = array (
				'name' => __ ( 'Library' ),
				'description' => __ ( 'Elements are book-like with the caption inside.' )
		);
		$layouts ['book'] = array (
				'name' => __ ( 'Book' ),
				'description' => __ ( 'Elements are pages in a book.' )
		);
		$layouts ['preview'] = array (
				'name' => __ ( 'Preview' ),
				'description' => __ ( 'The elements of the child exhibition page are show as thumbnails along with a text attachment.' )
		);
		$layouts ['cuadricula'] = array (
				'name' => __ ( 'Cuadrícula cronológica' ),
				'description' => __ ( 'Cuadrícula de elementos ordenados cronológicamente.' )
		);
		$layouts ['cabecera'] = array (
				'name' => __ ( 'Cabecera con imagen' ),
				'description' => __ ( 'Muestra una imagen a ancho completo como cabecera de una página de exposición' )
		);
		return $layouts;
	}
	public function hookExhibitBuilderPageHead($args) {
		
		// Mosaic
        if (array_key_exists('mosaic', $args['layouts'])) {
            queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide-full.js'));
            queue_css_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide.css'));
            queue_js_string("$ = jQuery");
            $graphicsDir = url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/graphics/');
            queue_js_string("
                    jQuery(document).ready(function() {
                        hs.graphicsDir ='$graphicsDir';
            			hs.showCredits = false;
        				hs.align = 'center';
						hs.dimmingOpacity = 0.75;
                    })
            ");
        }
        
        // Slides
        if (array_key_exists('slides', $args['layouts'])) {
        	queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/jquery-1.11.3.min.js'));
        	queue_js_string("if(typeof jQuery == 'undefined'){document.write('<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-1.9.1.min.js\"><\/script>');}");
        	queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide-full.js'));
        	queue_css_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide.css'));
        	queue_js_string("$ = jQuery");
        	$graphicsDir = url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/graphics/');
        	queue_js_string("
        			jQuery(document).ready(function() {
        			hs.graphicsDir ='$graphicsDir';
        			hs.showCredits = false;
        			hs.align = 'center';
					hs.dimmingOpacity = 0.75;
        	})
        			");
        }
        
	// Detail
        if (array_key_exists('detail', $args['layouts'])) {
        	queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/slidejs/jquery.slides.min.js'));
        	queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide-full.js'));
        	queue_css_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/highslide.css'));
        	queue_js_string("$ = jQuery");
        	$graphicsDir = url('/plugins/'.self::PLUGIN_NAME.'/javascripts/highslide/graphics/');
        	queue_js_string("
        			jQuery(document).ready(function() {
        			hs.graphicsDir ='$graphicsDir';
        			hs.showCredits = false;
        			hs.align = 'center';
					hs.dimmingOpacity = 0.75;
        })
        			");
        }
        
        // Library
        if (array_key_exists('library', $args['layouts'])) {
        	queue_js_string("$ = jQuery");
        }
        
        // Book
        if (array_key_exists('book', $args['layouts'])) {
        	queue_js_string("$ = jQuery");
        }
        
        // Preview
        if (array_key_exists('preview', $args['layouts'])) {
        	queue_js_string("$ = jQuery");
        }
        
        // Cuadricula
        if (array_key_exists('cuadricula', $args['layouts'])) {
        	queue_js_url('http://code.jquery.com/jquery-latest.min.js');
        	//queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/fancybox/source/jquery.fancybox.pack.js'));
        	queue_css_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/fancybox/source/jquery.fancybox.css'));
        	queue_js_string("$ = jQuery");
        }
        
        // Cabecera
        if (array_key_exists('cabecera', $args['layouts'])) {
        	queue_js_string("$ = jQuery");
        	queue_js_url(url('/plugins/'.self::PLUGIN_NAME.'/javascripts/parallax.min.js'));
        }
    }
}
?>