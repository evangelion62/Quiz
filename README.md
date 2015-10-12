# Quiz php app
application php pour créer et jouer des quiz

##Installation

- déziper l'archive à la racine de votre serveur web (www)
- éditer le fichier config/config.php
à la ligne 5 :
```
$bdd = new PDO('mysql:host=localhost;dbname=test','root','');
```
```
$bdd = new PDO('mysql:host=NomDuServerHote;
                dbname=NomDeLaBaseDeDonnees',
                'UtilisateurBdd',
                'MotsDePasseBdd');
```
> **Note:** dans le cas d'un test en local (wamp,mamp,lamp) il est généralement inutile d'éditer ces valeurs

- enfin lancer l'URL suivant :
```
http://NomDeDomaine/?controler=install
```
> **Note:** cette étape créé normalement les tables dont l'application a besoin pour fonctionner.

- enjoy : l'application est correctement installée. Il ne vous reste plus qu'a créer des thémes et des questions.
