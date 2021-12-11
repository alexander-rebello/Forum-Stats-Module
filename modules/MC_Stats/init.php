<?php
// Initialize the module language
$mc_stats_language = new Language(__DIR__ . '/language', LANGUAGE);

// Initialize the module
require_once('module.php');
$module = new MCStatsModule($mc_stats_language, $language, $pages, $queries, $cache);
