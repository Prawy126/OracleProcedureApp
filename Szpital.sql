CREATE TABLE "lekarze" (
  "id_lekarza" integer NOT NULL DEFAULT nextval('lekarze_id_lekarza_seq'::regclass),
  "imie" character varying(50),
  "nazwisko" character varying(50),
  "specjalizacja" character varying(50),
  "numer_licencji" character varying(50),
  "id_konta" integer NOT NULL,
  PRIMARY KEY ("id_lekarza")
);

CREATE TABLE "leki" (
  "id_leku" integer NOT NULL DEFAULT nextval('leki_id_leku_seq'::regclass),
  "nazwa_leku" character varying(100),
  "instrukcja" text,
  "forma_leku" character varying(50),
  "data_poczatkowa" date,
  "data_koncowa" date,
  "kategoria_leku" character varying(50),
  "dostepnosc_szpital" boolean,
  "cena" numeric(10,2),
  "dawka_jednostak" character varying(50),
  PRIMARY KEY ("id_leku")
);

CREATE TABLE "pacjenci" (
  "id_pacjentka" integer NOT NULL DEFAULT nextval('pacjenci_id_pacjentka_seq'::regclass),
  "imie" character varying(50),
  "nazwisko" character varying(50),
  "numer_identyczny" character varying(50),
  "id_pielegniarki" integer,
  "id_konta" integer NOT NULL,
  PRIMARY KEY ("id_pacjentka")
);

CREATE TABLE "pielegniarki" (
  "id_pielegniarki" integer NOT NULL DEFAULT nextval('pielegniarki_id_pielegniarki_seq'::regclass),
  "imie" character varying(50),
  "nazwisko" character varying(50),
  "numer_identyczny" character varying(50),
  "id_konta" integer NOT NULL,
  PRIMARY KEY ("id_pielegniarki")
);

CREATE TABLE "przypisania_leki" (
  "id_pacjenta" integer NOT NULL,
  "id_leku" integer NOT NULL,
  "dawka" integer
);

CREATE TABLE "rodzaje_zabiegow" (
  "id_rodzaju" integer NOT NULL DEFAULT nextval('rodzaje_zabiegow_id_rodzaju_seq'::regclass),
  "nazwa_zabiegu" character varying(100),
  "opis_zabiegu" text,
  "zalecenia_po_zabiegu" text,
  PRIMARY KEY ("id_rodzaju")
);

CREATE TABLE "sale" (
  "id_sali" integer NOT NULL DEFAULT nextval('sale_id_sali_seq'::regclass),
  "numer_sali" character varying(10),
  "lokalizacja" character varying(100),
  "status" character varying(50),
  PRIMARY KEY ("id_sali")
);

CREATE TABLE "statusy" (
  "nr_statusu" integer NOT NULL DEFAULT nextval('statusy_nr_statusu_seq'::regclass),
  "status" character varying(50),
  "opis_statusu" text,
  PRIMARY KEY ("nr_statusu")
);

CREATE TABLE "zabiegi" (
  "id_zabiegu" integer NOT NULL DEFAULT nextval('zabiegi_id_zabiegu_seq'::regclass),
  "nazwa_zabiegu" character varying(100),
  "id_rodzaju_zabiegu" integer NOT NULL,
  "id_sali" integer NOT NULL,
  "data_zabiegu" timestamp NOT NULL,
  "czas_trwania" time NOT NULL,
  "koszt" numeric(10,2) NOT NULL,
  "status" integer NOT NULL,
  "id_pielegniarki" integer NOT NULL,
  PRIMARY KEY ("id_zabiegu")
);

CREATE TABLE "zabiegi_lekarze" (
  "id_zabiegu" integer NOT NULL,
  "id_lekarza" integer NOT NULL,
  PRIMARY KEY ("id_zabiegu", "id_lekarza")
);

CREATE TABLE "Konta" (
  "id_konta" integer NOT NULL,
  "login" character varying(50),
  "haslo" character varying(50),
  "rodzaj_Konta" character varying(50)
);

CREATE TABLE "Zabiegi_Pielęgniraki" (
  "id_pielęgniarki" integer NOT NULL,
  "id_zabiegu" integer NOT NULL
);

ALTER TABLE "pacjenci" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "lekarze" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "pielegniarki" ADD FOREIGN KEY ("id_konta") REFERENCES "Konta" ("id_konta");

ALTER TABLE "leki" ADD FOREIGN KEY ("id_leku") REFERENCES "przypisania_leki" ("id_leku");

ALTER TABLE "pacjenci" ADD FOREIGN KEY ("id_pacjentka") REFERENCES "przypisania_leki" ("id_pacjenta");

ALTER TABLE "pielegniarki" ADD FOREIGN KEY ("id_pielegniarki") REFERENCES "Zabiegi_Pielęgniraki" ("id_pielęgniarki");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_zabiegu") REFERENCES "Zabiegi_Pielęgniraki" ("id_zabiegu");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_pielegniarki") REFERENCES "Zabiegi_Pielęgniraki" ("id_pielęgniarki");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_zabiegu") REFERENCES "zabiegi_lekarze" ("id_zabiegu");

ALTER TABLE "lekarze" ADD FOREIGN KEY ("id_lekarza") REFERENCES "zabiegi_lekarze" ("id_lekarza");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("status") REFERENCES "statusy" ("nr_statusu");

ALTER TABLE "zabiegi" ADD FOREIGN KEY ("id_rodzaju_zabiegu") REFERENCES "rodzaje_zabiegow" ("id_rodzaju");
