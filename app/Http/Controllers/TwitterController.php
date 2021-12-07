<?php

namespace App\Http\Controllers;


use App\Charts\TwitterChart;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Atymic\Twitter\Facade\Twitter;
use File;

class TwitterController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     *
     * index function call which sends data to view template
     */
    public function twitterSearch( Request $request ){

        $tweetHourPollList = [];
        $userId = $request->session()->get( 'twitterUserId' );

        if ( !empty( $userId ) ) {

            try {
                $allTweets = $this->getAllTweets( $userId );
                foreach ( $allTweets as $value ){
                    $convertData = json_decode( $value );

                    foreach ( $convertData->data as $tweetRecord ){
                        $date = strtotime($tweetRecord->created_at);
                        array_push( $tweetHourPollList, date('H', $date) );
                    }
                }
            } catch(  \Exception $e ){
                return view('twittergraph', [ 'errorMessage' => "Invalid username entered" ] );
            }
        }

        $chartData = array_count_values( $tweetHourPollList );
        ksort($chartData );

        if ( ! empty ( $chartData ) ) {
            $twitterChart = $this->buildGraph($chartData );
            return view('twittergraph', [ 'twitterGraph' => $twitterChart ] );
        }
    }


    /**
     * @param $chartData
     * @return TwitterChart
     *
     * build histogram based on chartdata value.
     */
    private function buildGraph ( $chartData ) {
        $twitterChart = new TwitterChart();

        $twitterChart->labels( array_keys( $chartData) );
        $twitterChart->dataset('x axis - 24 hrs , y axis - tweet counts', 'bar', array_values( $chartData ) )
                ->color("rgb(123, 104, 238)")
                ->backgroundcolor("rgb(123, 104, 238)");

        return $twitterChart;
    }

    /***
     * @param $userid
     * @return array
     *
     * iterate 5 times to get 500 tweets
     */
    private function getAllTweets( $userid ) {

        $tweetList = [];

        for ( $index = 0; $index < 5; $index ++) {

            $token = null;
            if (!empty( $data ) ){
                $decodedData = json_decode( $data );
                $token = $decodedData->meta->next_token;
            }


            $params = [
                'place.fields' => 'country,name',
                'tweet.fields' => 'created_at',
                'max_results' => 100,
                'expansions' => 'author_id,in_reply_to_user_id',
                'pagination_token' => $token,
                'next_token' => [],
                'response_format' => 'json',
            ];

            $data = Twitter::userTweets( $userid, $params );

            array_push( $tweetList, $data);
         }

        return $tweetList;
    }
}
