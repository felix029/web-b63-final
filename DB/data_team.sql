INSERT INTO
	team(fullname, id_job, bio, image_url)
VALUES
	(	
		'Félix-Olivier Landry', 
		(SELECT id FROM jobs WHERE title = 'Propriétaire'), 
		"J'ai toujours été passioné par la bouffe, sans elle, je ne serais probablement pas ici aujourd'hui pour vous écrire ce message... 
		C'est pourquoi j'ai décidé de me lancer dans la restauration, pour vous donner vous aussi la chance de survivre au quotidient en vous donnant accès à une alimentation de grade A. En esperant que mes recettes du terroir
		de la Côte-Nord vous fournirons les nutriments nécéssaires à la bonne continuitée de votre vie!",
		"images/equipe/felixo.jpg"
	),
	(
		'Bryan Brisk',
		(SELECT id FROM jobs WHERE title = 'Chef'),
		"Un esprit sain dans un corp sain, je vis selon ce dicton tout les jours de ma vie. Venez manger ma belle viande pas trop dure pas trop molle, un délice en bouche!",
		"images/equipe/bryan.jpg"
	),
	(
		'Sebastien Astronaute',
		(SELECT id FROM jobs WHERE title = 'Commis'),
		"Je sais pas trop pourquoi je travail ici, j'étais dans la rue pi c'est la première affaire que j'ai trouvé. Si j'vous feel je cracherais pas dans votre plat, promis juré! Sinon bien la job ici paye pas vraiment,
		salaire minimum pis aucun avantage, le boss c'est un méchant crosseur mais bon, au moins j'ai plus à dormir au parc Émilie-Gamelin avec les autres pauvres pétés sur la peanut!",
		"images/equipe/seb.jpg"
	),
	(
		'Alex Chiasse',
		(SELECT id FROM jobs WHERE title = 'Gérant(e)'),
		"Strappez moi la strap! Manger c'est plaisant.",
		"images/equipe/alex.jpg"
	);
	