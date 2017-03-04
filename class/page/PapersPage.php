<?php
class PapersPage extends InternalPage {
	public function getId() {
		return 'papers';
	}
	
	public function getMenuTitle() {
		return 'Papers';
	}
	
	public function getContent() {
		$papers = Paper::getAllPapers();
		$table = "";
		$counter = 0;
		krsort($papers);// TODO Sort anti-chronologically, don't assume it is sorted chronologically.
		$pdfImage = 'https://upload.wikimedia.org/wikipedia/commons/2/22/Pdf_icon.png';
		$slidesImage = 'https://upload.wikimedia.org/wikipedia/commons/0/07/X-office-presentation.svg';
		foreach($papers as $paper) {
			$links = "";
			
			$links .= PapersPage::formatLink($paper->getURL(), 'url', 'https://upload.wikimedia.org/wikipedia/commons/9/93/Internet_link.png', 'Publication');
			
			if ($paper->getPDF() != null) {
				if (isset($_GET['redirect']) && $_GET['redirect'] == $paper->getID()) {
					$target = Url::getCurrentUrl();
					$target->removeQueryVar('redirect');
					
					$form = "";
					$form .= "<form name='autoRedirect' action='".$target."' method='post'>";
					$form .= "<input type='hidden' name='redirect' value='".$paper->getID()."'>";
					$form .= "</form>";
					$form .= "<script language='JavaScript'>";
					$form .= "document.autoRedirect.submit();";
					$form .= "</script>";
					
					$links .= $form;
				} else if (isset($_POST['redirect']) && $_POST['redirect'] == $paper->getID()) {
					$form = "";
					$form .= "<form name='autoRedirect' action='".$paper->getPDF()."' method='post'></form>";
					$form .= "<script language='JavaScript'>";
					$form .= "document.autoRedirect.submit();";
					$form .= "</script>";
					
					$links .= $form;
				} else {
					$pdfUrl = $paper->getPDF();
					if ($pdfUrl === Paper::TBA) {
						// no refinement required
					} else {
						$pdfUrl = Url::getCurrentUrl();
						$pdfUrl->setQueryVar('redirect', $paper->getID());
					}
					$links .= PapersPage::formatLink($pdfUrl, 'pdf', $pdfImage, 'PDF');
				}
			} else {
				// no PDF
			}
			
			if ($paper->getPDFSource() != null) {
				$links .= PapersPage::formatLink($paper->getPDFSource(), 'source', $pdfImage, 'Source');
			} else {
				// no source
			}
			
			if ($paper->getSlides() != null) {
				$links .= PapersPage::formatLink($paper->getSlides(), 'slides', $slidesImage, 'Slides');
			} else {
				// no slides
			}
			
			if ($paper->getSlidesSource() != null) {
				$links .= PapersPage::formatLink($paper->getSlidesSource(), 'source', $slidesImage, 'Source');
			} else {
				// no source
			}
			
			$counter++;
			$row = "<td class='counter'>[".$counter."]</td>";
			$row .= "<td>".$paper->getDescription()."<br/><span class='links'>".$links."</span></td>";
			
			$table .= "<tr>".$row."</tr>";
		}
		$table = "<table width='100%'>".$table."</table>";
		
		$external = "See also on:";
		$external .= "<a class='external' href='http://scholar.google.it/citations?user=qpUf7jQAAAAJ'>Google Scholar</a>";
		$external .= "<a class='external' href='http://dblp.uni-trier.de/pers/hd/v/Vergne:Matthieu'>DBLP</a>";
		
		$content = "";
		$content .= "<p>".$external."</p>";
		$content .= $table;
		
		/*
		$form = "";
		$form .= "<form name='autoRedirect' style='display:none;visibility:hidden' action='' method='post'>";
		if () {
		} else {
		}
		foreach ($_POST as $a => $b) {
			echo "<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>";
		}
		$form .= "</form>";
		$form .= "<script language="JavaScript">";
		$form .= "document.frm.submit();";
		$form .= "</script>";
		*/
		
		return $content;
	}
	
	static function formatLink($url, $class, $image, $title) {
		$img = "<img src='$image' alt='$title' title='$title'></img>";
		if ($url === Paper::TBA) {
			$title = "$title to be announced";
			$class .= " TBA";
			$url = "#";
		} else {
			// No change
		}
		return "<a class='$class' href='".$url."'>$img</a>";
	}
}
?>