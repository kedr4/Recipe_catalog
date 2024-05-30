<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LinkController extends Controller
{
    public function click($id)
    {
        $link = 'https://www.bsuir.by';
        DB::table('links')->where('id', $id)->increment('clicks');

        return redirect($link);
    }
}
