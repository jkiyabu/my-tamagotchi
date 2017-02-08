<?php
    class Tamagotchi
    {
        private $name;
        private $sleep;
        private $happiness;
        private $hunger;

        function __construct($name) {
            $this->name = $name;
            $this->sleep = 40;
            $this->happiness = 25;
            $this->hunger = 25;
        }

        function setName($new_name) {
            $this->name = $new_name;
        }

        function getName() {
            return $this->name;
        }

        function setSleep($new_sleep) {
            $this->sleep = $new_sleep;
        }

        function getSleep() {
            return $this->sleep;
        }

        function setHappiness($new_happiness) {
            $this->happiness = $new_happiness;
        }

        function getHappiness() {
            return $this->happiness;
        }

        function setHunger($new_hunger) {
            $this->hunger = $new_hunger;
        }

        function getHunger() {
            return $this->hunger;
        }

        function save() {
            array_push($_SESSION['tamagotchis'], $this);
        }

        static function getAll() {
            return $_SESSION['tamagotchis'];
        }

        static function deleteAll() {
            $_SESSION['tamagotchis'] = array();
        }



    }

?>
