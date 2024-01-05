<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use App\Models\Respondens;
use App\Models\Results;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function create()
    {
        $user = 'resaka';
        $email = 'resa.komara.akbari@gmail.com';
        $pass = 'resasidewa123';
        $q = User::create([
            'name' => $user,
            'email' => $email,
            'password' => md5($pass)
        ]);
        if ($q) {
            return 'success';
        } else {
            return 'not success';
        }
    }

    public function index()
    {
        if (Session::has('nama') || Session::has('attempt')) {
            return redirect()->to('/adminPlace/home');
        }
        try {
            $URI = $_GET['user'];
            return view('admin.index', [
                'user' => $URI
            ]);
        } catch (\Throwable $th) {
            // Logs::create([
            //     'code' => 'breaking',
            //     'message' => $th->getMessage()
            // ]);
            return view('admin.index');
        }
    }

    public function auth()
    {
        $user = $_POST['user'];
        $pass = $_POST['pass'];
        if ($user == null) {
            Logs::create([
                'code' => 'breaking',
                'message' => 'Impos: ' . $pass
            ]);
            return response()->json([
                'status' => "You're impostor :)"
            ]);
        }
        $q = User::where('name', $user)->first();
        if (!$q) {
            Logs::create([
                'code' => 'breaking',
                'message' => 'Impos: ' . $pass
            ]);
            return response()->json([
                'status' => "You're impostor :)"
            ]);
        }
        if (md5($pass) == $q['password']) {
            Session::put('name', $user);
            Session::put('attempt', time());
            Logs::create([
                'code' => 'breaking',
                'message' => 'Someone has logged in: ' . $pass
            ]);
            return response()->json([
                'status' => 'ok'
            ]);
        } else {
            Logs::create([
                'code' => 'breaking',
                'message' => 'Wrong pass: ' . $pass
            ]);
            return response()->json([
                'status' => 'wrong password'
            ]);
        }
    }

    public function home(Request $r)
    {
        $post = Respondens::with('getResult')->orderby('id', 'DESC')->paginate(1);
        $count = Respondens::count();
        $menggunakan_email1 = Results::where('menggunakan_email', 'Setiap Hari')->count();
        $menggunakan_email2 = Results::where('menggunakan_email', 'Beberapa Kali dalam Seminggu')->count();
        $menggunakan_email3 = Results::where('menggunakan_email', 'Sekitar Sekali Seminggu')->count();
        $menggunakan_email4 = Results::where('menggunakan_email', 'Sekitar Sekali Sebulan')->count();
        $menggunakan_email5 = Results::where('menggunakan_email', 'Jarang Sekali atau Tidak Pernah')->count();

        $mengalami1 = Results::where('mengalami', 'Ya, Saya Pernah Mengalami')->count();
        $mengalami2 = Results::where('mengalami', 'Tidak, Saya Tidak Pernah Mengalami')->count();
        $mengalami3 = Results::where('mengalami', 'Tidak Yakin')->count();
        $mengalami4 = Results::where('mengalami', 'Mungkin, Tetapi Saya Tidak Yakin')->count();
        $mengalami5 = Results::where('mengalami', 'Tidak Ingin Mengungkapkan')->count();

        $kesadaran1 = Results::where('kesadaran', 'Sangat Sadar')->count();
        $kesadaran2 = Results::where('kesadaran', 'Cukup Sadar')->count();
        $kesadaran3 = Results::where('kesadaran', 'Kurang Sadar')->count();
        $kesadaran4 = Results::where('kesadaran', 'Sama Sekali Tidak Sadar')->count();
        $kesadaran5 = Results::where('kesadaran', 'Tidak Yakin')->count();

        $korban1 = Results::where('korban', 'Ya, Saya Pernah Menjadi Korban')->count();
        $korban2 = Results::where('korban', 'Tidak, Saya Belum Pernah Menjadi Korban')->count();
        $korban3 = Results::where('korban', 'Tidak Yakin')->count();
        $korban4 = Results::where('korban', 'Mungkin, Tetapi Saya Tidak Yakin')->count();
        $korban5 = Results::where('korban', 'Tidak Ingin Mengungkapkan')->count();

        $pengguna_extension1 = Results::where('pengguna_extension', 'Ya, Saya Pernah')->count();
        $pengguna_extension2 = Results::where('pengguna_extension', 'Tidak, Saya Belum Pernah')->count();

        $deteksi_email1 = Results::where('deteksi_email', 'Sangat Penting')->count();
        $deteksi_email2 = Results::where('deteksi_email', 'Penting')->count();
        $deteksi_email3 = Results::where('deteksi_email', 'Netral')->count();
        $deteksi_email4 = Results::where('deteksi_email', 'Tidak Terlalu Penting')->count();
        $deteksi_email5 = Results::where('deteksi_email', 'Tidak Penting Sama Sekali')->count();

        $mempertimbangkan1 = Results::where('mempertimbangkan', 'Ya, Saya Sedang Menggunakan Alat atau Layanan Tersebut')->count();
        $mempertimbangkan2 = Results::where('mempertimbangkan', 'Belum, Tetapi Saya Mempertimbangkan')->count();
        $mempertimbangkan3 = Results::where('mempertimbangkan', 'Tidak Pernah Memikirkan')->count();
        $mempertimbangkan4 = Results::where('mempertimbangkan', 'Tidak Tahu')->count();
        $mempertimbangkan5 = Results::where('mempertimbangkan', 'Tidak Ingin Menggunakan')->count();

        $fitur_utama1 = Results::where('fitur_utama', 'LIKE', '%Scan Email Otomatis%')->count();
        $fitur_utama2 = Results::where('fitur_utama', 'LIKE', '%Peringatan Langsung%')->count();
        $fitur_utama3 = Results::where('fitur_utama', 'LIKE', '%Integrasi Mudah%')->count();
        $fitur_utama4 = Results::where('fitur_utama', 'LIKE', '%Analisis Tautan dan Lampiran%')->count();
        $fitur_utama5 = Results::where('fitur_utama', 'LIKE', '%Pembaruan Berkala%')->count();
        $fitur_utama6 = Results::where('fitur_utama', 'LIKE', '%Panduan Keamanan%')->count();

        $seberapa_nyaman1 = Results::where('seberapa_nyaman', 'Sangat Nyaman')->count();
        $seberapa_nyaman2 = Results::where('seberapa_nyaman', 'Nyaman')->count();
        $seberapa_nyaman3 = Results::where('seberapa_nyaman', 'Netral')->count();
        $seberapa_nyaman4 = Results::where('seberapa_nyaman', 'Tidak Nyaman')->count();
        $seberapa_nyaman5 = Results::where('seberapa_nyaman', 'Tidak Suka')->count();

        $platform_email1 = Results::where('platform_email', 'LIKE', '%RoundCube%')->count();
        $platform_email2 = Results::where('platform_email', 'LIKE', '%Gmail%')->count();
        $platform_email3 = Results::where('platform_email', 'LIKE', '%Yahoo Mail%')->count();
        $platform_email4 = Results::where('platform_email', 'LIKE', '%Apple Mail%')->count();
        // $platform_email5 = Results::where('platform_email', 'NOT LIKE', 'RoundCube')->where('platform_email', 'NOT LIKE', 'Gmail')->where('platform_email', 'NOT LIKE', 'Yahoo Mail')->where('platform_email', 'NOT LIKE', 'Apple Mail')->count();
        // dd($post);
        return view('admin.home', compact('post'), [
            'count' => $count,
            'menggunakan_email1' => $menggunakan_email1,
            'menggunakan_email2' => $menggunakan_email2,
            'menggunakan_email3' => $menggunakan_email3,
            'menggunakan_email4' => $menggunakan_email4,
            'menggunakan_email5' => $menggunakan_email5,
            'mengalami1' => $mengalami1,
            'mengalami2' => $mengalami2,
            'mengalami3' => $mengalami3,
            'mengalami4' => $mengalami4,
            'mengalami5' => $mengalami5,
            'kesadaran1' => $kesadaran1,
            'kesadaran2' => $kesadaran2,
            'kesadaran3' => $kesadaran3,
            'kesadaran4' => $kesadaran4,
            'kesadaran5' => $kesadaran5,
            'korban1' => $korban1,
            'korban2' => $korban2,
            'korban3' => $korban3,
            'korban4' => $korban4,
            'korban5' => $korban5,
            'pengguna_extension1' => $pengguna_extension1,
            'pengguna_extension2' => $pengguna_extension2,
            'deteksi_email1' => $deteksi_email1,
            'deteksi_email2' => $deteksi_email2,
            'deteksi_email3' => $deteksi_email3,
            'deteksi_email4' => $deteksi_email4,
            'deteksi_email5' => $deteksi_email5,
            'mempertimbangkan1' => $mempertimbangkan1,
            'mempertimbangkan2' => $mempertimbangkan2,
            'mempertimbangkan3' => $mempertimbangkan3,
            'mempertimbangkan4' => $mempertimbangkan4,
            'mempertimbangkan5' => $mempertimbangkan5,
            'fitur_utama1' => $fitur_utama1,
            'fitur_utama2' => $fitur_utama2,
            'fitur_utama3' => $fitur_utama3,
            'fitur_utama4' => $fitur_utama4,
            'fitur_utama5' => $fitur_utama5,
            'fitur_utama6' => $fitur_utama6,
            'seberapa_nyaman1' => $seberapa_nyaman1,
            'seberapa_nyaman2' => $seberapa_nyaman2,
            'seberapa_nyaman3' => $seberapa_nyaman3,
            'seberapa_nyaman4' => $seberapa_nyaman4,
            'seberapa_nyaman5' => $seberapa_nyaman5,
            'platform_email1' => $platform_email1,
            'platform_email2' => $platform_email2,
            'platform_email3' => $platform_email3,
            'platform_email4' => $platform_email4,
        ]);
    }
}
