<?php
class PapersPage extends InternalPage {
	public function getId() {
		return 'papers';
	}
	
	public function getMenuTitle() {
		return 'Papers';
	}
	
	public function getContent() {
		$bib = Paper::getAllPapers();
		$table = "";
		$counter = 0;
		krsort($bib);// TODO Sort anti-chronologically, don't assume it is sorted chronologically.
		foreach($bib as $entry) {
			$links = "";
			
			$links .= "<a class='url' href='".$entry->getURL()."'><img src='https://upload.wikimedia.org/wikipedia/commons/9/93/Internet_link.png'></img></a>";
			
			if ($entry->getPDF() != null) {
				$links .= "<a class='pdf' href='".$entry->getPDF()."'><img src='https://upload.wikimedia.org/wikipedia/commons/2/22/Pdf_icon.png'></img></a>";
			} else {
				// no PDF
			}
			
			$permalink = Url::getCurrentUrl();
			$permalink->setQueryVars(array());
			$permalink->setQueryVar('accessPaperPDF', $entry->getID());
			$links .= "<a class='url' href='".$permalink."' style='float:right'>[PDF Permalink]</a>";
			
			$counter++;
			$row = "<td class='counter'>[".$counter."]</td>";
			$row .= "<td>".$entry->getDescription()."<br/><span class='links'>".$links."</span></td>";
			
			$table .= "<tr>".$row."</tr>";
		}
		$table = "<table width='100%'>".$table."</table>";
		
		$external = "See also on:";
		$external .= "<a class='external' href='http://scholar.google.it/citations?user=qpUf7jQAAAAJ'>Google Scholar</a>";
		$external .= "<a class='external' href='http://dblp.uni-trier.de/pers/hd/v/Vergne:Matthieu'>DBLP</a>";
		
		$content = "";
		$content .= "<p>".$external."</p>";
		$content .= $table;
		
		return $content;
	}
}
?>