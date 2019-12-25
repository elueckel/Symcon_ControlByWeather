<?
if (!defined('vtBoolean')) {
    define('vtBoolean', 0);
    define('vtInteger', 1);
    define('vtFloat', 2);
    define('vtString', 3);
    define('vtArray', 8);
    define('vtObject', 9);
}



	class Control_by_Weather extends IPSModule
	{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			$this->RegisterPropertyInteger("Timer", 0);
			$this->RegisterPropertyInteger("Azimut", 0);
			$this->RegisterPropertyInteger("Elevation", 0);
			$this->RegisterPropertyInteger("OutsideTemperature", 0);
			$this->RegisterPropertyInteger("InsideTemperature", 0);
			$this->RegisterPropertyInteger("WindSpeed", 0);
			$this->RegisterPropertyString("WindConversion", "ms");
			$this->RegisterPropertyInteger("Rain_last_Hour", 0);
			$this->RegisterPropertyInteger("Rain24h", 0);
			$this->RegisterPropertyInteger("RainSensor", 0);
			$this->RegisterPropertyInteger("Presence", 0);
			$this->RegisterPropertyInteger("SolarRadiation", 0);
			$this->RegisterPropertyInteger("DelayTimeForArchiveLux1", 0);
			$this->RegisterPropertyString("RadiationConversion","Lux");
			
			$this->RegisterPropertyBoolean("StormControlEnabled", 0);
			$this->RegisterPropertyInteger("StormControlCooldownTimer", 0);
			$this->RegisterPropertyInteger("StormControlThreshold", 0);	
			$this->RegisterPropertyInteger("WindGust", 0);
			
			
			$this->RegisterPropertyInteger("TimerControlMarquee", 0);
			$this->RegisterPropertyBoolean("MarqueeManagementActive", 0);
			$this->RegisterPropertyInteger("MarqueeManagementAzimutBegin", 0);
			$this->RegisterPropertyInteger("MarqueeManagementAzimutEnd", 360);
			$this->RegisterPropertyInteger("MarqueeManagementElevation", 0);
			$this->RegisterPropertyInteger("MarqueeManagementSolarRadiationSummer", 0);
			$this->RegisterPropertyInteger("MarqueeManagementSolarRadiationWinter", 0);
			$this->RegisterPropertyString("MarqueeMoveOutMode", "Direct");
			$this->RegisterPropertyString("MarqueeMoveInMode", "Direct");
			
			$this->RegisterPropertyBoolean("MarqueeManagementUseAutomaticWinter", 0);
			$this->RegisterPropertyInteger("MarqueeManagementWindSpeedMax", 0);
			$this->RegisterPropertyBoolean("MarqueeManagementConsiderRain", 0);
			$this->RegisterPropertyBoolean("AutoSeason", 1);
			$this->RegisterPropertyInteger("SummerStart", 4);
			$this->RegisterPropertyInteger("SummerEnd", 11);

			//Component sets timer, but default is OFF
			$this->RegisterTimer("CBWDataPreparation",0,"WC_DataPrep(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWDataControlMarquee",0,"WC_ControlMarquee(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWStormCooldown",0,"WC_StormCooldown(\$_IPS['TARGET']);");
			

		}
		public function ApplyChanges()
		{
			//Never delete this line!

			parent::ApplyChanges();
		        //Timer Update - if greater than 0 = On

				$TimerMS = $this->ReadPropertyInteger("Timer") * 1000;
				$this->SetTimerInterval("CBWDataPreparation",$TimerMS);
				
				$TimerMarqueeControl = $this->ReadPropertyInteger("TimerControlMarquee") * 1000;
				$this->SetTimerInterval("CBWDataControlMarquee",$TimerMarqueeControl);
				//$StormControlActive = 0;
				//Variablen anlegen

				$vpos = 10;
				$this->RegisterVariableBoolean('AutoSeasonIsSummer', $this->Translate('Automatic season is Summer'));
				$this->MaintainVariable('ManualSeason', $this->Translate('Manual Season'), vtString, "", $vpos++, $this->ReadPropertyBoolean("AutoSeason") == 0);

				$vpos = 100;
				$this->MaintainVariable('MarqueePosition', $this->Translate('Marquee Out'), vtBoolean, "", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);
				$this->MaintainVariable('MarqueeDescision', $this->Translate('Marquee Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);
				$this->MaintainVariable('MarqueeManual', $this->Translate('Marquee Manual'), vtBoolean, "", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);


		}

		public function DataPrep()
		{

		// Set season in case Auto Season is used
			$AutoSeason = $this->ReadPropertyBoolean("AutoSeason");
			$SummerStart = $this->ReadPropertyInteger("SummerStart");
			$SummerEnd = $this->ReadPropertyInteger("SummerEnd");
			$MonthTodayForSeason = date("n");
			//$MonthTodayForSeason = '4';

			if ($AutoSeason == 1)	{
				if ($MonthTodayForSeason > $SummerEnd AND $MonthTodayForSeason >$SummerStart) {
					SetValue($this->GetIDForIdent("AutoSeasonIsSummer"), (bool)0);
					$SeasonIsSummer = 0;
					$this->SetBuffer("SeasonIsSummer", $SeasonIsSummer);
					$this->SendDebug('Auto Season is summer',$SeasonIsSummer,0);
				}
				elseif ($MonthTodayForSeason < $SummerEnd AND $MonthTodayForSeason >= $SummerStart) {
					SetValue($this->GetIDForIdent("AutoSeasonIsSummer"), (bool)1);
					$SeasonIsSummer = 1;
					$this->SetBuffer("SeasonIsSummer", $SeasonIsSummer);
					$this->SendDebug('Auto Season is summer',$SeasonIsSummer,0);
				}
			}
			elseif ($AutoSeason == 0)	{
				SetValue($this->GetIDForIdent("ManualSeason"), (string)"To be changed");
			}	
			

			// Convert Values Windspeed
			//**************************

			$WindSpeed = GetValue($this->ReadPropertyInteger("WindSpeed"));
			$WindConversion = $this->ReadPropertyString("WindConversion");

			if ($WindConversion == "ms") {
				$WindspeedKMH = $WindSpeed * 3.6;
				$this->SetBuffer("WindspeedKMH", $WindspeedKMH);
				$this->SendDebug('Wind','converted from '.$WindSpeed.' m/s to '.$WindspeedKMH.' km/h',0);				
			}
			elseif ($WindConversion == "kmh"){
				$WindspeedKMH = $WindSpeed;
				$this->SetBuffer("WindspeedKMH", $WindspeedKMH);
				$this->SendDebug('Wind','no conversion'.$WindspeedKMH.' km/h',0);
			}
			
			// Storm lockdown for shades and marquee
			// Will check for storm and call function for cooldown period
			//***********************************************************
			$StormControlEnabled = $this->ReadPropertyBoolean("StormControlEnabled");
			$StormControlTimer = $this->ReadPropertyInteger("StormControlCooldownTimer");
			$StormControlThreshold = $this->ReadPropertyInteger("StormControlThreshold");
			$StormControlGust = GetValue($this->ReadPropertyInteger("WindGust"));
			//$StormControlActive = 0;
			//$this->SetBuffer("StormControlActive", $StormControlActive);
			$StormControlActive = $this->GetBuffer("StormControlActive");
			$this->SendDebug("Stormcontrol vor setzen",$StormControlActive, 0);
			
			if ($StormControlEnabled == 1){
				if ($StormControlThreshold < $StormControlGust) {
					$this->SendDebug("Stormcontrol","++++++++++++++++++ Storm control was activated by a gust", 0);
					$StormControlActive = 1;
					$this->SetBuffer("StormControlActive", $StormControlActive);
					$StormControlMS = $StormControlTimer * 1000;
					$this->SetTimerInterval("CBWStormCooldown",$StormControlMS);
					$this->ControlMarquee();					
				}
				elseif ($StormControlThreshold > $StormControlGust AND $StormControlActive <> 1) {
					$this->SendDebug("Stormcontrol","++++++++++++++++++ No Storm detected and no current lock", 0);
					$StormControlActive = 0;
					$this->SetBuffer("StormControlActive", $StormControlActive);
					$StormControlMS = $StormControlTimer * 1000 * 60;
					$this->SetTimerInterval("CBWStormCooldown",$StormControlMS);	
				}
				elseif ($StormControlThreshold > $StormControlGust AND $StormControlActive == 1) {
					$StormControlActive = 1;
					$this->SetBuffer("StormControlActive", $StormControlActive);
					$this->SendDebug("Stormcontrol","++++++++++++++++++ current lock", 0);
				}
			}
				


			// Current - Solar Radiation preparation
			//**************************************

			$SolarRadiation = GetValue($this->ReadPropertyInteger("SolarRadiation"));
			$RadiationConversion = $this->ReadPropertyString("RadiationConversion");

			if ($RadiationConversion == "Watt")	{
				$SolarRadiationLuxCurrent = $SolarRadiation * 0.13 * 1000;
				$this->SetBuffer("SolarRadiationLuxCurrent", $SolarRadiationLuxCurrent);
				$this->SendDebug('Solarradiation Current','converted from '.$SolarRadiation.' watt to '.$SolarRadiationLuxCurrent.' lux',0);
			}
			elseif ($RadiationConversion == "Lux") {
				$SolarRadiationLuxCurrent = $SolarRadiation;
				$this->SetBuffer("SolarRadiationLuxCurrent", $SolarRadiationLuxCurrent);
				$this->SendDebug('Solarradiation Current','no conversion '.$SolarRadiationLuxCurrent.' lux',0);
			}


			// Solar Radiation Archive 1 - Solar Radiation Delayed values
			//***********************************************************
			$archiveID = IPS_GetInstanceListByModuleID('{43192F0B-135B-4CE7-A0A7-1475603F3060}')[0];
			$SolarRadiationID = $this->ReadPropertyInteger("SolarRadiation");
			$DelayTimeForArchiveLux = $this->ReadPropertyInteger("DelayTimeForArchiveLux1");

			if ($SolarRadiationID != 0 AND $archiveID != 0 AND $DelayTimeForArchiveLux > 0)	{
				$endtime = time(); // time() for "now"
				$starttime = time()-($DelayTimeForArchiveLux*60); // for n minutes ago
				$limit = 0; // kein Limit

				$buffer = AC_GetLoggedValues($archiveID, $SolarRadiationID, $starttime, $endtime, $limit);
				$anzahl = 0;
				$summe = 0;
				foreach ($buffer as $werte){
					$wert = $werte["Value"];
					$anzahl = $anzahl +1;
					$summe = $summe + $wert;
				}
				if ($anzahl > 1) {
					$SolarRadiationCalculatedDelayRaw = $summe / $anzahl;
					$this->SendDebug('Solarradiation Archive 1','Data collected from archive '.$anzahl.', total '.$summe. ', calculated average '.$SolarRadiationCalculatedDelayRaw,0);
					$RadiationConversion = $this->ReadPropertyString("RadiationConversion");
				
					if ($RadiationConversion == "Watt")	{
						$SolarRadiationLuxDelayLux1 = $SolarRadiationCalculatedDelayRaw * 0.13 * 1000;
						$this->SetBuffer("SolarRadiationLuxDelayLux1", $SolarRadiationLuxDelayLux1);
						$this->SendDebug('Solarradiation delayed value 1','converted from '.$SolarRadiationCalculatedDelayRaw.' watt to '.$SolarRadiationLuxDelayLux1.' lux',0);
					}
					elseif ($RadiationConversion == "Lux") {
						$SolarRadiationLuxDelayLux1 = $SolarRadiationCalculatedDelayRaw;
						$this->SetBuffer("SolarRadiationLuxDelayLux1", $SolarRadiationLuxDelayLux1);
						$this->SendDebug('Solarradiation delayed value 1','no conversion '.$SolarRadiationLuxDelayLux1.' Lux',0);
					}
				}
				else {
				$this->SendDebug('Solarradiation delayed value 1','It seems no archive data is available for solar radiation - Average not calculated',1);
				}
			}
			else {
			$this->SendDebug('Solarradiation delayed value 1','ERROR Light average time must at least be 1',1);
			}
			//$StormControlActiveTest = $this->GetBuffer("StormControlActive");
			//$this->SendDebug('Test','Storm Control'.$StormControlActiveTest,1);
		}
		
		public function ControlMarquee()
		{
			
			//Regensensor prüfen an/aus vs. Quell Variable
			
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$WindspeedKMH = $this->GetBuffer("WindspeedKMH");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormControlActive = $this->GetBuffer("StormControlActive");
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$MarqueeManagementAzimutBegin = $this->ReadPropertyInteger("MarqueeManagementAzimutBegin"); // 110 grad
			$MarqueeManagementAzimutEnd = $this->ReadPropertyInteger("MarqueeManagementAzimutEnd"); // 220 grad
			$MarqueeManagementElevation = $this->ReadPropertyInteger("MarqueeManagementElevation"); // 10 grad
			$MarqueeManagementSolarRadiationSummerThreshold = $this->ReadPropertyInteger("MarqueeManagementSolarRadiationSummer"); // 50000 lux
			$MarqueeManagementSolarRadiationWinterThreshold = $this->ReadPropertyInteger("MarqueeManagementSolarRadiationWinter"); // 5000 lux
			$MarqueeManagementWindSpeedMax = $this->ReadPropertyInteger("MarqueeManagementWindSpeedMax"); //20 kmh
			$MarqueeManagementMoveOutMode = $this->ReadPropertyString("MarqueeMoveOutMode"); // Direct / Delay
			$MarqueeManagementMoveInMode = $this->ReadPropertyString("MarqueeMoveOutMode"); // Direct / Delay
			
			$this->SendDebug('Marquee Control','Location Settings: System Azi '.$System_Azimuth.$MarqueeManagementAzimutBegin.' / Begin '.$MarqueeManagementAzimutBegin.' / End '.$MarqueeManagementAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$MarqueeManagementElevation,0);			
			
			$MarqueeManagementManual = GetValue($this->GetIDForIdent("MarqueeManual"));
			$this->SendDebug('Marquee Control ','Manual Override '.$MarqueeManagementManual,0);
			
			
			
			//Define if the marquee should be moved in and out based on direct or delayed values
			if ($MarqueeManagementMoveOutMode == "Direct") {
				$SolarRadiationDecisionValueOut = $SolarRadiationLuxCurrent;
			}
			elseif ($MarqueeManagementMoveOutMode == "Delay") {
				$SolarRadiationDecisionValueOut = $SolarRadiationLuxDelayLux1;
			}
			
			if ($MarqueeManagementMoveInMode == "Direct") {
				$SolarRadiationDecisionValueIn = $SolarRadiationLuxCurrent;
			}
			elseif ($MarqueeManagementMoveInMode == "Delay") {
				$SolarRadiationDecisionValueIn= $SolarRadiationLuxDelayLux1;
			}
			
			
			

			// Decide if radiation is enough to Marquee OUT
			//*************************************************

			if ($SeasonIsSummer == 0)	{
				if ($SolarRadiationLuxCurrent >= $MarqueeManagementSolarRadiationWinterThreshold)	{
					$Marquee_Move_Out = 1;
					$Marquee_Move_Out_Reason = "Sun surpased threshold for winter";
					$this->SendDebug('Marquee Control','Sun surpased threshold for winter',0);
				}
				elseif ($SolarRadiationLuxCurrent < $MarqueeManagementSolarRadiationWinterThreshold) {
					$Marquee_Move_Out = 0;
					$Marquee_Move_Out_Reason = "Sun did not surpas threshold for winter";
					$this->SendDebug('Marquee Control ','Sun did not surpas threshold for winter',0);
				}
			}
			elseif ($SeasonIsSummer == 1)	{
				if ($SolarRadiationDecisionValueIn >= $MarqueeManagementSolarRadiationSummerThreshold)	{
					$Marquee_Move_Out = 1;
					$Marquee_Move_Out_Reason = "Sun surpased threshold for summer";
					$this->SendDebug('Marquee Control','Sun surpased threshold for winter',0);
				}
				ElseIf ($SolarRadiationDecisionValueIn < $MarqueeManagementSolarRadiationSummerThreshold) {
					$Marquee_Move_Out = 0;
					$Marquee_Move_Out_Reason = "Sun did not surpas threshold for summer";
					$this->SendDebug('Marquee Control ','Sun did not surpas threshold for summer',0);
				}
			}
			
			
			
			
			//Check if Rainsensor should be used
			$RainSensor = GetValue($this->ReadPropertyInteger("RainSensor"));
			$MarqueeManagementConsiderRain = $this->ReadPropertyBoolean("MarqueeManagementConsiderRain");
			
			if ($MarqueeManagementConsiderRain == 1){
				if ($RainSensor == 1){
					$MarqueeRainBlock = 1;
				}
				elseif ($RainSensor == 0){
					$MarqueeRainBlock = 0;
				}	
			}
			else {
				$MarqueeRainBlock = 0;
			}
			
			$this->SendDebug('Test','Enter descision',1);
			
			// $MarqueeManualDisable einbauen inkl. Notification ... 
			// Direktes ausfahren einbauen
			
			if ($MarqueeManagementManual == 0) {
				if ($Marquee_Move_Out == 1) {
					if ($StormControlActive == 0) {
						$this->SendDebug('Marquee Control','OK - No Storm',0);
						if ($MarqueeRainBlock == 0){
							$this->SendDebug('Marquee Control','OK - No Rain',0);
							if ($WindspeedKMH < $MarqueeManagementWindSpeedMax) {
								$this->SendDebug('Marquee Control','OK - Wind below Threshold',0);
								if ($MarqueeManagementAzimutBegin < $System_Azimuth AND $System_Azimuth < $MarqueeManagementAzimutEnd AND $MarqueeManagementElevation < $System_Elevation) {
									$this->SendDebug('Marquee Control','Move out - all parameters in range',0);
									SetValue($this->GetIDForIdent("MarqueePosition"), 1);
									SetValue($this->GetIDForIdent("MarqueeDescision"), 'Marquee out');
								}
								else{
									$SunPositionBlock = "Sun not in right area";
									$this->SendDebug('Marquee Control','Sun not in right area (Azimut / Elevation)',0);
									SetValue($this->GetIDForIdent("MarqueePosition"), 0);
									SetValue($this->GetIDForIdent("MarqueeDescision"), 'Sun not in right area (Azimut / Elevation)');
								}
							}
							else if ($WindspeedKMH > $MarqueeManagementWindSpeedMax) {
								$RainBlockReason = "Marquee blocked by too much wind";
								$this->SendDebug('Marquee Control','Marquee blocked by too much wind',0);
								SetValue($this->GetIDForIdent("MarqueeDescision"), 'Marquee blocked by too much wind');
								SetValue($this->GetIDForIdent("MarqueePosition"), 0);
							}
						}
						else if ($MarqueeRainBlock == 1){
							$RainBlockReason = "Marquee blocked by rain";
							$this->SendDebug('Marquee Control','Marquee blocked by rain',0);
							SetValue($this->GetIDForIdent("MarqueePosition"), 0);
							SetValue($this->GetIDForIdent("MarqueeDescision"), 'Marquee blocked by rain');
						}
					}	
					else if ($StormControlActive == 1){
						$StromControlReason = "Marquee blocked by storm";
						$this->SendDebug('Marquee Control','Marquee blocked by storm gusts',0);
						SetValue($this->GetIDForIdent("MarqueePosition"), 0);
						SetValue($this->GetIDForIdent("MarqueeDescision"), 'Marquee blocked by storm gusts');
					}

				elseif($Marquee_Move_Out == 0){
					$this->SendDebug('Marquee Control','Sun threshold not reached',0);
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Sun threshold not reached');
				}
				}
			}
			elseif($MarqueeManagementManual == 1){
					$this->SendDebug('Marquee Control','Manually disabled',0);
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Manually disabled');
			}
				
		}
		
		
		public function StormCooldown()
		{
			// function to wait until storm is over
			$this->SendDebug("Stormcontrol","*********************************** Storm control was disabled", 0);
			$this->SetTimerInterval("CBWStormCooldown",0);
			$StormControlActive = 0;
			$this->SetBuffer("StormControlActive", $StormControlActive);
		}

	}
?>
