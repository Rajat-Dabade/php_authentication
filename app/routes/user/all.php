<?php

$app->get('/users', function() use($app){

	$user = $app->user->where('active', true)->get();
	$app->render('user/all.php',[
			'users' => $user
		]);

})->name('user.all');