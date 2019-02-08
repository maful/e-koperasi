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
