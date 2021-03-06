<?php
/**
 * A single element of a menu.
 *
 * @package Elgg.Core
 * @subpackage Navigation
 *
 * @uses $vars['item']       ElggMenuItem
 * @uses $vars['item_class'] Additional CSS class for the menu item
 */

$item = $vars['item'];

$link_class = 'elgg-menu-closed';
if ($item->getSelected()) {
	// @todo switch to addItemClass when that is implemented
	//$item->setItemClass('elgg-state-selected');
	$link_class = 'elgg-menu-opened';
}

$children = $item->getChildren();
if ($children) {
	$item->addLinkClass($link_class);
	$item->addLinkClass('elgg-menu-parent');
}

$item_class = $item->getItemClass();
if ($item->getSelected()) {
	$item_class = "$item_class elgg-state-selected";
}
if (isset($vars['item_class']) && $vars['item_class']) {
	$item_class .= ' ' . $vars['item_class'];
}

if(strpos($item_class,'elgg-menu-item-delete') !== FALSE && strlen($vars['river_item'] > 0)){
	if(elgg_is_admin_logged_in() || elgg_get_logged_in_user_guid() == $vars['river_item']->subject_guid){
		echo "<li class=\"$item_class\">";
		echo $item->getContent();
		if ($children) {
			echo elgg_view('navigation/menu/elements/section', array(
				'items' => $children,
				'class' => 'elgg-menu elgg-child-menu',
			));
		}
		echo '</li>';
	}
}
else{
	echo "<li class=\"$item_class\">";
		echo $item->getContent();
		if ($children) {
			echo elgg_view('navigation/menu/elements/section', array(
				'items' => $children,
				'class' => 'elgg-menu elgg-child-menu',
			));
		}
		echo '</li>';
}