MovieManager
========================

#### But ?

Réaliser un "gros" projet sous Symfony3 afin de maitriser les fonctionnalités du framework. Customizer le rendus via un frmaework design performant.

### Outils

- Symfony 3
- Doctrine 2
- MySQL
- Materialize : http://materializecss.com/
- Icons : https://www.flaticon.com/packs/kids-avatars

![home1](https://user-images.githubusercontent.com/15357887/33442415-6a16d752-d5f5-11e7-85be-7e290b9d8c88.PNG)

## Profil utilisateur

Tout commence par une inscription au site, la sécurité a été monté via la documentation officielle de Symfony : https://symfony.com/doc/current/security.html


![register](https://user-images.githubusercontent.com/15357887/33441116-2cb647d8-d5f2-11e7-8a87-c78dbd35958d.PNG)

Puis l'utilisateur doit se connecter avec son username ou bien son email. Une checkbox permet de garde la session active 24h ( modifiable ) après connection.

![login](https://user-images.githubusercontent.com/15357887/33441110-27abe23e-d5f2-11e7-8473-766b4ffc76c3.PNG)

Une fois connecté il accède à la home page de MovieManager :

- Les 8 derniers articles sont alors présentés. L'utilisateur peut facileument accéder au synopsis ou directement à la fiche descriptive du film. Quatres boutons lui permettent de : signaler avoir vu le film ou non, ajouter ou retirer ce film de sa "wish" ou "like" list. Enfin il peut aller voir directement tous les films présents dans la même catégorie que le film choisi.

![home1](https://user-images.githubusercontent.com/15357887/33442415-6a16d752-d5f5-11e7-85be-7e290b9d8c88.PNG)

- Une liste des derniers commentaires ajoutés à différents films est disponible.

![home2](https://user-images.githubusercontent.com/15357887/33441937-30e48476-d5f4-11e7-939d-578d952c0f09.PNG)

- Enfin des listes proposent des séléctions de choix :
###### Des films recommandés en fonctions des goûts de l'utilisateur connecté :
![home3](https://user-images.githubusercontent.com/15357887/33441938-30fda0a0-d5f4-11e7-9934-6f6403360ac9.PNG)

###### Une suite de films choisis au hasard :
![home4](https://user-images.githubusercontent.com/15357887/33441939-3119fffc-d5f4-11e7-8328-2c6fa8bd6c0a.PNG)

###### Finalement les films les plus populaires :
![home5](https://user-images.githubusercontent.com/15357887/33441940-313a3a10-d5f4-11e7-8177-7f1ea5f3b8ca.PNG)

A tout moment, l'utilisateur peut vérifier les informations liées à son compte.

![account](https://user-images.githubusercontent.com/15357887/33441925-2f85cbee-d5f4-11e7-8be1-0223e45d8e17.PNG)

Une popup apparait affichant toutes les informations nécessaires, deux boutons lui permettent de modifier son compte ou bien se déconnecter.

![edit_account](https://user-images.githubusercontent.com/15357887/33441935-30c5b1e0-d5f4-11e7-9879-154bee25ca97.PNG)

De cette façon, l'utilisateur peut modifier son username ainsi que son mail.

Une page "Perso" est dédiée aux articles que l'utilisateur aura séléctiné comme "wish" ou "like". Il peut donc aisément retrouver les films qu'il veut voir ou qu'il a aimé. Il retrouve aussi ses catégories favorites.

![perso](https://user-images.githubusercontent.com/15357887/33441945-31891dec-d5f4-11e7-8ac4-bda07c9a8202.PNG)

Une page "Library" affiche tous les articles enregistrés dans MovieManager, une barre de recherche est disponible, un menu déroulant permet d'afficher les catégories enregistrées.

![library1](https://user-images.githubusercontent.com/15357887/33441942-3157c738-d5f4-11e7-865a-9b555fe5edcc.PNG)

En choisiant de séléctionner une categorie, l'utilisateur accède à la liste des catégories, pour chacune d'elles sont affiché :
- les favorite de l'utilisateur
- les articles datans de moins de deux semaines
- le nombre total d'articles présents

![library2](https://user-images.githubusercontent.com/15357887/33441943-316dd726-d5f4-11e7-9a4f-2b5122572b78.PNG)

## Profil administrateur




