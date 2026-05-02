# Herna_databaza
Jednoduchý webový systém na správu knižnice videohier a ich vývojárov. Projekt demonštruje základné prepojenie PHP s MySQL databázou pomocou operácií CRUD (Create, Read, Update, Delete) a prácu s relačnými tabuľkami.

Funkcie
Pridávanie hier: Registrácia novej hry spolu s informáciami o vývojárovi.

Dynamická správa vývojárov: Ak vývojár už v databáze existuje, systém ho automaticky priradí; ak nie, vytvorí nového.

Zobrazenie knižnice: Prehľadný zoznam všetkých hier prepojený s tabuľkou vývojárov cez INNER JOIN.

Úprava údajov: Možnosť spätne meniť informácie o hre aj vývojárovi.

Mazanie: Odstránenie hier z databázy.

Automatizácia: Skript sám vytvorí databázu aj potrebné tabuľky pri prvom spustení.

Použité technológie
Jazyk: PHP 

Databáza: MySQL (cez rozšírenie mysqli)

Frontend: HTML5, Bootstrap 5 