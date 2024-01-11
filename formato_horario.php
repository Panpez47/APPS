<?php
function formatWeekToMonthDayRange($weekString) {
    // Establece el locale a inglés para utilizar strftime() y luego traducir al español
    setlocale(LC_TIME, 'en_US.UTF-8');

    [$year, $week] = explode('-W', $weekString);
    
    $dateTime = new DateTime();
    $dateTime->setISODate((int)$year, (int)$week);

    // Obtiene el mes y el día en inglés
    $startOfWeek = strftime('%B %d', $dateTime->getTimestamp()); // January 01
    
    // Calcula la fecha del domingo de esa semana
    $dateTime->modify('+6 days');
    $endOfWeek = strftime('%d', $dateTime->getTimestamp()); // 07

    // Arreglo de traducción de meses de inglés a español
    $monthsEnglishToSpanish = [
        'January' => 'Enero',
        'February' => 'Febrero',
        'March' => 'Marzo',
        'April' => 'Abril',
        'May' => 'Mayo',
        'June' => 'Junio',
        'July' => 'Julio',
        'August' => 'Agosto',
        'September' => 'Septiembre',
        'October' => 'Octubre',
        'November' => 'Noviembre',
        'December' => 'Diciembre'
    ];

    // Divide la fecha en palabras para traducir el mes
    list($monthEn, $day) = explode(' ', $startOfWeek);
    
    // Traduce el mes al español
    $monthEs = isset($monthsEnglishToSpanish[$monthEn]) ? $monthsEnglishToSpanish[$monthEn] : $monthEn;

    // Devuelve la fecha en el nuevo formato
    return ucfirst($monthEs) . " " . $day . "-" . $endOfWeek . " - " . $year;
}