<?php
define('TEST_MODE_ACTIVATED', !isset($_GET['noTest']) && in_array($_SERVER["SERVER_NAME"], array(
				'127.0.0.1',
				'localhost',
				'to-do-list.me',
				'sazaju.dyndns-home.com'
		), true));

/**********************************\
           ERROR MANAGING
\**********************************/

function error_handler($code, $message, $file, $line)
{
    if (0 == error_reporting())
    {
        return;
    }
    throw new ErrorException($message, 0, $code, $file, $line);
}

function exception_handler($exception) {
	if (!TEST_MODE_ACTIVATED) {
		// TODO
		$administrators = "sazaju@gmail.com";
		$subject = "ERROR";
		$message = "aze";//$exception->getMessage();
		$header = "From: noreply@zerofansub.net\r\n";
		$sent = false;//mail($administrators, $subject, $message, $header);
		echo "Une erreur est survenue, ".(
			$sent ? "les administrateurs en ont été notifiés"
				  : "contactez les administrateurs : ".$administrators
			).".";
	}
	else {
		echo "Une erreur est survenue : ".$exception;
		if (defined('TESTING_FEATURE')) {
			echo "<br/><br/>".TESTING_FEATURE;
		}
		phpinfo();
	}
}

set_error_handler("error_handler");
set_exception_handler('exception_handler');

if (TEST_MODE_ACTIVATED) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
}

/**********************************\
              IMPORTS
\**********************************/

function findFile($fileName, $dir) {
	$expected = strtolower($dir.'/'.$fileName);
	foreach(glob($dir . '/*') as $file) {
		if (strtolower($file) == $expected) {
			return $file;
		}
		else if (is_dir($file)) {
			$file = findFile($fileName, $file);
			if ($file != null) {
				return $file;
			}
		}
	}
	return null;
}

spl_autoload_register(function($className) {
	$file = findFile($className.'.php', 'class');
	if ($file != null) {
		$chunks = explode("/", $file);
		if (TEST_MODE_ACTIVATED && in_array("old", $chunks)) {
			echo Debug::createWarningTag("Old script used: $file");
		}
		include $file;
	} else {
		throw new Exception($className." not found");
	}
});

/**********************************\
         STRANGE URL CHECK
\**********************************/

$url = Url::getCurrentUrl();
if ($url->isStrangeUrl()) {
	$currentAddress = $url->toFullString();
	$url->cleanStrangeParts();
	$cleanAddress = $url->toFullString();
	if (TEST_MODE_ACTIVATED) {
		throw new Exception ("Strange url (".$currentAddress."), maybe expected this one : ".$cleanAddress."? In not testing mode, redirection will be done.");
	} else if ($url->isStrangeUrl()) {
		header('Location: '.$_SERVER['SCRIPT_NAME']);
		exit();
	} else {
		header('Location: '.$cleanAddress);
		exit();
	}
}
?>
