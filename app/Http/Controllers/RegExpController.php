<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegExpController extends Controller
{
    public function process(Request $request)
    {
        $text = $request->input('user_input');

        $text = preg_replace('/(?<=\s|^)(\d+)(?=\s|$)/', '<span class="blue">$1</span>', $text);
        $text = preg_replace('/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/', '<span class="red">$0</span>', $text);

        $text = preg_replace_callback(
            '/\b(https?:\/\/[^\s]+)/',
            function ($matches) {
                $url = $matches[1];
                $parsed_url = parse_url($url);
                if (isset($parsed_url['host'])) {
                    return '<span class="green">'. $parsed_url['scheme'] .'://'. $parsed_url['host']  .'</span>';
                } else {
                    return '<span class="green">' . $url . '</span>';
                }
            },
            $text
        );

        return view('about', ['processedText' => $text]);
    }
}
