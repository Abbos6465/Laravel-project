<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LanguageController extends Controller
{
    public function change_locale(Request $request){
        $locale = $request->change_locale;
        App::setLocale($locale);
        Session::put('locale',$locale);

        return redirect()->back();
    }
}
