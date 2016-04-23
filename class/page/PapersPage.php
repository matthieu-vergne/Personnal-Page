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
		foreach($papers as $paper) {
			$links = "";
			
			$links .= "<a class='url' href='".$paper->getURL()."'><img src='https://upload.wikimedia.org/wikipedia/commons/9/93/Internet_link.png'></img></a>";
			
			if ($paper->getPDF() != null) {
				$links .= "<a class='pdf' href='".$paper->getPDF()."'><img src='https://upload.wikimedia.org/wikipedia/commons/2/22/Pdf_icon.png'></img></a>";
				
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
					$form .= "<form name='autoRedirect' action='".$paper->getPDF()."' method='get'></form>";
					$form .= "<script language='JavaScript'>";
					$form .= "document.autoRedirect.submit();";
					$form .= "</script>";
					
					$links .= $form;
				} else {
					$permalink = Url::getCurrentUrl();
					$permalink->setQueryVar('redirect', $paper->getID());
					$links .= "<a class='url' href='".$permalink."' style='float:right'>[PDF Permalink]</a>";
				}
			} else {
				// no PDF
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
}
?>