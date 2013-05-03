Movie
=====

Informations sur un film : movie

    URL : http://api.allocine.fr/rest/v3/movie
    Paramètres
        partner : code partenaire (YW5kcm9pZC12M3M pour l'application Android)
        code : identifiant du film (entier)
        profile (optionnel) : degré d'informations renvoyées (valeurs possibles : small, medium, large)
        mediafmt (optionnel) : format vidéo
            flv : FLV / H.264
            mp4-lc : MP4 / H.264 Baseline Profile, Low Complexity, with splashscreen
            mp4-hip : H264 High Profile, with splashscreen
            mp4-archive : MP4 / H.264 High Profile, for archive
            mpeg2-theater : MPEG-2 720p
            mpeg2 : MPEG-2 Main Profile
            et sûrement d'autres mais je n'ai pas le code correspondant …
        filter (optionnel) : filtrer selon un type de résultat (énumeration de termes séparés par des virgules)
            movie : afficher les films correspondant à la recherche
            theater : afficher les cinémas
            person : afficher les acteurs, réalisateurs, etc. (personnes)
            news : afficher les news
            tvseries : afficher les séries TV
        striptags (optionnel) : supprime les tags HTML des paramètres valeurs passées en paramètre

    Exemple : http://api.allocine.fr/rest/v3/movie?partner=YW5kcm9pZC12M3M&code=61282&profile=large&mediafmt=mp4-lc&format=json&filter=movie&striptags=synopsis,synopsisshort
