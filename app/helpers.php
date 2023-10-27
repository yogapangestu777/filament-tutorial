<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hashids\Hashids;

if (!function_exists('signin')) {
    function signin()
    {
        $results = Auth::user();
        return $results;
    }
}

if (!function_exists('role')) {
    function role($role)
    {
        if ($role == '1') {
            return 'Leader';
        }
        if ($role == '2') {
            return 'Admin';
        }
        if ($role == '3') {
            return 'Cutting';
        }
        if ($role == '4') {
            return 'Operator';
        }
    }
}

if (!function_exists('avatar')) {
    function avatar()
    {
        $name = User::where('id', signin()->id)->first();
        if ($name) {
            $name = ucwords($name->name); // Mengonversi nama pengguna ke huruf kapital
            $username = explode(" ", $name); // Membagi nama pengguna menjadi kata-kata
            $avatar = '';

            foreach ($username as $kata) {
                $avatar .= $kata[0]; // Mengambil huruf pertama dari setiap kata
            }
            return $avatar;
        }
    }
}

if (!function_exists('timeInd')) {
    function timeInd($date = null)
    {
        if ($date != null) {
            // array hari dan bulan
            $Hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
            $Bulan = array("Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des");

            // pemisahan tahun, bulan, hari, dan waktu
            $tahun = substr($date, 0, 4);
            $bulan = substr($date, 5, 2);
            $tgl = substr($date, 8, 2);
            $waktu = substr($date, 11, 5);
            $hari = date("w", strtotime($date));
            $result = $Hari[$hari] . ", " . $tgl . "-" . $Bulan[(int)$bulan - 1] . "-" . $tahun . " " . $waktu;

            return $result;
        } else {
            $result = '-';
            return $result;
        }
    }
}

function hashidEncode($id)
{
    $salt    = new Hashids('AingMaung');
    $hashids = $salt->encode([$id, 54715]);
    return $hashids;
}

function hashidDecode($id)
{
    $salt    = new Hashids('AingMaung');
    $hashids = $salt->decode($id);
    return $hashids;
}
