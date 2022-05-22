<?php

return [
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
