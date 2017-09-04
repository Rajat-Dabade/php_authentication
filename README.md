<h1>PHP_authentication</h1>
This is the well secure project for authentication writen in php with SQL at backend.This project is fully based on the various framework (i.e Slim framework,illuminate/database framework).


First of all what you want to do is go to the php_authentication folder and open cmd and fire the command:<h5> php composer.phar update</h5>
make sure that you have set the evnironment variables for php

After completing this stuff the<pre>"verdor"</pre> folder will appear which will carry all the dependencies of the project.

Then go to :<pre>verdor/slim</pre> folder and search for the file <h6>".htaccess"</h6> and copy that file and paste it into the <pre>"public"</pre> folder.

Go to :<pre>php_authentication/app/config/</pre> folder and check the appropiate development and production file and configure it according to your configuration(The mode of the file is been decided in the <pre>php_authentication/mode.php file)</p>


<h3>Then the database part:</h3>

Fire the query into the database to create the users and users_permission table into the database :

<pre>CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(256) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `active_hash` varchar(255) DEFAULT NULL,
  `recover_hash` varchar(255) DEFAULT NULL,
  `remember_identifier` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
</pre>
