<?php

class MCStatsModule extends Module
{
	private $mc_stats_language;
	private $language;
	private $queries;
	private $cache;

	public function __construct($mc_stats_language, $language, $pages, $queries, $cache)
	{
		// Module information
		$name = 'MC_Stats';
		$author = '<a href="https://www.hyperbuild.eu" target="_blank" rel="noreferrer noopener">Alexander Rebello</a>';
		$version = '1.0.0';
		$nameless_version = '2.0.0-pr12';

		// Initialize the module
		parent::__construct($this, $name, $author, $version, $nameless_version);

		// Register module page(s)
		$pages->add($this->getName(), '/stats', 'pages/stats.php');

		// Assign some variables
		$this->mc_stats_language = $mc_stats_language;
		$this->language = $language;
		$this->queries = $queries;
		$this->cache = $cache;
	}

	public function onInstall()
	{
		// Initialize navigation order
		$this->cache->setCache('navbar_order');
		if (!$this->cache->isCached('mc_stats_order')) {
			$this->cache->store('mc_stats_order', 100);
		}

		// Initialize navigation icon
		$this->cache->setCache('navbar_icons');
		if (!$this->cache->isCached('mc_stats_icon')) {
			$this->cache->store('mc_stats_icon', '<i class="icon fas fa-chart-bar"></i>');
		}
	}

	public function onUninstall()
	{
		// ...
	}

	public function onEnable()
	{
		// ...
	}

	public function onDisable()
	{
		// ...
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template)
	{
		// Get navigation order
		$cache->setCache('navbar_order');
		$nav_order = $cache->retrieve('mc_stats_order');

		// Get navigation icon
		$cache->setCache('navbar_icons');
		$nav_icon = $cache->retrieve('mc_stats_icon');

		if ($user->hasPermission('mc_stats.page')  && $user->isLoggedIn()) {
			// Register navigation item
			$navs[0]->add('mc_stats', $this->mc_stats_language->get('general', 'nav_title'), URL::build('/stats'), 'top', null, $nav_order, $nav_icon);
		}

		// Register module widgets(s)
		if ($widgets && $user->hasPermission('mc_stats.widget')  && $user->isLoggedIn()) {
			require_once('widgets/stats.php');
			$widgets->add(new MCStatsWidget($this, $widgets, $this->mc_stats_language, $this->$language, $smarty, $cache, $user));
		}
	}
}
