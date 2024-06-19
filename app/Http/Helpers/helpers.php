<?php

function format_of_money($number)
{
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function formatNumber($number) {
    if ($number >= 1000000000 || $number <= -1000000000) {
        return number_format($number / 1000000000, 1) . 'B';
    }
    elseif ($number >= 1000000 || $number <= -1000000) {
        return number_format($number / 1000000, 1) . 'M';
    }
    elseif ($number >= 1000 || $number <= -1000) {
        return number_format($number / 1000, 1) . 'K';
    }
    
    return $number; 
}

function indonesian_date($dt, $format = 'full')
{
    $name_day = array(
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    );

    $name_month = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $year   = substr($dt, 0, 4);
    $month  = $name_month[(int) substr($dt, 5, 2)] ?? '';
    $date   = substr($dt, 8, 2);

    switch ($format) {
        case 'full':
            $day_order  = date('w', mktime(0, 0, 0, substr($dt, 5, 2), $date, $year));
            $day        = $name_day[$day_order];
            return "$day, $date $month $year";
        case 'day_date_month_year':
            $day_order  = date('w', mktime(0, 0, 0, substr($dt, 5, 2), $date, $year));
            $day        = $name_day[$day_order];
            return "$day, $date $month $year";
        case 'date_month_year':
            return "$date $month $year";
        case 'month_year':
            return "$month $year";
        case 'year':
            return "$year";
        case 'month_only':
            return "$month";
        default:
            return "$date $month $year";
    }
}
