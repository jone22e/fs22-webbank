<?php

namespace App\Brasiltec\Types;

class NString {

    private $val = "";

    public function __construct($val) { $this->val = $val; }

    function startsWith($startString)
    {
        $len = strlen($startString);
        return (substr($this->val, 0, $len) === $startString);
    }

    function startsWithNumber() {
        return strlen($this->val) > 0 && ctype_digit(substr($this->val, 0, 1));
    }

    function endsWith($endString) {
        $count = strlen($endString);
        if ($count == 0) {
            return true;
        }
        return (substr($this->val, -$count) === $endString);
    }

    public function isHTML() {
        return $this->val != strip_tags($this->val) ? true:false;
    }

    function toString()
    {
        return $this->val;
    }

    function toUpper()
    {
        return mb_convert_case($this->val, MB_CASE_UPPER, "UTF-8");
    }

    function toLower()
    {
        return mb_convert_case($this->val, MB_CASE_LOWER, "UTF-8");
    }

    function getInitials()
    {
        $ret = '';
        foreach (explode(' ', $this->val) as $word) $ret .= strtoupper($word[0]);
        return substr($ret, 0, 3);
    }

    function toBase64URL()
    {
        $data = $this->val;

        // First of all you should encode $data to Base64 string
        $b64 = base64_encode($data);

        // Make sure you get a valid result, otherwise, return FALSE, as the base64_encode() function do
        if ($b64 === false) {
            return false;
        }

        // Convert Base64 to Base64URL by replacing “+” with “-” and “/” with “_”
        $url = strtr($b64, '+/', '-_');

        // Remove padding character from the end of line and return the Base64URL result
        return rtrim($url, '=');
    }

    function fromBase64URL()
    {
        $data = $this->val;
        // Convert Base64URL to Base64 by replacing “-” with “+” and “_” with “/”
        $b64 = strtr($data, '-_', '+/');

        // Decode Base64 string and return the original data
        return base64_decode($b64, $strict);
    }

    function numbersOnly()
    {
        return preg_replace("/[^0-9]/", "", $this->val);
    }

    function contains($string)
    {
        $pos = strpos($this->val, $string);
        if ($pos === false) {
            return false;
        } else {
            return true;
        }
    }

    function normalize()
    {

        $array = [
            "MM",
            "M3",
            "CB",
            "DB",
            "MC",
            "BSP",
            "PG",
            "LED",
            "CLP",
            "2NA",
            "1NA",
            "2NF",
            "1NF",
            "DIN",
            "VCC",
            "VCA",
            "KVAR",
            "3SE",
            "LAY",
            "APBB",
            "IHM",
            "XCK",
            "XAC",
            "VDC",
            "COB ",
            "SMD",
            "NM",
            "KA",
            "XXX",
            "XXXX",
            "KN",
            "PC",
            "PÇ",
            " IP",
            "GV",
            " até ",
            " ate ",
            " AZ",
            " M",
            " Y",
            " de ",
            " para ",
            " com ",
            " e ",
            " por ",
            " no ",
        ];

        $val = mb_convert_case($this->val, MB_CASE_TITLE, "UTF-8");

        for ($i = 0; $i < count($array); $i++) {
            $val = str_replace(mb_convert_case($array[$i], MB_CASE_LOWER, "UTF-8"), $array[$i], $val);
            $val = str_replace(mb_convert_case($array[$i], MB_CASE_TITLE, "UTF-8"), $array[$i], $val);
        }

        return $val;

    }

    public function firstName() {
        $val = explode(' ', $this->val);
        return $val[0];
    }

    public function removeAcentos() {
        $string =  $this->val;
        $acentos  =  'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $sem_acentos  =  'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $string = strtr($string, utf8_decode($acentos), $sem_acentos);
        $string = str_replace(" ","-",$string);
        return utf8_decode($string);
    }

    public function encrypt_decrypt($action) {
        $string = $this->val;
        $output = false;
        $encrypt_method = "AES-256-CBC";
        $secret_key = $this->chave;
        $secret_iv = $this->chave;
        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        if ( $action == 'e' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if( $action == 'd' ) {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
        return $output;
    }

    public function replace($search, $replace) {
        $this->val = str_replace($search, $replace,  $this->val);
    }

    /**
     * @param $zeros
     * @return NString
     */
    public function strzeros($zeros) {
        $this->val = str_pad($this->val, $zeros, "0", STR_PAD_LEFT);
        return $this;
    }

    public function getVideoID() {
        $url = $this->val;
        //https://www.youtube.com/watch?v=9IjotL1kuIw&t=20s
        parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
        return $my_array_of_vars['v'];
    }

    public function format($mask) {
        $this->val = (new NFormatter())->format($mask, $this->val);
        return $this;
    }

    public function toURL() {
        $str = strtolower($this->val);
        $str = str_replace(" -", "", $str);
        $str = str_replace("–", "", $str);
        $str = str_replace("™", "", $str);
        $str = str_replace("-", "", $str);
        $str = str_replace(":", "", $str);
        $str = str_replace(" ", "-", $str);
        $str = str_replace("|", "", $str);
        $str = str_replace("\\", "", $str);
        $str = str_replace("/", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(",", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace("+", "-", $str);
        $str = str_replace("%", "", $str);
        $str = str_replace("&", "", $str);
        $str = str_replace("²", "", $str);
        $str = str_replace("³", "", $str);
        $str = str_replace("°", "", $str);
        $str = str_replace("º", "", $str);
        $str = str_replace("®", "", $str);
        $str = str_replace("[", "", $str);
        $str = str_replace("]", "", $str);
        $str = str_replace("~", "", $str);
        $str = str_replace("\"", "", $str);
        $str = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/","/(ç|Ç)/"),explode(" ","a a e e i i o o u u n n c"),$str);
        return $str;
    }
}