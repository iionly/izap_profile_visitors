<?php
/**
 * iZAP izap profile visitor
 *
 * @license GNU Public License version 3
 * @author iZAP Team "<support@izap.in>"
 * @link http://www.izap.in/
 *
 * iionly; Version 1.9:
 * compatibility elgg-1.9
 */

$MaxVistors = $vars['entity']->num_display;

if(!$MaxVistors) {
    $MaxVistors = 5;
}

$VisitorArray = izapVisitorList();

if (!empty($VisitorArray) && count($VisitorArray) > 0) {
    $VisitorArray = array_slice($VisitorArray, 0, $MaxVistors);
    $online = find_active_users(array('seconds' => 600, 'limit' => false));

    if (!empty($online) && count($online) > 0) {
        $onlineUsers = array();
        foreach ($online as $key => $entity) {
            $onlineUsers[] = $entity->guid;
        }
    }

    foreach($VisitorArray as $VisitorGuid) {
        $VisitorEntity = get_entity($VisitorGuid);
        $icon = elgg_view_entity_icon($VisitorEntity, 'small');

        if (is_array($onlineUsers)) {
            if(in_array($VisitorGuid, $onlineUsers)) {
                $Visitors .= '<div class="izapWrapperOnline">' . $icon . '</div>';
            } else {
                $Visitors .= '<div class="izapWrapper">' . $icon . '</div>';
            }
        } else {
            $Visitors .= '<div class="izapWrapper">' . $icon . '</div>';
        }
    }
} else {
    $Visitors .= '<div>' . elgg_echo('izapProfileVisitor:NoVisits') . '</div>';
}
?>

<div class="izapMargin"><?php echo $Visitors;?>
<div style="clear:both"></div>
</div>
