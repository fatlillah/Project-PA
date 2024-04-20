<?php

function format_of_money($number)
{
    return 'Rp. ' . number_format($number, 0, ',', '.');
}

function indonesian_date($dt, $perform_day = true)
{
    $name_day = array(
        'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum\'at', 'Sabtu', 'Minggu'
    );
    $name_month = array(1 =>
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    $year   = substr($dt, 0, 4);
    $month  = $name_month[(int) substr($dt, 5, 2)];
    $date   = substr($dt, 8, 2);
    $text   = '';

    if ($perform_day) {
        $day_order  = date('w', mktime(0,0,0, substr($dt, 5, 2), $date, $year));
        $day        = $name_day[$day_order];
        $text      .= "$day, $date $month $year";
    }else {
        $text      .= "$date $month $year";
    }

    return $text;
}