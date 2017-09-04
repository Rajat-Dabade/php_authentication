<?php

use Slim\Slim;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

use Noodlehaus\Config;
use RandomLib\Factory as RandowLib;

use Codecourse\User\User;
use Codecourse\Mail\Mailer;
use Codecourse\Helpers\Hash;
use Codecourse\Validation\Validator;
use Codecourse\Middleware\BeforeMiddleware;
use Codecourse\Middleware\CsrfMiddleware;



session_cache_limiter(false);
session_start();

ini_set('display_error', 'On');

define('INC_ROOT', dirname(__DIR__));

require INC_ROOT . '/vendor/autoload.php';

$app = new Slim([
		'mode' => file_get_contents(INC_ROOT. '/mode.php'),
		'view' => new Twig(),
		'templates.path' => INC_ROOT. '/app/views'
	]);

$app->add(new BeforeMiddleware);
$app->add(new CsrfMiddleware);


$app->configureMode($app->mode, function() use($app) {
	$app->config = Config::load(INC_ROOT . "/app/config/{$app->mode}.php");
});

require 'database.php';
require 'filters.php';
require 'routes.php';

$app->auth = false;

$app->container->set('user', function(){
	return new User;
});

$app->container->singleton('hash', function() use($app){
	return new Hash($app->config);
});

$app->container->singleton('validation', function() use($app){
	return new Validator($app->user, $app->hash, $app->auth);
});

$app->container->singleton('mail', function() use($app){
	$mailer = new PHPMailer;

	$mailer->Host = $app->config->get('mail.host');
	$mailer->SMTPAuth = $app->config->get('mail.smtp_auth');
	$mailer->SMTPSucure = $app->config->get('mail.smtp_secure');
	$mailer->Port = $app->config->get('mail.port');
	$mailer->Username = $app->config->get('mail.username');
	$mailer->Password = $app->config->get('mail.password');

	$mailer->isHTML($app->config->get('mail.html'));

	return new Mailer($app->view , $mailer);
});

$app->container->singleton('randomlib', function(){
	$factory = new RandowLib;
	return $factory->getMediumStrengthGenerator();
});

$view = $app->view();

$view->parserOption = [
	'debug' => $app->config->get('twig.debug')
];

$view->parserExtensions = [
	new TwigExtension
];



