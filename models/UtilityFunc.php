<?php

namespace app\models;

use DateTime;
use stdClass;
use Yii;

class UtilityFunc
{

    public static function getRealUserIp()
    {
        switch (true) {
            case (!empty($_SERVER['HTTP_X_REAL_IP'])):
                return $_SERVER['HTTP_X_REAL_IP'];
            case (!empty($_SERVER['HTTP_CLIENT_IP'])):
                return $_SERVER['HTTP_CLIENT_IP'];
            case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            default:
                return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function CountryList()
    {

        $api_url = 'https://registrar.ums.edu.my/staff/web/api/staff/country-list';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        return $response_data;
    }

    public static function DepartmentList()
    {

        $api_url = 'https://registrar.ums.edu.my/staff/web/api/staff/dept-list';

        // Read JSON file
        $json_data = file_get_contents($api_url);

        // Decode JSON data into PHP array
        $response_data = json_decode($json_data);

        return $response_data;
    }

    public static function BloodTypeList()
    {
        return [
            'A+' => 'A+',
            'A' => 'A',
            'A-' => 'A-',
            'B+' => 'B+',
            'B' => 'B',
            'B-' => 'B-',
            'AB+' => 'AB+',
            'AB' => 'AB',
            'AB-' => 'AB-',
            'O+' => 'O+',
            'O' => 'O',
            'O-' => 'O-',
            'x' => 'Tidak Tahu',
        ];
    }
    public static function WargaList()
    {
        return [
            'Warganegara Malaysia' => 'Warganegara Malaysia',
            // 'Penduduk Tetap' => 'Penduduk Tetap',
            'Bukan Warganegara' => 'Bukan Warganegara',
        ];
    }

    public static function StatusKerja()
    {
        return [
            'Bekerja' => 'Bekerja',
            'Pelajar' => 'Pelajar',
            '99' => 'Lain-lain',
        ];
    }

    public static function msgError($msg)
    {
        return Yii::$app->getSession()->setFlash('danger', [
            'type' => 'danger',
            'duration' => 5000,
            'icon' => 'fa fa-exclamation',
            'message' => $msg,
            'title' => 'Tidak Berjaya',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function msgSuccess($msg)
    {
        return Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'fa fa-check',
            'message' => $msg,
            'title' => 'Berjaya',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function displayMsg($type, $title, $msg)
    {
        return Yii::$app->getSession()->setFlash($type, [
            'type' => $type,
            'duration' => 5000,
            'icon' => 'fa fa-check',
            'title' => $title,
            'message' => $msg,
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function myKad($icno)
    {

        $arr = [];

        $tmp_hari = substr($icno, 4, 2);
        $tmp_bulan = substr($icno, 2, 2);
        $tmp_tahun = substr($icno, 0, 2);

        //TARIKH LAHIR//////////////////////////////////////
        if ($tmp_tahun >= 00 && $tmp_tahun <= 30) {
            $tmp_tahun = 2000 + $tmp_tahun;
        }

        if ($tmp_tahun >= 31 && $tmp_tahun <= 99) {
            $tmp_tahun = 1900 + $tmp_tahun;
        }

        $tarikh_lahir = $tmp_hari . "/" . $tmp_bulan . "/" . $tmp_tahun;

        //UMUR//////////////////////////////////////
        $tmp_tarikh_lahir = $tmp_tahun . "-" . $tmp_bulan . "-" . $tmp_hari;;
        $umur = date_create($tmp_tarikh_lahir)->diff(date_create('today'))->y;

        $arr = [
            'tarikh_lahir' =>  $tarikh_lahir,
            'umur' => $umur,
        ];

        return $arr;
    }

    public static function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);



        if ($errno = curl_errno($curl)) {



            $error_message = curl_strerror($errno);
            echo "cURL error ({$errno}):\n {$error_message}";
            exit();
        }

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

    public static function dateDifference($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);

        $interval = date_diff($datetime1, $datetime2);

        return $interval->format($differenceFormat);
    }

    /**
     * diff from datetime
     * @param datetime $dt1
     * @param datetime $dt2
     * @return object $dtd (day, hour, min, sec / total)
     */
    public static function datetimeDiff($dt1, $dt2)
    {
        $t1 = strtotime($dt1);
        $t2 = strtotime($dt2);

        $dtd = new stdClass();
        $dtd->interval = $t2 - $t1;
        $dtd->total_sec = abs($t2 - $t1);
        $dtd->total_min = floor($dtd->total_sec / 60);
        $dtd->total_hour = floor($dtd->total_min / 60);
        $dtd->total_day = floor($dtd->total_hour / 24);

        $dtd->day = $dtd->total_day;
        $dtd->hour = $dtd->total_hour - ($dtd->total_day * 24);
        $dtd->min = $dtd->total_min - ($dtd->total_hour * 60);
        $dtd->sec = $dtd->total_sec - ($dtd->total_min * 60);
        return $dtd;
    }

    public static function time_diff($dt1, $dt2)
    {
        $y1 = substr($dt1, 0, 4);
        $m1 = substr($dt1, 5, 2);
        $d1 = substr($dt1, 8, 2);
        $h1 = substr($dt1, 11, 2);
        $i1 = substr($dt1, 14, 2);
        $s1 = substr($dt1, 17, 2);

        $y2 = substr($dt2, 0, 4);
        $m2 = substr($dt2, 5, 2);
        $d2 = substr($dt2, 8, 2);
        $h2 = substr($dt2, 11, 2);
        $i2 = substr($dt2, 14, 2);
        $s2 = substr($dt2, 17, 2);

        $r1 = date('U', mktime($h1, $i1, $s1, $m1, $d1, $y1));
        $r2 = date('U', mktime($h2, $i2, $s2, $m2, $d2, $y2));
        return ($r1 - $r2);
    }

    public static function hour_diff($d1, $d2)
    {
        $d1 = new DateTime($d1);
        $d2 = new DateTime($d2);
        $interval = $d1->diff($d2);
        return ($interval->days * 24) + $interval->h;
    }

    public static function ifError($msg)
    {
        return Yii::$app->getSession()->setFlash('danger', [
            'type' => 'danger',
            'duration' => 5000,
            'icon' => 'fa fa-exclamation',
            'message' => $msg,
            'title' => 'Tidak Berjaya',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function ifSuccess($msg)
    {
        return Yii::$app->getSession()->setFlash('success', [
            'type' => 'success',
            'duration' => 5000,
            'icon' => 'fa fa-check',
            'message' => $msg,
            'title' => 'Berjaya',
            'positonY' => 'top',
            'positonX' => 'right'
        ]);
    }

    public static function btnStatus($type, $msg, $label)
    {
        $icon = 'times-circle';

        if($type == 'success'){
            $icon = 'check-circle';
        }

        return '<button type="button" class="btn btn-' . $type . ' btn-sm" data-toggle="tooltip" 
        data-placement="top" title="' . $msg . '"><i class="fas fa-'.$icon.'"></i>&nbsp;' . $label . '</button>';
    }

    public static function isCurrentPage($controller, $action) {
        return Yii::$app->controller->id === $controller && Yii::$app->controller->action->id === $action;
    }

    public static function isCurrentSub($expectedSubValue) {
        $currentSubValue = Yii::$app->request->get('sub', 'default');
        return $currentSubValue == $expectedSubValue;
    }

    public static function getYearsList($plus = 0)
    {

        $currentYear = date('Y') + $plus;
        $yearFrom = 2022;
        $yearsRange = range($yearFrom, $currentYear);
        return array_combine($yearsRange, $yearsRange);
    }
}
