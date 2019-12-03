INSERT INTO
    offers(id_job, salary, job_desc)
VALUES
    ((SELECT id FROM jobs WHERE title = 'Gérant(e)'), '23,15$', "Nous cherchons quelqu'un de dynamique et leader pour gérer notre équipe de service. Temps plein (40h/semaine)."),
    ((SELECT id FROM jobs WHERE title = 'Serveur/Serveuse'), '16,50$', "Si vous aimez intéragir avec le public et leur piquer une jasette, cet emploi est fait pour vous! Temps partiel (environs 25h/semaine).");