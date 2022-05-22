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

$widget = elgg_extract('entity', $vars);

$MaxVistors = (int) $widget->num_display ?: 4;

$ProfileEntity = elgg_get_page_owner_entity();

if (!$ProfileEntity) {
	$ProfileEntity = elgg_get_logged_in_user_entity();
}

$md = elgg_get_metadata([
	'guid' => $ProfileEntity->guid,
	'metadata_name' => 'izapProfileVisitor',
	'limit' => false,
]);

$Metadata = [];
if ($md && count($md) == 1) {
	$Metadata = $md[0];
} else {
	$Metadata = $md;
}

if ($Metadata) {
	$VisitorsArray = unserialize($Metadata->value);
	$VisitorsArray = array_slice($VisitorsArray, 0, $MaxVistors);

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
	foreach($VisitorsArray as $user_guid) {
		$VisitorEntity = get_entity($user_guid);
		if ($VisitorEntity instanceof ElggUser) {
			if (is_array($onlineUsers)) {
				$class = in_array($VisitorEntity->guid, $onlineUsers) ? "izapWrapperOnline" : (($VisitorEntity->isFriend()) ? "izapWrapperFriend" : "izapWrapper");
			} else {
				$class = ($VisitorEntity->isFriend()) ? "izapWrapperFriend" : "izapWrapper";
			}
			$Visitors .= elgg_view_entity_icon($VisitorEntity, 'small', ['img_class' => $class]);
		}
	}
} else {
	$Visitors = elgg_echo('izapProfileVisitor:NoVisits');
}

echo elgg_format_element('div', [], $Visitors);
