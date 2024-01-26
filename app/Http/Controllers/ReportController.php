<?php

namespace App\Http\Controllers;

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
        $name = $request->name; //$request->query('name');
        return view('viewer', compact('name'));
    }
}
