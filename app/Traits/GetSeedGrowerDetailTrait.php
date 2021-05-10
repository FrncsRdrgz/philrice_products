<?php

namespace App\Traits;
use App\Traits\LoadXmlTrait;
use DB,Auth;

trait GetSeedGrowerDetailTrait {
	use LoadXmlTrait;

	public function serial_number() {
		$seed_growers = $this->loadSGXml();
		$serial_num ="";
		foreach($seed_growers as $seed_grower){
			if($seed_grower['AccreNum'] == Auth::user()->accreditation_no){
				$serial_num = $seed_grower['SerialNum'];
			}
		}
		return $serial_num;
	}

	public function accredited_area() {
		$seed_growers = $this->loadSGXml();
		$area ="";
		foreach($seed_growers as $seed_grower){
			if($seed_grower['AccreNum'] == Auth::user()->accreditation_no){
				$area = $seed_grower['AccreArea'];
			}
		}
		return $area;
	}
}