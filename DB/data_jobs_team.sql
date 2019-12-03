-- INSERTING JOB TITLES ***************************************
INSERT INTO 
	jobs(title)
VALUES
	('Propriétaire'),
	('Gestionnaire'),
	('Gérant(e)'),
	('Chef'),
	('Sous-chef'),
	('Aboyeur'),
	('Commis'),
	('Aide cuisinier'),
	('Serveur/Serveuse'),
	('Réceptionniste');

-- INSERTING TEAM MEMBERS *************************************
INSERT INTO
	team(fullname, id_job, bio, image_url, pos)
VALUES
	(	
		'Félix-Olivier Landry', 
		(SELECT id FROM jobs WHERE title = 'Propriétaire'), 
		"J'ai toujours été passioné par la bouffe, sans elle, je ne serais probablement pas ici aujourd'hui pour vous écrire ce message... 
		C'est pourquoi j'ai décidé de me lancer dans la restauration, pour vous donner vous aussi la chance de survivre au quotidient en vous donnant accès à une alimentation de grade A. En esperant que mes recettes du terroir
		de la Côte-Nord vous fournirons les nutriments nécéssaires à la bonne continuitée de votre vie!",
		"img/equipe/felixo.jpg",
		1
	),
	(
		'Bryan Brisk',
		(SELECT id FROM jobs WHERE title = 'Chef'),
		"Un esprit sain dans un corp sain, je vis selon ce dicton tout les jours de ma vie. Venez manger ma belle viande pas trop dure pas trop molle, un délice en bouche!",
		"img/equipe/bryan.jpg",
		2
	),
	(
		'Sebastien Astronaute',
		(SELECT id FROM jobs WHERE title = 'Commis'),
		"Je sais pas trop pourquoi je travail ici, j'étais dans la rue pi c'est la première affaire que j'ai trouvé. Si j'vous feel je cracherais pas dans votre plat, promis juré! Sinon bien la job ici paye pas vraiment,
		salaire minimum pis aucun avantage, le boss c'est un méchant sauté mais bon, au moins maintenant j'peux m'payer des des trios Mozza rondelle au lieu d'un seul Buddy Burger.
		!",
		"img/equipe/seb.jpg",
		3
	);

-- INSERTING JOB OFFERS ***************************************
INSERT INTO
    offers(id_job, salary, job_desc)
VALUES
    ((SELECT id FROM jobs WHERE title = 'Gérant(e)'), '23,15$', "Nous cherchons quelqu'un de dynamique et leader pour gérer notre équipe de service. Temps plein (40h/semaine)."),
    ((SELECT id FROM jobs WHERE title = 'Serveur/Serveuse'), '16,50$', "Si vous aimez intéragir avec le public et leur piquer une jasette, cet emploi est fait pour vous! Temps partiel (environs 25h/semaine).");
	