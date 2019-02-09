<?php

if ( ! function_exists('format_rupiah'))
{
    /**
     * Convert to Format Rupiah
     *
     * @param    integer    required
     * @return    string
     */
    function format_rupiah($data)
    {
        return 'Rp' . number_format($data, 2, ',', '.');
    }
}

if ( ! function_exists('religions'))
{
    /**
     * List Religion
     *
     * @return    array
     */
    function religions()
    {
        return array('Islam', 'Kristen', 'Hindu', 'Budha', 'Katolik');
    }
}

if ( ! function_exists('month_id'))
{
    function month_id($str)
    {
        $month = '';
        switch($str){
            case '01':
                $month = 'Januari';
                break;
            case '02':
                $month = 'Februari';
                break;
            case '03':
                $month = 'Maret';
                break;
            case '04':
                $month = 'April';
                break;
            case '05':
                $month = 'Mei';
                break;
            case '06':
                $month = 'Juni';
                break;
            case '07':
                $month = 'Juli';
                break;
            case '08':
                $month = 'Agustus';
                break;
            case '09':
                $month = 'September';
                break;
            case '10':
                $month = 'Oktober';
                break;
            case '11':
                $month = 'November';
                break;
            case '12':
                $month = 'Desember';
                break;
        }
        return $month;
    }
}
