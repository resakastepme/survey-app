<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Results;

class TestController extends Controller
{
    public function latbel1()
    {
        try {
            $q1 = Results::whereNotIn('id', [3, 32, 57, 41])->get();
            foreach ($q1 as $q) {
                $id = $q->id;
                $exe = Results::where('id', $id)->update([
                    'latbel1' => 'Ya'
                ]);
            }
            $q2 = Results::whereIn('id', [3, 32, 57, 41])->get();
            foreach ($q2 as $r) {
                $id2 = $r->id;
                $exe = Results::where('id', $id2)->update([
                    'latbel1' => 'Tidak'
                ]);
            }
            if ($q1 && $q2) {
                return 'Done';
            } else {
                return 'Wait.....';
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function latbel2()
    {
        try {
            $q1 = Results::whereNotIn('id', [43, 4])->get();
            foreach ($q1 as $q) {
                $id = $q->id;
                $exe = Results::where('id', $id)->update([
                    'latbel2' => 'Ya'
                ]);
            }
            $q2 = Results::whereIn('id', [43, 4])->get();
            foreach ($q2 as $r) {
                $id2 = $r->id;
                $exe = Results::where('id', $id2)->update([
                    'latbel2' => 'Tidak'
                ]);
            }
            if ($q1 && $q2) {
                return 'Done';
            } else {
                return 'Wait.....';
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function latbel3()
    {
        try {
            $q = Results::get();
            foreach ($q as $y) {
                $id = $y->id;
                $exe = Results::where('id', $id)->update([
                    'latbel3' => 'Ya'
                ]);
            }
            return 'Done';
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
