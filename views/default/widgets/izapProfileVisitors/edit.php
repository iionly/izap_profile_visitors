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

/* @var $widget ElggWidget */
$widget = elgg_extract('entity', $vars);

$count = (int) $widget->num_display;
if ($count < 1) {
	$count = 4;
}

echo elgg_view_field([
	'#type' => 'number',
	'#label' => elgg_echo('izapProfileVisitor:NumberOfVisitors'),
	'name' => 'params[num_display]',
	'value' => $count,
	'min' => 1,
	'max' => 25,
	'step' => 1,
]);
