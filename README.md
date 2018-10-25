# Documentation du framework

## Fonctionnalités du framework

Notre framework est un framework utilisant l’architecture logicielle MVC (Model-View-Controller). 

La demande de l’utilisateur est reçue et interprétée par le Controller.
Le Controller utilise les services du Model pour accéder aux données de la base.
Le Controller traite ces données pour les transmettre à la View.
La View affiche les données à l’utilisateur (par exemple sous la forme d’une page HTML).

Chaque projet avec notre framework contient un dossier Core qui est le coeur du projet. En fonction des besoins du développeur, il y a possibilité de créer des modules. Il y a également possibilité d’importer des modules via composer.

Notre framework n’est pas livré avec un ORM.


## Arborescence

```
core
----View 
--------Template
------------main.html             
------------menu.php          
--------style
------------main.css
----Model
--------Model.php
----Controller
--------Router.php
--------View.php
modules
----(nom du module)
--------view
------------style
                [nom du module].css
--------controller
------------[nom du module].php
--------model
------------[nom du module].model.php

index.php
    require autoload composer
    require config.php
    instancie Router.php 

.htacces
    contient les règles de ré-écriture d'url

config.php
    contient les constantes de connection bdd

composer.json
    autoload
    mustache/mustache

vendor

package.json
    Gulp
    Tailwind
    CSS purge
```

#### Dossier Config
Le dossier config contient le fichier conf.php qui contient toutes les données importantes pour la connexion à la base de données.

#### Dossier Core
Il s’agit du coeur du framework et de votre projet. Il s’agit du “module” principal. Il contient les dossiers Controller, Model, View.
Dossier Core\Controller
Dispatcher.php
Permet d’afficher une page avec la méthode displayPage.
Contient également la méthode code404 pour les pages introuvable.

#### Router.php
Permet d’exécuter l’action d’un controller en fonction de son module. Sa fonction route() permet de s’assurer que le module existe et exécute les instructions de l’action ensuite.

#### View.php
Permet de charger le template et le layout lié à la View en fonction de son module.

#### Dossier Core\Model
Model.php
Assure la connexion à la base de données. Propose des requêtes préparées comme des SELECT ou UPDATE.

#### Dossier Core\View
Style\main.css
Contient le style global de l’application.
Dossier Template
Contient les fichiers template de l’application.

#### Dossier Modules
Il s’agit du dossier dans lequel vous allez rajouter vos modules. Pour l’exemple, nous avons créé le module Salarié.

Le module Salarié possède ses propres dossiers Controller, Model et View.

Dossier Salarie\Controller
Contient toutes les actions du module salarié.

Dossier Salarie\Model
Contient le model pour le module salarié.

Dossier Salarie\View
Contient les layouts et les modification de View pour le module;
