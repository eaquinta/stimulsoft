<?php

namespace App\Http\Controllers\test;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class XlsxController extends Controller
{
    public function generateXlsx()
    {
        $users = User::get();
        // Export all users
        return (new FastExcel($users))->download('file.xlsx');
        return (new FastExcel($users))->export('file.xlsx');
    }
}
