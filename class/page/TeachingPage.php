<?php
class TeachingPage extends InternalPage {
	public function getId() {
		return 'teaching';
	}
	
	public function getMenuTitle() {
		return 'Teaching';
	}
	
	public function getContent() {
		$content = "";
		
		$content .= "<p>You will find here the resources I produced for the courses I participated as an assistant lecturer. Feel free to contact me for any inquiry.</p>";
		
		$content .= "<table width='100%'>";
		
		$content .= "<tr>";
		$content .= "<th>Date</th>";
		$content .= "<th>Location</th>";
		$content .= "<th>Course</th>";
		$content .= "<th>Resource</th>";
		$content .= "</tr>";
		
		$slidesUrl = Resource::getResource(18)->getFileUrl();
		$content .= "<tr>";
		$content .= "<td><time datetime='2017-03-01'>2017-03-01</time></td>";
		$content .= "<td><abbr title='Nara Institute of Science and Technology'>NAIST</abbr>, Japan</td>";
		$content .= "<td>Advanced Software Engineering<br/>(by Pr. Kenichi Matsumoto)</td>";
		$content .= "<td><a href='$slidesUrl'>Introduction to Requirements Engineering</a></td>";
		$content .= "</tr>";
		
		$slidesUrl = Resource::getResource(13)->getFileUrl();
		$content .= "<tr>";
		$content .= "<td><time datetime='2015-03-24'>2015-03-24</time></td>";
		$content .= "<td>University of Trento, Italy</td>";
		$content .= "<td>Requirements Engineering<br/>(by Anna Perini)</td>";
		$content .= "<td><a href='$slidesUrl'>IBM® Rational® DOORS®</a></td>";
		$content .= "</tr>";
		
		$slidesUrl = Resource::getResource(14)->getFileUrl();
		$content .= "<tr>";
		$content .= "<td><time datetime='2014-05-22'>2014-05-22</time></td>";
		$content .= "<td>University of Trento, Italy</td>";
		$content .= "<td>Requirements Engineering<br/>(by Anna Perini)</td>";
		$content .= "<td><a href='$slidesUrl'>Stakeholders Prioritization</a></td>";
		$content .= "</tr>";
		
		$content .= "</table>";
		
		return $content;
	}
}
?>