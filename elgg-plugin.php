<?php

return [
	'plugin' => [
		'name' => 'iZAP Profile Visitors',
		'version' => '4.0.0',
	],
	'widgets' => [
		'izapProfileVisitors' => [
			'context' => ['profile', 'dashboard'],
		],
	],
	'view_extensions' => [
		'css/elgg' => [
			'izapprofilevisitor/css' => [],
		],
		'profile/details' => [
			'izapprofilevisitor/userdetails' => [
				'priority' => 1,
			],
		],
	],
];
