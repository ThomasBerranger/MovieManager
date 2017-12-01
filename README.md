MovieManager
========================

### But ?

Réaliser un "gros" projet sous Symfony3 afin de maitriser les fonctionnalités du framework. Customizer le rendu via un framework design performant. Ce site est inspiré de nombreux autre site déjà existants mais diffère sur quelques points le but n'étant pas de réaliser une application web totalement crédible mais plutôt, de réaliser de nombreuses fonctionnalités.

### Outils

- Symfony 3
- Doctrine 2
- MySQL
- Materialize : http://materializecss.com/
- Icons : https://www.flaticon.com/packs/kids-avatars
- Source d'information : http://www.allocine.fr/

![home1](https://user-images.githubusercontent.com/15357887/33442415-6a16d752-d5f5-11e7-85be-7e290b9d8c88.PNG)

## Profil utilisateur

Tout commence par une inscription au site, la sécurité a été monté via la documentation officielle de Symfony : https://symfony.com/doc/current/security.html


![register](https://user-images.githubusercontent.com/15357887/33441116-2cb647d8-d5f2-11e7-8a87-c78dbd35958d.PNG)

Puis l'utilisateur doit se connecter avec son username ou bien son email. Une checkbox permet de garde la session active 24h (modifiable) après connexion.

![login](https://user-images.githubusercontent.com/15357887/33441110-27abe23e-d5f2-11e7-8473-766b4ffc76c3.PNG)

Une fois connecté il accède à la home page de MovieManager :

- Les 8 derniers articles sont alors présentés. L'utilisateur peut facilement accéder au synopsis ou directement à la fiche descriptive du film. Quatre boutons lui permettent de : signaler avoir vu le film ou non, ajouter ou retirer ce film de sa "wish" ou "like" list. Enfin il peut aller voir directement tous les films présents dans la même catégorie que le film choisi.

![home1](https://user-images.githubusercontent.com/15357887/33442415-6a16d752-d5f5-11e7-85be-7e290b9d8c88.PNG)

- Une liste des derniers commentaires ajoutés à différents films est disponible.

![home2](https://user-images.githubusercontent.com/15357887/33441937-30e48476-d5f4-11e7-939d-578d952c0f09.PNG)

- Enfin des listes proposent des sélections de choix :
###### Des films recommandés en fonctions des goûts de l'utilisateur connecté :
![home3](https://user-images.githubusercontent.com/15357887/33441938-30fda0a0-d5f4-11e7-9934-6f6403360ac9.PNG)

###### Une suite de films choisis au hasard :
![home4](https://user-images.githubusercontent.com/15357887/33441939-3119fffc-d5f4-11e7-8328-2c6fa8bd6c0a.PNG)

###### Finalement les films les plus populaires :
![home5](https://user-images.githubusercontent.com/15357887/33441940-313a3a10-d5f4-11e7-8177-7f1ea5f3b8ca.PNG)

À tout moment, l'utilisateur peut vérifier les informations liées à son compte.

![account](https://user-images.githubusercontent.com/15357887/33441925-2f85cbee-d5f4-11e7-8be1-0223e45d8e17.PNG)

Un popup apparait affichant toutes les informations nécessaires, deux boutons lui permettent de modifier son compte ou bien se déconnecter.

![edit_account](https://user-images.githubusercontent.com/15357887/33441935-30c5b1e0-d5f4-11e7-9879-154bee25ca97.PNG)

De cette façon, l'utilisateur peut modifier son username ainsi que son mail.

Même principe d'affiche pour la description du site :

![about](https://user-images.githubusercontent.com/15357887/33441924-2f6adc4e-d5f4-11e7-91d1-3dc89f6049ac.PNG)

Une page "Perso" est dédiée aux articles que l'utilisateur aura sélectionné comme "wish" ou "like". Il peut donc aisément retrouver les films qu'il veut voir ou qu'il a aimé. Il retrouve aussi ses catégories favorites.

![perso](https://user-images.githubusercontent.com/15357887/33441945-31891dec-d5f4-11e7-8ac4-bda07c9a8202.PNG)

Une page "Library" affiche tous les articles enregistrés dans MovieManager, une barre de recherche est disponible, un menu déroulant permet d'afficher les catégories enregistrées.

![library1](https://user-images.githubusercontent.com/15357887/33441942-3157c738-d5f4-11e7-865a-9b555fe5edcc.PNG)

En choisissant de sélectionner une catégorie, l'utilisateur accède à la liste des catégories, pour chacune d'elles sont affiché :
- les favorite de l'utilisateur
- les articles datant de moins de deux semaines
- le nombre total d'articles présents

![library2](https://user-images.githubusercontent.com/15357887/33441943-316dd726-d5f4-11e7-9a4f-2b5122572b78.PNG)

La page d'un film !

![article](https://user-images.githubusercontent.com/15357887/33441928-2fcf50de-d5f4-11e7-8d16-24075dbd8165.PNG)

Sont disponibles : titre, affiche (zoomable) synopsis, auteur, note, date de réalisation, nombre de like / wish / view, la catégorie à laquelle il appartient et les tags le définissant. Les boutons pour view, wish, like et accès à la catégorie sont toujours présent.

![article2](https://user-images.githubusercontent.com/15357887/33479103-1f994f6a-d68c-11e7-8167-0da0cd297e1e.PNG)

Au bas de la page se trouve un espace commentaire. Un utilisateur peut rédiger des commentaires pour chaque article. Après l'avoir rédigé, il peut choisir une couleur, le reste de l'affichage sera automatique. Une fois le commentaire inscrit, l'utilisateur et l'administrateur peuvent à tout moment le supprimer.

## Profil administrateur

L'administrateur possède un profil user avec des fonctionnalités supplémentaires.

Affichage d'un compte administrateur :

![admin](https://user-images.githubusercontent.com/15357887/33441927-2fb78738-d5f4-11e7-9394-2cd27c2c3a3f.PNG)

En plus des fonctionnalités basiques, l'admin peut voir la liste d'utilisateur enregistrés, supprimer son compte ou ajouter un nouveau film.
Liste des utilisateurs :

![user_list](https://user-images.githubusercontent.com/15357887/33441922-2f3ed892-d5f4-11e7-9209-cdd3a10e1fca.PNG)

On peut ainsi retrouver chaque utilisateur, consulter leurs données, les modifier et enfin supprimer leur compte.
Affichage d'un profil choisi par l'administrateur :

![user_show](https://user-images.githubusercontent.com/15357887/33441923-2f54fbe0-d5f4-11e7-9a04-7400aae287be.PNG)

L'admin peut mute un utilisateur trop vulgaire dans les commentaires. La modification des données se déroule sur le même principe qu'une modification normale sauf que dans notre cas, l'administrateur modifie les données d'un autre utilisateur.

Ajout d'un article :

![article_add](https://user-images.githubusercontent.com/15357887/33441929-2fe7867c-d5f4-11e7-83d3-fd1c960571e6.PNG)

Les différents champs à référencer : Titre, auteur, date de réalisation, image, synopsis, catégorie, tags associés et une note sur 10.

Modification d'un article :

![article_edit](https://user-images.githubusercontent.com/15357887/33441930-2ffe9a88-d5f4-11e7-8469-32bad5b7a295.PNG)

Le principe est le même sauf que les champs sont préremplis.

## Version mobile

###### Bien sûr l'application web est entièrement responsive.

![phone1](https://user-images.githubusercontent.com/15357887/33441947-319fbed0-d5f4-11e7-9c13-200087b2dde0.PNG)      ![phone2](https://user-images.githubusercontent.com/15357887/33441921-2f205cbe-d5f4-11e7-9d9e-42352794c0f4.PNG)

## Schéma de la base de données

###### (Une version de ma base est disponible sur le git)
![databaseschema](https://user-images.githubusercontent.com/15357887/33441934-30a8069a-d5f4-11e7-957a-1ea39d6a0597.PNG)
