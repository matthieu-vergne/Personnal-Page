<?php
class Paper {
	const TBA = "To be announced";
	private $id = null;
	private $description = null;
	private $doi = null;
	private $url = null;
	private $pdf = null;
	private $pdfSource = null;
	private $slides = null;
	private $slidesSource = null;
	private $datasets = array();
	
	public function __construct($id) {
		if (empty($id)) {
			throw new Exception("No ID provided.");
		} else {
			$this->id = $id;
		}
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDOI($doi) {
		$this->doi = $doi;
	}
	
	public function getDOI() {
		return $this->doi;
	}
	
	public function setURL($url) {
		$this->url = $url;
	}
	
	public function getURL() {
		if($this->url != null) {
			return $this->url;
		} else if($this->doi != null) {
			return "http://dx.doi.org/".$this->doi;
		} else {
			return null;
		}
	}
	
	public function setPDF($pdf) {
		$this->pdf = $pdf;
	}
	
	public function getPDF() {
		return $this->pdf;
	}
	
	public function setPDFSource($source) {
		$this->pdfSource = $source;
	}
	
	public function getPDFSource() {
		return $this->pdfSource;
	}
	
	public function setSlides($slides) {
		$this->slides = $slides;
	}
	
	public function getSlides() {
		return $this->slides;
	}
	
	public function setSlidesSource($source) {
		$this->slidesSource = $source;
	}
	
	public function getSlidesSource() {
		return $this->slidesSource;
	}
	
	public function addDataset($dataset) {
		return $this->datasets[] = $dataset;
	}
	
	public function getDatasets() {
		return $this->datasets;
	}
	
	private static $allPapers = null;
	public static function getAllPapers() {
		if (Paper::$allPapers === null) {
			Paper::$allPapers = array();
			
			$paper = new Paper('EmpiRE-2012');
			$paper->setDescription("I. Morales-Ramirez, M. Vergne, M. Morandini, L. Sabatucci, A. Perini, and A. Susi, « Revealing the obvious?: A retrospective artefact analysis for an ambient assisted-living project », article in 2012 IEEE Second International Workshop on Empirical Requirements Engineering (EmpiRE), 2012, p. 41 ‑48.");
			$paper->setDOI("10.1109/EmpiRE.2012.6347681");
			$paper->setPDF(Resource::getResource(1)->getFileUrl());
			$paper->setSlides(Resource::getResource(6)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('RIGiM-2012');
			$paper->setDescription("I. Morales-Ramirez, M. Vergne, M. Morandini, L. Sabatucci, A. Perini, and A. Susi, « Where Did the Requirements Come from? A Retrospective Case Study », article in Advances in Conceptual Modeling, S. Castano, P. Vassiliadis, L. V. Lakshmanan, and M. L. Lee, Ed. Springer Berlin Heidelberg, 2012, p. 185‑194.");
			$paper->setDOI("10.1007/978-3-642-33999-8_23");
			$paper->setPDF(Resource::getResource(2)->getFileUrl());
			$paper->setSlides(Resource::getResource(7)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('iStar-2013');
			$paper->setDescription("M. Vergne, I. Morales-Ramirez, M. Morandini, A. Susi, and A. Perini, « Analysing User Feedback and Finding Experts: Can Goal-Orientation Help? », article in 6th International i* Workshop, Valencia, Spain, 2013, vol. 978, p. 49‑54.");
			$paper->setURL("http://ceur-ws.org/Vol-978/paper_9.pdf");
			$paper->setPDF("http://ceur-ws.org/Vol-978/paper_9.pdf");
			$paper->setSlides(Resource::getResource(8)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('ICSE-2014');
			$paper->setDescription("I. Morales-Ramirez, M. Vergne, M. Morandini, A. Siena, A. Perini, and A. Susi, « Who is the Expert? Combining Intention and Knowledge of Online Discussants in Collaborative RE Tasks », article in Companion Proceedings of the 36th International Conference on Software Engineering, New York, NY, USA, 2014, p. 452–455.");
			$paper->setDOI("10.1145/2591062.2591103");
			$paper->setPDF("http://dl.acm.org/authorize?N08506");
			$paper->setSlides(Resource::getResource(9)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('CAISE-2014');
			$paper->setDescription("M. Vergne and A. Susi, « Expert Finding Using Markov Networks in Open Source Communities », article in Advanced Information Systems Engineering, M. Jarke, J. Mylopoulos, C. Quix, C. Rolland, Y. Manolopoulos, H. Mouratidis, and J. Horkoff, Ed. Springer International Publishing, 2014, p. 196‑210.");
			$paper->setDOI("10.1007/978-3-319-07881-6_14");
			$paper->setPDF(Resource::getResource(3)->getFileUrl());
			$paper->setPDFSource(Resource::getResource(19)->getFileUrl());
			$paper->setSlides(Resource::getResource(10)->getFileUrl());
			$paper->setSlidesSource(Resource::getResource(20)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('EvoSoft-2014');
			$paper->setDescription("A. J. Nebro, J. J. Durillo, and M. Vergne, « Redesigning the jMetal Multi-Objective Optimization Framework », article in Companion Publication of the 2015 Annual Conference on Genetic and Evolutionary Computation, 2015, p. 1093‑1100.");
			$paper->setDOI("10.1145/2739482.2768462");
			$paper->setPDF("http://dl.acm.org/authorize?N08507");
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('ER-2015');
			$paper->setDescription("M. Vergne and A. Susi, « Breaking the Recursivity: Towards a Model to Analyse Expert Finders », article in Conceptual Modeling, vol. 9381, P. Johannesson, M. L. Lee, S. W. Liddle, A. L. Opdahl, and Ó. P. López, Ed. Cham: Springer International Publishing, 2015, p. 539‑547.");
			$paper->setDOI("10.1007/978-3-319-25264-3_40");
			$paper->setPDF(Resource::getResource(4)->getFileUrl());
			$paper->setPDFSource(Resource::getResource(21)->getFileUrl());
			$paper->setSlides(Resource::getResource(11)->getFileUrl());
			$paper->setSlidesSource(Resource::getResource(22)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('arXiv-2016a');
			$paper->setDescription("M. Vergne, « Gold Standard for Expert Ranking: A Survey on the XWiki Dataset », technical report in arXiv.org, 2016.");
			$paper->setURL("https://arxiv.org/abs/1603.03809");
			$paper->setPDF("https://arxiv.org/pdf/1603.03809");
			$paper->setPDFSource(Resource::getResource(23)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('arXiv-2016b');
			$paper->setDescription("M. Vergne, « Mitigation Procedures to Rank Experts through Information Retrieval Measures », technical report in arXiv.org, 2016.");
			$paper->setURL("https://arxiv.org/abs/1603.04953");
			$paper->setPDF("https://arxiv.org/pdf/1603.04953");
			$paper->setPDFSource(Resource::getResource(24)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('thesis-2016');
			$paper->setDescription("M. Vergne, « Expert Finding for Requirements Engineering », Ph.D. thesis in University of Trento, 2016.");
			$paper->setURL("http://eprints-phd.biblio.unitn.it/1703/");
			$paper->setPDF(Resource::getResource(5)->getFileUrl());
			$paper->setPDFSource(Resource::getResource(25)->getFileUrl());
			$paper->setSlides(Resource::getResource(12)->getFileUrl());
			$paper->setSlidesSource(Resource::getResource(26)->getFileUrl());
			$paper->addDataset("http://selab.fbk.eu/vergne/Thesis-2016/");
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('hmcl-2017');
			$paper->setDescription("M. Vergne, « Artificial Intelligence and Expertise: the Two Faces of the Same Artificial Performance Coin », technical report in Workshops at the Thirty-First AAAI Conference on Artificial Intelligence, 2017.");
			$paper->setURL("http://www.aaai.org/ocs/index.php/WS/AAAIW17/paper/view/15148");// TODO replace ?
			$paper->setPDF(Resource::getResource(16)->getFileUrl());
			$paper->setPDFSource(Resource::getResource(27)->getFileUrl());
			$paper->setSlides(Resource::getResource(17)->getFileUrl());
			$paper->setSlidesSource(Resource::getResource(28)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			$paper = new Paper('re4ai-2020');
			$paper->setDescription("M. Vergne, « Trustworthy AI: Towards the Golden Age of RE? », article in RE4AI Workshop at the 26th International Conference on Requirements Engineering: Foundation for Software Quality (REFSQ), 2020.");
			$paper->setURL("http://ceur-ws.org/Vol-2584/RE4AI-paper5.pdf");
			$paper->setPDF("http://ceur-ws.org/Vol-2584/RE4AI-paper5.pdf");
			$paper->setPDFSource(Resource::getResource(29)->getFileUrl());
			$paper->setSlides(Resource::getResource(30)->getFileUrl());
			$paper->setSlidesSource(Resource::getResource(31)->getFileUrl());
			Paper::$allPapers[] = $paper;
			
			// Check unique IDs
			$ids = array();
			foreach(Paper::$allPapers as $paper) {
				$id = $paper->getID();
				if (isset($ids[$id])) {
					throw new Exception($id." used more than once.");
				} else {
					$ids[$id] = $paper;
				}
			}
			
			// Check provide descriptions
			foreach(Paper::$allPapers as $paper) {
				if (empty($paper->getDescription())) {
					throw new Exception("No description provided for paper ".$paper->getID());
				} else {
					// OK
				}
			}
			
			// Check provide URL
			foreach(Paper::$allPapers as $paper) {
				if (empty($paper->getURL())) {
					throw new Exception("No URL provided for paper ".$paper->getID());
				} else {
					// OK
				}
			}
		}
		return Paper::$allPapers;
	}
	
	public static function getPaper($id) {
		foreach(Paper::getAllPapers() as $paper) {
			if ($paper->getID() === $id) {
				return $paper;
			} else {
				// Not found yet
			}
		}
		throw new Exception($id." is not a known paper ID.");
	}
}
?>