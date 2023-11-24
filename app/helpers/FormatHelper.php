<?php
if (!function_exists('formatRupiah')) {
    function formatRupiah($angka)
    {
        return 'Rp. ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('formatDecimal')) {
    function formatDecimal($angka)
    {
        return number_format($angka, 0, ',', '.');
    }
}
