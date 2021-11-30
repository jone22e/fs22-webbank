<?php


namespace App\Brasiltec\Types;


class NDate {

    public $val;

    public function __construct($val='') {
        if ($val=='') {
            $this->val = date('Y-m-d H:i:s');
        } else {
            $this->val = $val;
        }
    }

    public function toDate() {
        return $this->val;
    }

    public function fromTimeStamp($val) {
        $this->val = date('Y-m-d H:i:s', strtotime($val));
        return $this;
    }

    public function fromYYYYMMDD($val) {
        if ($val=='') {
            return "";
        } else {
            $this->val = date("Y-m-d", strtotime($val));
        }
    }

    public function fromDate($val) {
        $this->val = $val;
        return $this;
    }

    public function fromString($val) {
        if ($val=='') {
            return "";
        } else {
            $data = str_replace("/", "-", $val);
            $this->val = date('Y-m-d', strtotime($data));
        }
        return $this;
    }

    public function fromStringHora($val) {
        if ($val=='') {
            return "";
        } else {
            $data = str_replace("/", "-", $val);
            $this->val = date('Y-m-d H:i:s', strtotime($data));
        }
        return $this;
    }

    public function toDateOnly() {
        $val = $this->val;
        return date('Y-m-d', strtotime($val));
    }

    public function toFormat($format='dmY') {
        $val = $this->val;
        return date($format, strtotime($val));
    }

    public function toJS() {
        $val = $this->val;
        return date('D M d Y H:i:s O', strtotime($val));
    }

    public function toString() {
        $val = $this->val;
        if ($val=='') {
            return "";
        } else {
            $data = str_replace("-", "-", $val);
            return date('d/m/Y', strtotime($data));
        }
    }

    public function toTimeDecimal() {
        $time = $this->toTime();
        $timeArr = explode(':', $time);
        $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
        return $decTime;
    }

    public function toStringHora() {
        $val = $this->val;
        if ($val=='') {
            return "";
        } else {
            $data = str_replace("-", "-", $val);
            return date('d/m/Y H:i', strtotime($data));
        }
    }

    public function toTime() {
        $val = $this->val;
        if ($val=='') {
            return "";
        } else {
            $data = str_replace("-", "-", $val);
            return date('H:i:s', strtotime($data));
        }
    }

    public function addDays($dias=0){
        $data = $this->val;
        $this->val = date('Y-m-d H:i:s', strtotime($data. ' +'.$dias.' days'));
    }

    public function addHours($horas=0){
        $data = $this->val;
        $this->val = date('Y-m-d H:i:s', strtotime($data. ' +'.$horas.' hours'));
    }

    public function getMonthString() {
        setlocale(LC_TIME, 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        return strftime("%B / %Y", strtotime($this->val));
    }

    public function getMonthYear() {
        return date("m/Y", strtotime($this->val));
    }

    public function moveToFirstDayOfMonth() {
        $data = $this->val;
        $this->val = date('Y-m-01 H:i:s', strtotime($data));
    }

    public function moveToLastDayOfMonth() {
        $data = $this->val;
        $mes = date('m', strtotime($data));
        $ano = date('Y', strtotime($data));
        $hora = date('H', strtotime($data));
        $minuto = date('i', strtotime($data));
        $segundo = date('s', strtotime($data));
        $ultimo_dia = date("Y-m-t H:i:s", mktime($hora,$minuto,$segundo,$mes,'01',$ano));
        $this->val = $ultimo_dia;
    }

    public function moveToFirstDayOfWeek() {
        $string_date = $this->val;
        $day_of_week = date('N', strtotime($string_date));
        $week_first_day = date('Y-m-d', strtotime($string_date . " - " . ($day_of_week - 1) . " days"));
        $this->val = $week_first_day;
    }
    public function moveToLastDayOfWeek() {
        $string_date = $this->val;
        $day_of_week = date('N', strtotime($string_date));
        $week_last_day = date('Y-m-d', strtotime($string_date . " + " . (7 - $day_of_week) . " days"));
        $this->val = $week_last_day;
    }

    public function addmonths($messes=0){
        $data = $this->val;
        $this->val = date('Y-m-d', strtotime($data. ' +'.$messes.' months'));
    }

    /**
     * Função para retornar a diferença de dias até a data informada
     * Exemplo: $count = $date->daysUntil('2020-01-01');
     * @param $data yyyy-mm-dd
     * @return integer
     */
    function daysUntil($data) {
        $d1 = strtotime($data);
        $d2 = strtotime($this->toDate());
        $dataFinal = ($d2 - $d1) /86400;
        if($dataFinal < 0) { $dataFinal *= -1; }
        return ceil($dataFinal);
    }

    function secondsUntil($data) {
        $d1 = strtotime($data);
        $d2 = strtotime($this->toDate());
        $dataFinal = ($d1 - $d2);
        return ceil($dataFinal);
    }

    function daysRemaining() {
        $d1 = strtotime(date('Y-m-d'));
        $d2 = strtotime($this->toDate());
        $dataFinal = ($d2 - $d1) /86400;
        if($dataFinal < 0) { $dataFinal = 0; }
        return ceil($dataFinal);
    }

    function monthsUntil($data) {
        $d1 = strtotime($data);
        $d2 = strtotime($this->toDate());
        $dataFinal = ($d2 - $d1) /(86400*30);
        if($dataFinal < 0) { $dataFinal *= -1; }
        return ceil($dataFinal);
    }

    function timeForHumans($full = false) {
        $now = new \DateTime();
        $ago = new \DateTime($this->val);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'ano',
            'm' => 'mes',
            'w' => 'semana',
            'd' => 'dia',
            'h' => 'hora',
            'i' => 'minuto',
            's' => 'segundo',
        );
        $mais = false;
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) {
            if (count($string)>4) {
                $mais = true;
            }
            $string = array_slice($string, 0, 1);
        }
        $res =  $string ? implode(', ', $string) . ' atrás' : 'agora';

        $res = str_replace('mess', 'meses', $res);

       /* $str = new NString($string);
        if ($str->contains("meses")) {
            $mais = true;
        }
        if ($str->contains("semanas")) {
            $mais = true;
        }
        if ($str->contains("anos")) {
            $mais = true;
        }*/

        return ($mais?'mais de ':'') . $res;
    }

    /**
     * @Annotation Menor que hoje
     * @return bool
     */
    public function isLessToday() {
        if(strtotime($this->val) < strtotime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }

    public function isLessNow() {
        if(strtotime($this->val) < strtotime(date('Y-m-d H:i:s'))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Annotation  Maior que hoje
     * @return bool
     */
    public function isHigherToday() {
        if(strtotime($this->val) > strtotime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Annotation  Maior que hoje
     * @return bool
     */
    public function isHigher($date) {
        if(strtotime($this->val) > strtotime($date)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Annotation Menor que hoje
     * @return bool
     */
    public function isLess($date) {
        if(strtotime($this->val) < strtotime($date)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @Annotation  É hoje
     * @return bool
     */
    public function isToday() {
        if(strtotime($this->val) == strtotime(date('Y-m-d'))) {
            return true;
        } else {
            return false;
        }
    }

    public function timeToDecimal($time) {
        $timeArr = explode(':', $time);
        $decTime = ($timeArr[0]*60) + ($timeArr[1]) + ($timeArr[2]/60);
        return $decTime;
    }

    public function isBefore(int $hour) {
        if (date('H') < $hour) {
            return true;
        } else {
            return false;
        }
    }

}