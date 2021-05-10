<?php

namespace App\Traits;

trait LoadXmlTrait {

	public function loadSGXml(){
		//$production = $_SERVER['DOCUMENT_ROOT'].'/api/xml/bpi/APISG/APIDataAPISG';
        //$simulation $_SERVER['DOCUMENT_ROOT'].'/api/xml/test/SimulationAPISG';
    	$localhost = base_path().'/APIDataAPISG';
        $simulation = base_path().'/SimulationAPISG.xml';

        $xml = simplexml_load_file($localhost) or die("Error: Cannot create object");
        $json = json_encode($xml);
        
        return json_decode($json,TRUE);

	}

	public function loadSCXml(){
		//$production = $_SERVER['DOCUMENT_ROOT'].'/api/xml/bpi/APISG/APIDataAPISG';
        //$simulation $_SERVER['DOCUMENT_ROOT'].'/api/xml/test/SimulationAPISG';
    	$localhost = base_path().'/APIDataAPISC';
        //return base_path().'/SimulationAPISG.xml';

        $xml = simplexml_load_file($localhost) or die("Error: Cannot create object");
        $json = json_encode($xml);
        
        return json_decode($json,TRUE);
	}

    public function loadRcefXml(){
        //$production = $_SERVER['DOCUMENT_ROOT'].'/api/xml/bpi/APISG/APIDataAPISG';
        //$simulation $_SERVER['DOCUMENT_ROOT'].'/api/xml/test/SimulationAPISG';
        $localhost = base_path().'/APIDataWS2021';
        //return base_path().'/SimulationAPISG.xml';

        $xml = simplexml_load_file($localhost) or die("Error: Cannot create object");
        $json = json_encode($xml);
        
        return json_decode($json,TRUE);
    }
}