<?php
$methods = [
	'submitAmbassador' => [
		'params' => [
			[
				'name' => 'firstname',
				'source' => 'p',
				'pattern' => 'name',
				'obligatory' => 'true'
			],
			[
				'name' => 'secondname',
				'source' => 'p',
				'pattern' => 'name',
				'obligatory' => 'true'
			],
			[
				'name' => 'position',
				'source' => 'p',
				'pattern' => 'name',
				'obligatory' => 'false'
			],
			[
				'name' => 'phone',
				'source' => 'p',
				'pattern' => 'phone',
				'obligatory' => 'true'
			],
			[
				'name' => 'email',
				'source' => 'p',
				'pattern' => 'email',
				'obligatory' => 'true'
			],
		]
	]
];