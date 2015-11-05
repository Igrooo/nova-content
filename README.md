COSMICBOX NOVA

************************
PHP 5.0 required
PHP 5.3 recommanded
************************

WARNING
This web interface for the CosmicBox is a work in progress.
It's programmed by a PHP noobie in procedural style.

ATTENTION
Cette interface web pour la CosmicBox est un travail en cours.
Elle est codé par un noobie du PHP en style procédural.

Changements (octobre 2015):
------------------------------------------------------------------------------------------------------------------
- Prise en charge des caractères spéciaux (UTF-8)
- Suppression des fichiers inutiles (LibraryBox)
- Réorganisation et pleins de modifs PHP
- Plein de modifs/corrections CSS + fonts
- Affichage sur mobile (responsive)
- Personnalisation : ajout de la possibilité de changer le titre et le nom du bouton "Explorateur de fichiers"
- Personnalisation : ajout de la possibilité d'ajouter un titre et un texte pour la page d'acceuil
- Personnalisation : ajout de la possibilté de glisser-déposer une image pour la bannière
- Personnalisation : ajout de la possibilté de désactiver l'interface HTML
- Personnalisation : meilleure prise en compte des types d'image jpg,png,gif pour la bannière
- Correction du fil d'arianne
- Changement du logo
- Meilleur prise en charge des types mime pour afficher des icones appropriés
- Erreurs PHP masquées / journalisation
- Modification du fichier de conf
- Ajout d'un htaccess (amélioration du cache notament)

Bugs :
------------------------------------------------------------------------------------------------------------------
- En PHP 5.2, les fichiers vides (type mime inode/x-empty) avec une extension apparraissent
  sans nom dans la liste des fichiers (mais les fichiers vides sans extension apparaissent correctement)


Liste des GET PHP spéciaux :
------------------------------------------------------------------------------------------------------------------
- ?enable		Reactive l'interface graphique après l'avoir désactivée
- ?reset		Effacer la personnalisation (formulaire demandant le code d'identification)
- ?debug		Afficher les informations de debogage
- ?clearlog		Vide le journal des erreurs


A faire :
------------------------------------------------------------------------------------------------------------------
- Intégrer la lecture des fichiers dans l'interface
- Textes explicatifs pour le choix "Découverte - Configuration guidée étape par étape"
- Navigation asynchrone (ajax...)
- Intégrations de fonctionnalités précédentes LibraryBox (chat, stats...)
- URL Rewriting ?
