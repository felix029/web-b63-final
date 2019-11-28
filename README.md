# DKoncept
## Projet final - B63

Félix-Olivier Landry

## Mise en place

Site web de gestion d'un faux restaurant codé en PHP et avec une BD MySql.

Avant toute chose, executer le script `Structure.sql` pour créer les tables de la BD. créer l'utilisateur administrateur par défaut (détails plus bas). Les mots de passes des utilisateurs seront stockés dans la BD sous forme de hash bcrypt (12 rounds).

## Administration

Pour accéder à la console d'administration, appuyez, à partir de n'importe quelle page du site, sur `ALT + 1`. *(seulement accessible via un ordinateur)*

### Connexion


<table>
    <tr>
        <th colspan="2">Utilisateur par défaut</th>
    </tr>
        <td><b>Nom d'utilisateur</b></td>
        <td>dkadmin</td>
    <tr>
    </tr>
    <tr>
        <td><b>Mot de passe</b></td>
        <td>dkdefaultpwd</td>
    </tr>
</table>

La connexion avec un compte administrateur vous permettra de modifier le contenu de certaines pages du site avec l'éditeur de texte *Quill*.
L'utilisateur connecté pourra aussi gérer la page "L'équipe" en y ajoutant, modifiant ou supprimant des membres. 
Il pourra aussi modifier l'ordre dans lequel apparaissent les fiches d'employés.

Vous pourrez aussi ajouter et supprimer d'autres utilisateurs à partir de ce compte si vous avez les droits d'administrateur.

Chaque utilisateur aura aussi la possibilité de modifier son mot de passe.

## Sources

[**Quill**](https://github.com/quilljs/quill)
