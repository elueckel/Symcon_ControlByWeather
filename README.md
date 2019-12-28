# Symcon Control By Weather // Kontrolle anhand von Wetterdaten

## Funktionsumfang
Das Modul löst diverse Wetterwarnungen aus. So kann z.B. ein Warnwert für Markiesen und Raffstores bereitgestellt werden oder eine Warnung bei bestimmten Wetterereignissen gesendet werden. 

## Voraussetzungen
IP-Symcon ab Version 5.x (darauf wurde entwickelt - sollte aber auch mit Version 4.x funktionieren.

## Software-Installation
Über das Modul-Control folgende URL hinzufügen.
https://github.com/elueckel/Symcon_Weatheralert

## Einrichten der Instanzen in IP-Symcon
Unter "Instanz hinzufügen" ist das 'Weatheralert'-Modul unter dem Hersteller '(Sonstige)' aufgeführt.

## Konfigurationsseite:

Windwarnung:
* Variable für Windstärke
* Auslösewert für Windstärke
* Zeitraum wie lange die Variable überschritten sein soll
* Zeit wie lange der Warnwert unterschritten sein soll bis die Warnung zurückgesetzt wird
* Variable für Notification in Symcon App (setzt Konfiguration voraus)




Daten
Hier können die Sensoren ausgewählt werden. 

Version 1.0 umfasst:
* Setzen einer Variable bei einer bestimmten Windstärke


