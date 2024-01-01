<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Results;
use App\Models\Respondens;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function submit()
    {
        try {
            $nama = $_POST['nama'];
            $namaTrue = '';
            if ($nama == '') {
                $namaTrue = 'Anonymous#' . rand(10, 99) . Str::random(2);
            } else {
                $namaTrue = $nama;
            }
            $email = $_POST['email'];
            $jenis_kelamin = $_POST['jenis_kelamin'];
            $rentang_usia = $_POST['rentang_usia'];
            $pekerjaan = $_POST['pekerjaan'];
            $bidang_industri = $_POST['bidang_industri'];
            $menggunakan_email = $_POST['menggunakan_email'];
            $mengalami = $_POST['mengalami'];
            $kesadaran = $_POST['kesadaran'];
            $korban = $_POST['korban'];
            $pengguna_extension = $_POST['pengguna_extension'];
            $pengguna_extension_spesifik = $_POST['pengguna_extension_spesifik'];
            $deteksi_email = $_POST['deteksi_email'];
            $mempertimbangkan = $_POST['mempertimbangkan'];
            $fitur_utama = $_POST['fitur_utama'];
            $seberapa_nyaman = $_POST['seberapa_nyaman'];
            $platform_email = $_POST['platform_email'];

            $result = [
                'menggunakan_email' => $menggunakan_email,
                'mengalami' => $mengalami,
                'kesadaran' => $kesadaran,
                'korban' => $korban,
                'pengguna_extension' => $pengguna_extension,
                'pengguna_extension_spesifik' => $pengguna_extension_spesifik,
                'deteksi_email' => $deteksi_email,
                'mempertimbangkan' => $mempertimbangkan,
                'fitur_utama' => $fitur_utama,
                'seberapa_nyaman' => $seberapa_nyaman,
                'platform_email' => $platform_email
            ];

            $q2 = Results::create($result);
            $result_id = $q2['id'];

            $responden = [
                'result_id' => $result_id,
                'nama' => $namaTrue,
                'email' => $email,
                'jenis_kelamin' => $jenis_kelamin,
                'rentang_usia' => $rentang_usia,
                'pekerjaan' => $pekerjaan,
                'bidang_industri' => $bidang_industri,
                'emote' => 1
            ];

            $q = Respondens::create($responden);
            $responden_id = $q['id'];

            Cache::forever('surveys_isSubmitted', '1');

            return response()->json([
                'status' => 'ok',
                'responden_id' => $responden_id,
                'result_id' => $result_id,
                'nama' => $namaTrue,
                'email' => $email
            ]);
        } catch (\Throwable $th) {
            $unique = time() . Str::random(2);
            $log = [
                'code' => $unique,
                'message' => $th->getMessage()
            ];
            Logs::create($log);
            return response()->json([
                'status' => 'not ok',
                'code' => $unique
            ]);
        }

        $namaDummy = 'Fina Annisa Rahmasari';
        if (stripos($namaDummy, 'fina') !== false) {
            return true;
        } else {
            return false;
        }
    }

    public function sendEmail () {
        $responden_id = $_POST['responden_id'];
        $nama = $_POST['nama'];
        $email = $_POST['email'];



    }

}
