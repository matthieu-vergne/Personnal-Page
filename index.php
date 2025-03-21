<?php
require_once('baseImport.php');

// Redirection to activate ACM Authorizer links
$url = Url::getCurrentUrl();
if ($url->get(URL_SERVER) == 'matthieu-vergne.fr') {
	$url->set(URL_SERVER, 'www.matthieu-vergne.fr');
	header("HTTP/1.1 301 Moved Permanently", false, 301);
	header('Location: '.$url->toString());
	exit();
}

// Redirection requests
$url = Url::getCurrentUrl();
if ($url->hasQueryVar('redirect')) {
	$id = $url->getQueryVar('redirect');
	if ($url->getQueryVar('page') == 'papers') {
		$paper = Paper::getPaper($id);
		$target = $paper->getPDF();
		if(stripos($target, "http://dl.acm.org/authorize?") === 0) {
			/*
			ACM Authorizer link. Let the inner implementation of the
			paper page manage this case to maintain the right referer.
			*/
		} else {
			// General case, supposed to work in a simpler way
			header('Location: '.$target);
			exit();
		}
	} else {
		throw new Exception("This URL is not valid.");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Matthieu Vergne's Homepage</title>
		
		<meta charset="utf-8">
		<meta name="description" content="Matthieu's personal page">
		<meta name="keywords" content="Matthieu Vergne, personal homepage">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		
		<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-okaidia.css" rel="stylesheet" />
		<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.css" rel="stylesheet" />
		<link href="style.css" rel="stylesheet" type="text/css" />
		
		<script type="text/x-mathjax-config">
			MathJax.Hub.Config({
				TeX: {
					extensions: ["color.js"],
					equationNumbers: { autoNumber: "AMS" },
				}
			});
		</script>
		<script language="JavaScript" type="text/javascript" async src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.1/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/components/prism-core.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/autoloader/prism-autoloader.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/keep-markup/prism-keep-markup.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/normalize-whitespace/prism-normalize-whitespace.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/plugins/line-numbers/prism-line-numbers.min.js"></script>
		<script language="JavaScript" type="text/javascript" src="scripts.js"></script>
		
		<?php
			if (TEST_MODE_ACTIVATED) {
				echo '<link href="debug-style.css" rel="stylesheet" type="text/css" />';
			} else {
				// do not use the debug style
			}
		?>
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
		<![endif]-->
	</head>
	<body>
		<?php
			if (TEST_MODE_ACTIVATED) {
				echo '<div id="test">';
				$url = Url::getCurrentUrl();
				$url->setQueryVar('noTest');
				echo '<a href="'.$url.'">Deactivate testing mode</a>';
				echo '</div>';
			} else {
				// do not display testing stuff
			}
		?>
		<header>
			<h1>Matthieu Vergne's Homepage</h1>
		</header>
		<nav>
			<?php
				$displayedPage = Page::getDisplayedPage();
				foreach(Page::getAvailablePages() as $page) {
					if ($page instanceOf ExternalPage) {
						$url = new Url($page->getUrl());
						echo '<a href="'.$url.'"><span style="background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAoAAAAKCAYAAACNMs+9AAAAVklEQVR4Xn3PgQkAMQhDUXfqTu7kTtkpd5RA8AInfArtQ2iRXFWT2QedAfttj2FsPIOE1eCOlEuoWWjgzYaB/IkeGOrxXhqB+uA9Bfcm0lAZuh+YIeAD+cAqSz4kCMUAAAAASUVORK5CYII=) center right no-repeat;padding-right: 13px;">'.$page->getMenuTitle().'</span></a>';
					} else {
						$url = Url::getCurrentUrl();
						$url->setQueryVar('page', $page->getId());
						$url->removeQueryVar('entry');
						echo '<a '.($displayedPage == $page ? 'class="selected"' : '').' href="'.$url.'">'.$page->getMenuTitle().'</a>';
					}
				}
			?>
		</nav>
		<?php
			$page = Page::getDisplayedPage();
			echo '<article id="'.$page->getId().'">';
			echo '<div id="lastUpdateTime">Last update: '.date ("d/m/Y H:i:s", $page->getLastUpdateTime()).'</div>';
			echo $page->getContent();
			echo '</article>';
		?>
		<footer><?php require_once("copyright.php"); ?></footer>
		<script language="JavaScript" type="text/javascript">
			<?php
				// TODO replace this a poteriori modification (Javascript) by an a priori one (generate correct title from the start).
				$data = array(
						'title' => Website::hasTitle() ? " -- ".Website::getTitle() : ""
				);
			?>
			var phpData = <?php echo json_encode($data) ?>;
			document.title = document.title + phpData.title;
		</script>
	</body>
</html>