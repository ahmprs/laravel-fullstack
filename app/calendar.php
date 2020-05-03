<?php
namespace App;

define("JAL_ORG_GDP", 226894);
define("JAL_MAX_GDP", 3652058);
define("GREG_ORG_GDP", 0);
define("GREG_MAX_GDP", 3652058);

class Calendar
{
    // Days passed from 0001/01/01
    public $gdp = 0;

    public function getGdp(){
        return $this->gdp;
    }

    public function getNew($gdp=0){
        return new Calendar($gdp);
    }

    // Main constructor
    public function __construct($gdp = 0, $timeZone="Iran"){
        // $this->gdp = $gdp;
        
        // if the constructor is called with no gdp value
        // the current date time of server is used to make 
        // present time gdp value.
        if ($gdp==0)
        {
            date_default_timezone_set($timeZone);
            $info = getdate();
            $year = $info['year'];
            $month = $info['mon'];
            $day_of_month = $info['mday'];
            $hour = $info['hours'];
            $min = $info['minutes'];
            $sec = $info['seconds'];
    
            $this->gregDateTimeToGdp(
                $year,
                $month,
                $day_of_month,
                $hour,
                $min,
                $sec
            );
        }
        else {
            $this->gdp = $gdp;
        }
    }

    public static function fromJalDate(string $jalDateStr){
        // make an instance of calendar from the given jal date string
        $gdp = Calendar::jalToGdp($jalDateStr);
        $c = new Calendar($gdp);
        return $c;
    }

    public static function fromGregDate(string $gregDateStr){
        // make an instance of calendar from the given jal date string
        $gdp = Calendar::gregToGdp($gregDateStr);
        $c = new Calendar($gdp);
        return $c;
    }

    public static function getServerGdp(){
        $c = new Calendar();
        $arr = Calendar::getServerGregDateTimeArr();
        $y = $arr['year'];
        $M = $arr['month'];
        $d = $arr['day_of_month'];
        $h = $arr['hour'];
        $m = $arr['min'];
        $s = $arr['sec'];
        $gdp = $c->gregDateTimeToGdp($y, $M, $d, $h, $m, $s);
        return $gdp;
    }

    public static function getServerJalDateStr($timeZone="Iran"){
        // NOT IMPLEMENTED
    }

    public static function getServerGregDateStr($timeZone="Iran"){
        $arr = Calendar::getServerGregDateArr();
        $date_str = '';
        $date_str .= str_pad($arr['year'], 2, "0", STR_PAD_LEFT);
        $date_str .= '/';
        $date_str .= str_pad($arr['month'], 2, "0", STR_PAD_LEFT);
        $date_str .= '/';
        $date_str .= str_pad($arr['day_of_month'], 2, "0", STR_PAD_LEFT);
        return $date_str;
    }

    public static function getServerGregDateArr($timeZone="Iran")
    {
        date_default_timezone_set($timeZone);
        $info = getdate();
        $year = $info['year'];
        $month = $info['mon'];
        $day_of_month = $info['mday'];
        $arr = array(
            'year' => $year,
            'month' => $month,
            'day_of_month' => $day_of_month,
        );
        return $arr;
    }


    public static function getServerGregDateTimeArr($timeZone="Iran")
    {
        date_default_timezone_set($timeZone);
        $info = getdate();
        $year = $info['year'];
        $month = $info['mon'];
        $day_of_month = $info['mday'];
        $hour = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];
        $arr = array(
            'year' => $year,
            'month' => $month,
            'day_of_month' => $day_of_month,
            'hour' => $hour,
            'min' => $min,
            'sec' => $sec,
        );
        return $arr;
    }


    public static function getServerGregDateTimeStr($timeZone="Iran")
    {
        $date_str = Calendar::getServerGregDateStr($timeZone);
        $time_str = Calendar::getServerTimeStr($timeZone);
        return "$date_str-$time_str";
    }


    public static function getServerTimeArr($timeZone="Iran"){
        date_default_timezone_set($timeZone);
        $info = getdate();
        $hour = $info['hours'];
        $min = $info['minutes'];
        $sec = $info['seconds'];
        $arr = array(
            'hour' => $hour,
            'min' => $min,
            'sec' => $sec,
        );
        return $arr;
    }

    public static function getServerTimeStr($timeZone="Iran"){
        $t = Calendar::getServerTimeArr($timeZone);
        $ts = '';
        $ts .= str_pad($t['hour'], 2, "0", STR_PAD_LEFT);
        $ts .= ':';
        $ts .= str_pad($t['min'], 2, "0", STR_PAD_LEFT);
        $ts .= ':';
        $ts .= str_pad($t['sec'], 2, "0", STR_PAD_LEFT);
        return $ts;
    }

    public static function jalToGreg(string $jalDateStr){
        $c = new Calendar();
        $gdp = $c->jalDateStrToGdp($jalDateStr);
        $arr = $c->gdpToGregDateTimeInfoArr($gdp);
        return $arr['gregDateStr'];
    }
    public static function gregToJal(string $gregDateStr){
        $c = new Calendar();
        $gdp = $c->gregDateStrToGdp($gregDateStr);
        $arr = $c->gdpToJalDateTimeInfoArr($gdp);
        return $arr['jalDateStr'];
    }

    public static function jalToGdp(string $jalDateStr){
        $c = new Calendar();
        $gdp = $c->jalDateStrToGdp($jalDateStr);
        return $gdp;
    }
    public static function gdpToJal(float $gdp){
        $c = new Calendar();
        $arr = $c->gdpToJalDateTimeInfoArr($gdp);
        return $arr['jalDateStr'];
    }

    public static function gregToGdp(string $gregDateStr){
        $c = new Calendar();
        $gdp = $c->gregDateStrToGdp($gregDateStr);
        return $gdp;
    }
    public static function gdpToGreg(float $gdp){
        $c = new Calendar();
        $arr = $c->gdpToGregDateTimeInfoArr($gdp);
        return $arr['gregDateStr'];
    }

    public static function gdpToTimeArr(float $gdp){
        $t = $gdp - (int)$gdp;
        $h = $t * 24;
        $t = $h-(int)$h;
        $m = $t * 60;
        $t = $m - (int)$m;
        $s = $t * 60;
        return [
            'hour'=>(int)$h,
            'min'=>(int)$m,
            'sec'=>(int)$s
        ];
    }

    public static function gdpToTimeStr(float $gdp){
        $t = Calendar::gdpToTimeArr($gdp);
        $ts = '';
        $ts .= str_pad($t['hour'], 2, "0", STR_PAD_LEFT);
        $ts .= ':';
        $ts .= str_pad($t['min'], 2, "0", STR_PAD_LEFT);
        $ts .= ':';
        $ts .= str_pad($t['sec'], 2, "0", STR_PAD_LEFT);
        return $ts;
    }


    public static function getYear(string $dateStr){
    try {
        $parts = explode('/', trim($dateStr));
        if (count($parts) != 3) {
            return 0;
        }
        $year = (int) ($parts[0]);
        return $year;
    } 
    catch (Exception $e) {
            return 0;
        }
    }
    
    public static function getMonth(string $dateStr){
        try {
            $parts = explode('/', trim($dateStr));
            if (count($parts) != 3) {
                return 0;
            }
            $month = (int) ($parts[1]);
            return $month;
        } 
        catch (Exception $e) {
            return 0;
        }
    }
    public static function getDay(string $dateStr){
        try {
            $parts = explode('/', trim($dateStr));
            if (count($parts) != 3) {
                return 0;
            }
            $day = (int) ($parts[2]);
            return $day;
        } 
        catch (Exception $e) {
            return 0;
        }
    }


    public function gregDateStrToGdp($dateStr, $h = 0, $m = 0, $s = 0){
        $is_valid = $this->getDateParts($dateStr, $year, $month, $day);
        if ($is_valid == false) {
            return null;
        } else {
            $gdp = $this->gregDateTimeToGdp($year, $month, $day, $h, $m, $s);
            return $gdp;
        }
    }

    public function gregDateTimeToGdp($Year, $Month, $DayOfMonth, $hour=0, $minute=0, $second=0)
    {
        $c = 0;
        $y = 1;
        $d = 0;
        $M = array();

        while (($c + 1) * 100 < $Year) {
            $c++;
            if ($c % 4 == 0) {
                $d += 36525;
            } else {
                $d += 36524;
            }
        }

        while ($c * 100 + $y < $Year) {
            if ($this->isGregLeapYear($c * 100 + $y)) {
                $d += 366;
            } else {
                $d += 365;
            }

            $y++;
        }
        $M = array();
        if ($this->isGregLeapYear($Year)) {
            $M = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        } else {
            $M = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        }

        for ($m = 1; $m < $Month; $m++) {
            $d += $M[$m - 1];
        }
        $d += $DayOfMonth;
        $this->gdp = $d - 1;

        $t = ($hour * 3600 + $minute * 60 + $second) / (24*3600);
        $this->gdp += $t;
        return $this->gdp;
    }
    
    public function setGdp(float $gdp){
        if ($gdp>GREG_MAX_GDP) return;
        if ($gdp<0) return;

        $this->gdp = $gdp;
    }

    public function getJalDate(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalDateStr'];
    }


    public function getJalMonth(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalMonth'];
    }

    public function getJalMonthTitle(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalMonthTitle'];
    }

    public function getJalDayOfMonth(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalDayOfMonth'];
    }


    public function getJalDayOfWeek(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalDayOfWeek'];
    }

    public function getJalDayOfWeekTitle(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['jalDayTitle'];
    }

    public function getJalDaysInYear(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['daysInYear'];
    }


    public function getJalIsLeapYear(){
        $arr = $this->gdpToJalDateTimeInfoArr($this->gdp);
        return $arr['isLeapYear'];
    }


    public function isValidJalDateStr(string $jalDateStr){
        $year=0;
        $month=0;
        $day=0;
        $valid = $this->getDateParts($jalDateStr, $year, $month, $day);
        if(!$valid) return false;
        return $this->isValidJalDate($year, $month, $day);
    }

    public function setJalDate(string $jalDateStr){
        if(!$this->isValidJalDateStr($jalDateStr)) return;
        $gdp = Calendar::jalToGdp($jalDateStr);
        $this->setGdp($gdp);
    }

    public function getGregDate(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregDateStr'];
    }

    public function getGregMonthTitle(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregMonthTitle'];
    }

    public function getGregDayOfMonth(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregDayOfMonth'];
    }

    public function getGregDayOfWeek(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregDayOfWeek'];
    }

    public function getGregDayOfWeekTitle(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregDayTitle'];
    }


    public function getGregDaysInMonth(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['gregDayTitle'];
    }


    public function getGregDaysInYear(){
        $arr = $this->gdpToGregDateTimeInfoArr();
        return $arr['daysInYear'];
    }

    public function getGregIsValidDate(string $gregDateStr){
        $year=0;
        $month=0;
        $day=0;
        $valid = $this->getDateParts($jalDateStr, $year, $month, $day);
        if(!$valid) return false;
        
        if($year>9999) return false;

        if($month<1) return false;
        if($month>12) return false;

        if($day<0) return false;

        $c=new Calendar($year, 1, 1);
        $arr_month_days = null;
        if ($c->isGregLeapYear($year)) {
            $arr_month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        } else {
            $arr_month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        }
        $daysInMonth = $arr_month_days[$month];
        if($day>$daysInMonth) return false;
        
        return true;
    }

    public function setGregDate(string $gregDateStr){
        $gdp = Calendar::gregToGdp($gregDateStr);
        $this->setGdp($gdp);
    }


    public function isGregLeapYear($AYear)
    {
        if ($AYear <= 0) {
            return false;
        }
        if ($AYear % 4 != 0) {
            return false;
        }
        if ($AYear % 100 == 0) {
            if ($AYear % 400 == 0) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
    
    
    //---
    private function getGregCentury($gdp) {
        $RemainingDays = 0;
        $d = 0;
        $c = 0;
        $c_days = 0;
        while (true) {
            $c++;
            if ($c % 4 == 0) $c_days = 36525;
            else $c_days = 36524;

            if ($d + $c_days > $gdp) break;
            $d += $c_days;
        }
        $RemainingDays = $gdp - $d;
        return [
            'Century'=> $c,
            'RemainingDays'=> $RemainingDays
        ];
    }

    private function getGregYear($gdp) {
        $RemainingDays = 0;
        if ($gdp < GREG_ORG_GDP) return -1;
        if ($gdp > GREG_MAX_GDP) return -1;


        $res = $this->getGregCentury($gdp);
        $c = $res['Century'];
        $rem = $res['RemainingDays'];

        $d = 0;
        $y = 0;
        $y_days = 0;
        while (true) {
            $y++;
            if ($this->IsGregLeapYear($y + ($c - 1) * 100)) $y_days = 366;
            else $y_days = 365;

            if ($d + $y_days > $rem) break;
            $d += $y_days;
        }
        $RemainingDays = $rem - $d;
        $g = $y + ($c - 1) * 100;

        return [
            'GregYear'=> $g,
            'RemainingDays'=> $RemainingDays
        ];
    }

    private function getGregMonth($isLeapYear, $yearDaysPassed) {
        $RemainingDays = 0;
        if ($yearDaysPassed > 366) return -1;
        if ($yearDaysPassed < 0) return -1;

        $M = [];
        if ($isLeapYear) $M = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        else $M = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        $d = 0;
        $m = 1;
        while ($d + $M[$m - 1] <= $yearDaysPassed) {
            $d += $M[$m - 1];
            $m++;
        }
        $RemainingDays = $yearDaysPassed - $d;
        return [
            'GregMonth'=> $m,
            'RemainingDays'=> $RemainingDays
        ];
    }

    public function gdpToGregDateTimeInfoArr($gdp = 0) {
        if ($gdp==0) $gdp = $this->gdp;

        $greg_week_days_abbr=[
            'SAT',
            'SUN',
            'MON',
            'TUE',
            'WED',
            'THR',
            'FRI',
        ];

        $greg_months_abbr=[
            'JAN',
            'FEB',
            'MAR',
            'APR',
            'MAY',
            'JUN',
            'JUL',
            'AUG',
            'SEP',
            'OCT',
            'NOV',
            'DEC'
        ];

        $res = $this->getGregYear($gdp);
        $Rem = $res['RemainingDays'];
        $Y = $res['GregYear'];

        $isLeapYear = $this->isGregLeapYear($Y);
        $res = $this->getGregMonth($isLeapYear, $Rem);
        $M = $res['GregMonth'];
        $Rem = $res['RemainingDays'];
        $D = (int)($Rem + 1);

        $date_str = '';
        $date_str .= $this->padLeft($Y, 4, '0') . "/";
        $date_str .= $this->padLeft($M, 2, '0') . "/";
        $date_str .= $this->padLeft($D, 2, '0');

        $day_of_week_number = ((int)($gdp) + 2) % 7;
        $day_title = $greg_week_days_abbr[$day_of_week_number];
        $month_title = $greg_months_abbr[$M - 1];


        $full_date_str = "";
        $full_date_str .= $day_title . ", ";
        $full_date_str .= $month_title . ", ";
        $full_date_str .= $D . ", ";
        $full_date_str .= $Y;

        $t = $gdp - (int)$gdp;
        $h = $t * 24;
        $t = $h-(int)$h;
        $m = $t * 60;
        $t = $m - (int)$m;
        $s = $t * 60;

        $time_str = '';
        $time_str .= $this->padLeft((int)$h, 2, '0');
        $time_str .= ':';
        $time_str .= $this->padLeft((int)$m, 2, '0');
        $time_str .= ':';
        $time_str .= $this->padLeft((int)$s, 2, '0');

        $arr_month_days = null;
        if ($this->isGregLeapYear($Y)) {
            $arr_month_days = array(31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        } else {
            $arr_month_days = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        }

        $daysInMonth = $arr_month_days[$M-1];
        $daysInYear = $isLeapYear? 366:365;

        return [
            'gregDateStr'=> $date_str,
            'timeStr'=>$time_str,
            'gregYear'=> $Y,
            'gregMonth'=> $M,
            'gregDayOfMonth'=> $D,
            'hour'=>(int)$h,
            'min'=>(int)$m,
            'sec'=>(int)$s,
            'gregMonthTitle'=> $month_title,
            'gregDayTitle'=> $day_title,
            'gregDayOfWeek'=> $day_of_week_number,
            'daysInMonth'=>$daysInMonth,
            'daysInYear'=>$daysInYear,
            'isLeapYear'=>$isLeapYear,
        ];
    }    

    private function padLeft($n, $m, $c){
        $r=trim("$n");
        return str_pad($r, $m, $c, STR_PAD_LEFT);
    }

    // gdpToGregDateTimeInfoArr
    public function gdpToJalDateTimeInfoArr($gdp=0)
    {
        if ($gdp==0) $gdp = $this->gdp;

        $jal_week_days_abbr=[
            'ش',
            'ی',
            'د',
            'س',
            'چ',
            'پ',
            'ج',
        ];

        $jal_months_abbr=[
            'فروردین',
            'اردیبهشت',
            'خرداد',
            'تیر',
            'مرداد',
            'شهریور',
            'مهر',
            'آبان',
            'آذر',
            'دی',
            'بهمن',
            'اسفند'
        ];

        $jal_year = 0;
        $jal_month = 0;
        $jal_day_of_month = 0;
        $day_of_week_number = ((int)($gdp) + 2) % 7;
        $rem = 0;
        $jal_year = $this->getJalYear($gdp, $rem);
        $is_leap = $this->IsJalLeapYear($jal_year);

        $rem2 = 0;
        $jal_month = $this->_getJalMonth($is_leap, $rem, $rem2);
        $jal_day_of_month = (int)($rem2 + 1);

        $date_str = "";
        $date_str .= str_pad($jal_year, 4, "0", STR_PAD_LEFT) . '/'; // padLeft($jal_year.toString(), 4, '0') + "/";
        $date_str .= str_pad($jal_month, 2, "0", STR_PAD_LEFT) . '/'; // padLeft($jal_month.toString(), 2, '0') + "/";
        $date_str .= str_pad($jal_day_of_month, 2, "0", STR_PAD_LEFT); //padLeft($jal_day_of_month.toString(), 2, '0');

        $t = $gdp - (int)$gdp;
        $h = $t * 24;
        $t = $h-(int)$h;
        $m = $t * 60;
        $t = $m - (int)$m;
        $s = $t * 60;

        $time_str = '';
        $time_str .= $this->padLeft((int)$h, 2, '0');
        $time_str .= ':';
        $time_str .= $this->padLeft((int)$m, 2, '0');
        $time_str .= ':';
        $time_str .= $this->padLeft((int)$s, 2, '0');

        $month_title = $jal_months_abbr[$jal_month - 1];
        $day_title = $jal_week_days_abbr[$day_of_week_number];

        $daysInYear =  $is_leap ? 366 : 365;
        $daysInMonth = $jal_month < 7 ? 31 : 30;
        if(!$is_leap && $jal_month == 12) $daysInMonth = 29;

        return [
            'jalDateStr'=> $date_str,
            'timeStr'=>$time_str,
            'jalYear'=> $jal_year,
            'jalMonth'=> $jal_month,
            'jalDayOfMonth'=> $jal_day_of_month,
            'hour'=>(int)$h,
            'min'=>(int)$m,
            'sec'=>(int)$s,
            'jalMonthTitle'=> $month_title,
            'jalDayTitle'=> $day_title,
            'jalDayOfWeek'=> $day_of_week_number,
            'isLeapYear'=>$is_leap,
            'daysInYear'=>$daysInYear,
            'daysInMonth'=>$daysInMonth,
        ];
        return $res;
    }

    private function getJalYearFrom($gdp)
    {
        $jal_year = 0;
        $rem = 0;
        $jal_year = $this->getJalYear($gdp, $rem);
        return $jal_year;
    }

    private function getJalMonthFrom($gdp)
    {
        $rem = 0;
        $rem2 = 0;
        $jal_year = $this->getJalYear($gdp, $rem);
        $is_leap = $this->IsJalLeapYear($jal_year);
        $jal_month = $this->_getJalMonth($is_leap, $rem, $rem2);
        return $jal_month;
    }

    private function getJalDaysInMonth($gdp)
    {
        $rem = 0;
        $jal_year = $this->getJalYear($gdp, $rem);
        $year = $this->getJalYearFrom($gdp);
        $month = $this->getJalMonthFrom($gdp);
        $is_leap = $this->IsJalLeapYear($jal_year);
        $M = array();
        if ($is_leap) {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30);
        } else {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        }
        return $M[$month - 1];
    }

    private function getJalDayOfMonthFrom($gdp)
    {
        $rem = 0;
        $rem2 = 0;
        $jal_year = $this->getJalYear($gdp, $rem);
        $is_leap = $this->IsJalLeapYear($jal_year);
        $rem = 0;
        $jal_month = $this->_getJalMonth($is_leap, $rem, $rem2);
        $jal_day_of_month = $rem + 1;
        return $jal_day_of_month;
    }

    private function getJalDayOfWeekFrom($gdp)
    {
        $jal_day_of_week = floor($gdp + 2) % 7;
        return $jal_day_of_week;
    }

    private function getJalFirstDayOfMonthFrom($gdp)
    {
        $g = $gdp;
        $d = $this->getJalDayOfMonthFrom($gdp);
        $g = $g - $d + 1;
        $d = $this->getJalDayOfWeekFrom($g);
        return $d;
    }

    private function IsJalLeapYear($AJalaliYear)
    {
        for ($i = 0; $i < 7; $i++) {
            if (($AJalaliYear - ($i * 4 - 7)) % 33 == 0) {
                return true;
            }
        }

        if (($AJalaliYear - (7 * 4 - 6)) % 33 == 0) {
            return true;
        }

        return false;
    }


    private function getJalYear($GregDaysPassed, &$rem)
    {
        if ($GregDaysPassed < JAL_ORG_GDP) {
            return -1;
        }

        if ($GregDaysPassed > JAL_MAX_GDP) {
            return -1;
        }

        $d = 0;
        $y = 0;

        $Rem = 0;
        $n = $this->GetJalLeapSequence($GregDaysPassed, $Rem);
        if ($n == 0) {
            $y = 0;
        } else {
            $y = $n * 33 - 8;
        }

        $y_days = 0;
        while (true) {
            $y++;
            if ($this->IsJalLeapYear($y)) {
                $y_days = 366;
            } else {
                $y_days = 365;
            }

            if ($d + $y_days > $Rem) {
                break;
            }

            $d += $y_days;
        }
        $rem = $Rem - $d;
        return $y;
    }


    private function GetJalLeapSequence($GregDaysPassed, &$rem)
    {
        $JalDaysPassed = $GregDaysPassed - JAL_ORG_GDP;
        $n = floor(($JalDaysPassed + 2922) / 12053);

        if ($n == 0) {
            $rem = $JalDaysPassed;
            return $n;
        } else if ($n == 1) {
            $rem = $JalDaysPassed - 9131;
            return $n;
        } else {
            $rem = $JalDaysPassed - (9131 + ($n - 1) * 12053);
            return $n;
        }
    }

    private function _getJalMonth($IsLeapYear, $YearDaysPassed, &$rem)
    {
        if ($YearDaysPassed > 366) {
            return -1;
        }

        if ($YearDaysPassed < 0) {
            return -1;
        }

        $M = array();
        if ($IsLeapYear) {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30);
        } else {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        }

        $d = 0;
        $m = 1;
        while ($d + $M[$m - 1] <= $YearDaysPassed) {
            $d += $M[$m - 1];
            $m++;
        }
        $rem = $YearDaysPassed - $d;
        return $m;
    }    

// --------------------------------------


    public function jalDateTimeToGdp($Year, $Month, $DayOfMonth, $hour=0, $minute=0, $second=0)
    {
        if ($this->isValidJalDate($Year, $Month, $DayOfMonth) == false) {
            return null;
        }

        $n = floor(($Year + 7) / 33);
        $y = 0;
        $d = 0;
        $m = 1;
        $M = array();

        if ($n == 0) {
            $d = 0;
            $y = 1;
        } else {
            $d = 9131 + ($n - 1) * 12053;
            $y = $n * 33 - 7;
        }

        while ($y < $Year) {
            if ($this->IsJalLeapYear($y)) {
                $d += 366;
            } else {
                $d += 365;
            }

            $y++;
        }

        if ($this->IsJalLeapYear($y)) {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 30);
        } else {
            $M = array(31, 31, 31, 31, 31, 31, 30, 30, 30, 30, 30, 29);
        }

        while ($m < $Month) {
            $d += $M[$m - 1];
            $m++;
        }
        $d += $DayOfMonth;
        $d += JAL_ORG_GDP;
        $this->gdp = $d - 1;

        $t = ($hour * 3600 + $minute * 60 + $second) / (24*3600);
        $this->gdp += $t;
        return $this->gdp;
    }

    public function jalDateStrToGdp($dateStr, $h=0,$m=0,$s=0)
    {
        $year = 0;
        $month = 0;
        $day = 0;

        $is_valid = $this->getDateParts($dateStr, $year, $month, $day);
        if ($is_valid == false) {
            return null;
        } else {
            $gdp = $this->jalDateTimeToGdp($year, $month, $day, $h, $m, $s);
            return $gdp;
        }
    }

    public function isValidJalDate($JalYear, $JalMonth, $JalDayOfMonth)
    {
        if ($JalYear < 0) {
            return false;
        }

        if ($JalYear > 9999) {
            return false;
        }

        if ($JalMonth < 0) {
            return false;
        }

        if ($JalMonth > 12) {
            return false;
        }

        if ($JalDayOfMonth < 0) {
            return false;
        }

        if ($JalDayOfMonth > 31) {
            return false;
        }

        if ($JalMonth > 6 && $JalDayOfMonth > 30) {
            return false;
        }

        $is_leap = $this->IsJalLeapYear($JalYear);
        if ($is_leap && $JalMonth == 12 && $JalDayOfMonth > 29) {
            return false;
        }

        return true;
    }

    public function getDateParts($dateStr, &$year, &$month, &$day)
    {
        try {
            $parts = explode('/', trim($dateStr));
            if (count($parts) != 3) {
                return null;
            }

            $year = (int) ($parts[0]);
            $month = (int) ($parts[1]);
            $day = (int) ($parts[2]);

            if($year<0) return false;
            if($month<0) return false;
            if($day<0) return false;

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
} // CLASS

# TESTS:
#########################################################
// Route::get('/test', function(){
//     $c = Calendar::fromJalDate("1399/02/08");
//     $c -> setjalDate('1360/04/20');
//     $c -> setgregDate('2012/06/06');
//     $gdp = 0;
//     return u::resp(1, [
//         // 'getServerTimeArr'=>Calendar::getServerTimeArr(),
//         // 'getServerTimeStr'=>Calendar::getServerTimeStr(),
//         // 'getServerGregDateTimeArr'=>Calendar::getServerGregDateTimeArr(),
//         // 'getServerGregDateTimeStr'=>Calendar::getServerGregDateTimeStr(),
//         // 'getServerGregDateArr'=>Calendar::getServerGregDateArr(),
//         // 'getServerGregDateStr'=>Calendar::getServerGregDateStr(),
//         // 'getServerGdp'=>Calendar::getServerGdp(),
//         // 'gregDateTimeToGdp (2020,01,01)'=>$c->gregDateTimeToGdp(2020,01,01),
//         // 'gdpToTimeArr'=>Calendar::gdpToTimeArr(Calendar::getServerGdp()),
//         // 'gdpToTimeStr'=>Calendar::gdpToTimeStr(Calendar::getServerGdp()),
//         'gdpToGregDateTimeInfoArr'=>$c->gdpToGregDateTimeInfoArr(),
//         'gdpToJalDateTimeInfoArr'=>$c->gdpToJalDateTimeInfoArr(),
//         // 'jalDateTimeToGdp'=>$c->jalDateTimeToGdp(1399,02,06, 10, 11, 12),
//         // 'jalDateStrToGdp'=>$c->jalDateStrToGdp('1399/02/06', 10, 11, 12),
//         // 'jalToGreg (1399/02/07)'=>Calendar::jalToGreg('1399/02/07'),
//         // 'gregToJal (2020/04/26)'=>Calendar::gregToJal('2020/04/26'),
//         // 'jalToGdp (1399/02/07)'=>Calendar::jalToGdp('1399/02/07'),
//         // 'gdpToJal (737540)'=>Calendar::gdpToJal(737540),
//         // 'gregToGdp (2020/04/26)'=>Calendar::gregToGdp('2020/04/26'),
//         // 'gdpToGreg (737540)'=>Calendar::gdpToGreg(737540),

//         // 'getYear (1399/02/07)'=>Calendar::getYear('1399/02/07'),
//         // 'getMonth (1399/02/07)'=>Calendar::getMonth('1399/02/07'),
//         // 'getDay (1399/02/07)'=>Calendar::getDay('1399/02/07'),

//         'getJalDate'=>$c->getJalDate(),
//         'getJalMonth'=>$c->getJalMonth(),
//         'getJalMonthTitle'=>$c->getJalMonthTitle(),
//         'getJalDayOfMonth'=>$c->getJalDayOfMonth(),
//         'getJalDayOfWeek'=>$c->getJalDayOfWeek(),
//         'getJalDayOfWeekTitle'=>$c->getJalDayOfWeekTitle(),
//         'getJalDaysInYear'=>$c->getJalDaysInYear(),
//         'getJalIsLeapYear'=>$c->getJalIsLeapYear(),
//         'isValidJalDateStr (1399/07/31)'=>$c->isValidJalDateStr('1399/07/31'),
//         'getGregDate'=>$c->getGregDate(),
//         'getGregMonthTitle'=>$c->getGregMonthTitle(),
//         'getGregDayOfMonth'=>$c->getGregDayOfMonth(),
//         'getGregDayOfWeek'=>$c->getGregDayOfWeek(),
//         'getGregDayOfWeekTitle'=>$c->getGregDayOfWeekTitle(),
//         'getGregDaysInYear'=>$c->getGregDaysInYear(),
//     ]);
// });
#########################################################
