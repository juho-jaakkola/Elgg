<?php

/**
 * Page handler for activity
 *
 * @param array $segments URL segments
 * @return \Elgg\Http\ResponseBuilder
 * @access private
 */
function elgg_activity_page_handler($segments) {
	elgg_set_page_owner_guid(elgg_get_logged_in_user_guid());

	// make a URL segment available in page handler script
	$page_type = elgg_extract(0, $segments, 'all');
	$page_type = preg_replace('[\W]', '', $page_type);

	if ($page_type == 'owner') {
		elgg_gatekeeper();
		$page_username = elgg_extract(1, $segments, '');
		if ($page_username == elgg_get_logged_in_user_entity()->username) {
			$page_type = 'mine';
		} else {
			$vars['subject_username'] = $page_username;
		}
	}

	$vars['page_type'] = $page_type;

	return elgg_ok_response(elgg_view_resource("river", $vars));
}

function elgg_activity_init() {
	elgg_register_page_handler('activity', 'elgg_activity_page_handler');

	$item = new \ElggMenuItem('activity', elgg_echo('activity'), 'activity');
	elgg_register_menu_item('site', $item);

	elgg_register_action('river/delete', '', 'admin');

	elgg_register_widget_type(
		'group_activity',
		elgg_echo('groups:widget:group_activity:title'),
		elgg_echo('groups:widget:group_activity:description'),
		array('dashboard'),
		true
	);
}

elgg_register_event_handler('init', 'system', 'elgg_activity_init');
