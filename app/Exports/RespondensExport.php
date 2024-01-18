<?php

namespace App\Exports;

use App\Models\Respondens;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class RespondensExport implements FromView
{
    public function view(): View
    {
        return view('exports.respondens', [
            'respondens' => Respondens::orderby('id', 'DESC')
        ]);
    }
}
