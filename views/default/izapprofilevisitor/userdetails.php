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

// iZAP visitor marker

$ProfileEntity = elgg_get_page_owner_entity();
$ProfileGuid = $ProfileEntity->guid;
$ProfileOwner = $ProfileEntity->owner_guid;

$VisitorEntity = elgg_get_logged_in_user_entity();
$VisitorGuid = $VisitorEntity->guid;

$VisitorsArray = [];

if (($VisitorGuid != $ProfileGuid) && $VisitorEntity && $ProfileEntity) {
	$md = elgg_get_metadata([
		'guid' => $ProfileGuid,
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
		$Id = $Metadata->id;
		$VisitorsArray = unserialize($Metadata->value);
		array_unshift($VisitorsArray, $VisitorGuid);
		$InsertArray = array_slice(array_unique($VisitorsArray), 0, 25);
		$InsertArray = serialize($InsertArray);
		$result = update_metadata($Id, 'izapProfileVisitor', $InsertArray, 'text', $ProfileOwner, ACCESS_PUBLIC);
		if ($result !== false) {
			elgg_delete_metadata(['metadata_id' => $Id]);
		}
	} else {
		array_unshift($VisitorsArray, $VisitorGuid);
		$InsertArray = serialize($VisitorsArray);
		create_metadata($ProfileGuid, 'izapProfileVisitor', $InsertArray, 'text', $ProfileOwner, ACCESS_PUBLIC);
	}
}
