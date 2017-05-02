<?php
class AnalyticsPlugin extends Omeka_Plugin_AbstractPlugin {
	const PLUGIN_NAME = 'Analytics';
	private $analytics_key = "UA-84765466-1";
	
	protected $_hooks = array(
		'install',
		'config_form',
		'config',
		'public_head');
	
	public function hookInstall()
	{
		set_option('analytics_api_key', serialize(array()));
	}

	public function hookPublicHead($args)
	{

		queue_js_string("
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', '" . unserialize(get_option('analytics_api_key')) . "', 'auto');
  ga('send', 'pageview');
				"); // Google Analytics script
	}
	
	public function hookConfig($args)
	{
		$post = $args['post'];
		foreach($post as $key=>$value) {
			if($key == 'analytics_api_key') {
				$value = serialize($value);
			}
			set_option($key, $value);
		}
	}
	
	public function hookConfigForm()
	{
		include 'config_form.php';
	}

}
?>