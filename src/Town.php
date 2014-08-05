<?php
	namespace Mimi\Town;
    class Town {

        public $townName;
        public $foundYear;
        public $townCoords;
        public $streetCount;

        public function __construct($townBuilder, $streetBuilder, $buildingBuilder, $apartmentBuilder) {
            $townOptions = $townBuilder->getTownOptions();
            $townNameArr = array(
                'Sransk', 'Dransk', 'Spansk', 'Letansk', 'Zuransk'
            );
            $this->townName = $townNameArr[$townOptions['townNameRand']];
            $townFoundYear = array(
                2014, 2015, 2016, 2017, 2018
            );
            $this->foundYear = $townFoundYear[$townOptions['townNameRand']];
            $townCoord = array(
                '2014',
                '2015',
                '2016', 
                '2017' 
            );
            $this->townCoords = $townCoord[$townOptions['townNameRand']];
            for ($i = 0; $i < $townOptions['streetCountRand']; $i++) {
                $arr[$i] = new Street($streetBuilder, $buildingBuilder, $apartmentBuilder);
            }
            $this->streetCount = $arr;
        }
        public function townTax(){
            $townTaxes = 0;
            foreach($this->streetCount as $key => $value){
                $townTaxes += $value->streetTax();
            }
            return $townTaxes;
        }
        public function townLandTax(){
            $townLandTaxes = 0;
            foreach($this->streetCount as $key => $value){
                $townLandTaxes += $value->streetLandTax();
            }
            return $townLandTaxes;
        }
        public function peopleCount(){
            $peopleCount = 0;
            foreach($this->streetCount as $value){
                foreach($value->houseCount as $value2){
                    foreach ($value2->apartmentCount as $value3) {
                        $peopleCount += $value3->people."<br>";
                    }
                }
            }
            return $peopleCount;
        }
    }

?>
