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
    <div class="file-size">
        <?php echo $this->formLabel($formStem . '[options][file-size]', __('Image size to be used:')); ?>
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