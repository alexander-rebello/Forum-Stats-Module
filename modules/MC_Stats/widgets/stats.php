<?php
class MCStatsWidget extends WidgetBase
{
	private $mc_stats_language;
	private $language;
	private $smarty;
	private $user;
	private $cache;

	public function __construct($module, $widgets, $mc_stats_language, $language, $smarty, $cache, $user)
	{
		// Widget information
		$this->_name = 'MC Stats';
		$this->_description = 'MC Stats widget';
		$this->_module = $module->getName();

		// Initialize the widget
		parent::__construct($widgets->getPages($this->getName()));

		// Set widget location and order
		$widget_query = DB::getInstance()->query('SELECT `location`, `order` FROM nl2_widgets WHERE `name` = ?', [$this->getName()])->first();
		$this->_location = $widget_query->location;
		$this->_order = $widget_query->order;

		// Assign the variables
		$this->_mc_stats_language = $mc_stats_language;
		$this->_language = $language;
		$this->_smarty = $smarty;
		$this->_user = $user;
		$this->_cache = $cache;
	}

	public function initialise()
	{
		if ($this->_user->hasPermission("mc_stats.widget") && $this->_user->isLoggedIn()) {
			require_once(ROOT_PATH . '/modules/MC_Stats/getStats.php');
			$stats = getStats($this->_user->data()->uuid);
			$titles = [
				"STATS_TITLE" => $this->_mc_stats_language->get('general', 'widget_title'),
				"MONEY_CITYBUILD_TITLE" => $this->_mc_stats_language->get('general', 'money_citybuild'),
				"MONEY_FREEBUILD_TITLE" => $this->_mc_stats_language->get('general', 'money_freebuild'),
				"MONEY_SKYBLOCK_TITLE" => $this->_mc_stats_language->get('general', 'money_skyblock'),
				"TERRA_TITLE" => $this->_mc_stats_language->get('general', 'terra'),
				"PLAYTIME_TITLE" => $this->_mc_stats_language->get('general', 'playtime')
			];
			$data = array_merge($stats, $titles);
			$this->_smarty->assign($data);
			$this->_content = $this->_smarty->fetch('MC_Stats/widgets/stats.tpl');
		}
	}
}
