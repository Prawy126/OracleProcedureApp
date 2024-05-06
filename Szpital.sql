CREATE TABLE "lekarze" (
  "id_lekarza" integer NOT NULL PRIMARY KEY,
  "imie" varchar2(50) NOT NULL,
  "nazwisko" varchar2(50) NOT NULL,
  "specjalizacja" varchar2(50) NOT NULL,
  "numer_licencji" varchar2(50) NOT NULL,
  "id_konta" integer NOT NULL
);


CREATE TABLE "leki" (
  "id_leku" integer NOT NULL PRIMARY KEY,
  "nazwa_leku" varchar2(100) NOT NULL,
  "instrukcja" clob NOT NULL,
  "forma_leku" varchar2(50) NOT NULL,
  "ilosc_magazyn" integer,
  "kategoria_leku" varchar2(50) NOT NULL,
  "cena" float,
  "dawka_jednostka" varchar2(50) NOT NULL
);


CREATE TABLE "pacjenci" (
  "id_pacjentka" integer NOT NULL PRIMARY KEY,
  "imie" character varying(50) NOT NULL,
  "nazwisko" character varying(50) NOT NULL,
  "id_pielegniarki" integer,
  "id_konta" integer NOT NULL,
  "Czas_pobytu(DNI)" integer NOT NULL,
  "id_Sali" integer NOT NULL
);

CREATE TABLE "pielegniarki" (
  "id_pielegniarki" integer NOT NULL PRIMARY KEY,
  "imie" character varying(50) NOT NULL,
  "nazwisko" character varying(50) NOT NULL,
  "numer_identyfikacyjny" character varying(50) NOT NULL,
  "id_konta" integer NOT NULL
);

CREATE TABLE "przypisania_leki" (
  "id_pacjenta" integer NOT NULL,
  "id_leku" integer NOT NULL,
  "dawka" integer NOT NULL,
  "data_poczatkowa" date,
  "data_koncowa" date,
  "data_waznosci" date,
  "dostepnosc_szpital" CHAR(1)
);

CREATE TABLE "rodzaje_zabiegow" (
  "id_rodzaju" integer NOT NULL PRIMARY KEY,
  "nazwa_zabiegu" varchar2(100) NOT NULL,
  "opis_zabiegu" clob NOT NULL,
  "zalecenia_przed_zabiegiem" clob,
  "zalecenia_po_zabiegu" clob
);


CREATE TABLE "sale" (
  "id_sali" integer NOT NULL PRIMARY KEY,
  "numer_sali" character varying(10),
  "lokalizacja" character varying(100) NOT NULL,
  "status" character varying(50) NOT NULL,
  "typ_sali" character varying(50),
  "miejsca" integer NOT NULL
);

CREATE TABLE "statusy" (
  "nr_statusu" integer NOT NULL PRIMARY KEY,
  "status" character varying(50) NOT NULL,
  "opis_statusu" clob NOT NULL
);

CREATE TABLE "zabiegi" (
  "id_zabiegu" integer NOT NULL PRIMARY KEY,
  "id_rodzaju_zabiegu" integer NOT NULL,
  "id_sali" integer NOT NULL,
  "data_zabiegu" timestamp NOT NULL,
  "czas_trwania" interval DAY TO SECOND NOT NULL,
  "koszt" numeric(10,2) NOT NULL,
  "status" number(1) NOT NULL
);


CREATE TABLE "zabiegi_lekarze" (
  "id_zabiegu" integer NOT NULL,
  "id_lekarza" integer NOT NULL
);

CREATE TABLE "Konta" (
  "id_konta" integer NOT NULL PRIMARY KEY,
  "login" character varying(50) NOT NULL,
  "haslo" character varying(50) NOT NULL,
  "rodzaj_Konta" character varying(50) NOT NULL
);

CREATE TABLE "Zabiegi_Piel�gniraki" (
  "id_piel�gniarki" integer NOT NULL,
  "id_zabiegu" integer NOT NULL
);


// do wywalenia
DROP TABLE IF EXISTS "przypisania_leki_leki";


// do wywalenia
DROP TABLE "przypisania_leki_pacjenci";


// do wywalenia
DROP TABLE "Zabiegi_Piel�gniraki_zabiegi";

//do wywalenia
DROP TABLE "zabiegi_lekarze_zabiegi";

// do wywalenia
DROP TABLE "zabiegi_lekarze_lekarze";

COMMENT ON COLUMN "lekarze"."id_konta" IS '
Klucz obcy z tabeli Konta
';

COMMENT ON COLUMN "pacjenci"."id_pielegniarki" IS '
Klucz obcy z tabeli pilegniarki
';

COMMENT ON COLUMN "pacjenci"."id_konta" IS '
Klucz obcy z tabeli konta
';

COMMENT ON COLUMN "pacjenci"."id_Sali" IS '
Klucz obcy z tabeli sale
';

COMMENT ON COLUMN "pielegniarki"."id_konta" IS '
Klucz obcy z tabeli konta
';

COMMENT ON COLUMN "przypisania_leki"."id_pacjenta" IS '
Klucz obcy z tabeli pacjenci
';

COMMENT ON COLUMN "przypisania_leki"."id_leku" IS '
Klucz obcy z tabeli leki
';

COMMENT ON COLUMN "zabiegi"."id_rodzaju_zabiegu" IS '
Klucz obcy z tabeli rodzaj_zabiegow
';

COMMENT ON COLUMN "zabiegi_lekarze"."id_zabiegu" IS '
Klucz obcy z tabeli zabiegi
';

COMMENT ON COLUMN "zabiegi_lekarze"."id_lekarza" IS '
Klucz obcy z tabeli lekarze
';

COMMENT ON COLUMN "Zabiegi_Piel�gniraki"."id_piel�gniarki" IS '\undefined    Klucz obcy z tabeli pielegniarki
  ';

COMMENT ON COLUMN "Zabiegi_Piel�gniraki"."id_zabiegu" IS '
Klucz obcy z tabeli zabiegi
';

ALTER TABLE "pacjenci" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "lekarze" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "pielegniarki" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "Zabiegi_Piel�gniraki" ADD FOREIGN KEY ("id_piel�gniarki") REFERENCES "pielegniarki" ("id_pielegniarki");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("status") REFERENCES "statusy" ("nr_statusu");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_rodzaju_zabiegu") REFERENCES "rodzaje_zabiegow" ("id_rodzaju");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_sali") REFERENCES "sale" ("id_sali");

ALTER TABLE "pacjenci" ADD FOREIGN KEY ("id_Sali") REFERENCES "sale" ("id_sali");

ALTER TABLE "pacjenci" ADD FOREIGN KEY ("id_pielegniarki") REFERENCES "pielegniarki" ("id_pielegniarki");

INSERT ALL 
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (1, 'user1', 'pass1', 'Pacjent')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (2, 'user2', 'pass2', 'Pacjent')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (3, 'user3', 'pass3', 'Pacjent')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (4, 'user4', 'pass4', 'Pacjent')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (5, 'user5', 'pass5', 'Pacjent')
SELECT * FROM dual;

INSERT ALL 
INTO "sale" ("id_sali", "numer_sali", "lokalizacja", "status", "typ_sali", "miejsca") VALUES (101, '001', 'Budynek A', 'Dost�pna', 'Standard', 2)
INTO "sale" ("id_sali", "numer_sali", "lokalizacja", "status", "typ_sali", "miejsca") VALUES (102, '002', 'Budynek A', 'Dost�pna', 'Standard', 2)
INTO "sale" ("id_sali", "numer_sali", "lokalizacja", "status", "typ_sali", "miejsca") VALUES (103, '003', 'Budynek B', 'Dost�pna', 'Standard', 2)
INTO "sale" ("id_sali", "numer_sali", "lokalizacja", "status", "typ_sali", "miejsca") VALUES (104, '004', 'Budynek B', 'Dost�pna', 'Standard', 2)
INTO "sale" ("id_sali", "numer_sali", "lokalizacja", "status", "typ_sali", "miejsca") VALUES (105, '005', 'Budynek C', 'Dost�pna', 'Standard', 2)
SELECT * FROM dual;

INSERT ALL 
INTO "pacjenci" ("id_pacjentka", "imie", "nazwisko", "id_pielegniarki", "id_konta", "Czas_pobytu(DNI)", "id_Sali") VALUES (1, 'Jan', 'Kowalski', NULL, 1, 14, 101)
INTO "pacjenci" ("id_pacjentka", "imie", "nazwisko", "id_pielegniarki", "id_konta", "Czas_pobytu(DNI)", "id_Sali") VALUES (2, 'Anna', 'Nowak', NULL, 2, 30, 102)
INTO "pacjenci" ("id_pacjentka", "imie", "nazwisko", "id_pielegniarki", "id_konta", "Czas_pobytu(DNI)", "id_Sali") VALUES (3, 'Piotr', 'Wi�niewski', NULL, 3, 7, 103)
INTO "pacjenci" ("id_pacjentka", "imie", "nazwisko", "id_pielegniarki", "id_konta", "Czas_pobytu(DNI)", "id_Sali") VALUES (4, 'Katarzyna', 'Maj', NULL, 4, 21, 104)
INTO "pacjenci" ("id_pacjentka", "imie", "nazwisko", "id_pielegniarki", "id_konta", "Czas_pobytu(DNI)", "id_Sali") VALUES (5, 'Marcin', 'B�k', NULL, 5, 10, 105)
SELECT * FROM dual;

SELECT * FROM "pacjenci";
SELECT * FROM "sale";
SELECT * FROM "Konta";

INSERT ALL 
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (6, 'lekarz1', 'pass6', 'Lekarz')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (7, 'lekarz2', 'pass7', 'Lekarz')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (8, 'lekarz3', 'pass8', 'Lekarz')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (9, 'lekarz4', 'pass9', 'Lekarz')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (10, 'lekarz5', 'pass10', 'Lekarz')
SELECT * FROM dual;

INSERT ALL 
INTO "lekarze" ("id_lekarza", "imie", "nazwisko", "specjalizacja", "numer_licencji", "id_konta") VALUES (1, 'Robert', 'Lewandowski', 'Kardiologia', 'LIC001', 6)
INTO "lekarze" ("id_lekarza", "imie", "nazwisko", "specjalizacja", "numer_licencji", "id_konta") VALUES (2, 'Monika', 'Kowalczyk', 'Neurologia', 'LIC002', 7)
INTO "lekarze" ("id_lekarza", "imie", "nazwisko", "specjalizacja", "numer_licencji", "id_konta") VALUES (3, 'Tomasz', 'Nowak', 'Ortopedia', 'LIC003', 8)
INTO "lekarze" ("id_lekarza", "imie", "nazwisko", "specjalizacja", "numer_licencji", "id_konta") VALUES (4, 'Aleksandra', 'Zieli�ska', 'Dermatologia', 'LIC004', 9)
INTO "lekarze" ("id_lekarza", "imie", "nazwisko", "specjalizacja", "numer_licencji", "id_konta") VALUES (5, 'Jakub', 'Krzysztof', 'Pediatria', 'LIC005', 10)
SELECT * FROM dual;

SELECT * FROM "lekarze";
SELECT * FROM "Konta";

INSERT ALL 
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (11, 'piel1', 'pass11', 'Piel�gniarka')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (12, 'piel2', 'pass12', 'Piel�gniarka')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (13, 'piel3', 'pass13', 'Piel�gniarka')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (14, 'piel4', 'pass14', 'Piel�gniarka')
INTO "Konta" ("id_konta", "login", "haslo", "rodzaj_Konta") VALUES (15, 'piel5', 'pass15', 'Piel�gniarka')
SELECT * FROM dual;

INSERT ALL 
INTO "pielegniarki" ("id_pielegniarki", "imie", "nazwisko", "numer_identyfikacyjny", "id_konta") VALUES (6, 'Ewa', 'Borowik', 'PN12345', 11)
INTO "pielegniarki" ("id_pielegniarki", "imie", "nazwisko", "numer_identyfikacyjny", "id_konta") VALUES (7, 'Ola', 'Klimek', 'PN12346', 12)
INTO "pielegniarki" ("id_pielegniarki", "imie", "nazwisko", "numer_identyfikacyjny", "id_konta") VALUES (8, 'Ula', 'Gorecka', 'PN12347', 13)
INTO "pielegniarki" ("id_pielegniarki", "imie", "nazwisko", "numer_identyfikacyjny", "id_konta") VALUES (9, 'Iza', 'Zalewska', 'PN12348', 14)
INTO "pielegniarki" ("id_pielegniarki", "imie", "nazwisko", "numer_identyfikacyjny", "id_konta") VALUES (10, 'Maja', 'Kot', 'PN12349', 15)
SELECT * FROM dual;


SELECT * FROM "pielegniarki";
SELECT * FROM "Konta";


INSERT ALL 
INTO "leki" ("id_leku", "nazwa_leku", "instrukcja", "forma_leku", "ilosc_magazyn", "kategoria_leku", "cena", "dawka_jednostka") VALUES (1, 'Paracetamol', 'Dawkowanie doros�ych 2 tabletki co 4 godziny', 'Tabletka', 100, 'Przeciwb�lowy', 10.50, '500mg')
INTO "leki" ("id_leku", "nazwa_leku", "instrukcja", "forma_leku", "ilosc_magazyn", "kategoria_leku", "cena", "dawka_jednostka") VALUES (2, 'Ibuprofen', 'Nie przekracza� 6 tabletek dziennie', 'Tabletka', 150, 'Przeciwzapalny', 15.75, '200mg')
INTO "leki" ("id_leku", "nazwa_leku", "instrukcja", "forma_leku", "ilosc_magazyn", "kategoria_leku", "cena", "dawka_jednostka") VALUES (3, 'Amoksycylina', 'Stosowa� zgodnie z zaleceniami lekarza', 'Kapsu�ka', 50, 'Antybiotyk', 25.30, '500mg')
INTO "leki" ("id_leku", "nazwa_leku", "instrukcja", "forma_leku", "ilosc_magazyn", "kategoria_leku", "cena", "dawka_jednostka") VALUES (4, 'Cetirizine', '1 tabletka dziennie', 'Tabletka', 75, 'Antyhistaminowy', 18.00, '10mg')
INTO "leki" ("id_leku", "nazwa_leku", "instrukcja", "forma_leku", "ilosc_magazyn", "kategoria_leku", "cena", "dawka_jednostka") VALUES (5, 'Metformin', 'Stosowa� 2 razy dziennie po posi�ku', 'Tabletka', 90, 'Antydiabetyk', 20.45, '500mg')
SELECT * FROM dual;


SELECT * FROM "rodzaje_zabiegow";

INSERT ALL 
INTO "rodzaje_zabiegow" ("id_rodzaju", "nazwa_zabiegu", "opis_zabiegu", "zalecenia_przed_zabiegiem", "zalecenia_po_zabiegu") VALUES (1, 'Artroskopia', 'Artroskopia to minimalnie inwazyjna metoda badania staw�w', 'Nie przyjmowa� pokarm�w na 12 godzin przed zabiegiem.', 'Ograniczy� aktywno�� fizyczn� przez tydzie�.')
INTO "rodzaje_zabiegow" ("id_rodzaju", "nazwa_zabiegu", "opis_zabiegu", "zalecenia_przed_zabiegiem", "zalecenia_po_zabiegu") VALUES (2, 'Laparoskopia', 'Laparoskopia to procedura u�ywana do badania organ�w wewn�trznych brzucha', 'Nie je�� i nie pi� na 8 godzin przed zabiegiem.', 'Unika� ci�kiego podnoszenia przez miesi�c.')
INTO "rodzaje_zabiegow" ("id_rodzaju", "nazwa_zabiegu", "opis_zabiegu", "zalecenia_przed_zabiegiem", "zalecenia_po_zabiegu") VALUES (3, 'Endoskopia', 'Endoskopia to technika diagnostyczna pozwalaj�ca na ogl�danie wn�trza kana��w cia�a', 'Post �cis�y na 24 godziny przed zabiegiem.', 'Dieta p�ynna przez kilka dni po zabiegu.')
INTO "rodzaje_zabiegow" ("id_rodzaju", "nazwa_zabiegu", "opis_zabiegu", "zalecenia_przed_zabiegiem", "zalecenia_po_zabiegu") VALUES (4, 'Biopsja', 'Biopsja to zabieg polegaj�cy na usuni�ciu fragmentu tkanki do badania', 'Nie stosowa� lek�w rozrzedzaj�cych krew na tydzie� przed.', 'Zminimalizowa� aktywno��, monitorowa� miejsce biopsji.')
INTO "rodzaje_zabiegow" ("id_rodzaju", "nazwa_zabiegu", "opis_zabiegu", "zalecenia_przed_zabiegiem", "zalecenia_po_zabiegu") VALUES (5, 'Angioplastyka', 'Angioplastyka to procedura medyczna maj�ca na celu rozszerzenie zw�onych lub zablokowanych t�tnic', 'Przyjmowa� przepisane leki przeciwzakrzepowe.', 'Regularne kontrole i stosowanie przepisanych lek�w.')
SELECT * FROM dual;

SELECT * FROM "leki";
SELECT * FROM "zabiegi";

SELECT * FROM "rodzaje_zabiegow";
SELECT * FROM "sale";
SELECT * FROM "statusy";

INSERT ALL
INTO "statusy" ("nr_statusu", "status", "opis_statusu") VALUES (1, 'Zaplanowany', 'Zabieg zosta� zaplanowany i oczekuje na realizacj�.')
INTO "statusy" ("nr_statusu", "status", "opis_statusu") VALUES (2, 'W trakcie', 'Zabieg jest aktualnie przeprowadzany.')
INTO "statusy" ("nr_statusu", "status", "opis_statusu") VALUES (3, 'Zako�czony', 'Zabieg zosta� zako�czony pomy�lnie.')
INTO "statusy" ("nr_statusu", "status", "opis_statusu") VALUES (4, 'Odwo�any', 'Zabieg zosta� odwo�any.')
INTO "statusy" ("nr_statusu", "status", "opis_statusu") VALUES (5, 'Prze�o�ony', 'Zabieg zosta� prze�o�ony na inny termin.')
SELECT * FROM dual;

SELECT * FROM "zabiegi";

INSERT ALL 
INTO "zabiegi" ("id_zabiegu", "id_rodzaju_zabiegu", "id_sali", "data_zabiegu", "czas_trwania", "koszt", "status") VALUES (1, 1, 101, TO_TIMESTAMP('2023-10-15 08:00:00', 'YYYY-MM-DD HH24:MI:SS'), INTERVAL '1' HOUR, 300.00, 1)
INTO "zabiegi" ("id_zabiegu", "id_rodzaju_zabiegu", "id_sali", "data_zabiegu", "czas_trwania", "koszt", "status") VALUES (2, 2, 102, TO_TIMESTAMP('2023-10-16 09:30:00', 'YYYY-MM-DD HH24:MI:SS'), INTERVAL '2' HOUR, 450.00, 1)
INTO "zabiegi" ("id_zabiegu", "id_rodzaju_zabiegu", "id_sali", "data_zabiegu", "czas_trwania", "koszt", "status") VALUES (3, 3, 103, TO_TIMESTAMP('2023-10-17 10:00:00', 'YYYY-MM-DD HH24:MI:SS'), INTERVAL '30' MINUTE, 150.00, 1)
INTO "zabiegi" ("id_zabiegu", "id_rodzaju_zabiegu", "id_sali", "data_zabiegu", "czas_trwania", "koszt", "status") VALUES (4, 4, 104, TO_TIMESTAMP('2023-10-18 11:00:00', 'YYYY-MM-DD HH24:MI:SS'), INTERVAL '45' MINUTE, 200.00, 1)
INTO "zabiegi" ("id_zabiegu", "id_rodzaju_zabiegu", "id_sali", "data_zabiegu", "czas_trwania", "koszt", "status") VALUES (5, 5, 105, TO_TIMESTAMP('2023-10-19 12:00:00', 'YYYY-MM-DD HH24:MI:SS'), INTERVAL '1' HOUR + INTERVAL '30' MINUTE, 400.00, 1)
SELECT * FROM dual;







