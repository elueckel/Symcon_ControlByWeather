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
			$this->RegisterPropertyInteger("Humidity", 0);
			$this->RegisterPropertyInteger("WindSpeed", 0);
			$this->RegisterPropertyString("WindConversion", "ms");
			$this->RegisterPropertyInteger("Rain_last_Hour", 0);
			$this->RegisterPropertyInteger("Rain24h", 0);
			$this->RegisterPropertyInteger("RainSensor", 0);
			$this->RegisterPropertyInteger("SystemPresence", 0);
			$this->RegisterPropertyInteger("SystemIsDay", 0);
			$this->RegisterPropertyInteger("SolarRadiation", 0);
			$this->RegisterPropertyInteger("DelayTimeForArchiveLux1", 0);
			$this->RegisterPropertyString("RadiationConversion","Lux");
			//Forecast
			$this->RegisterPropertyInteger("Forecast12h", 0);
			$this->RegisterPropertyInteger("ForecastN12h", 0);
			$this->RegisterPropertyInteger("HotNightThreshold", 0);
			//Heavy Rain
			$this->RegisterPropertyBoolean("RainIntensityActive", 0);
			$this->RegisterPropertyInteger("RainIntensity", 0);
			$this->RegisterPropertyInteger("RainIntensityThreshold", 0);
			$this->RegisterPropertyBoolean("ProvideHeavyRainVariable", 0);
			
			$this->RegisterPropertyBoolean("StormProtectionEnabled", 0);
			$this->RegisterPropertyInteger("StormProtectionCooldownTimer", 0);
			$this->RegisterPropertyInteger("StormProtectionThreshold", 0);
			$this->RegisterPropertyBoolean("StormVariableUseArchived",0);			
			$this->RegisterPropertyInteger("WindGust", 0);
			$this->RegisterPropertyBoolean("ProvideStormVariable", 0);
			$this->RegisterPropertyBoolean("FrostProtectionEnabled", 0);
			$this->RegisterPropertyInteger("HumidityThreshold", 90);
			$this->RegisterPropertyBoolean("ProvideFrostVariable", 0);
			
			
			//Marquee Variables
			$this->RegisterPropertyInteger("TimerControlMarquee", 0);
			$this->RegisterPropertyBoolean("MarqueeManagementActive", 0);
			$this->RegisterPropertyInteger("MarqueeManagementAzimutBegin", 0);
			$this->RegisterPropertyInteger("MarqueeManagementAzimutEnd", 360);
			$this->RegisterPropertyInteger("MarqueeManagementElevation", 0);
			$this->RegisterPropertyInteger("MarqueeManagementSolarRadiationSummer", 0);
			$this->RegisterPropertyInteger("MarqueeManagementSolarRadiationWinter", 0);
			$this->RegisterPropertyString("MarqueeMoveOutMode", "Direct");
			$this->RegisterPropertyString("MarqueeMoveInMode", "Direct");
			//$this->RegisterPropertyBoolean("MarqueeManagementUseAutomaticWinter", 0);
			$this->RegisterPropertyInteger("MarqueeManagementWindSpeedMax", 0);
			$this->RegisterPropertyBoolean("MarqueeManagementConsiderRain", 0);
			$this->RegisterPropertyBoolean("AutoSeason", 1);
			$this->RegisterPropertyInteger("SummerStart", 4);
			$this->RegisterPropertyInteger("SummerEnd", 11);
			$this->RegisterPropertyFloat("MarqueeManagementMoveOutFactorHysterese", 1.0);
			$this->RegisterPropertyFloat("MarqueeManagementMoveInFactorHysterese", 0.9);
			
			

			// Shutter East Variables
			$this->RegisterPropertyInteger("ShutterEastTimerControl", 0);
			$this->RegisterPropertyBoolean("ShutterEastActive", 0);
			$this->RegisterPropertyInteger("ShutterEastAzimutBegin", 0);
			$this->RegisterPropertyInteger("ShutterEastAzimutEnd", 360);
			$this->RegisterPropertyInteger("ShutterEastElevation", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationSummerDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationSummerDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationSummerDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationWinterDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationWinterDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterEastSolarRadiationWinterDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterEastTemperatureOutsideThreshold", 0);
			$this->RegisterPropertyInteger("ShutterEastTemperatureOutsideReaction", 0);
			$this->RegisterPropertyString("ShutterEastDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("ShutterEastUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("ShutterEastStormDetection", 0);
			$this->RegisterPropertyBoolean("ShutterEastFrostDetection", 0);
			
			// Shutter South Variables
			$this->RegisterPropertyInteger("ShutterSouthTimerControl", 0);
			$this->RegisterPropertyBoolean("ShutterSouthActive", 0);
			$this->RegisterPropertyInteger("ShutterSouthAzimutBegin", 0);
			$this->RegisterPropertyInteger("ShutterSouthAzimutEnd", 360);
			$this->RegisterPropertyInteger("ShutterSouthElevation", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationSummerDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationSummerDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationSummerDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationWinterDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationWinterDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthSolarRadiationWinterDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthTemperatureOutsideThreshold", 0);
			$this->RegisterPropertyInteger("ShutterSouthTemperatureOutsideReaction", 0);
			$this->RegisterPropertyString("ShutterSouthDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("ShutterSouthUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("ShutterSouthStormDetection", 0);
			$this->RegisterPropertyBoolean("ShutterSouthFrostDetection", 0);
			
			// Shutter West Variables
			$this->RegisterPropertyInteger("ShutterWestTimerControl", 0);
			$this->RegisterPropertyBoolean("ShutterWestActive", 0);
			$this->RegisterPropertyInteger("ShutterWestAzimutBegin", 0);
			$this->RegisterPropertyInteger("ShutterWestAzimutEnd", 360);
			$this->RegisterPropertyInteger("ShutterWestElevation", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationSummerDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationSummerDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationSummerDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationWinterDownShaded1Threshold", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationWinterDownShaded2Threshold", 0);
			$this->RegisterPropertyInteger("ShutterWestSolarRadiationWinterDownClosedThreshold", 0);
			$this->RegisterPropertyInteger("ShutterWestTemperatureOutsideThreshold", 0);
			$this->RegisterPropertyInteger("ShutterWestTemperatureOutsideReaction", 0);
			$this->RegisterPropertyString("ShutterWestDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("ShutterWestUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("ShutterWestStormDetection", 0);
			$this->RegisterPropertyBoolean("ShutterWestFrostDetection", 0);
			
			
			// Window Variables
			$this->RegisterPropertyInteger("WindowTimerControl", 0);
			$this->RegisterPropertyBoolean("WindowActive", 0);
			$this->RegisterPropertyInteger("WindowWintergardenTargetTemperature", 0);
			$this->RegisterPropertyInteger("WindowWintergardenTemperatureWintergarden", 0);
			$this->RegisterPropertyInteger("WindowWintergardenTemperatureReference", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenControlUpperWindows", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenControlLowerWindows", 0);
			$this->RegisterPropertyInteger("WindowWintergarden50ThresholdUpper", 0);
			$this->RegisterPropertyInteger("WindowWintergarden50ThresholdLower", 0);
			$this->RegisterPropertyInteger("WindowWintergarden100ThresholdUpper", 0);
			$this->RegisterPropertyInteger("WindowWintergarden100ThresholdLower", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenConsiderReferenceTemperature", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenDisableAtNight", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenDisableNotPresent", 0);
			$this->RegisterPropertyBoolean("WindowWintergardenDisableHeavyRain", 0);
			
			
			// Building Blinds/Shutter East Variables
			$this->RegisterPropertyInteger("BlindsEastTimerControl", 0);
			$this->RegisterPropertyBoolean("BlindsEastActive", 0);
			$this->RegisterPropertyBoolean("BlindsEastShutterMode", 0);
			$this->RegisterPropertyBoolean("BlindsEastReactOnHotDays", 0);
			$this->RegisterPropertyInteger("BlindsEastAzimutBegin", 0);
			$this->RegisterPropertyInteger("BlindsEastAzimutEnd", 360);
			$this->RegisterPropertyInteger("BlindsEastElevation", 0);
			$this->RegisterPropertyInteger("BlindsEastSolarRadiationSummerDownShadedThreshold", 0);
			$this->RegisterPropertyInteger("BlindsEastSolarRadiationWinterDownShadedThreshold", 0);
			$this->RegisterPropertyString("BlindsEastDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("BlindsEastUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("BlindsEastStormDetection", 0);
			$this->RegisterPropertyBoolean("BlindsEastFrostDetection", 0);
			
			// Building Blinds/Shutter South Variables
			$this->RegisterPropertyInteger("BlindsSouthTimerControl", 0);
			$this->RegisterPropertyBoolean("BlindsSouthActive", 0);
			$this->RegisterPropertyBoolean("BlindsSouthShutterMode", 0);
			$this->RegisterPropertyBoolean("BlindsSouthReactOnHotDays", 0);
			$this->RegisterPropertyInteger("BlindsSouthAzimutBegin", 0);
			$this->RegisterPropertyInteger("BlindsSouthAzimutEnd", 360);
			$this->RegisterPropertyInteger("BlindsSouthElevation", 0);
			$this->RegisterPropertyInteger("BlindsSouthSolarRadiationSummerDownShadedThreshold", 0);
			$this->RegisterPropertyInteger("BlindsSouthSolarRadiationWinterDownShadedThreshold", 0);
			$this->RegisterPropertyString("BlindsSouthDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("BlindsSouthUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("BlindsSouthStormDetection", 0);
			$this->RegisterPropertyBoolean("BlindsSouthFrostDetection", 0);
			
			// Building Blinds/Shutter West Variables
			$this->RegisterPropertyInteger("BlindsWestTimerControl", 0);
			$this->RegisterPropertyBoolean("BlindsWestActive", 0);
			$this->RegisterPropertyBoolean("BlindsWestShutterMode", 0);
			$this->RegisterPropertyBoolean("BlindsWestReactOnHotDays", 0);
			$this->RegisterPropertyInteger("BlindsWestAzimutBegin", 0);
			$this->RegisterPropertyInteger("BlindsWestAzimutEnd", 360);
			$this->RegisterPropertyInteger("BlindsWestElevation", 0);
			$this->RegisterPropertyInteger("BlindsWestSolarRadiationSummerDownShadedThreshold", 0);
			$this->RegisterPropertyInteger("BlindsWestSolarRadiationWinterDownShadedThreshold", 0);
			$this->RegisterPropertyString("BlindsWestDecisionMode", "Direct");
			//$this->RegisterPropertyBoolean("BlindsWestUseAutomaticWinter", 0);
			$this->RegisterPropertyBoolean("BlindsWestStormDetection", 0);
			$this->RegisterPropertyBoolean("BlindsWestFrostDetection", 0);


			
			//Notifier Options
			$this->RegisterPropertyBoolean("WriteToLog",0);
			$this->RegisterPropertyBoolean("NotificationWarning",0); //To be fill with warning messages
			

			
			//Component sets timer, but default is OFF
			$this->RegisterTimer("CBWDataPreparation",0,"WC_DataPrep(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWStormCooldown",0,"WC_StormCooldown(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlMarquee",0,"WC_ControlMarquee(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlShutterEast",0,"WC_ShutterEast(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlShutterSouth",0,"WC_ShutterSouth(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlShutterWest",0,"WC_ShutterWest(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlWindowsWintergarden",0,"WC_WindowWintergardenControl(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlBlindsEast",0,"WC_BlindsEast(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlBlindsSouth",0,"WC_BlindsSouth(\$_IPS['TARGET']);");
			$this->RegisterTimer("CBWControlBlindsWest",0,"WC_BlindsWest(\$_IPS['TARGET']);");
			

		}
		public function ApplyChanges()
		{
			//Never delete this line!

			parent::ApplyChanges();
		        
				//Var Profile Creation
				if (IPS_VariableProfileExists("CBW.Blindposition") == false) {
					IPS_CreateVariableProfile("CBW.Blindposition", 1);
					IPS_SetVariableProfileIcon("CBW.Blindposition", "Shutter");
					IPS_SetVariableProfileAssociation("CBW.Blindposition", 0, $this->Translate("Open"), "", "");
					IPS_SetVariableProfileAssociation("CBW.Blindposition", 1, $this->Translate("Shaded"), "", "");
				}
				
				if (IPS_VariableProfileExists("CBW.ShutterPosition") == false) {
					IPS_CreateVariableProfile("CBW.ShutterPosition", 1);
					IPS_SetVariableProfileIcon("CBW.ShutterPosition", "Shutter");
					IPS_SetVariableProfileAssociation("CBW.ShutterPosition", 0, $this->Translate("Open"), "", "");
					IPS_SetVariableProfileAssociation("CBW.ShutterPosition", 1, $this->Translate("Position 1"), "", "");
					IPS_SetVariableProfileAssociation("CBW.ShutterPosition", 2, $this->Translate("Position 2"), "", "");
					IPS_SetVariableProfileAssociation("CBW.ShutterPosition", 3, $this->Translate("Closed"), "", "");
					IPS_SetVariableProfileAssociation("CBW.ShutterPosition", 9, $this->Translate("Frost/Sturm Position"), "", "");
				}
				
				if (IPS_VariableProfileExists("CBW.Windows") == false) {
					IPS_CreateVariableProfile("CBW.Windows", 1);
					IPS_SetVariableProfileIcon("CBW.Windows", "Shutter");
					IPS_SetVariableProfileAssociation("CBW.Windows", 0, $this->Translate("Closed"), "", "");
					IPS_SetVariableProfileAssociation("CBW.Windows", 1, $this->Translate("Half Open"), "", "");
					IPS_SetVariableProfileAssociation("CBW.Windows", 2, $this->Translate("Open"), "", "");
				}
				
				if (IPS_VariableProfileExists("CBW.SunInArea") == false) {
					IPS_CreateVariableProfile("CBW.SunInArea", 0);
					IPS_SetVariableProfileIcon("CBW.SunInArea", "Sun");
					IPS_SetVariableProfileAssociation("CBW.SunInArea", 0, $this->Translate("No"), "", "");
					IPS_SetVariableProfileAssociation("CBW.SunInArea", 1, $this->Translate("Yes"), "", "");
				}
				
				
				
				
				
				//Timer Update - if greater than 0 = On

				$TimerMS = $this->ReadPropertyInteger("Timer") * 1000;
				$this->SetTimerInterval("CBWDataPreparation",$TimerMS);
				
				$TimerMarqueeControl = $this->ReadPropertyInteger("TimerControlMarquee") * 1000;
				$this->SetTimerInterval("CBWControlMarquee",$TimerMarqueeControl);
				
				$TimerShutterEastControl = $this->ReadPropertyInteger("ShutterEastTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlShutterEast",$TimerShutterEastControl);
				
				$TimerShutterSouthControl = $this->ReadPropertyInteger("ShutterSouthTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlShutterSouth",$TimerShutterSouthControl);
				
				$TimerShutterWestControl = $this->ReadPropertyInteger("ShutterWestTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlShutterWest",$TimerShutterWestControl);
				
				$WindowTimerControl = $this->ReadPropertyInteger("WindowTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlWindowsWintergarden",$WindowTimerControl);
				
				$TimerBlindsEastControl = $this->ReadPropertyInteger("BlindsEastTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlBlindsEast",$TimerBlindsEastControl);
				
				$TimerBlindsSouthControl = $this->ReadPropertyInteger("BlindsSouthTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlBlindsSouth",$TimerBlindsSouthControl);
				
				$TimerBlindsWestControl = $this->ReadPropertyInteger("BlindsWestTimerControl") * 1000;
				$this->SetTimerInterval("CBWControlBlindsWest",$TimerBlindsWestControl);


				$vpos = 10;
				$this->RegisterVariableBoolean('AutoSeasonIsSummer', $this->Translate('Automatic season is Summer'), 'CBW.SunInArea');
				$this->MaintainVariable('ManualSeason', $this->Translate('Manual Season'), vtString, "", $vpos++, $this->ReadPropertyBoolean("AutoSeason") == 0);
				$this->MaintainVariable('StormVariable', $this->Translate('Storm Warning'), vtBoolean, "~Alert", $vpos++, $this->ReadPropertyBoolean("ProvideStormVariable") == 1);
				$this->MaintainVariable('FrostVariable', $this->Translate('Frost Warning'), vtBoolean, "~Alert", $vpos++, $this->ReadPropertyBoolean("ProvideFrostVariable") == 1);
				$this->MaintainVariable('HeavyRainVariable', $this->Translate('Heavy Rain Warning'), vtBoolean, "~Alert", $vpos++, $this->ReadPropertyBoolean("ProvideHeavyRainVariable") == 1);

				$vpos = 100;
				$this->MaintainVariable('MarqueePosition', $this->Translate('Marquee Out'), vtBoolean, "~ShutterMove", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);
				$this->MaintainVariable('MarqueeDescision', $this->Translate('Marquee Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);
				$this->MaintainVariable('MarqueeManual', $this->Translate('Marquee Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("MarqueeManagementActive") == 1);
				
				$vpos = 200;
				$this->MaintainVariable('ShutterEastPosition', $this->Translate('Shutter East Position'), vtInteger, "CBW.ShutterPosition", $vpos++, $this->ReadPropertyBoolean("ShutterEastActive") == 1);
				$this->MaintainVariable('ShutterEastSun', $this->Translate('Shutter East Sun'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("ShutterEastActive") == 1);
				$this->MaintainVariable('ShutterEastDescision', $this->Translate('Shutter East Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("ShutterEastActive") == 1);
				$this->MaintainVariable('ShutterEastManual', $this->Translate('Shutter East Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("ShutterEastActive") == 1);
				
				$vpos = 210;
				$this->MaintainVariable('ShutterSouthPosition', $this->Translate('Shutter South Position'), vtInteger, "CBW.ShutterPosition", $vpos++, $this->ReadPropertyBoolean("ShutterSouthActive") == 1);
				$this->MaintainVariable('ShutterSouthSun', $this->Translate('Shutter South Sun'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("ShutterSouthActive") == 1);
				$this->MaintainVariable('ShutterSouthDescision', $this->Translate('Shutter South Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("ShutterSouthActive") == 1);
				$this->MaintainVariable('ShutterSouthManual', $this->Translate('Shutter South Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("ShutterSouthActive") == 1);
				
				$vpos = 220;
				$this->MaintainVariable('ShutterWestPosition', $this->Translate('Shutter West Position'), vtInteger, "CBW.ShutterPosition", $vpos++, $this->ReadPropertyBoolean("ShutterWestActive") == 1);
				$this->MaintainVariable('ShutterWestSun', $this->Translate('Shutter West Sun'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("ShutterWestActive") == 1);
				$this->MaintainVariable('ShutterWestDescision', $this->Translate('Shutter West Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("ShutterWestActive") == 1);
				$this->MaintainVariable('ShutterWestManual', $this->Translate('Shutter West Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("ShutterWestActive") == 1);
				
				$vpos = 300;
				$this->MaintainVariable('WindowUpperOpenStatus', $this->Translate('Window Open Status Upper'), vtInteger, "CBW.Windows", $vpos++, $this->ReadPropertyBoolean("WindowActive") == 1);
				$this->MaintainVariable('WindowLowerOpenStatus', $this->Translate('Window Open Status Lower'), vtInteger, "CBW.Windows", $vpos++, $this->ReadPropertyBoolean("WindowActive") == 1);
				$this->MaintainVariable('WindowDescisionUpper', $this->Translate('Window Descision Upper'), vtString, "", $vpos++, $this->ReadPropertyBoolean("WindowActive") == 1);
				$this->MaintainVariable('WindowDescisionLower', $this->Translate('Window Descision Lower'), vtString, "", $vpos++, $this->ReadPropertyBoolean("WindowActive") == 1);
				$this->MaintainVariable('WindowWintergardenManual', $this->Translate('Window Wintergarden Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("WindowActive") == 1);
				
				$vpos = 400;
				$this->MaintainVariable('BlindsEastPosition', $this->Translate('Blinds East Position'), vtInteger, "CBW.Blindposition", $vpos++, $this->ReadPropertyBoolean("BlindsEastActive") == 1);
				$this->MaintainVariable('BlindsEastSun', $this->Translate('Blinds East Sun In Execution Area'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("BlindsEastActive") == 1);
				$this->MaintainVariable('BlindsEastDescision', $this->Translate('Blinds East Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("BlindsEastActive") == 1);
				$this->MaintainVariable('BlindsEastManual', $this->Translate('Blinds East Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("BlindsEastActive") == 1);
				
				$vpos = 410;
				$this->MaintainVariable('BlindsSouthPosition', $this->Translate('Blinds South Position'), vtInteger, "CBW.Blindposition", $vpos++, $this->ReadPropertyBoolean("BlindsSouthActive") == 1);
				$this->MaintainVariable('BlindsSouthSun', $this->Translate('Blinds South Sun In Execution Area'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("BlindsSouthActive") == 1);
				$this->MaintainVariable('BlindsSouthDescision', $this->Translate('Blinds South Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("BlindsSouthActive") == 1);
				$this->MaintainVariable('BlindsSouthManual', $this->Translate('Blinds South Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("BlindsSouthActive") == 1);
				
				$vpos = 420;
				$this->MaintainVariable('BlindsWestPosition', $this->Translate('Blinds West Position'), vtInteger, "CBW.Blindposition", $vpos++, $this->ReadPropertyBoolean("BlindsWestActive") == 1);
				$this->MaintainVariable('BlindsWestSun', $this->Translate('Blinds West Sun In Execution Area'), vtBoolean, "CBW.SunInArea", $vpos++, $this->ReadPropertyBoolean("BlindsWestActive") == 1);
				$this->MaintainVariable('BlindsWestDescision', $this->Translate('Blinds West Descision'), vtString, "", $vpos++, $this->ReadPropertyBoolean("BlindsWestActive") == 1);
				$this->MaintainVariable('BlindsWestManual', $this->Translate('Blinds West Manual'), vtBoolean, "~Switch", $vpos++, $this->ReadPropertyBoolean("BlindsWestActive") == 1);
				
				

		}

		public function DataPrep()
		{

		$this->SendDebug('Data Preperation',"+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++", 0);
		
		$NotificationWarning = $this->ReadPropertyBoolean("NotificationWarning");
		$WriteToLog = $this->ReadPropertyBoolean("WriteToLog");
		
		// Set season in case Auto Season is used
			$AutoSeason = $this->ReadPropertyBoolean("AutoSeason");
			$SummerStart = $this->ReadPropertyInteger("SummerStart");
			$SummerEnd = $this->ReadPropertyInteger("SummerEnd");
			$MonthTodayForSeason = date("n");
			//$MonthTodayForSeason = '4';

			if ($AutoSeason == 1)	{
				if (($MonthTodayForSeason > $SummerEnd) AND ($MonthTodayForSeason > $SummerStart)) {
					SetValue($this->GetIDForIdent("AutoSeasonIsSummer"), (bool)0);
					$SeasonIsSummer = 0;
					$this->SetBuffer("SeasonIsSummer", $SeasonIsSummer);
					$this->SendDebug('Data Preperation','Auto Season is summer '.$SeasonIsSummer,0);
				}
				elseif (($MonthTodayForSeason < $SummerEnd) AND ($MonthTodayForSeason >= $SummerStart)) {
					SetValue($this->GetIDForIdent("AutoSeasonIsSummer"), (bool)1);
					$SeasonIsSummer = 1;
					$this->SetBuffer("SeasonIsSummer", $SeasonIsSummer);
					$this->SendDebug('Data Preperation','Auto Season is summer '.$SeasonIsSummer,0);
				}
			}
			elseif ($AutoSeason == 0)	{
				SetValue($this->GetIDForIdent("ManualSeason"), (string)"To be changed");
				$this->SendDebug('Data Preperation','Auto Season is not used - Summer Value for Lux threshold is used',0);
				$SeasonIsSummer = 1;
			}	
			

			// Convert Values Windspeed
			//**************************

			$WindSpeed = GetValue($this->ReadPropertyInteger("WindSpeed"));
			$WindConversion = $this->ReadPropertyString("WindConversion");

			if ($WindConversion == "ms") {
				$WindspeedKMH = $WindSpeed * 3.6;
				$this->SetBuffer("WindspeedKMH", $WindspeedKMH);
				$this->SendDebug('Data Preperation','Wind converted from '.$WindSpeed.' m/s to '.$WindspeedKMH.' km/h',0);				
			}
			elseif ($WindConversion == "kmh"){
				$WindspeedKMH = $WindSpeed;
				$this->SetBuffer("WindspeedKMH", $WindspeedKMH);
				$this->SendDebug('Data Preperation','Wind - no conversion needed'.$WindspeedKMH.' km/h',0);
			}
			
			//in case storm protection is activated values get configured here
			$StormProtectionEnabled = $this->ReadPropertyBoolean("StormProtectionEnabled");
			if ($StormProtectionEnabled == 1){
				$WindGust = GetValue($this->ReadPropertyInteger("WindGust"));
				$WindConversion = $this->ReadPropertyString("WindConversion");

				if ($WindConversion == "ms") {
					$StormProtectionGustKMH = $WindGust * 3.6;
					$this->SetBuffer("StormProtectionGustKMH", $StormProtectionGustKMH);
					$this->SendDebug('Data Preperation','Wind converted from '.$WindGust.' m/s to '.$StormProtectionGustKMH.' km/h',0);				
				}
				elseif ($WindConversion == "kmh"){
					$StormProtectionGustKMH = $WindGust;
					$this->SetBuffer("StormProtectionGustKMH", $StormProtectionGustKMH);
					$this->SendDebug('Data Preperation','Wind - no conversion needed'.$StormProtectionGustKMH.' km/h',0);
				}
			}
			
			
			// Storm lockdown for shades and marquee
			// Will check for storm and call function for cooldown period
			//***********************************************************
			$StormProtectionEnabled = $this->ReadPropertyBoolean("StormProtectionEnabled");
			$ProvideStormVariable = $this->ReadPropertyBoolean("ProvideStormVariable");
			$StormProtectionTimer = $this->ReadPropertyInteger("StormProtectionCooldownTimer");
			$StormProtectionThreshold = $this->ReadPropertyInteger("StormProtectionThreshold");
			$StormProtectionGust = $StormProtectionGustKMH;
			$StormVariableUseArchived = $this->ReadPropertyBoolean("StormVariableUseArchived");
			//$StormProtectionActive = 0;
			//$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive");
			//$this->SendDebug("Data Preperation","StormProtection vor setzen ".$StormProtectionActive, 0);
			// Warnungen
			$StormNotification = $this->GetBuffer("StormNotification");
			if (empty ($StormNotification)) {
				$StormNotification = 0;
			}
			$StormLogging = $this->GetBuffer("StormLogging");
			if (empty ($StormLogging)) {
				$StormLogging = 0;
			}
			
			
			
			if ($StormProtectionEnabled == 1){
				if (($StormProtectionThreshold < $StormProtectionGust) AND $StormProtectionActive == 0 ) {
					$this->SendDebug("StormProtection","++++++++++++++++++ Storm control was activated by a gust", 0);
					$StormProtectionActive = 1;
					SetValue($this->GetIDForIdent("StormVariable"), 1);
					$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
					$StormProtectionMS = $StormProtectionTimer * 1000;
					$this->SetTimerInterval("CBWStormCooldown",$StormProtectionMS);
					if ($ProvideStormVariable == 1){
						SetValue($this->GetIDForIdent("StormVariable"), 1);
					}
					// Warnungen
					if ($NotificationWarning == 1 AND $StormNotification ==	0){
						$this->SetBuffer("NotifierTitle", "Wetter Warnung");
						$this->SetBuffer("NotifierMessage", "Starke Sturmböen wurden erkannt ".$StormProtectionGust." km/h");
						$this->CBWNotifyApp();
						$StormNotification = 1;
						$this->SetBuffer("StormNotification", 1);
												
					}
					if ($WriteToLog == 1 AND $StormLogging == 0){
						IPS_LogMessage("Control by Weather", "Starke Sturmböen wurden erkannt ".$StormProtectionGust." km/h");
						$StormLogging = 1;
						$this->SetBuffer("StormLogging", 1);
												
					}				
				}
				// check if storm is still there 
				else if (($StormProtectionThreshold < $StormProtectionGust) AND $StormProtectionActive == 1) {
					
					//check if archived value should be used 
					if ($StormVariableUseArchived == 1){
					$archiveID = IPS_GetInstanceListByModuleID('{43192F0B-135B-4CE7-A0A7-1475603F3060}')[0];
					$GustID = $this->ReadPropertyInteger("WindGust");
					$DelayTimeForGust = 5;

						if ($GustID != 0 AND $archiveID != 0 AND $DelayTimeForGust > 0)	{
							$endtime = time(); // time() for "now"
							$starttime = time()-($DelayTimeForGust*60); // for n minutes ago
							$limit = 0; // kein Limit

							$buffer = AC_GetLoggedValues($archiveID, $GustID, $starttime, $endtime, $limit);
							$anzahl = 0;
							$summe = 0;
							foreach ($buffer as $werte){
								$wert = $werte["Value"];
								$anzahl = $anzahl +1;
								$summe = $summe + $wert;
							}
							if ($anzahl > 1) {
								$GustDelayRaw = $summe / $anzahl;
								$this->SendDebug('Data Preperation','Gust delayed value for 5 minutes - Records collected from archive '.$anzahl.', totaling '.$summe.', calculated average '.$GustDelayRaw,0);
								
								$WindConversion = $this->ReadPropertyString("WindConversion");
								//check on kmh or m/s and convert
								if ($WindConversion == "ms") {
									$StormProtectionGustKMH = $GustDelayRaw * 3.6;
									$this->SetBuffer("StormProtectionGustKMH", $StormProtectionGustKMH);
									$this->SendDebug('Data Preperation','Gusts converted from '.$GustDelayRaw.' m/s to '.$StormProtectionGustKMH.' km/h',0);
									// check if storm is still there
									if ($StormProtectionThreshold < $StormProtectionGustKMH) {
										$this->SendDebug("StormProtection","++++++++ Storm protection uses archived value found storm", 0);
										$StormProtectionActive = 1;
										SetValue($this->GetIDForIdent("StormVariable"), 1);
										$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
										$StormProtectionMS = $StormProtectionTimer * 1000;
										$this->SetTimerInterval("CBWStormCooldown",$StormProtectionMS);	
									}
								}
								elseif ($WindConversion == "kmh"){
									$StormProtectionGustKMH = $GustDelayRaw;
									$this->SetBuffer("StormProtectionGustKMH", $StormProtectionGustKMH);
									$this->SendDebug('Data Preperation','Gusts - no conversion needed'.$StormProtectionGustKMH.' km/h',0);
									// check if storm is still there
									if ($StormProtectionThreshold < $StormProtectionGustKMH) {
										$this->SendDebug("StormProtection","++++++++ Storm protection uses archived value found storm", 0);
										$StormProtectionActive = 1;
										SetValue($this->GetIDForIdent("StormVariable"), 1);
										$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
										$StormProtectionMS = $StormProtectionTimer * 1000;
										$this->SetTimerInterval("CBWStormCooldown",$StormProtectionMS);	
									}
								}
								//else {
								//$this->SendDebug('Data Preperation','Gust normalization - It seems no archive data is available for gusts - Average not calculated',1);
								//}
							}
						}
						elseif ($StormVariableUseArchived == 0){
							$this->SendDebug("StormProtection","+++++++++++ Storm control using not archived value and found storm", 0);
							$StormProtectionActive = 1;
							SetValue($this->GetIDForIdent("StormVariable"), 1);
							$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
							$StormProtectionMS = $StormProtectionTimer * 1000;
							$this->SetTimerInterval("CBWStormCooldown",$StormProtectionMS);	
						}	
					}
				}
				elseif ($StormProtectionThreshold > $StormProtectionGust AND $StormProtectionActive <> 1) {
					$this->SendDebug("StormProtection","++++++++++++++++++ No Storm detected and no current lock", 0);
					$StormProtectionActive = 0;
					if ($ProvideStormVariable == 1){
						SetValue($this->GetIDForIdent("StormVariable"), $StormProtectionActive);
					}
					$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
					$StormProtectionMS = $StormProtectionTimer * 1000;
					$this->SetTimerInterval("CBWStormCooldown",$StormProtectionMS);	
				}
				elseif ($StormProtectionThreshold > $StormProtectionGust AND $StormProtectionActive == 1) {
					$this->SendDebug("StormProtection","++++++++++++++++++ current lock", 0);
				}
			}

			// Current - Solar Radiation preparation
			//**************************************

			$SolarRadiation = GetValue($this->ReadPropertyInteger("SolarRadiation"));
			$RadiationConversion = $this->ReadPropertyString("RadiationConversion");

			if ($RadiationConversion == "Watt")	{
				$SolarRadiationLuxCurrent = $SolarRadiation * 0.13 * 1000;
				$this->SetBuffer("SolarRadiationLuxCurrent", $SolarRadiationLuxCurrent);
				$this->SendDebug('Data Preperation','Light (Solarradiation) converted from '.$SolarRadiation.' watt to '.$SolarRadiationLuxCurrent.' lux',0);
			}
			elseif ($RadiationConversion == "Lux") {
				$SolarRadiationLuxCurrent = $SolarRadiation;
				$this->SetBuffer("SolarRadiationLuxCurrent", $SolarRadiationLuxCurrent);
				$this->SendDebug('Data Preperation','Light (Solarradiation) no conversion needed '.$SolarRadiationLuxCurrent.' lux',0);
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
					$this->SendDebug('Data Preperation','Solarradiation Archive 1 - Records collected from archive '.$anzahl.', totaling '.$summe.', calculated average '.$SolarRadiationCalculatedDelayRaw,0);
					$RadiationConversion = $this->ReadPropertyString("RadiationConversion");
				
					if ($RadiationConversion == "Watt")	{
						$SolarRadiationLuxDelayLux1 = $SolarRadiationCalculatedDelayRaw * 0.13 * 1000;
						$this->SetBuffer("SolarRadiationLuxDelayLux1", $SolarRadiationLuxDelayLux1);
						$this->SendDebug('Data Preperation','Solarradiation Archive 1 - Value converted from '.$SolarRadiationCalculatedDelayRaw.' watt to '.$SolarRadiationLuxDelayLux1.' lux',0);
					}
					elseif ($RadiationConversion == "Lux") {
						$SolarRadiationLuxDelayLux1 = $SolarRadiationCalculatedDelayRaw;
						$this->SetBuffer("SolarRadiationLuxDelayLux1", $SolarRadiationLuxDelayLux1);
						$this->SendDebug('Data Preperation','Solarradiation Archive 1 - No conversion needed'.$SolarRadiationLuxDelayLux1.' Lux',0);
					}
				}
				else {
				$this->SendDebug('Data Preperation','Light (Solarradiation) - It seems no archive data is available for solar radiation - Average not calculated',1);
				}
			}
			else {
			$this->SendDebug('Data Preperation','Solarradiation delayed value 1 - ERROR Light average time must at least be 1',1);
			}
			
			// Frost detection 0 degree and humidity over x%
			$FrostProtectionEnabled = $this->ReadPropertyBoolean("FrostProtectionEnabled");
			$OutsideTemperature = GetValue($this->ReadPropertyInteger("OutsideTemperature"));
			$Humidity = GetValue($this->ReadPropertyInteger("Humidity"));
			$HumidityThreshold = $this->ReadPropertyInteger("HumidityThreshold");
			$ProvideFrostVariable = $this->ReadPropertyBoolean("ProvideFrostVariable");
			$FrostNotification = $this->GetBuffer("FrostNotification");
			if (empty ($FrostNotification)) {
				$FrostNotification = 0;
			}
			$FrostLogging = $this->GetBuffer("FrostLogging");
			if (empty ($FrostLogging)) {
				$FrostLogging = 0;
			}
			
			
			if ($FrostProtectionEnabled == 1){
				if (($OutsideTemperature <= 1) AND ($Humidity > $HumidityThreshold)) {
					$FrostActive = 1;
					$this->SetBuffer("FrostActive", $FrostActive);
					$this->SendDebug("Data Preperation","Frost Protection - frost detected and warning set / Outside Temperature ".$OutsideTemperature." / Humidity ".$Humidity." / Threshold ".$HumidityThreshold, 0);
					if ($ProvideFrostVariable == 1){
						SetValue($this->GetIDForIdent("FrostVariable"), 1);
					}
					if ($NotificationWarning == 1 AND $FrostNotification ==	0){
						$this->SetBuffer("NotifierTitle", "Wetter Warnung");
						$this->SetBuffer("NotifierMessage", "Frost Schutz wurde ausgelöst / Aussentemperatur ".$OutsideTemperature." / Luftfeuchte ".$Humidity." / Warnwert ".$HumidityThreshold);
						$this->CBWNotifyApp();
						$FrostNotification = 1;
						$this->SetBuffer("FrostNotification", 1);
												
					}
					if ($WriteToLog == 1 AND $FrostLogging == 0){
						IPS_LogMessage("Control by Weather", "Frost Schutz wurde ausgelöst / Aussentemperatur ".$OutsideTemperature." / Luftfeuchte ".$Humidity." / Warnwert ".$HumidityThreshold);
						$FrostLogging = 1;
						$this->SetBuffer("FrostLogging", 1);
												
					}
				}				
				elseif (($OutsideTemperature > 0) OR (($OutsideTemperature <= 1) AND ($Humidity <= $HumidityThreshold))) {
					$FrostActive = 0;
					$this->SetBuffer("FrostActive", $FrostActive);
					$this->SendDebug("Data Preperation","Frost Protection - no frost / Outside Temperature ".$OutsideTemperature." / Humidity ".$Humidity." / Threshold ".$HumidityThreshold, 0);
					if ($ProvideFrostVariable == 1){
						SetValue($this->GetIDForIdent("FrostVariable"), 0);
					}
					if ($NotificationWarning == 1 AND $FrostNotification ==	1){
						$this->SetBuffer("NotifierTitle", "Wetter Warnung");
						$this->SetBuffer("NotifierMessage", "Frost Schutz wurde aufgehoben");
						$this->CBWNotifyApp();
						$FrostNotification = 0;
						$this->SetBuffer("FrostNotification", 0);
												
					}
					if ($WriteToLog == 1 AND $FrostLogging == 1){
						IPS_LogMessage("Control by Weather", "Frost Schutz wurde aufgehoben");
						$FrostLogging = 0;
						$this->SetBuffer("FrostLogging", 0);
												
					}
				}
				
			}
			else if ($FrostProtectionEnabled == 0){
				$FrostActive = 0;
				$this->SetBuffer("FrostActive", $FrostActive);
			}
			
			
			//Heavy rain detection
			$RainIntensityActive = $this->ReadPropertyBoolean("RainIntensityActive");
			$RainIntensity = GetValue($this->ReadPropertyInteger("RainIntensity"));
			$RainIntensityThreshold = $this->ReadPropertyInteger("RainIntensityThreshold");
			$ProvideHeavyRainVariable = $this->ReadPropertyBoolean("ProvideHeavyRainVariable");
			$HeavyRainNotification = $this->GetBuffer("HeavyRainNotification");
			if (empty ($HeavyRainNotification)) {
				$HeavyRainNotification = 0;
			}
			$HeavyRainLogging = $this->GetBuffer("HeavyRainLogging");
			if (empty ($HeavyRainLogging)) {
				$HeavyRainLogging = 0;
			}
			
			
			if ($RainIntensityActive == 1){
				if (($RainIntensity > $RainIntensityThreshold)) {
					$HeavyRainDetected = 1;
					$this->SetBuffer("HeavyRainProtectionActive", $HeavyRainDetected);
					$this->SendDebug("Data Preperation","Heavy Rain Protection - Detected, raining with ".$RainIntensity." l/m", 0);
					if ($ProvideHeavyRainVariable == 1){
						SetValue($this->GetIDForIdent("HeavyRainVariable"), 1);
					}
					if ($NotificationWarning == 1 AND $HeavyRainNotification ==	0){
						$this->SetBuffer("NotifierTitle", "Wetter Warnung");
						$this->SetBuffer("NotifierMessage", "Starkregen wurde erkannt mit ".$RainIntensity." l/m");
						$this->CBWNotifyApp();
						$HeavyRainNotification = 1;
						$this->SetBuffer("HeavyRainNotification", 1);
												
					}
					if ($WriteToLog == 1 AND $HeavyRainLogging == 0){
						IPS_LogMessage("Control by Weather", "Starkregen erkannt mit ".$RainIntensity." l/m");
						$HeavyRainLogging = 1;
						$this->SetBuffer("HeavyRainLogging", 1);
												
					}
				}
				elseif ($RainIntensity <= $RainIntensityThreshold) {
					$HeavyRainDetected = 0;
					$this->SetBuffer("HeavyRainProtectionActive", $HeavyRainDetected);
					$this->SendDebug("Data Preperation","Heavy Rain Protection - Nothing detected", 0);
					if ($ProvideHeavyRainVariable == 1){
						SetValue($this->GetIDForIdent("HeavyRainVariable"), 0);
					}
					if ($NotificationWarning == 1 AND $HeavyRainNotification == 1){
						$this->SetBuffer("NotifierTitle", "Wetter Warnung");
						$this->SetBuffer("NotifierMessage", "Warnung für Starkregen ist aufgehoben");
						$this->CBWNotifyApp();
						$HeavyRainNotification = 0;
						$this->SetBuffer("HeavyRainNotification", 0);
												
					}
					if ($WriteToLog == 1 AND $HeavyRainLogging == 1){
						IPS_LogMessage("Control by Weather", "Warnung für Starkregen ist aufgehoben");
						$HeavyRainLogging = 0;
						$this->SetBuffer("HeavyRainLogging", 0);
												
					}
				}
				
			}
			else if ($RainIntensityActive == 0){
				$HeavyRainDetected = 0;
				$this->SetBuffer("HeavyRainProtectionActive", $HeavyRainDetected);
			}
			
			
			
			
		}
		
		// Function to reset "Storm status" after x minutes to avoid ongoing triggering due to gusts
		
		public function StormCooldown()
		{
			// function to wait until storm is over
			$this->SendDebug("StormProtection","+++ Storm control was disabled", 0);
			$this->SetTimerInterval("CBWStormCooldown",0);
			$StormProtectionActive = 0;
			$this->SetBuffer("StormProtectionActive", $StormProtectionActive);
			//if ($ProvideStormVariable == 1){
						SetValue($this->GetIDForIdent("StormVariable"), 0);
			//		}
			// Warnungen
			
			$StormNotification = $this->GetBuffer("StormNotification");
			$StormLogging = $this->GetBuffer("StormLogging");
			
			$this->SetBuffer("NotifierTitle", "Wetter Warnung");
			$this->SetBuffer("NotifierMessage", "Es wurden keine Sturmböen mehr erkannt");
			$this->CBWNotifyApp();
			$StormNotification = 0;
			$this->SetBuffer("StormNotification", 0);
										
			IPS_LogMessage("Control by Weather", "Es wurden keine Sturmböen mehr erkannt");
			$StormLogging = 0;
			$this->SetBuffer("StormLogging", 0);
						
		}
		
		public function CBWNotifyApp()
		{
			$NotifierTitle = $this->GetBuffer("NotifierTitle");
			$NotifierMessage = $this->GetBuffer("NotifierMessage");
			//NotifierTitle - NotifierMessage
			//$WebFrontMobile = $this->ReadPropertyInteger("WebFrontMobile");
			$WebFrontMobile = IPS_GetInstanceListByModuleID('{3565B1F2-8F7B-4311-A4B6-1BF1D868F39E}')[0];
			
			
			// to send notifications
			$this->SendDebug("Notifier","********** App Notifier **********", 0);
			$this->SendDebug("Notifier","Message: ".$NotifierMessage." was sent", 0);			
			WFC_PushNotification($WebFrontMobile, $NotifierTitle, $NotifierMessage , "buzzer", 0);
		}
		
		
		
		
		public function ControlMarquee()
		{
			
			$this->SendDebug('Marquee Control','*************************** Marquee Control Begin ***************************',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$WindspeedKMH = $this->GetBuffer("WindspeedKMH");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive");
			
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
			$MarqueeManagementMoveInHystereseFactor = $this->ReadPropertyFloat("MarqueeManagementMoveInFactorHysterese");
			$MarqueeManagementMoveOutHystereseFactor = $this->ReadPropertyFloat("MarqueeManagementMoveOutFactorHysterese");
			
			$this->SendDebug('Marquee Control','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$MarqueeManagementAzimutBegin.' / End '.$MarqueeManagementAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$MarqueeManagementElevation,0);			
			
			$MarqueeManagementManual = GetValue($this->GetIDForIdent("MarqueeManual"));
			//$this->SendDebug('Marquee Control ','Manual Override '.$MarqueeManagementManual,0);
			
			
			
			//Define if the marquee should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($MarqueeManagementMoveOutMode == "Direct") {
				$SolarRadiationDecisionValueOut = ($SolarRadiationLuxCurrent * $MarqueeManagementMoveOutHystereseFactor);
			}
			elseif ($MarqueeManagementMoveOutMode == "Delay") {
				$SolarRadiationDecisionValueOut = ($SolarRadiationLuxDelayLux1 * $MarqueeManagementMoveOutHystereseFactor);
			}
			
			if ($MarqueeManagementMoveInMode == "Direct") {
				$SolarRadiationDecisionValueIn = ($SolarRadiationLuxCurrent * $MarqueeManagementMoveInHystereseFactor);
			}
			elseif ($MarqueeManagementMoveInMode == "Delay") {
				$SolarRadiationLuxDelayLux1 = ($SolarRadiationLuxDelayLux1 * $MarqueeManagementMoveInHystereseFactor);
			}
			
			
			

			// Decide if radiation is enough to Marquee OUT
			//*********************************************

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
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Sun threshold not reached - no shading needed');
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
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Sun threshold not reached - no shading needed');
				}
			}
			
			
			//Check if Rainsensor should be used
			//**********************************
			
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
			
			//Check on manual override, rain, wind, storm and decide to move out
			//******************************************************************
			
			if ($MarqueeManagementManual == 0) {
				if ($Marquee_Move_Out == 1) {
					if ($StormProtectionActive == 0) {
						$this->SendDebug('Marquee Control','OK - No Storm',0);
						if ($MarqueeRainBlock == 0){
							$this->SendDebug('Marquee Control','OK - No Rain',0);
							if ($WindspeedKMH < $MarqueeManagementWindSpeedMax) {
								$this->SendDebug('Marquee Control','OK - Wind below Threshold',0);
								if ($MarqueeManagementAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $MarqueeManagementAzimutEnd AND $MarqueeManagementElevation <= $System_Elevation) {
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
					else if ($StormProtectionActive == 1){
						$StromControlReason = "Marquee blocked by storm";
						$this->SendDebug('Marquee Control','Marquee blocked by storm gusts',0);
						SetValue($this->GetIDForIdent("MarqueePosition"), 0);
						SetValue($this->GetIDForIdent("MarqueeDescision"), 'Marquee blocked by storm gusts');
					}
				}
				elseif($Marquee_Move_Out == 0){
					$this->SendDebug('Marquee Control','Sun threshold not reached',0);
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Sun threshold not reached');
					SetValue($this->GetIDForIdent("MarqueePosition"), 0);
				}
			}
			elseif($MarqueeManagementManual == 1){
					$this->SendDebug('Marquee Control','Manually disabled',0);
					SetValue($this->GetIDForIdent("MarqueeDescision"), 'Manually disabled');
			}
		
		}
				
		
		public function ShutterEast()
		{
			// function to wait until storm is over
			$this->SendDebug('Shutter Control East','************************* Shutter East Control Begin *************************',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$ShutterEastAzimutBegin = $this->ReadPropertyInteger("ShutterEastAzimutBegin"); // 110 grad
			$ShutterEastAzimutEnd = $this->ReadPropertyInteger("ShutterEastAzimutEnd"); // 220 grad
			$ShutterEastElevation = $this->ReadPropertyInteger("ShutterEastElevation"); // 10 grad
			
			$ShutterEastSolarRadiationSummerDownShaded1Threshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationSummerDownShaded1Threshold"); // >25000 lux
			$ShutterEastSolarRadiationSummerDownShaded2Threshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationSummerDownShaded2Threshold"); // >50000 lux
			$ShutterEastSolarRadiationSummerDownClosedThreshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationSummerDownClosedThreshold"); // >75000 lux
			
			$ShutterEastSolarRadiationWinterDownShaded1Threshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationWinterDownShaded1Threshold"); // >25000 lux
			$ShutterEastSolarRadiationWinterDownShaded2Threshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationWinterDownShaded2Threshold"); // >50000 lux
			$ShutterEastSolarRadiationWinterDownClosedThreshold = $this->ReadPropertyInteger("ShutterEastSolarRadiationWinterDownClosedThreshold"); // >75000 lux
			
			$ShutterEastTemperatureOutsideThreshold = $this->ReadPropertyInteger("ShutterEastTemperatureOutsideThreshold"); // > Closes Shutter
			$ShutterEastTemperatureOutsideReaction = $this->ReadPropertyInteger("ShutterEastTemperatureOutsideReaction"); // > Zu, Kipp, Nichts
						
			//$ShutterEastStormDetection = $this->ReadPropertyString("ShutterEastStormDetection"); // 0 or 1
			//$ShutterEastFrostDetection = $this->ReadPropertyString("ShutterEastFrostDetection"); // 0 or 1
			
			$ShutterEastDecisionMode = $this->ReadPropertyString("MarqueeMoveOutMode"); // Direct / Delay
			
			$ShutterEastHotDayForecast = $this->ReadPropertyString("MarqueeMoveOutMode"); // 0 or 1
			
			$this->SendDebug('Shutter Control East','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$ShutterEastAzimutBegin.' / End '.$ShutterEastAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$ShutterEastElevation,0);			
			
			$ShutterEastManual = GetValue($this->GetIDForIdent("ShutterEastManual"));
			$this->SendDebug('Shutter Control East','Manual Override '.$ShutterEastManual,0);
			
			
			
			//Define if the shutter should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($ShutterEastDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($ShutterEastDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$ShutterEastSolarRadiationDownShaded1Threshold = $ShutterEastSolarRadiationWinterDownShaded1Threshold;
				$ShutterEastSolarRadiationDownShaded2Threshold = $ShutterEastSolarRadiationWinterDownShaded2Threshold;
				$ShutterEastSolarRadiationDownClosedThreshold = $ShutterEastSolarRadiationWinterDownClosedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$ShutterEastSolarRadiationDownShaded1Threshold = $ShutterEastSolarRadiationSummerDownShaded1Threshold;
				$ShutterEastSolarRadiationDownShaded2Threshold = $ShutterEastSolarRadiationSummerDownShaded2Threshold;
				$ShutterEastSolarRadiationDownClosedThreshold = $ShutterEastSolarRadiationSummerDownClosedThreshold;
			}
			

			// Decide what to do with the shutter based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $ShutterEastSolarRadiationDownShaded1Threshold){
				$ShutterEastPosition = 0;
				$ShutterEastPositionReason = "Open";
				$this->SendDebug('Shutter Control East','Position: Open - Current light // Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$ShutterEastSolarRadiationDownShaded1Threshold,0);
			}			
			else if (($SolarRadiationDecisionValueLux >= $ShutterEastSolarRadiationDownShaded1Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterEastSolarRadiationDownShaded2Threshold)) { // 0 lux - 35000 lux
				$ShutterEastPosition = 1;
				$ShutterEastPositionReason = "Shading Level 1";
				$this->SendDebug('Shutter Control East','Position: Shading Level 1 - Current light Current light // '.$SolarRadiationDecisionValueLux.' > threshold for level 1: '.$ShutterEastSolarRadiationDownShaded1Threshold.' and < threshold for level 2: '.$ShutterEastSolarRadiationDownShaded2Threshold,0);
			}
			else if (($SolarRadiationDecisionValueLux >= $ShutterEastSolarRadiationDownShaded2Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterEastSolarRadiationDownClosedThreshold)) { // 35000 lux - 75000
				$ShutterEastPosition = 2;
				$ShutterEastPositionReason = "Shading Level 2";
				$this->SendDebug('Shutter Control East','Position: Shading Level 2 - Current light // Current light '.$SolarRadiationDecisionValueLux.' > threshold for level 2: '.$ShutterEastSolarRadiationDownShaded2Threshold.' and < threshold for closed: '.$ShutterEastSolarRadiationDownClosedThreshold,0);
			}
			else if ($SolarRadiationDecisionValueLux >= $ShutterEastSolarRadiationDownClosedThreshold) { // >75000 lux
				$ShutterEastPosition = 3;
				$ShutterEastPositionReason = "Shading Level 3 - Closed";
				$this->SendDebug('Shutter Control East','Position: Shading Level 3 - Closed // Current light '.$SolarRadiationDecisionValueLux.' > threshold for closed '.$ShutterEastSolarRadiationDownClosedThreshold,0);
			}
				
						
			//Check on manual override, storm and decide the position
			//******************************************************************
			
			if ($ShutterEastManual == 0) {
				if ($StormProtectionActive == 0) {
					$this->SendDebug('Shutter Control East','OK - No Storm',0);
					if ($FrostActive == 0) { //Must noch erstellt werden !!!!
						$this->SendDebug('Shutter Control East','OK - No Frost',0);
							if ($ShutterEastAzimutBegin < $System_Azimuth AND $System_Azimuth < $ShutterEastAzimutEnd AND $ShutterEastElevation < $System_Elevation) {
								SetValue($this->GetIDForIdent("ShutterEastPosition"), $ShutterEastPosition);
								SetValue($this->GetIDForIdent("ShutterEastDescision"), $ShutterEastPositionReason);
								SetValue($this->GetIDForIdent("ShutterEastSun"), 1);
								$this->SendDebug('Shutter Control East',$ShutterEastPositionReason,0);
							}
							else{
								SetValue($this->GetIDForIdent("ShutterEastDescision"), 'Sun not in right area (Azimut / Elevation)');
								$this->SendDebug('Shutter Control East','Sun not in right area (Azimut / Elevation)',0);
								SetValue($this->GetIDForIdent("ShutterEastPosition"), 0);
								SetValue($this->GetIDForIdent("ShutterEastSun"), 0);
							}
						}	
					else if ($FrostActive == 1){
						$this->SendDebug('Shutter Control East','Shutter move to: Up - Frost detected',0);
						SetValue($this->GetIDForIdent("ShutterEastDescision"), 'Blocked by frost');
						SetValue($this->GetIDForIdent("ShutterEastPosition"), 9);
					}
				}
				elseif($StormProtectionActive == 1){
					$this->SendDebug('Shutter Control East','Shutter move to: Up - Storm',0);
					SetValue($this->GetIDForIdent("ShutterEastDescision"), 'Blocked by storm');
					SetValue($this->GetIDForIdent("ShutterEastPosition"), 9);
				}
			}
			elseif($ShutterEastManual == 1){
					$this->SendDebug('Shutter Control East','Manually disabled',0);
					SetValue($this->GetIDForIdent("ShutterEastDescision"), 'Manually disabled');
			}
			
		}
		
		public function ShutterSouth()
		{
			// function to wait until storm is over
			$this->SendDebug('Shutter Control South','************************* Shutter South Control Begin *************************',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$ShutterSouthAzimutBegin = $this->ReadPropertyInteger("ShutterSouthAzimutBegin"); // 110 grad
			$ShutterSouthAzimutEnd = $this->ReadPropertyInteger("ShutterSouthAzimutEnd"); // 220 grad
			$ShutterSouthElevation = $this->ReadPropertyInteger("ShutterSouthElevation"); // 10 grad
			
			$ShutterSouthSolarRadiationSummerDownShaded1Threshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationSummerDownShaded1Threshold"); // >25000 lux
			$ShutterSouthSolarRadiationSummerDownShaded2Threshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationSummerDownShaded2Threshold"); // >50000 lux
			$ShutterSouthSolarRadiationSummerDownClosedThreshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationSummerDownClosedThreshold"); // >75000 lux
			
			$ShutterSouthSolarRadiationWinterDownShaded1Threshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationWinterDownShaded1Threshold"); // >25000 lux
			$ShutterSouthSolarRadiationWinterDownShaded2Threshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationWinterDownShaded2Threshold"); // >50000 lux
			$ShutterSouthSolarRadiationWinterDownClosedThreshold = $this->ReadPropertyInteger("ShutterSouthSolarRadiationWinterDownClosedThreshold"); // >75000 lux
			
			$ShutterSouthTemperatureOutsideThreshold = $this->ReadPropertyInteger("ShutterSouthTemperatureOutsideThreshold"); // > Closes Shutter
			$ShutterSouthTemperatureOutsideReaction = $this->ReadPropertyInteger("ShutterSouthTemperatureOutsideReaction"); // > Zu, Kipp, Nichts
						
			//$ShutterSouthStormDetection = $this->ReadPropertyString("ShutterSouthStormDetection"); // 0 or 1
			//$ShutterSouthFrostDetection = $this->ReadPropertyString("ShutterSouthFrostDetection"); // 0 or 1
			
			$ShutterSouthDecisionMode = $this->ReadPropertyString("MarqueeMoveOutMode"); // Direct / Delay
			
			$ShutterSouthHotDayForecast = $this->ReadPropertyString("MarqueeMoveOutMode"); // 0 or 1
			
			$this->SendDebug('Shutter Control South','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$ShutterSouthAzimutBegin.' / End '.$ShutterSouthAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$ShutterSouthElevation,0);			
			
			$ShutterSouthManual = GetValue($this->GetIDForIdent("ShutterSouthManual"));
			$this->SendDebug('Shutter Control South','Manual Override '.$ShutterSouthManual,0);
			
			
			
			//Define if the shutter should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($ShutterSouthDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($ShutterSouthDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$ShutterSouthSolarRadiationDownShaded1Threshold = $ShutterSouthSolarRadiationWinterDownShaded1Threshold;
				$ShutterSouthSolarRadiationDownShaded2Threshold = $ShutterSouthSolarRadiationWinterDownShaded2Threshold;
				$ShutterSouthSolarRadiationDownClosedThreshold = $ShutterSouthSolarRadiationWinterDownClosedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$ShutterSouthSolarRadiationDownShaded1Threshold = $ShutterSouthSolarRadiationSummerDownShaded1Threshold;
				$ShutterSouthSolarRadiationDownShaded2Threshold = $ShutterSouthSolarRadiationSummerDownShaded2Threshold;
				$ShutterSouthSolarRadiationDownClosedThreshold = $ShutterSouthSolarRadiationSummerDownClosedThreshold;
			}
			

			// Decide what to do with the shutter based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $ShutterSouthSolarRadiationDownShaded1Threshold){
				$ShutterSouthPosition = 0;
				$ShutterSouthPositionReason = "Open";
				$this->SendDebug('Shutter Control South','Position: Open - Current light // Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$ShutterSouthSolarRadiationDownShaded1Threshold,0);
			}			
			else if (($SolarRadiationDecisionValueLux >= $ShutterSouthSolarRadiationDownShaded1Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterSouthSolarRadiationDownShaded2Threshold)) { // 0 lux - 35000 lux
				$ShutterSouthPosition = 1;
				$ShutterSouthPositionReason = "Shading Level 1";
				$this->SendDebug('Shutter Control South','Position: Shading Level 1 - Current light Current light // '.$SolarRadiationDecisionValueLux.' > threshold for level 1: '.$ShutterSouthSolarRadiationDownShaded1Threshold.' and < threshold for level 2: '.$ShutterSouthSolarRadiationDownShaded2Threshold,0);
			}
			else if (($SolarRadiationDecisionValueLux >= $ShutterSouthSolarRadiationDownShaded2Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterSouthSolarRadiationDownClosedThreshold)) { // 35000 lux - 75000
				$ShutterSouthPosition = 2;
				$ShutterSouthPositionReason = "Shading Level 2";
				$this->SendDebug('Shutter Control South','Position: Shading Level 2 - Current light // Current light '.$SolarRadiationDecisionValueLux.' > threshold for level 2: '.$ShutterSouthSolarRadiationDownShaded2Threshold.' and < threshold for closed: '.$ShutterSouthSolarRadiationDownClosedThreshold,0);
			}
			else if ($SolarRadiationDecisionValueLux >= $ShutterSouthSolarRadiationDownClosedThreshold) { // >75000 lux
				$ShutterSouthPosition = 3;
				$ShutterSouthPositionReason = "Shading Level 3 - Closed";
				$this->SendDebug('Shutter Control South','Position: Shading Level 3 - Closed // Current light '.$SolarRadiationDecisionValueLux.' > threshold for closed '.$ShutterSouthSolarRadiationDownClosedThreshold,0);
			}
				
						
			//Check on manual override, storm and decide the position
			//******************************************************************
			
			if ($ShutterSouthManual == 0) {
				if ($StormProtectionActive == 0) {
					$this->SendDebug('Shutter Control South','OK - No Storm',0);
					if ($FrostActive == 0) { //Must noch erstellt werden !!!!
						$this->SendDebug('Shutter Control South','OK - No Frost',0);
							if ($ShutterSouthAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $ShutterSouthAzimutEnd AND $ShutterSouthElevation <= $System_Elevation) {
								SetValue($this->GetIDForIdent("ShutterSouthPosition"), $ShutterSouthPosition);
								SetValue($this->GetIDForIdent("ShutterSouthDescision"), $ShutterSouthPositionReason);
								$this->SendDebug('Shutter Control South',$ShutterSouthPositionReason,0);
								SetValue($this->GetIDForIdent("ShutterSouthSun"), 1);
							}
							else{
								SetValue($this->GetIDForIdent("ShutterSouthDescision"), 'Sun not in right area (Azimut / Elevation)');
								$this->SendDebug('Shutter Control South','Sun not in right area (Azimut / Elevation)',0);
								SetValue($this->GetIDForIdent("ShutterSouthPosition"), 0);
								SetValue($this->GetIDForIdent("ShutterSouthSun"), 0);
							}
						}	
					else if ($FrostActive == 1){
						$this->SendDebug('Shutter Control South','Shutter move to: Up - Frost detected',0);
						SetValue($this->GetIDForIdent("ShutterSouthDescision"), 'Blocked by frost');
						SetValue($this->GetIDForIdent("ShutterSouthPosition"), 9);
					}
				}
				elseif($StormProtectionActive == 1){
					$this->SendDebug('Shutter Control South','Shutter move to: Up - Storm',0);
					SetValue($this->GetIDForIdent("ShutterSouthDescision"), 'Blocked by storm');
					SetValue($this->GetIDForIdent("ShutterSouthPosition"), 9);
				}
			}
			elseif($ShutterSouthManual == 1){
					$this->SendDebug('Shutter Control South','Manually disabled',0);
					SetValue($this->GetIDForIdent("ShutterSouthDescision"), 'Manually disabled');
			}

		}
		
		
		public function ShutterWest()
		{
			// function to wait until storm is over
			$this->SendDebug('Shutter Control West','************************* Shutter East Control Begin *************************',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$ShutterWestAzimutBegin = $this->ReadPropertyInteger("ShutterWestAzimutBegin"); // 110 grad
			$ShutterWestAzimutEnd = $this->ReadPropertyInteger("ShutterWestAzimutEnd"); // 220 grad
			$ShutterWestElevation = $this->ReadPropertyInteger("ShutterWestElevation"); // 10 grad
			
			$ShutterWestSolarRadiationSummerDownShaded1Threshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationSummerDownShaded1Threshold"); // >25000 lux
			$ShutterWestSolarRadiationSummerDownShaded2Threshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationSummerDownShaded2Threshold"); // >50000 lux
			$ShutterWestSolarRadiationSummerDownClosedThreshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationSummerDownClosedThreshold"); // >75000 lux
			
			$ShutterWestSolarRadiationWinterDownShaded1Threshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationWinterDownShaded1Threshold"); // >25000 lux
			$ShutterWestSolarRadiationWinterDownShaded2Threshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationWinterDownShaded2Threshold"); // >50000 lux
			$ShutterWestSolarRadiationWinterDownClosedThreshold = $this->ReadPropertyInteger("ShutterWestSolarRadiationWinterDownClosedThreshold"); // >75000 lux
			
			$ShutterWestTemperatureOutsideThreshold = $this->ReadPropertyInteger("ShutterWestTemperatureOutsideThreshold"); // > Closes Shutter
			$ShutterWestTemperatureOutsideReaction = $this->ReadPropertyInteger("ShutterWestTemperatureOutsideReaction"); // > Zu, Kipp, Nichts
						
			//$ShutterWestStormDetection = $this->ReadPropertyString("ShutterWestStormDetection"); // 0 or 1
			//$ShutterWestFrostDetection = $this->ReadPropertyString("ShutterWestFrostDetection"); // 0 or 1
			
			$ShutterWestDecisionMode = $this->ReadPropertyString("MarqueeMoveOutMode"); // Direct / Delay
			
			$ShutterWestHotDayForecast = $this->ReadPropertyString("MarqueeMoveOutMode"); // 0 or 1
			
			$this->SendDebug('Shutter Control West','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$ShutterWestAzimutBegin.' / End '.$ShutterWestAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$ShutterWestElevation,0);			
			
			$ShutterWestManual = GetValue($this->GetIDForIdent("ShutterWestManual"));
			$this->SendDebug('Shutter Control West','Manual Override '.$ShutterWestManual,0);
			
			
			
			//Define if the shutter should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($ShutterWestDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($ShutterWestDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$ShutterWestSolarRadiationDownShaded1Threshold = $ShutterWestSolarRadiationWinterDownShaded1Threshold;
				$ShutterWestSolarRadiationDownShaded2Threshold = $ShutterWestSolarRadiationWinterDownShaded2Threshold;
				$ShutterWestSolarRadiationDownClosedThreshold = $ShutterWestSolarRadiationWinterDownClosedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$ShutterWestSolarRadiationDownShaded1Threshold = $ShutterWestSolarRadiationSummerDownShaded1Threshold;
				$ShutterWestSolarRadiationDownShaded2Threshold = $ShutterWestSolarRadiationSummerDownShaded2Threshold;
				$ShutterWestSolarRadiationDownClosedThreshold = $ShutterWestSolarRadiationSummerDownClosedThreshold;
			}
			

			// Decide what to do with the shutter based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $ShutterWestSolarRadiationDownShaded1Threshold){
				$ShutterWestPosition = 0;
				$ShutterWestPositionReason = "Open";
				$this->SendDebug('Shutter Control West','Position: Open - Current light // Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$ShutterWestSolarRadiationDownShaded1Threshold,0);
			}			
			else if (($SolarRadiationDecisionValueLux >= $ShutterWestSolarRadiationDownShaded1Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterWestSolarRadiationDownShaded2Threshold)) { // 0 lux - 35000 lux
				$ShutterWestPosition = 1;
				$ShutterWestPositionReason = "Shading Level 1";
				$this->SendDebug('Shutter Control West','Position: Shading Level 1 - Current light Current light // '.$SolarRadiationDecisionValueLux.' > threshold for level 1: '.$ShutterWestSolarRadiationDownShaded1Threshold.' and < threshold for level 2: '.$ShutterWestSolarRadiationDownShaded2Threshold,0);
			}
			else if (($SolarRadiationDecisionValueLux >= $ShutterWestSolarRadiationDownShaded2Threshold) AND ($SolarRadiationDecisionValueLux < $ShutterWestSolarRadiationDownClosedThreshold)) { // 35000 lux - 75000
				$ShutterWestPosition = 2;
				$ShutterWestPositionReason = "Shading Level 2";
				$this->SendDebug('Shutter Control West','Position: Shading Level 2 - Current light // Current light '.$SolarRadiationDecisionValueLux.' > threshold for level 2: '.$ShutterWestSolarRadiationDownShaded2Threshold.' and < threshold for closed: '.$ShutterWestSolarRadiationDownClosedThreshold,0);
			}
			else if ($SolarRadiationDecisionValueLux >= $ShutterWestSolarRadiationDownClosedThreshold) { // >75000 lux
				$ShutterWestPosition = 3;
				$ShutterWestPositionReason = "Shading Level 3 - Closed";
				$this->SendDebug('Shutter Control West','Position: Shading Level 3 - Closed // Current light '.$SolarRadiationDecisionValueLux.' > threshold for closed '.$ShutterWestSolarRadiationDownClosedThreshold,0);
			}
				
						
			//Check on manual override, storm and decide the position
			//******************************************************************
			
			if ($ShutterWestManual == 0) {
				if ($StormProtectionActive == 0) {
					$this->SendDebug('Shutter Control West','OK - No Storm',0);
					if ($FrostActive == 0) { //Must noch erstellt werden !!!!
						$this->SendDebug('Shutter Control West','OK - No Frost',0);
							if ($ShutterWestAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $ShutterWestAzimutEnd AND $ShutterWestElevation <= $System_Elevation) {
								SetValue($this->GetIDForIdent("ShutterWestPosition"), $ShutterWestPosition);
								SetValue($this->GetIDForIdent("ShutterWestDescision"), $ShutterWestPositionReason);
								$this->SendDebug('Shutter Control West',$ShutterWestPositionReason,0);
								SetValue($this->GetIDForIdent("ShutterWestSun"), 1);
							}
							else{
								SetValue($this->GetIDForIdent("ShutterWestDescision"), 'Sun not in right area (Azimut / Elevation)');
								$this->SendDebug('Shutter Control West','Sun not in right area (Azimut / Elevation)',0);
								SetValue($this->GetIDForIdent("ShutterWestPosition"), 0);
								SetValue($this->GetIDForIdent("ShutterWestSun"), 0);
							}
						}	
					else if ($FrostActive == 1){
						$this->SendDebug('Shutter Control West','Shutter move to: Up - Frost detected',0);
						SetValue($this->GetIDForIdent("ShutterWestDescision"), 'Blocked by frost');
						SetValue($this->GetIDForIdent("ShutterWestPosition"), 9);
					}
				}
				elseif($StormProtectionActive == 1){
					$this->SendDebug('Shutter Control West','Shutter move to: Up - Storm',0);
					SetValue($this->GetIDForIdent("ShutterWestDescision"), 'Blocked by storm');
					SetValue($this->GetIDForIdent("ShutterWestPosition"), 9);
				}
			}
			elseif($ShutterSouthManual == 1){
					$this->SendDebug('Shutter Control West','Manually disabled',0);
					SetValue($this->GetIDForIdent("ShutterWestDescision"), 'Manually disabled');
			}

			
			
		}
		
		//end
		
		
		
		public function WindowWintergardenControl()
		{
			// function to wait until storm is over
			$this->SendDebug('Windows Wintergarden','OOOOOOOOOOOOOOOOOOOOOOO Windows Wintergarden Control Begin OOOOOOOOOOOOOOOOOOOOOOO',0);
			
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$WindowBlockedByRain = $this->GetBuffer("HeavyRainProtectionActive");
			
			$WindowWintergardenTargetTemperature = GetValue($this->ReadPropertyInteger("WindowWintergardenTargetTemperature")); // check against outside
			$WindowWintergardenTemperatureWintergarden = GetValue($this->ReadPropertyInteger("WindowWintergardenTemperatureWintergarden")); // check against outside
			$WindowWintergardenTemperatureReference = GetValue($this->ReadPropertyInteger("WindowWintergardenTemperatureReference")); // check against outside
			$WindowWintergardenOutsideTemperature = GetValue($this->ReadPropertyInteger("OutsideTemperature")); // check against outside
			
			$SystemIsDay = GetValue($this->ReadPropertyInteger("SystemIsDay")); // check if is day
			
			$SystemPresenceVar = $this->ReadPropertyInteger("SystemPresence");
			
			if (empty ($SystemPresenceVar)) {
				$SystemPresence = 1;
			}
			else {
				$SystemPresence = GetValue($this->ReadPropertyInteger("SystemPresence")); 
			}
						
			//Was soll gesteuert werden - Fenster oben unten
			$WindowWintergardenControlUpperWindows = $this->ReadPropertyBoolean("WindowWintergardenControlUpperWindows");
			$WindowWintergardenControlLowerWindows = $this->ReadPropertyBoolean("WindowWintergardenControlLowerWindows");
			
			//Open thresholds to decide how far the window will be opened
			$WindowWintergarden50ThresholdUpper = $this->ReadPropertyInteger("WindowWintergarden50ThresholdUpper");
			$WindowWintergarden50ThresholdLower = $this->ReadPropertyInteger("WindowWintergarden50ThresholdLower");
			$WindowWintergarden100ThresholdUpper = $this->ReadPropertyInteger("WindowWintergarden100ThresholdUpper");
			$WindowWintergarden100ThresholdLower = $this->ReadPropertyInteger("WindowWintergarden100ThresholdLower");
			
			$WindowWintergardenConsiderReferenceTemperature = $this->ReadPropertyBoolean("WindowWintergardenConsiderReferenceTemperature");
			
			//Blocking variables 
			$WindowWintergardenDisableAtNight = $this->ReadPropertyBoolean("WindowWintergardenDisableAtNight"); // Wenn nachts wirklich nicht gelüftet werden soll
			$WindowWintergardenDisableNotPresent = $this->ReadPropertyBoolean("WindowWintergardenDisableNotPresent"); // Wenn keiner daheim ist
			$WindowWintergardenDisableHeavyRain = $this->ReadPropertyBoolean("WindowWintergardenDisableHeavyRain"); // Wenn es stark regnet
			
			$WindowWintergardenManual = GetValue($this->GetIDForIdent("WindowWintergardenManual"));
			$this->SendDebug('Windows Wintergarden','Manual Override '.$WindowWintergardenManual,0);
		
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			//Check if Windows should be controlled at night?
			if ($WindowWintergardenDisableAtNight == 1) {
				if ($SystemIsDay == 1) {
					$WindowIsDay = 1;
				}
				elseif ($SystemIsDay == 0) {
					$WindowIsDay = 0;
				}
			}
			else if ($WindowWintergardenDisableAtNight == 0) {
				$WindowIsDay = 1;
			}
			
			//Check if Windows should be controlled if no one is at home?
			if ($WindowWintergardenDisableNotPresent == 1) {
				if ($SystemPresence == 1) {
					$WindowPresence = 1;
				}
				elseif ($SystemPresence == 0) {
					$WindowPresence = 0;
				}
			}
			else if ($WindowWintergardenDisableNotPresent == 0) {
				$WindowPresence = 1;
			}
			
			//Check if Windows should be closed during heavy Rain
			if ($WindowWintergardenDisableHeavyRain == 1) {
				if ($WindowBlockedByRain == 1) {
					$WindowBlockedByRain = 1 ;
				}
				elseif ($WindowBlockedByRain == 0) {
					$WindowBlockedByRain = 0;
				}
			}
			else if ($WindowWintergardenDisableHeavyRain == 0) {
				$WindowBlockedByRain = 0;
			}
			
			//Check if Reference Sensor should be used
			if ($WindowWintergardenConsiderReferenceTemperature == 1) {
				if ($WindowWintergardenTemperatureReference < $WindowWintergardenTemperatureWintergarden) {
					$WindowBlockedByReferenceSensor = 1;
				}
				else if ($WindowWintergardenTemperatureReference >= $WindowWintergardenTemperatureWintergarden) {
					$WindowBlockedByReferenceSensor = 0;
				}
			}
			else if ($WindowWintergardenConsiderReferenceTemperature == 0) {
				$WindowBlockedByReferenceSensor = 0;
			}
			
					
			// Decide how far the Windows can open based on outside temperature
			//*****************************************************************
						
			//Oben
			if (($WindowWintergardenOutsideTemperature >= $WindowWintergarden50ThresholdUpper) AND ($WindowWintergardenOutsideTemperature < $WindowWintergarden100ThresholdUpper)){
				$WindowOpenAngleUpper = 1;
				$WindowOpenAngleReasonUpper = "Position 1";
				//$this->SendDebug('Windows Wintergarden','Upper windows opened to position 1',0);
			}			
			else if ($WindowWintergardenOutsideTemperature >= $WindowWintergarden100ThresholdUpper){
				$WindowOpenAngleUpper = 2;
				$WindowOpenAngleReasonUpper = "Position 2";
				//$this->SendDebug('Windows Wintergarden','Upper windows opened to position 2',0);
			}
			else if ($WindowWintergardenOutsideTemperature <= $WindowWintergarden50ThresholdUpper){
				$WindowOpenAngleUpper = 0;
				$WindowOpenAngleReasonUpper = "Position 0";
				//$this->SendDebug('Windows Wintergarden','Upper windows stays closed - below threshold 1',0);
			}	
			
			if (($WindowWintergardenOutsideTemperature >= $WindowWintergarden50ThresholdLower) AND ($WindowWintergardenOutsideTemperature < $WindowWintergarden100ThresholdLower)){
				$WindowOpenAngleLower = 1;
				$WindowOpenAngleReasonLower = "Position 1";
				//$this->SendDebug('Windows Wintergarden','Lower windows opened to position 1',0);
			}			
			else if ($WindowWintergardenOutsideTemperature >= $WindowWintergarden100ThresholdLower){
				$WindowOpenAngleLower = 2;
				$WindowOpenAngleReasonLower = "Position 2";
				//$this->SendDebug('Windows Wintergarden','Lower windows opened to position 2',0);
			}
			else if ($WindowWintergardenOutsideTemperature <= $WindowWintergarden50ThresholdLower){
				$WindowOpenAngleLower = 0;
				$WindowOpenAngleReasonLower = "Position 0";
				//$this->SendDebug('Windows Wintergarden','Lower windows stays closed - below threshold 1',0);
			}	
			
		
			//Check on manual override, storm and decide the position
			//******************************************************************
			
			if ($WindowWintergardenManual == 0) {
				if ($WindowPresence == 1) {
					$this->SendDebug('Windows Wintergarden','OK - Someone is at home',0);
					if ($WindowIsDay == 1) {
						$this->SendDebug('Windows Wintergarden','OK - It is day or the setting is ignored',0);
							if ($WindowBlockedByRain == 0) { 
							$this->SendDebug('Windows Wintergarden','OK - No heavy rain',0);
								if ($WindowBlockedByReferenceSensor == 0) {
								$this->SendDebug('Windows Wintergarden','OK - Not block by reference sensor',0);
									if ($WindowWintergardenTargetTemperature <= $WindowWintergardenTemperatureWintergarden) {
										if ($WindowWintergardenControlUpperWindows == 1){
											SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), $WindowOpenAngleUpper);
											SetValue($this->GetIDForIdent("WindowDescisionUpper"), $WindowOpenAngleReasonUpper);
											$this->SendDebug('Windows Wintergarden','Upper Windows opened to level '.$WindowOpenAngleReasonUpper,0);
										}
										if ($WindowWintergardenControlLowerWindows == 1){
											SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), $WindowOpenAngleLower);
											SetValue($this->GetIDForIdent("WindowDescisionLower"), $WindowOpenAngleReasonLower);
											$this->SendDebug('Windows Wintergarden','Lower Windows opened to level '.$WindowOpenAngleReasonLower,0);
										}
									}
									else{
										$this->SendDebug('Windows Wintergarden','Windows do not need to be opened - target temperature '.$WindowWintergardenTargetTemperature.' below current temperature '.$WindowWintergardenTemperatureWintergarden,0);
										SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), 0);
										SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), 0);
										SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'OK - but not warm enough');
										SetValue($this->GetIDForIdent("WindowDescisionLower"), 'OK - but not warm enough');
									}
								}
								else if ($WindowBlockedByReferenceSensor == 1){
								$this->SendDebug('Windows Wintergarden','Blocked by Reference Sensor',0);
								SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'Blocked by Reference Sensor');
								SetValue($this->GetIDForIdent("WindowDescisionLower"), 'Blocked by Reference Sensor');
								SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), 0);
								SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), 0);
								}
							}
							else if ($WindowBlockedByRain == 1){
							$this->SendDebug('Windows Wintergarden','Blocked by heavy rain',0);
							SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'Blocked by heavy rain');
							SetValue($this->GetIDForIdent("WindowDescisionLower"), 'Blocked by heavy rain');
							SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), 0);
							SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), 0);
						}
					}
					else if ($WindowIsDay == 0){
						$this->SendDebug('Windows Wintergarden','Blocked by night execution being disabled',0);
						SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'Blocked by night execution being disabled');
						SetValue($this->GetIDForIdent("WindowDescisionLower"), 'Blocked by night execution being disabled');
						SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), 0);
						SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), 0);
					}
				}
				elseif($WindowPresence == 0){
					$this->SendDebug('Windows Wintergarden','Blocked by no one being home',0);
					SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'Blocked by no one being home');
					SetValue($this->GetIDForIdent("WindowDescisionLower"), 'Blocked by no one being home');
					SetValue($this->GetIDForIdent("WindowUpperOpenStatus"), 0);
					SetValue($this->GetIDForIdent("WindowLowerOpenStatus"), 0);
				}
			}
			elseif($WindowWintergardenManual == 1){
					$this->SendDebug('Windows Wintergarden','Manually disabled',0);
					SetValue($this->GetIDForIdent("WindowDescisionUpper"), 'Manually disabled');
					SetValue($this->GetIDForIdent("WindowDescisionLower"), 'Manually disabled');
			}

			
			
		}
		
		
		public function BlindsEast()
		{
			
			$this->SendDebug('Shutter Control East','ooooooooooooooooooo Building Blinds/Shutters East Control Begin ooooooooooooooooooo',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			$BlindsEastShutterMode = $this->ReadPropertyBoolean("BlindsEastShutterMode");
			//$BlindsEastReactOnHotDays = GetValue($this->ReadPropertyBoolean("BlindsEastReactOnHotDays"));
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$BlindsEastAzimutBegin = $this->ReadPropertyInteger("BlindsEastAzimutBegin"); // 110 grad
			$BlindsEastAzimutEnd = $this->ReadPropertyInteger("BlindsEastAzimutEnd"); // 220 grad
			$BlindsEastElevation = $this->ReadPropertyInteger("BlindsEastElevation"); // 10 grad
			
			$BlindsEastSolarRadiationSummerDownShadedThreshold = $this->ReadPropertyInteger("BlindsEastSolarRadiationSummerDownShadedThreshold"); 
						
			$BlindsEastSolarRadiationWinterDownShadedThreshold = $this->ReadPropertyInteger("BlindsEastSolarRadiationWinterDownShadedThreshold");
			
		
			$BlindsEastDecisionMode = $this->ReadPropertyString("BlindsEastDecisionMode"); // Direct / Delay
			
			//$BlindsEastHotDayForecast = $this->ReadPropertyString("BlindsEastHotDayForecast"); // 0 or 1
			
			$this->SendDebug('Blinds Control East','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$BlindsEastAzimutBegin.' / End '.$BlindsEastAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$BlindsEastElevation,0);			
			
			$BlindsEastManual = GetValue($this->GetIDForIdent("BlindsEastManual"));
			//$this->SendDebug('Blinds Control East','Manual Override '.$BlindsEastManual,0);
			
			
			
			//Define if the shutter should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($BlindsEastDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($BlindsEastDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$BlindsEastSolarRadiationDownShadedThreshold = $BlindsEastSolarRadiationWinterDownShadedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$BlindsEastSolarRadiationDownShadedThreshold = $BlindsEastSolarRadiationSummerDownShadedThreshold;
			}
			

			// Decide what to do with the shutter based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $BlindsEastSolarRadiationDownShadedThreshold){
				$BlindsEastPosition = 0;
				$BlindsEastPositionReason = "Up";
				$this->SendDebug('Blinds Control East','Position: Up - Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$BlindsEastSolarRadiationDownShadedThreshold,0);
			}			
			else if ($SolarRadiationDecisionValueLux >= $BlindsEastSolarRadiationDownShadedThreshold) {
				$BlindsEastPosition = 1;
				$BlindsEastPositionReason = "Shading";
				$this->SendDebug('Blinds Control East','Position: Shading - Current light '.$SolarRadiationDecisionValueLux.' > threshold: '.$BlindsEastSolarRadiationDownShadedThreshold,0);
			}
			
				
						
			//Check on manual override, storm and decide the position
			//******************************************************************
			
			if ($BlindsEastManual == 0) {
				if ($BlindsEastAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $BlindsEastAzimutEnd AND $BlindsEastElevation <= $System_Elevation) {
					SetValue($this->GetIDForIdent("BlindsEastPosition"), $BlindsEastPosition);
					SetValue($this->GetIDForIdent("BlindsEastDescision"), $BlindsEastPositionReason);
					SetValue($this->GetIDForIdent("BlindsEastSun"), 1);
					$this->SendDebug('Blinds Control East',$BlindsEastPositionReason,0);
				}
				else{
					SetValue($this->GetIDForIdent("BlindsEastDescision"), 'Sun not in right area (Azimut / Elevation)');
					$this->SendDebug('Blinds Control East','Sun not in right area (Azimut / Elevation)',0);
					SetValue($this->GetIDForIdent("BlindsEastPosition"), 0);
					SetValue($this->GetIDForIdent("BlindsEastSun"), 0);
				}
					
			}
			elseif($BlindsEastManual == 1){
					$this->SendDebug('Blinds Control East','Manually disabled',0);
					SetValue($this->GetIDForIdent("BlindsEastDescision"), 'Manually disabled');
			}
			
		}
		
		public function BlindsSouth()
		{
			
			$this->SendDebug('Shutter Control South','ooooooooooooooooooo Building Blinds/Shutters South Control Begin ooooooooooooooooooo',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			$BlindsSouthShutterMode = $this->ReadPropertyBoolean("BlindsSouthShutterMode");
			//$BlindsSouthReactOnHotDays = GetValue($this->ReadPropertyBoolean("BlindsSouthReactOnHotDays"));
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$BlindsSouthAzimutBegin = $this->ReadPropertyInteger("BlindsSouthAzimutBegin"); // 110 grad
			$BlindsSouthAzimutEnd = $this->ReadPropertyInteger("BlindsSouthAzimutEnd"); // 220 grad
			$BlindsSouthElevation = $this->ReadPropertyInteger("BlindsSouthElevation"); // 10 grad
			
			$BlindsSouthSolarRadiationSummerDownShadedThreshold = $this->ReadPropertyInteger("BlindsSouthSolarRadiationSummerDownShadedThreshold"); 
						
			$BlindsSouthSolarRadiationWinterDownShadedThreshold = $this->ReadPropertyInteger("BlindsSouthSolarRadiationWinterDownShadedThreshold");
			
		
			$BlindsSouthDecisionMode = $this->ReadPropertyString("BlindsSouthDecisionMode"); // Direct / Delay
			
			//$BlindsSouthHotDayForecast = $this->ReadPropertyString("BlindsSouthHotDayForecast"); // 0 or 1
			
			$this->SendDebug('Blinds Control South','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$BlindsSouthAzimutBegin.' / End '.$BlindsSouthAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$BlindsSouthElevation,0);			
			
			$BlindsSouthManual = GetValue($this->GetIDForIdent("BlindsSouthManual"));
			//$this->SendDebug('Blinds Control South','Manual Override '.$BlindsSouthManual,0);
			
			
			
			//Define if the blinds should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($BlindsSouthDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($BlindsSouthDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$BlindsSouthSolarRadiationDownShadedThreshold = $BlindsSouthSolarRadiationWinterDownShadedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$BlindsSouthSolarRadiationDownShadedThreshold = $BlindsSouthSolarRadiationSummerDownShadedThreshold;
			}
			

			// Decide what to do with the blinds based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $BlindsSouthSolarRadiationDownShadedThreshold){
				$BlindsSouthPosition = 0;
				$BlindsSouthPositionReason = "Up";
				$this->SendDebug('Blinds Control South','Position: Up - Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$BlindsSouthSolarRadiationDownShadedThreshold,0);
			}			
			else if ($SolarRadiationDecisionValueLux >= $BlindsSouthSolarRadiationDownShadedThreshold) {
				$BlindsSouthPosition = 1;
				$BlindsSouthPositionReason = "Shading";
				$this->SendDebug('Blinds Control South','Position: Shading - Current light '.$SolarRadiationDecisionValueLux.' > threshold: '.$BlindsSouthSolarRadiationDownShadedThreshold,0);
			}
			
				
						
			//Check on manual override and decide the position
			//******************************************************************
			
			if ($BlindsSouthManual == 0) {
				if ($BlindsSouthAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $BlindsSouthAzimutEnd AND $BlindsSouthElevation <= $System_Elevation) {
					SetValue($this->GetIDForIdent("BlindsSouthPosition"), $BlindsSouthPosition);
					SetValue($this->GetIDForIdent("BlindsSouthDescision"), $BlindsSouthPositionReason);
					SetValue($this->GetIDForIdent("BlindsSouthSun"), 1);
					$this->SendDebug('Blinds Control South',$BlindsSouthPositionReason,0);
				}
				else{
					SetValue($this->GetIDForIdent("BlindsSouthDescision"), 'Sun not in right area (Azimut / Elevation)');
					$this->SendDebug('Blinds Control South','Sun not in right area (Azimut / Elevation)',0);
					SetValue($this->GetIDForIdent("BlindsSouthPosition"), 0);
					SetValue($this->GetIDForIdent("BlindsSouthSun"), 0);
				}
					
			}
			elseif($BlindsSouthManual == 1){
					$this->SendDebug('Blinds Control South','Manually disabled',0);
					SetValue($this->GetIDForIdent("BlindsSouthDescision"), 'Manually disabled');
			}
			
		}
		
		public function BlindsWest()
		{
			
			$this->SendDebug('Shutter Control West','ooooooooooooooooooo Building Blinds/Shutters West Control Begin ooooooooooooooooooo',0);
			
			$SeasonIsSummer = $this->GetBuffer("SeasonIsSummer");
			$SolarRadiationLuxCurrent = $this->GetBuffer("SolarRadiationLuxCurrent");
			$SolarRadiationLuxDelayLux1 = $this->GetBuffer("SolarRadiationLuxDelayLux1");
			$StormProtectionActive = $this->GetBuffer("StormProtectionActive"); // Bei Sturm hoch oder nicht runter
			$FrostActive = $this->GetBuffer("FrostActive"); // Bei Sturm hoch oder nicht runter
			
			$BlindsWestShutterMode = $this->ReadPropertyBoolean("BlindsWestShutterMode");
			//$BlindsWestReactOnHotDays = GetValue($this->ReadPropertyBoolean("BlindsWestReactOnHotDays"));
			
			$System_Azimuth = GetValue($this->ReadPropertyInteger("Azimut")); // 155 grad
			$System_Elevation = GetValue($this->ReadPropertyInteger("Elevation")); // 50 grad
			$BlindsWestAzimutBegin = $this->ReadPropertyInteger("BlindsWestAzimutBegin"); // 110 grad
			$BlindsWestAzimutEnd = $this->ReadPropertyInteger("BlindsWestAzimutEnd"); // 220 grad
			$BlindsWestElevation = $this->ReadPropertyInteger("BlindsWestElevation"); // 10 grad
			
			$BlindsWestSolarRadiationSummerDownShadedThreshold = $this->ReadPropertyInteger("BlindsWestSolarRadiationSummerDownShadedThreshold"); 
						
			$BlindsWestSolarRadiationWinterDownShadedThreshold = $this->ReadPropertyInteger("BlindsWestSolarRadiationWinterDownShadedThreshold");
			
		
			$BlindsWestDecisionMode = $this->ReadPropertyString("BlindsWestDecisionMode"); // Direct / Delay
			
			//$BlindsWestHotDayForecast = $this->ReadPropertyString("BlindsWestHotDayForecast"); // 0 or 1
			
			$this->SendDebug('Blinds Control West','Location Settings: System Azi '.$System_Azimuth.' / Begin '.$BlindsWestAzimutBegin.' / End '.$BlindsWestAzimutEnd.' Elevation'.$System_Elevation.' Elevation '.$BlindsWestElevation,0);			
			
			$BlindsWestManual = GetValue($this->GetIDForIdent("BlindsWestManual"));
			//$this->SendDebug('Blinds Control West','Manual Override '.$BlindsWestManual,0);
			
			
			
			//Define if the blinds should be moved in and out based on direct or delayed values
			//**********************************************************************************
			
			if ($BlindsWestDecisionMode == "Direct") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxCurrent;
			}
			elseif ($BlindsWestDecisionMode == "Delay") {
				$SolarRadiationDecisionValueLux = $SolarRadiationLuxDelayLux1;
			}
			
			
			//Decide which thresholds should be used - winter or summer
			//*********************************************************
			
			if ($SeasonIsSummer == 0) {
				$BlindsWestSolarRadiationDownShadedThreshold = $BlindsWestSolarRadiationWinterDownShadedThreshold;
			}
			else if ($SeasonIsSummer == 1) {
				$BlindsWestSolarRadiationDownShadedThreshold = $BlindsWestSolarRadiationSummerDownShadedThreshold;
			}
			

			// Decide what to do with the blinds based on light
			//**************************************************
			

			if ($SolarRadiationDecisionValueLux < $BlindsWestSolarRadiationDownShadedThreshold){
				$BlindsWestPosition = 0;
				$BlindsWestPositionReason = "Up";
				$this->SendDebug('Blinds Control West','Position: Up - Current light '.$SolarRadiationDecisionValueLux.' < threshold for open '.$BlindsWestSolarRadiationDownShadedThreshold,0);
			}			
			else if ($SolarRadiationDecisionValueLux >= $BlindsWestSolarRadiationDownShadedThreshold) {
				$BlindsWestPosition = 1;
				$BlindsWestPositionReason = "Shading";
				$this->SendDebug('Blinds Control West','Position: Shading - Current light '.$SolarRadiationDecisionValueLux.' > threshold: '.$BlindsWestSolarRadiationDownShadedThreshold,0);
			}
			
				
						
			//Check on manual override and decide the position
			//******************************************************************
			
			if ($BlindsWestManual == 0) {
				if ($BlindsWestAzimutBegin <= $System_Azimuth AND $System_Azimuth <= $BlindsWestAzimutEnd AND $BlindsWestElevation <= $System_Elevation) {
					SetValue($this->GetIDForIdent("BlindsWestPosition"), $BlindsWestPosition);
					SetValue($this->GetIDForIdent("BlindsWestDescision"), $BlindsWestPositionReason);
					SetValue($this->GetIDForIdent("BlindsWestSun"), 1);
					$this->SendDebug('Blinds Control West',$BlindsWestPositionReason,0);
				}
				else{
					SetValue($this->GetIDForIdent("BlindsWestDescision"), 'Sun not in right area (Azimut / Elevation)');
					$this->SendDebug('Blinds Control West','Sun not in right area (Azimut / Elevation)',0);
					SetValue($this->GetIDForIdent("BlindsWestPosition"), 0);
					SetValue($this->GetIDForIdent("BlindsWestSun"), 0);
				}
					
			}
			elseif($BlindsWestManual == 1){
					$this->SendDebug('Blinds Control West','Manually disabled',0);
					SetValue($this->GetIDForIdent("BlindsWestDescision"), 'Manually disabled');
			}
			
		}

	}
?>
