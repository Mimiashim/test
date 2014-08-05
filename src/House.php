<?php
	namespace Mimi\Town;
    class House {
        public $houseNumber;
        public $floorCount;
        public $porchCount;
        public $apartmentCount;
        public $nearestArea;
        public $houseLights;
        
        public $landPrice = 14;
        
        public function __construct($buildingBuilder, $apartmentBuilder){
            $buildingOptions = $buildingBuilder->getBuildingOptions();
            $this->houseNumber = $buildingOptions['houseNumberRand'];
            if($buildingOptions['floorCountRand'] == 0){
                $this->floorCount = 5;
            } elseif($buildingOptions['floorCountRand'] == 1){
                $this->floorCount = 9;
            } else {
                $this->floorCount = 16;
            }
            $this->porchCount = $buildingOptions['porchCountRand'];
            $this->nearestArea = $this->floorCount * $this->porchCount * 50;
            $this->houseLights =  $this->floorCount * $this->porchCount * 10.5;
            $apartmentCount = $this->floorCount * $this->porchCount * 4;
            $this->apartmentCount($apartmentCount, $apartmentBuilder);
        }
        public function apartmentCount($number, $apartmentBuilder){
            $arr = array();
            for($i = 0; $i < $number; $i++){
                $apartmentOptions = $apartmentBuilder -> getApartmentOptions();
                $apartmentOptions['floorCount'] = $this->floorCount; 
               $arr[$i] = new Apart($apartmentOptions);
            }
            $this->apartmentCount = $arr;
        }
        public function landTax(){
            $land = ($this->porchCount * 40 + $this->nearestArea) * $this->landPrice;
            return $land;
        }
        public function houseTax(){
            $houseTaxes = 0;
            foreach($this->apartmentCount as $value){
                $houseTaxes += $value->allTaxes();
            }
            return $houseTaxes;
        }
        
    }
    
?>
