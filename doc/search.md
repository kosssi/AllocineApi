Search
======

Recherche : search

    URL : http://api.allocine.fr/rest/v3/search
    Paramètres
        partner : code partenaire (YW5kcm9pZC12M3M pour l'application Android)
        q : chaîne à chercher (chaîne de caractères)
        filter (optionnel) : filtrer selon un type de résultat (énumeration de termes séparés par des virgules)
            movie : afficher les films correspondant à la recherche
            theater : afficher les cinémas
            person : afficher les acteurs, réalisateurs, etc. (personnes)
            news : afficher les news
            tvseries : afficher les séries TV
        count (optionnel) : nombre de résultats à renvoyer (entier)
        page (optionnel) : numéro de la page de résultats à afficher (10 résultats par page par défaut)

    Exemple : http://api.allocine.fr/rest/v3/search?partner=YW5kcm9pZC12M3M&filter=movie,theater,person,news,tvseries&count=5&page=1&q=avatar&format=json
