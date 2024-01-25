<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StimulsoftController extends Controller
{
    public function stimulviewer1()
    {
        $rptTitle='customer test report1 title';
        $RptReclist=Storage::get('customer.json');
        $RptFileName="Report/SimpleList.mrt";
        return view('viewer1',compact('RptFileName','RptReclist','rptTitle'));
    }

}
