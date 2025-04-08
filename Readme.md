###  Étapes

1/ php bin/console make:entity
Pingouin (Va génerer Entity/Pingouin.php & Repository/PingouinRepository.php)

2/ php bin/console make:migration
(Va générer un fichier PHP dans migrations)

3/ php bin/console doctrine:migrations:migrate
(Met à jour la base de données)

4/ php bin/console make:form
(Va générer un fichier src/Form/PingouinType)

5/ php bin/console make:controller
Pingouin (Va générer PingouinController.php)





### Pense bête

git init
git remote add origin https://github.com/jedev85/programmation-web-3-0704.git
