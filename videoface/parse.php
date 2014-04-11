<?php


function getSampleData()
{

	return array(
		array (
				'start' => 2, 
				'end' => 5, 
				'name' => 'Gérald Darmanin', 
				'bio_link' => 'http://fr.wikipedia.org/wiki/G%C3%A9rald_Darmanin', 
				'title' => 'Député', 
				'organisation' => 'UMP',
				'organisation_link' => 'http://fr.wikipedia.org/wiki/Union_pour_un_mouvement_populaire'
				),
		array(
				'start' => 10, 
				'end' => 17, 
				'name' => 'Jean-LUC MOUDNEC', 
				'bio_link' => 'https://www.facebook.com/jlmoudenc', 
				'title' => 'Député de Moselle', 
				'organisation' => 'UMP',
				'organisation_link' => 'http://fr.wikipedia.org/wiki/Union_pour_un_mouvement_populaire'
			),
			
		array(
				'start' => 20, 
				'end' => 25, 
				'name' => 'Manuel Carlos Valls Galfetti', 
				'bio_link' => 'http://en.wikipedia.org/wiki/Manuel_Valls', 
				'title' => 'Premier ministre français', 
				'organisation' => 'PS',
				'organisation_link' => 'http://fr.wikipedia.org/wiki/Parti_socialiste'
				),
	);
}


function generatePersonsCues() 
{
	$persons = getSampleData();
	$rdf_person = 'http://data-vocabulary.org/Person';

	$html = '<ul id="cues">';
	foreach ($persons as $person)
	{
		$html.= sprintf('<li id="person_%s"></li>', $person['start']); 
	}
	$html.= '</ul>';

	foreach ($persons as $person) {
		$html.= sprintf('<aside id="person_%s" class="person" data-active-during="%s-%s" itemscope itemtype="%s">', $person['start'], $person['start'], $person['end'], $rdf_person);
		
		$html.= '<section class="title">';
		$html.= sprintf('<h1>%s</h1>', $person['name']);
		$html.= '<dl>';
		$html.= sprintf('<a target="_blank" href="%s" target="_blank" title="%s">', $person['bio_link'], $person['name']);
		$html.= '<dt>Name:</dt>';
		$html.= sprintf('<dd itemprop="name">%s</dd>', $person['name']);
		$html.= '</a>';
		
		$html.='<dt>Role:</dt>';
		$html.= sprintf('<dd itemprop="title">%s</dd>', $person['title']);	
		$html.= '<dt>Organization</dt>';
		$html.= '<dd class="organization">';
		$html.= sprintf('<a target="_blank" href="%s target="blank"><span itemprop="affiliation">%s</span></a>', $person['organisation'], $person['organisation_link']);
		$html.= '</dd>';

		$html.= '</dl>';
		$html.= '</section><!-- end section.title -->';
		
		
		$html.= sprintf('<section class="links" data-active-during="%s-%s">', $person['start'], $person['end']);
		$html.= '<h1>Links</h1>';
		$html.= '<ul>';
		$html.= '<li><a href="#"><img src="http://www.thebandbdirectory.co.uk/images/twitter.png" /></a>@Suivez le sur twitter</li>';
		$html.= '<li><a href="#"><img src="http://j.static-locatetv.com/static/images/facebook/facebook_mini_icon.png" /></a>Aimez le sur facebook</li>';
		$html.= '<li><a href="#"><img src="http://www.frameshow.com/ecard_application/pics/webservices/icon-dailymotion.png" /></a>Regardez ces autres videos</li>';
		$html.= '</ul>';
		$html.= '</section><!-- end section.links -->';

		$html.= '</aside>';
	}

	return $html;

}