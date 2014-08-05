<?php
	namespace Mimi\Town;
    class Street{
        public $streetName;
        public $streetLength;
        public $streetCoords;
        public $houseCount;
        
        public $yardManSquare = 4500;
        
        public function __construct($streetBuilder, $buildingBuilder, $apartmentBuilder){
            $streetOptions = $streetBuilder->getStreetOptions();
            $streetNameArr = array(
                'Svitla', 'Temna', 'Dovga', 'Korotka', 'Vyzka', 'Shiroka'
            );
            $this->streetName = $streetNameArr[$streetOptions['streetNameRand']];
            $this->streetLength = $streetOptions['streetLengthRand'];
            $this->streetCoords = $streetOptions['streetCoordsRand'];
            for($i = 0; $i < $streetOptions['houseCountRand']; $i++){
               $arr[$i] = new House($buildingBuilder, $apartmentBuilder);
            }
            $this->houseCount = $arr;
        }
        public function yardManCount(){
            $yardMan = 0;
            foreach ($this->houseCount as $value) {
                $yardMan += $value->nearestArea;
            }
            $yardMan = ceil($yardMan / $this->yardManSquare);
            return $yardMan;
        }
        public function streetTax(){
            $streetTaxes = 0;
            foreach($this->houseCount as $value){
                $streetTaxes += $value->houseTax();
            }
            return $streetTaxes;
        }
        public function streetLandTax(){
            $streetLandTaxes = 0;
            foreach($this->houseCount as $value){
                $streetLandTaxes += $value->landTax();
            }
            return $streetLandTaxes;
        }
    }
?>