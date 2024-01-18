<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\RespondensExport;
use Maatwebsite\Excel\Facades\Excel;

class ExportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Excel::download(new RespondensExport, 'survey-results.xlsx');
    }
}
