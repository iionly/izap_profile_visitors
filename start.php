<?php
/**
 * iZAP izap profile visitor
 *
 * @license GNU Public License version 3
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 *
 * iionly; Version 1.9 and newer
 */

// registering the plugin
elgg_register_event_handler('init', 'system', 'izapProfileVisitors', 10000);

function izapProfileVisitors() {
	// Register library
	elgg_register_library('izap_profile_visitors_library', elgg_get_plugins_path() . 'izap_profile_visitors/lib/izap_profile_visitors_lib.php');
	elgg_load_library('izap_profile_visitors_library');

	elgg_register_widget_type('izapProfileVisitors', elgg_echo('izapProfileVisitor:Widget'), elgg_echo('izapProfileVisitor:WidgetDescription'));

	elgg_extend_view('css/elgg', 'izapprofilevisitor/css');
	elgg_extend_view('profile/details', 'izapprofilevisitor/userdetails', 1);
}
