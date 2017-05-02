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

	<div class="width">
        <?php echo $this->formLabel($formStem . '[options][width]', __('Minimum book width (px):')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][width]', @$options ['width'] );?>
    </div>
    
    <div class="percentwidth">
        <?php echo $this->formLabel($formStem . '[options][percentwidth]', __('Book width (percentage):')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][percentwidth]', @$options ['percentwidth'] );?>
    </div>
    
    <div class="height">
        <?php echo $this->formLabel($formStem . '[options][height]', __('Minimum book height (px):')); ?>
        <?php
			echo $this->formText ( $formStem . '[options][height]', @$options ['height'] );?>
    </div>
    
    <div class="cover">
        <?php echo $this->formLabel($formStem . '[options][cover]', __('Cover image')); ?>
        <?php
			echo $this->formFile ( $formStem . '[options][cover]', @$options ['cover'] );?>
    </div>
    
    <div class="bgcolor">
        <?php echo $this->formLabel($formStem . '[options][bgcolor]', __('Background color for each element:')); ?>
        <input type="color" value="<?php echo $options['bgcolor']?>" name="<?php echo ($formStem . '[options][bgcolor]');?>" id="blocks-0-options-bgcolor">
    </div>
    
    <div class="borderColor">
        <?php echo $this->formLabel($formStem . '[options][borderColor]', __('Element border color:')); ?>
        <input type="color" value="<?php echo $options['borderColor']?>" name="<?php echo ($formStem . '[options][borderColor]');?>" id="blocks-0-options-borderColor">
    </div>
    
    <div class="alpha">
        <?php echo $this->formLabel($formStem . '[options][alpha]', __('Background opacity for each element. From 0 to 1:')); ?>
        <input type="number" value="<?php echo $options['alpha']?>" step="0.1" name="<?php echo ($formStem . '[options][alpha]');?>" id="blocks-0-options-bgcolor" min="0" max="1">
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