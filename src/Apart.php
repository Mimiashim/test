<?php
	namespace Mimi\Town;
 class Apart {
            public $room;
            public $square;
            public $floor;
            public $people;
            public $balcony;
            public $heating;
            public $kvt;
            
            public $squarePrice1floor = 1.5;
            public $squarePrice2floor = 2;
            public $waterPriceCenter = 52.2;
            public $waterPriceAuto = 63;
            public $hotWaterPrice = 53.84;
            public $heatingPrice = 3.48;
            public $tboPrice = 10;
            public $kvtPrice = 0.28;
                     
            public function __construct($apartmentOptions){    
                $this->room = $apartmentOptions['roomRand'];
                $this->square = $apartmentOptions['roomRand'] * $apartmentOptions['squareRand'] + 15;
                $this->floor = rand (1, $apartmentOptions['floorCount']);
                $this->people = $apartmentOptions['peopleRand'];
                if ($this->room > 2){
                    $this->balcony = 2;
                } else {
                    $this->balcony = 1;
                }
                if($apartmentOptions['gasRand'] == 0){
                    $this->heating = 'централизованное';
                } else {
                     $this->heating = 'автономное';
                }
                $this->kvt = $apartmentOptions['kvtRand'];
            }
            public function setTenant($tent){
                $this->people = $tent;
            }
            public function getTenant(){
                return $this->people;
            }
            public function squarePay(){
                if($this->floor == 1){
                    $tax = $this->square * $this->squarePrice1floor;
                    return $tax;
                } else {
                    $tax = $this->square * $this->squarePrice2floor;
                    return $tax;
                }
            }
            public function waterPay(){
                if($this->heating == 'централизованное'){
                $tax = $this->people * $this->waterPriceCenter;
                return $tax;
                } else {
                    $tax = $this->people * $this->waterPriceAuto;
                return $tax;
                }
            }
            public function hotWaterPay(){
                if($this->heating == 'централизованное'){
                    $tax = $this->people * $this->hotWaterPrice + $this->people * $this->heatingPrice;
                    return $tax;
                } else {
                    $tax = 0;
                    return $tax;
                }
            }
            public function tbo(){
                $tax = $this->people * $this->tboPrice;
                return $tax;
            }
            public function electricity(){
                 $electr = round($this->kvt * $this->kvtPrice, 2);
                return $electr;
              }
            
            public function allTaxes(){
                $all = $this->squarePay() + $this->waterPay() + $this->hotWaterPay() + $this->tbo() + 
                         $this->electricity();
                return $all;
            }
            
        }
?>
