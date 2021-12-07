<?php

namespace App\Http\Controllers;

use Atymic\Twitter\Facade\Twitter;
use Illuminate\Http\Request;

class SearchConrtoller extends Controller
{
   public function userIdSearch(Request $request) {
      $twitterUserId = $request->input('userid');
      $data = json_decode( Twitter::getUserByUsername( $twitterUserId, [] ) );

      $request->session()->put('twitterUserId', $data->data->id ); //'34116377'

       return redirect()->back();
   }

}
