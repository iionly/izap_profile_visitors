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

$MaxVistors = $vars['entity']->num_display;

if (!$MaxVistors) {
	$MaxVistors = 4;
}

$ProfileEntity = elgg_get_page_owner_entity();

if (!$ProfileEntity) {
	$ProfileEntity = elgg_get_logged_in_user_entity();
}

$Metadata = elgg_get_metadata([
	'guid' => $ProfileEntity->guid,
	'metadata_name' => 'izapProfileVisitor',
	'limit' => $MaxVistors,
]);

$VisitorArray = [];
if ($Metadata) {
	$VisitorArray = unserialize($Metadata[0]->value);
}

if (!empty($VisitorArray) && count($VisitorArray) > 0) {
	$online = find_active_users([
		'seconds' => 300,
		'limit' => false,
	]);

	if (!empty($online) && count($online) > 0) {
		$onlineUsers = [];
		foreach ($online as $key => $entity) {
			$onlineUsers[] = $entity->guid;
		}
	}
	$Visitors = '';
	foreach($VisitorArray as $VisitorGuid) {
		$VisitorEntity = get_entity($VisitorGuid);
		if (is_array($onlineUsers)) {
			$class = in_array($VisitorGuid, $onlineUsers) ? "izapWrapperOnline" : (($VisitorEntity->isFriend()) ? "izapWrapperFriend" : "izapWrapper");
		} else {
			$class = ($VisitorEntity->isFriend()) ? "izapWrapperFriend" : "izapWrapper";
		}
		$Visitors .= elgg_view_entity_icon($VisitorEntity, 'small', ['img_class' => $class]);
	}
} else {
	$Visitors = elgg_echo('izapProfileVisitor:NoVisits');
}

echo elgg_format_element('div', [], $Visitors);
