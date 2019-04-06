<?php
/**
 * iZAP Profile Visitors
 *
 * @license GNU Public License version 3
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 *
 * iionly; Version 1.8 and newer
 */

// Init the plugin
elgg_register_event_handler('init', 'system', 'izapProfileVisitors', 10000);

function izapProfileVisitors() {
	elgg_extend_view('elgg.css', 'izapprofilevisitor/izapprofilevisitor.css');
	elgg_extend_view('profile/details', 'izapprofilevisitor/userdetails', 1);
}
