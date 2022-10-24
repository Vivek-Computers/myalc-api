<?php

    /**
     * Prints variable in redable format.
     * @param $var any
     */
    function display($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    /**
     * Prints variable in redable format and stops execution
     * @param $var any
     */
    function show($var) {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        die();
    }

    /**
     * Converts stdClass object to array
     * @param $stdClassObject object
     * @return array
     */
    function stdClassToArray($stdClassObject) {
        return json_decode(json_encode($stdClassObject), true);
    }

    /**
     * Validate string and returns true if string is valid, otherwise false
     * @param $var any
     * @return boolean
     */
    function valStr($var) {
        if(!is_string($var) || 0 == strlen($var)) {
            return false;
        }

        return true;
    }

    /**
     * Validate if variable is number and is greater than 0
     * @param $var any
     * @return boolean
     */
    function valId($var) {
        if(!is_numeric($var) || 0 >= $var) {
            return false;
        }

        return true;
    }

    /**
     * Validates if given variable is instance of given class
     * @param $obj any
     * @param $className string
     * @return boolean
     */
    function valObj($obj, $className) {
        if(!is_object($obj) || $className != get_class($obj)) {
            return false;
        }

        return true;
    }

    /**
     * Validates if given variable is valid array of given length
     * @param $var any
     * @param $minCount number
     * @return boolean
     */
    function valArr($arr, $minCount = 1) {
        if(!is_array($arr) || $minCount > count($arr)) {
            return false;
        }

        return true;
    }

    /**
     * Returns string for SQL IN converted from array of varchars
     * @param $arrVars array
     * @return string
     */
    function sqlStringImplode($arrVars) {
        if(!valArr($arrVars)) return '';
        return '\'' . implode('\', \'', $arrVars) . '\'';
    }

    /**
     * Returns string for SQL IN converted from array of integers
     * @param $arrVars array
     * @return string
     */
    function sqlIntImplode($arrVars) {
        if(!valArr($arrVars)) return '';
        return implode(', ', $arrVars);
    }

    /**
     * Converts varibale to boolean
     * @param $var any
     * @return boolean
     */
    function toBool($var) {
        switch($var) {
            case 'f':
            case 'F':
            case 'False':
            case 'false':
            case 'FALSE':
            case '0':
            case 0:
            case false:
                return false;

            default:
                return true;
        }
    }
?>