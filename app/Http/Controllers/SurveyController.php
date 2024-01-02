<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\Results;
use App\Models\Respondens;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

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
            Cache::forever('surveys_responden_id', $responden_id);

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
    }

    public function doEmail($email, $template)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = env('MAIL_HOST');
            $mail->SMTPAuth = true;
            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');
            $mail->SMTPSecure = env('MAIL_ENCRYPTION');
            $mail->Port = env('MAIL_PORT');

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $mail->addAddress($email);

            $mail->isHTML(true);

            $mail->Subject = '[Surveys] no-reply';
            $mail->Body = $template;

            if ($mail->send()) {
                Cache::forget('surveys_failedEmail');
                return 'email success';
            } else {
                Cache::forever('surveys_failedEmail', $email);
                return 'email not success';
            }
        } catch (Exception $e) {
            Cache::forever('surveys_failedEmail', $email);
            return $e->getMessage();
        }
    }

    public function sendEmail()
    {
        try {
            $responden_id = $_POST['responden_id'];
            $nama = $_POST['nama'];
            $email = $_POST['email'];
            $emote = $_POST['emote'];

            if ($email == '') {
                Respondens::where('id', $responden_id)->update(['emote' => $emote]);
                Cache::forget('surveys_failedEmail');
                return response()->json([
                    'status' => 'ok',
                    'email' => 'no email'
                ]);
            } else {

                if (stripos($nama, 'fina') !== false || stripos($email, 'fina') !== false) {
                    Respondens::where('id', $responden_id)->update([
                        'emote' => $emote,
                        'agree_sent_email' => 1
                    ]);
                    $template = file_get_contents(resource_path('views/template/special.php'));
                    $template = str_replace("{{nama}}", $nama, $template);
                    $emailResult = $this->doEmail($email, $template);
                } else {
                    Respondens::where('id', $responden_id)->update([
                        'emote' => $emote,
                        'agree_sent_email' => 1
                    ]);
                    $template = file_get_contents(resource_path('views/template/email.php'));
                    $template = str_replace("{{nama}}", $nama, $template);
                    $emailResult = $this->doEmail($email, $template);
                }
                return response()->json([
                    'status' => 'ok',
                    'email' => $emailResult
                ]);
            }
        } catch (\Throwable $th) {
            Cache::forever('surveys_failedEmail', $email);
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
    }

    public function getResponden()
    {
        $id = $_GET['id'];
        $q = Respondens::where('id', $id)->first();
        return response()->json([
            'status' => 'ok',
            'data' => $q
        ]);
    }

    public function getRespondens()
    {
        $q = Respondens::orderby('id', 'DESC')->get();
        return response()->json([
            'status' => 'ok',
            'data' => $q
        ]);
    }

    public function fillAgain()
    {
        try {
            Cache::forget('surveys_isSubmitted');
            Cache::forget('surveys_responden_id');
            Cache::forget('surveys_failedEmail');
            return response()->json([
                'status' => 'ok'
            ]);
        } catch (\Throwable $th) {
            $unique = time() . Str::random(2);
            $log = [
                'code' => $unique,
                'message' => $th->getMessage()
            ];
            Logs::create($log);
            return response()->json([
                'status' => $unique
            ]);
        }
    }

    public function cache() {
        $parameter = $_GET['parameter'];

        if($parameter == 'isSubmitted') return Cache::get('surveys_isSubmitted');
        if($parameter == 'responden_id') return Cache::get('surveys_responden_id');
        if($parameter == 'failedEmail') return Cache::get('surveys_failedEmail');
    }
}
