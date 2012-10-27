<img id="photo" src="content/home/photo.jpg" alt="Photo"/>
<?php
$data = array(
	'Surname' => 'Matthieu',
	'Family name' => 'Vergne',
	'Nationality' => 'French',
	'E-mail' => Format::toHtmlEmail('matthieu.vergne@gmail.com'),
	'Google+' => Format::toHtmlUrl('https://plus.google.com/113987650579242368833'),
	'GitHub' => Format::toHtmlUrl('https://github.com/matthieu-vergne'),
	'Interests' => 'programming, optimization, AI, mathematics, japanimation',
	'Skills' => 'Object Oriented programming, optimization techniques, project management',
	'Current work' => 'PhD. student in Requirements Engineering, Fondazione Bruno Kessler (Trento, Italy)',
);
foreach($data as $type => $value) {
	echo "<b>$type:</b> $value<br/>";
}
?>