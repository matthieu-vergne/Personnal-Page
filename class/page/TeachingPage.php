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
		
		$slidesUrl = Resource::getResource(13)->getFileUrl();
		$content .= "<tr>";
		$content .= "<td><time datetime='2015-03-24'>2015-03-24</time></td>";
		$content .= "<td>University of Trento</td>";
		$content .= "<td><a href='http://ict.unitn.it/program/exams/courses/30023-requirements-engineering'>Requirements Engineering</a><br\>(by Anna Perini)</td>";
		$content .= "<td><a href='$slidesUrl'>IBM® Rational® DOORS®</a></td>";
		$content .= "</tr>";
		
		$slidesUrl = Resource::getResource(14)->getFileUrl();
		$content .= "<tr>";
		$content .= "<td><time datetime='2014-05-22'>2014-05-22</time></td>";
		$content .= "<td>University of Trento</td>";
		$content .= "<td><a href='http://ict.unitn.it/program/exams/courses/29022-requirements-engineering'>Requirements Engineering</a><br\>(by Anna Perini)</td>";
		$content .= "<td><a href='$slidesUrl'>Stakeholders Prioritization</a></td>";
		$content .= "</tr>";
		
		$content .= "</table>";
		
		return $content;
	}
}
?>