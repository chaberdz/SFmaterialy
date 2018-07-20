# Materiały

Prosta aplikacja napisana w Symfony 2 która implementuje 3 klasy z poniższego diagramu oraz wymagania funkcjonalne.Wykorzystuje bazę danych MySQL.
# Diagram
![alt text](https://raw.githubusercontent.com/chaberdz/SFmaterialy/opis/web/materialy_uml.PNG)

# Wymagania funkcjonalne:
1. Można utworzyć dowolną ilość Grup Materiałów.
2. Grupy Materiałów zorganizowane są w strukturze drzewiastej.
3. Jedna Grupa Materiałów może być elementem nadrzędnym dla innej Grupy / innych Grup Materiałów.
4. Materiał musi należeć wyłącznie do jednej grupy.
5. Materiał może występować w jednej, określonej Jednostce Miary.
6. Istnieje widok aplikacji, na którym można zarządzać Jednostkami Miary w zakresie:
    - tworzenia nowej Jednostki Miary,
    - zmiany danych istniejącej Jednostki Miary,
    - usunięcie jednostki miary.
7. Jednostkę Miary można usunąć tylko jeśli nie jest powiązana z żadnym Materiałem.
8. Istnieje widok aplikacji, na którym można zarządzać Grupami Materiałów w zakresie:
    - tworzenia nowej Grupy Materiałów,
    - zmiany danych istniejącej Grupy Materiałów,
    - usunięcie Grupy Materiałów
    - zmiany organizacji drzewa Grup Materiałów
    - zmiany elementu nadrzędnego dla Grupy Materiałów.
9. Grupę Materiałów można usunąć tylko jeśli nie posiada ona podgrup oraz powiązania z żadnym Materiałem.
10. Istnieje widok aplikacji, na którym można zarządzać Materiałami w zakresie:
    - tworzenia nowego Materiału w wybranej Grupie Materiałów oraz mierzonego w określonej Jednostce Miary,
    - zmiany danych istniejącego Materiału, w tym zmiany Grupy Materiału, do którego Materiał należy oraz zmiany Jednostki Miary w jakiej   Materiał jest mierzony.

# Instalacja:
1.Pobranie repozytium i instalacja zależności
`git clone https://github.com/chaberdz/SFmaterialy.git`
`cd SFmaterialy`
`composer install`

2.Wykonanie polecenia tworzącego strukturę tabel oraz powiązania między nimi.
`php app/console server:start doctrine:schema:update --force`


3.Uruchomienie aplikacji w wersji developerskiej poleceniem `php app/console server:start`

4. Uruchomienie testów: php phpunit-5.7.22.phar -c app/
