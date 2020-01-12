#Kontrolle anhand von Wetterdaten in Symcon

WICHTIG: WER DIESES MODUL EINSETZT TUT DIES AUF EIGENE GEFAHR. ICH TUE MEIN BESTES FEHLER ZU FINDEN UND ZU BEHEBEN. TRETEN ABER FEHLER AUF UND FÜHREN ZU SCHÄDEN ÜBERNEHME ICH KEINE HAFTUNG! 

## Anwendungsbeispiele
Das Modul ermöglicht das Auslösen von Stati basierend auf diversen Wetterdaten. So kann z.B. ein Wintergarten beschattet oder belüftet werden. Weiterhin ist in Planung es auch für Benachrichtigungen oder Bewässerungsthemen nutzbar zu machen. 

Was macht das Modul: 
* Markise ausfahren bei starker Sonne anhand von Status Variable - Markise raus = 1
* Markiese nicht ausfahren wenn zu starker Wind herrscht - Markise raus = 0 wenn Wind > x
* Markise bei Sturmböen einfahren und warten bis die Böen abgeklungen sind - Markise Raus = 0, bis Böen < y
* Raffstores am Wiga auf Position 2 fahren wenn Sonne in Azimut 180 Grad und Strahlung > 30000 lux - Raffstore Status = 2
* Erkennung von Frost anhand von Aussentemperatur < 1 Grad und Luftfeuchte > 90% um auch an kalten trockenen Tagen eine Beschattung zu ermöglichen

Was macht das Modul nicht:
* Das Modul steuert keine Komponenten direkt (es liefert nur einen Status). Das heißt es gibt nur einen Status, z.B. Raffstore Position 2 aus ... dieser ist dann via Event zu nutzen. Zeiten sind z.B. im Event zu setzen - auch was genau Position 2 bedeutet, muss in einem separaten Skript definiert werden. 
* Aktuell schreibt das Modul nichts ins Log - es werden aber die "Entscheidungen" in eine Variable gepackt - ebenso werden diverse Informationen via Debug bereitgestellt 

WICHTIG: Das Modul ist enthält eine Vielzahl an Scripten die in unserem System zu Einsatz kamen und ist relativ kompliziert was die Regeln angeht (auf jeden Fall für meine Verhältnisse). Ich gehe von Logik Fehlern (Stand 28-12-2019) aus - bitte im Forum melden. 


## Voraussetzungen
IP-Symcon ab Version 5.2

## Software-Installation
Über das Modul-Control folgende URL hinzufügen.
https://github.com/elueckel/Symcon_ControlByWeather

## Einrichten der Instanzen in IP-Symcon
Unter "Instanz hinzufügen" ist das 'Control_by_Weather'-Modul unter dem Hersteller '(Sonstige)' aufgeführt.

## Konfigurationsseite & Hinweise
Am besten die Webconsole verwenden ... es gibt viele Einstellmöglichkeiten

### Grundkonfiguration / Datenaufbereitung
* Ausführhäufigkeit: Wie oft werden Wetterdaten aktualisiert - hier reicht bei den meisten Stationen vermutlich etwas im Bereich 2 bis 5 Minuten ... bei Nutzung einer Davis kommen die Daten alle 2.5 Sekunden, weswegen ich 10 Sekunden als Basis nutze. 
* Felder für Sonnenstand aus Location Modul
* Setzen der Jahreszeit (Sommer/Winter) um unterschiedliche Schwellwerte für unterschiedliche Zeit zu ermöglichen (im Winter gibt es weniger Helligkeit als im Sommer um einen Raffstore zu steuern) - die Jahreszeit Sommer wird von / bis - April bis inkl. Oktober gesetzt. Standard ist immer der Sommerwert
* Anwesenheit wird aktuell nur für die Fenster genutzt, damit sich diese nicht öffnen wenn niemand daheim ist
* Temperaturen sollten klar sein ... die Vorhersagen werden noch nicht genutzt, sollen aber zukünftig für proaktive Steuerung nutzbar sein.
* Umrechnung allgemein ... die meisten Wetterstationen sollten km/h und lux liefern. Für Nutzer einer Davis kommen m/s und Watt - diese werden umgerechnet
* Helligkeitssensor in Lux
* Erstellen von verzögerten Helligkeitswerten ermöglicht z.B. eine Markise direkt bei Helligkeit auszufahren, aber erst nach einiger Zeit einzufahren (weniger nervös bei Wolken)
* Schutzfunktionen (die sind noch ein wenig Beta)
* Schutz vor Böen (sehr beta) - im Unterschied zu Wind treten diese Stark in Spitzen auf (vor allem bei uns am Haus im Sommer), somit sollten sie unterschiedlich von Wind genutzt werden, welcher langsam an- und abschwillt. Die Davis Wetterstation liefert einen separaten Wert hierfür welcher genutzt werden kann. Ein Abschwellen kann aus einer Archivvariable genutzt werden um einen längeren Zeitraum zu prüfen (sind die Böen wirklich wegen?).
* Schutz vor Frost - soll anfrieren von Raffstores verhindern, aber trotzdem ein Beschatten an sonnigen, trockenen Tag ermöglichen. Aktuell wird Frost anhand von Luftfeuchte > Schwellwert und Temp < 1 grad gesetzt
* Erkennen von Starkregen - vermutlich nur von Davis nutzern nutzbar ... hier wird die aktuelle Regenintensität ausgewertet - wird bei der Fenstersteuerung genutzt.

### Steuerung Markise
(gedacht aber nicht limitiert auf einem Wintergarten)
* Timer gesteuert ... hier reicht vermutlich ein Wert in Minuten (Sturm und Regen werden zukünftig in der Datenaufbereitung abgefangen und triggern ein Update wenn sie auftreten)
* Trigger sind Helligkeit und Sonnenstand
* Unterschiedliche Werte zum Ein- und Ausfahren (Direkt vom Sensor oder verzögert) können gesetzt werden
* Unterschiedliche Werte für Helligkeit im Sommer/Winter nutzbar
* Geprüft wird standardisiert gegen Regen und normalen Wind
* Es ist möglich die Steuerung manuell zu übersteuern und zu stoppen


### Steuerung von Raffstores
(gedacht aber nicht limitiert auf einen Wintergarten) 
* Timer gesteuert ... hier reicht vermutlich ein Wert in Minuten (Sturm und Frost werden in der Datenaufbereitung abgefangen und triggern ein Update wenn sie auftreten)
* Trigger sind Helligkeit und Sonnenstand
* Es ist möglich Werte direkt vom Sensor oder verzögert zu nutzen 
* Unterschiedliche Werte für Helligkeit im Sommer/Winter nutzbar
* Geprüft wird standardisiert gegen Sturm und Frost
* Stati sind 0 für Normal (je nachdem was das für den Einzelfall bedeutet - bei uns ist es Raffstore unten/geöffnet, bei anderen ist es evtl. oben), 1 und 2 als unterschiedliche Winkel der Lamellen, 3 geschlossen und 9 bei Sturm oder Frost um wirklich nach oben zu fahren.
* Es ist möglich die Steuerung manuell zu übersteuern und zu stoppen

## Steuerung Fenster an einem Wintergarten
(Beispiel bei uns: Wir haben oben und unten am Wintergarten Fenster die gekippt werden können und somit einen Durchzug erzeugen - bitte die Steuerung unter diesem Ansatz sehen)
* Timer gesteuert ... hier reicht vermutlich ein Wert in Minuten (Starkregen wird in der Datenaufbereitung abgefangen und triggert ein Update wenn er auftritt)
* Trigger sind Temperatur im Wintergarten, Aussentemperatur und ein Referenzsensor
* Wunschtemperatur ist z.B. via Homematic Thermostat einstellbar
* Die Fenster sehen folgende Statis vor: 0 für zu, 1 z.B. halb und 2 voll gekippt 
* Der Kippwinkel ist abhängig von der Außentemperatur oben geht recht schnell ... unten kippt erst bei einer bestimmten Temperatur um ein zu schnelles auskühlen im Winter zu verhindern
* Nutzung des Referenzsensors (zur Steigerung des WAF): Der Wintergarten wärmt sich bei Sonne recht schnell auf, allerdings befindet sich bei uns hinter dem Wintergarten das Wohnzimmer. Es soll keine Lüftung erfolgen, wenn es im Wohnzimmer noch kühler als im Wintergarten ist
* Einschränkung: Aktuell wird noch keine Hysterese unterstützt - ist aber geplant 
* Bei diesem Modul wird auch auf Anwesenheit als Schutz geprüft
* In heissen Sommernächten soll ein Lüften weiter möglich sein - dies kann aber deaktiviert werden 
* Es ist möglich die Steuerung manuell zu übersteuern und zu stoppen


## Versionshinweise

Version 1.0 (28.12.2019)
* Auswerten von Diversen Wetterdaten
* Aufbereiten von Daten
* Erkennung von Sturm, Starkregen und Frost (inkl. Bereitstellung in Variablen)
* Steuerung von Markise
* Steuerung von Raffstores am Wintergarten
* Steuerung von Fenstern am Wintergarten

Version 1.1 (03.01.2020)
* Neue Variable für die Raffstores um "In (Azimut) Bereich" auszuweisen (für Verwendung in Events)
* Ein Art Hysterese für Markise zur weiteren Reduktion der "Nervösität" - Man kann den "Auslösewert für Einfahren" künstlich erhöhen mit 1.1 für 10% mehr oder 0.9 für 10% weniger. Hilft bei Wetter im Winter, bei dem Temperaturen sehr nach bei einander liegen. 
* Diverse Buxfixes

Version 1.2 (12.01.2020)
* Benachrichtigung bei Sturmböen, Frost und Starkregen
* Eintrag ins bei Sturmböen, Frost und Starkregen
* Steuerung von Rollläden an den Gebäudeseiten basierend auf der Helligkeit
* Diverse Bugfixes vor allem bei dem Vergleichen von Werten


Generell
* Benachrichtigungen
* Bewässerung
* Dachfenster (hier ist Feedback willkommen)
* Allgemeine Beschattung des Hauses mit Rollläden (Ost Süd West)
