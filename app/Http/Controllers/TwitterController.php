<?php

namespace App\Http\Controllers;


use App\Charts\TwitterChart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use File;

class TwitterController extends Controller
{
    public function twitterSearch( Request $request ){

        $tweetHourPollList = [];

        try {
            $params = [ 'place.fields' => 'country,name',
                        'tweet.fields' => 'created_at',
                        'max_results' => 100,
                        'expansions' => 'author_id,in_reply_to_user_id',
                        'response_format' => 'json',
            ];

            $userId = $request->session()->get( 'twitterUserId' );

            if ( !empty( $userId ) ) {
                $data = Twitter::userTweets( $userId, $params );
                $decodedData = json_decode( $data );

                foreach( $decodedData->data as $tweetRecord ) {
                    $date = strtotime($tweetRecord->created_at);
                    array_push($tweetHourPollList, date('H', $date) );
                }
            }

        } catch( \Exception $e)  {
            $request->session()->forget('twitterUserId');
            return view('twittergraph', [ 'errorMessage' => $e->getMessage() ] );
        }

        $chartData = array_count_values( $tweetHourPollList );
        ksort($chartData );
        $twitterChart = new TwitterChart();

        if ( ! empty ( $chartData) ){
            $twitterChart->labels( array_keys( $chartData) );
            $twitterChart->dataset('x axis - 24 hrs , y axis - tweet counts', 'bar', array_values( $chartData ) )
                ->color("rgb(123, 104, 238)")
                ->backgroundcolor("rgb(123, 104, 238)");
        }

        return view('twittergraph', [ 'twitterGraph' => $twitterChart ] );
    }
}
