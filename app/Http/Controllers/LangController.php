<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LangController extends Controller
{
    public function changeLocale($locale)
    {
        session(['locale'=>$locale]);
        App::setLocale($locale);
        return redirect()->back();
    }
}
