<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Stimulsoft\Report\StiReport;

class ReportController extends Controller
{
    public function showReport()
    {
        // Create a new report object
        $report = new StiReport();

        // Load the report template
        $report->loadFile(public_path('reports/stimulsoft/SimpleList.mrt'));

        // Render the report
        $report->render();

        // Return the report as a view
        return view('report', ['report' => $report]);
    }

    public function viewer(Request $request){
        $users = User::all();

        return view('viewer', [
            'users' => $users,
            'license' => env('SITUMULSOFT_LICENSE_FILE')
        ]);
    }
}
