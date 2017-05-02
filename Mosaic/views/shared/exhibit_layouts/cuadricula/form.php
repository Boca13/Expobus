<?php
$formStem = $block->getFormStem();
$options = $block->getOptions();
?>
<div class="selected-items">
	<h4><?php echo __('Items'); ?></h4>
    <?php echo $this->exhibitFormAttachments($block); ?>
</div>

<div class="layout-options">
	<div class="block-header">
		<h4><?php echo __('Layout options'); ?></h4>
		<div class="drawer"></div>
	</div>

	<div class="title">
        <?php echo $this->formLabel($formStem . '[options][title]', __('Block title:')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][title]', @$options ['title'] );?>
    </div>
    
	<div class="width">
        <?php echo $this->formLabel($formStem . '[options][width]', __('Minimum image width (px):')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][width]', @$options ['width'] );
			?>
    </div>
    
    <div class="percentwidth">
        <?php echo $this->formLabel($formStem . '[options][percentwidth]', __('Image width (percentage):')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][percentwidth]', @$options ['percentwidth'] );
			?>
    </div>
    
    <div class="borderColor">
        <?php echo $this->formLabel($formStem . '[options][borderColor]', __('Element border color:')); ?>
        <input type="color" value="<?php echo $options['borderColor']?>" name="<?php echo ($formStem . '[options][borderColor]');?>" id="blocks-0-options-borderColor">
    </div>
    
    <div class="file-size">
        <?php echo $this->formLabel($formStem . '[options][file-size]', __('Image size to be used in mosaic:')); ?>
        <?php
        echo $this->formSelect($formStem . '[options][file-size]',
            @$options['file-size'], array(),
            array(
                'fullsize' => __('Fullsize'),
                'thumbnail' => __('Thumbnail'),
                'square_thumbnail' => __('Square Thumbnail')
            ));
        ?>
    </div>
</div>