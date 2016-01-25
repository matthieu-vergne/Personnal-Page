<?php
class PapersPage extends InternalPage {
	public function getId() {
		return 'papers';
	}
	
	public function getMenuTitle() {
		return 'Papers';
	}
	
	public function getContent() {
		$bib = array();
		$bib[] = array(
			'paper' => "I. Morales-Ramirez, M. Vergne, M. Morandini, L. Sabatucci, A. Perini, et A. Susi, « Revealing the obvious?: A retrospective artefact analysis for an ambient assisted-living project », in 2012 IEEE Second International Workshop on Empirical Requirements Engineering (EmpiRE), 2012, p. 41 ‑48.",
			'doi' => "10.1109/EmpiRE.2012.6347681",
		);
		$bib[] = array(
			'paper' => "I. Morales-Ramirez, M. Vergne, M. Morandini, L. Sabatucci, A. Perini, et A. Susi, « Where Did the Requirements Come from? A Retrospective Case Study », in Advances in Conceptual Modeling, S. Castano, P. Vassiliadis, L. V. Lakshmanan, et M. L. Lee, Éd. Springer Berlin Heidelberg, 2012, p. 185‑194.",
			'doi' => "10.1007/978-3-642-33999-8_23",
		);
		$bib[] = array(
			'paper' => "M. Vergne, I. Morales-Ramirez, M. Morandini, A. Susi, et A. Perini, « Analysing User Feedback and Finding Experts: Can Goal-Orientation Help? », in 6th International i* Workshop, Valencia, Spain, 2013, vol. 978, p. 49‑54.",
			'url' => "http://ceur-ws.org/Vol-978/paper_9.pdf",
			'pdf' => "http://ceur-ws.org/Vol-978/paper_9.pdf",
		);
		$bib[] = array(
			'paper' => "I. Morales-Ramirez, M. Vergne, M. Morandini, A. Siena, A. Perini, et A. Susi, « Who is the Expert? Combining Intention and Knowledge of Online Discussants in Collaborative RE Tasks », in Companion Proceedings of the 36th International Conference on Software Engineering, New York, NY, USA, 2014, p. 452–455.",
			'doi' => "10.1145/2591062.2591103",
			'pdf' => "http://dl.acm.org/authorize?N08506",
		);
		$bib[] = array(
			'paper' => "M. Vergne et A. Susi, « Expert Finding Using Markov Networks in Open Source Communities », in Advanced Information Systems Engineering, M. Jarke, J. Mylopoulos, C. Quix, C. Rolland, Y. Manolopoulos, H. Mouratidis, et J. Horkoff, Éd. Springer International Publishing, 2014, p. 196‑210.",
			'doi' => "10.1007/978-3-319-07881-6_14",
		);
		$bib[] = array(
			'paper' => "A. J. Nebro, J. J. Durillo, et M. Vergne, « Redesigning the jMetal Multi-Objective Optimization Framework », in Companion Publication of the 2015 Annual Conference on Genetic and Evolutionary Computation, 2015, p. 1093‑1100.",
			'doi' => "10.1145/2739482.2768462",
			'pdf' => "http://dl.acm.org/authorize?N08507",
		);
		$bib[] = array(
			'paper' => "M. Vergne et A. Susi, « Breaking the Recursivity: Towards a Model to Analyse Expert Finders », in Conceptual Modeling, vol. 9381, P. Johannesson, M. L. Lee, S. W. Liddle, A. L. Opdahl, et Ó. P. López, Éd. Cham: Springer International Publishing, 2015, p. 539‑547.",
			'doi' => "10.1007/978-3-319-25264-3_40",
		);
		
		$content = "";
		$counter = 0;
		krsort($bib);
		foreach($bib as $entry) {
			$links = "";
			if (isset($entry['doi'])) {
				$url = "http://dx.doi.org/".$entry['doi'];
			} else if (isset($entry['url'])) {
				$url = $entry['url'];
			} else {
				throw new Exception("No URL set for entry ".print_r($entry, true));
			}
			$links .= "<a class='url' href='".$url."'><img src='https://upload.wikimedia.org/wikipedia/commons/9/93/Internet_link.png'></img></a>";
			
			if (isset($entry['pdf'])) {
				$links .= "<a class='pdf' href='".$entry['pdf']."'><img src='https://upload.wikimedia.org/wikipedia/commons/2/22/Pdf_icon.png'></img></a>";
			} else {
				// no PDF
			}
			
			$counter++;
			$row = "<td class='counter'>[".$counter."]</td>";
			$row .= "<td>".$entry['paper']."<br/><span class='links'>".$links."</span></td>";
			
			$content .= "<tr>".$row."</tr>";
		}
		
		return "<table width='100%'>".$content."</table>";
	}
}
?>