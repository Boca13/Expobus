<div class="field">
    <div class="inputs five columns">
        <p class="explanation"><?php echo __('Clave de API de Google Analytics.'); ?></p>
        <div class="input-block">
        <?php echo get_view()->formText('analytics_api_key', unserialize(get_option('analytics_api_key')),
			array('size'=> 30)
        );?>
        </div>
    </div>
</div>