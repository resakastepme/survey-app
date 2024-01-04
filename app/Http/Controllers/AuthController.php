<?php

namespace App\Http\Controllers;

use App\Models\Logs;
use App\Models\User;
use App\Models\Respondens;
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
        try {
            $URI = $_GET['user'];
            return view('admin.index', [
                'user' => $URI
            ]);
        } catch (\Throwable $th) {
            Logs::create([
                'code' => 'breaking',
                'message' => $th->getMessage()
            ]);
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

    public function home(Request $r) {
        $post = Respondens::with('getResult')->orderby('id', 'DESC')->paginate(1);
        $v = Respondens::with('getResult')->first();
        // dd($post);
        return view('admin.home', compact('post'), ['values' => $v]);
    }
}
