<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\DynamicExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReportController extends Controller
{
    public function exportExcel($table)
    {
        if (!Schema::hasTable($table)) {
            abort(404, "Table not found.");
        }

        $data = collect(DB::table($table)->get());

        return Excel::download(new DynamicExport($data), "{$table}.xlsx");
    }

    public function exportCsv($table)
    {
        if (!Schema::hasTable($table)) {
            abort(404, "Table not found.");
        }

        $data = collect(DB::table($table)->get());

        return Excel::download(new DynamicExport($data), "{$table}.csv");
    }

    public function exportPdf($table)
    {
        if (!Schema::hasTable($table)) {
            abort(404, "Table not found.");
        }

        $data = DB::table($table)->get();

        $pdf = Pdf::loadView('pdf.dynamic', [
            'data' => $data,
            'table' => $table,
        ])
        ->setPaper('A4', 'portrait')
        ->setOption([
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
        ]);

        return $pdf->download("{$table}.pdf");
    }
}
