<?php


namespace App\Brasiltec\Types;


class NDouble {

    private $val;

    public function __construct($val=0) {

        if ($val=='') {
            $this->val = 0.00;
        } else {
            $this->val = $val;
        }
    }

    public function toString() {
        return $this->val;
    }

    public function toDouble() {
        if ($this->val=='' || $this->val == null) {
            return 0;
        } else {
            return $this->val;
        }
    }


    public function toFloat() {
        if ($this->val=='' || $this->val == null) {
            return floatval(0);
        } else {
            return floatval($this->val);
        }
    }

    /**
     * @example truncate(-1.49999, 2); // returns -1.49
     * @example truncate(.49999, 3); // returns 0.499
     * @param float $val
     * @param int f
     * @return float
     */
    private function truncate($val, $f="0")
    {
        if(($p = strpos($val, '.')) !== false) {
            $val = floatval(substr($val, 0, $p + 1 + $f));
        }
        return $val;
    }

    public function toDoubleDecimal($n=2) {
        return $this->truncate($this->val, $n);
    }

    public function toReais($ndec=2) {
        $val = $this->val;
        if ($val=='') {
            return "0,00";
        } else if ($val=='NaN') {
            return '0,00';
        } else {
            $val = number_format($val,$ndec);
            $val = str_replace(",", ";", $val);
            $val = str_replace(".", ",", $val);
            return str_replace(";", ".", $val);
        }
    }

    public function toInt() {
       return number_format($this->val,0,',','');
    }

    public function toText() {
        return number_format($this->val,2,'','');
    }

    public function toDecimalFormat() {
        return number_format($this->val,2,'.','');
    }

    /**
     * Arredonda para próximo valor multiplo de X
     * @param int $x
     * @return float|int
     */
    function toRoundUpToAny($x=10) {
        $n = $this->val;
        return round(($n+$x/2)/$x)*$x;
    }

    function roundDownToAny($x=10) {
        $n = $this->val;
        $res = floor($n/$x) * $x;
        if ($res==0) {
            return 5;
        } else {
            return $res;
        }
    }


    public function toReaisFormat($ndec=2, $decimalSeparator=',', $milharPoing='.') {
        $val = $this->val;
        if ($val=='') {
            return "0{$decimalSeparator}00";
        } else if ($val=='NaN') {
            return "0{$decimalSeparator}00";
        } else {
            $val = number_format($val,$ndec, $decimalSeparator, $milharPoing);
           // $val = str_replace(",", ";", $val);
          //  $val = str_replace(".", ",", $val);
            return $val; //str_replace(";", ".", $val);
        }
    }

    /**
     * @param $val
     * @return NDouble
     */
    public function fromReais($val) {
        $this->val = str_replace(",", ".", str_replace(".", "", $val));
        return $this;
    }

    public function fromDouble($val) {
        $this->val = $val;
        return $this;
    }

    public function add($val) {
        $this->val += $val;
    }

    public function addfromReais($val) {
        $val = str_replace(",", ".", str_replace(".", "", $val));
        $this->val += $val;
    }

    public function subtract($val) {
        $this->val -= $val;
    }

    public function discount($pct) {
        $this->val = ($this->val - ($this->val * ($pct/100)));
    }

    public function discountReturn($pct) {
        //90 + 5% = 94,5
        //return to 100 with pct
        // (94,5 * 100) / (100 + 5)
        $this->val = (($this->val * 100) / (100 + $pct));
    }

    public function discountFix($pct) {
        //90 + 5% = 94,5
        //return to 100 with pct
        // (94,5 * 100) / (100 - 5)
        $this->val = (($this->val * 100) / (100 - $pct));
    }

    public function addPct($pct) {
        $this->val = $this->val + ( $this->val * ($pct/100));
    }

    public function toHour($usasinal=false) {
        $sinal = "+";
        $input = $this->val;
        if ($input<0) {
            $input = $input * (-1);
            $sinal = "-";
        }
        $hours = intval($input);
        $realPart = $input - $hours;
        $minutes = round( $realPart * 60, 0);

        if ($usasinal) {
            return $sinal . str_pad($hours, 2, "0", STR_PAD_LEFT)  . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT);
        } else {
            return str_pad($hours, 2, "0", STR_PAD_LEFT)  . ":" . str_pad($minutes, 2, "0", STR_PAD_LEFT);
        }
    }


}