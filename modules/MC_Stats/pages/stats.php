<?php
// Define page name
define('PAGE', 'mc_stats');

// Set page title
$page_title = $mc_stats_language->get('general', 'page_title');

if (!$user->hasPermission('mc_stats.page') || !$user->isLoggedIn()) {
    require_once(ROOT_PATH . '/403.php');
    die();
}

// Initialize frontend
require_once(ROOT_PATH . '/core/templates/frontend_init.php');


require_once(ROOT_PATH . '/modules/MC_Stats/getStats.php');
$stats = getStats($user->data()->uuid);
$titles = [
    "STATS_TITLE" => $mc_stats_language->get('general', 'widget_title'),
    "MONEY_CITYBUILD_TITLE" => $mc_stats_language->get('general', 'money_citybuild'),
    "MONEY_FREEBUILD_TITLE" => $mc_stats_language->get('general', 'money_freebuild'),
    "MONEY_SKYBLOCK_TITLE" => $mc_stats_language->get('general', 'money_skyblock'),
    "TERRA_TITLE" => $mc_stats_language->get('general', 'terra'),
    "PLAYTIME_TITLE" => $mc_stats_language->get('general', 'playtime')
];
$data = array_merge($stats, $titles);
$data["IMAGE"] = "https://crafatar.com/renders/body/" . $user->data()->uuid . "?overlay=true";
$smarty->assign($data);
$content = $smarty->fetch('MC_Stats/pages/stats.tpl');


// Load module page(s)
Module::loadPage($user, $pages, $cache, $smarty, [$navigation, $cc_nav, $mod_nav], $widgets);

// Assign page load time
$page_load_time = round(microtime(true) - $start);
define('PAGE_LOAD_TIME', str_replace('{x}', $page_load_time, $language->get('general', 'page_loaded_in')));

// Load page template
$template->onPageLoad();

$smarty->assign('WIDGETS_LEFT', $widgets->getWidgets('left'));
$smarty->assign('WIDGETS_RIGHT', $widgets->getWidgets('right'));

// Initialize navbar & footer
require_once(ROOT_PATH . '/core/templates/navbar.php');
require_once(ROOT_PATH . '/core/templates/footer.php');

// Display the template (uncomment to use the template)
$template->displayTemplate('MC_Stats/pages/stats.tpl', $smarty);
