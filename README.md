[color=#e6172c]Projet en cours[/color]

# Aux futurs employeurs voici mon projet en cours

C'est un Blog avec d'articles avec de fausses données en symfony 4

1. Pour le cloner tapez dans votre terminal la commande suivante : 

    **if ($cleSSH) {echo "tapez cette commande"}**
``` git clone git@github.com:Celine-Nova/SymfoBlog.git ```
    **else {Tapez celle-ci}**
``` https://github.com/Celine-Nova/SymfoBlog.git ```
    

2. Installez composer :
``` composer install ```

3. Créez la BDD :
``` php bin/console doctrine:database:create ```

4. Importez la :
```  php bin/console doctrine:migrations:migrate ```

5. Demarrez le serveur :
``` php bin/console server:run ```

6. Appuyez sur la touche **Ctrl** puis cliquez sur l'adresse du serveur ![capture terminal](images/Capture_terminal.PNG)

<span class="text-info">Naviguez sur  SimBLog </span>


NB: ce projet est en cours d'amelioration
- Finir le formulaire
- Pouvoir telecharger les images
- créer une session utilisateur
- pouvoir ajouter des commentaires