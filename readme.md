# Cricket

Cette petite application sert à compter les points lors d'une partie de cricket.
Le cricket est une règle de jeu de fléchettes.

## Les règles

Seuls les chiffres de 15 à 20 et la bulle (le centre de la cible) comptent dans les scores du cricket.
Le but est de "fermer" tous ces chiffres en scorant trois points pour chaque chiffre. La bande du milieu ("zone des triples") compte pour 3 points et la bande extérieure ("zone des doubles") compte pour 2 points.

Une fois qu'un joueur a fermé une zone, il peut marquer des points si il tire à nouveau dedans. Si une zone a été fermé par tous les joueurs, plus personne ne peut marquer de point avec cette zone.

Dans le jeu de cricket original, une zone ayant été fermée en premier par un joueur "appartient" désormais à ce joueur ; les autres pourront fermer cette zone à leur tour mais ne pourront alors plus marquer de points dessus.
Cette application propose une variante du cricket qui ne prend pas cette règle en compte.

## Pré-requis et utilisation

Cette application ne fait que compter les points. Elle n'a aucun intérêt sans un vrai jeu de fléchettes !
Elle a en fait été conçue pour être utilisée sur smartphone, à travers une application permettant d'héberger un serveur local. Le serveur doit être compatible PHP.
[Simple HTTP Server](https://play.google.com/store/apps/details?id=jp.ubi.common.http.server) est une application gratuite, entre autres, qui permet ceci.

Il est possible, cela dit, d'utiliser le lien de la section "Démo" ci-après, dans la mesure où il est peu probable qu'il soit utilisé par plusieurs personnes en même temps.

Après avoir lancé vos fléchettes, cliquez (ou tapez) simplement sur la case correspondant au score effectué dans la colonne correspondant à votre nom de joueur.

A savoir : il est impossible d'annuler une action en cas d'erreur.

## A propos

### Démo

L'application est mise en ligne sur Hostinger en tant que démo : **elle n'est pas conçue pour être utilisée par plusieurs utilisateurs à la fois**.
<!-- TODO -->
[Cricket](https://www.perdu.com/) (à venir)

### Nota bene

- Cricket a été fait dans un but d'exercice et de pratique du code, et ne prétend pas être un produit fini.
- Il n'a été testée que sur Firefox 109. Il peut y avoir des problèmes d'affichage, voire de fonctionnalité, selon les navigateurs.
- Il n'est pas prévu que Cricket soit maintenu, corrigé ou amélioré.

### Technologies

Javascript, PHP, HTML et SCSS, "from scratch".
Les icônes ont été réalisées avec Gimp.

### Auteur

[Olivier Genel](https://github.com/usernameJunior)

### Licence

<!-- This project is licensed under the [CC0 1.0 Universal](LICENSE.md)
Creative Commons License - see the [LICENSE.md](LICENSE.md) file for
details -->
