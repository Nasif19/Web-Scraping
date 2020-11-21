<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class BanglaController extends Controller
{
    public $head;
    public function index()
    {
        $url = "http://www.bangladesh.gov.bd/site/view/district-list/%E0%A6%9C%E0%A7%87%E0%A6%B2%E0%A6%BE%E0%A6%B8%E0%A6%AE%E0%A7%82%E0%A6%B9?fbclid=IwAR1VWqSU481hmAllV2ewjxK5dk2xUVRiQakHFtCmJWtNCUmf7ZdlwDZntn0";
        $client = new Client();

        $data = $client->request('GET', $url);
        $data->filter(' #printable_area ')->each(function($node){
            $this->head = $node->filter(' h3 ');
            $this->head3 = $node->filter(' table > thead > tr ');
            $this->head2 = $node->filter(' table > tbody ');
        });

        $str = str_replace(',','',$this->head2->text());
        $Values = preg_split('/\s+/', $str, -1, PREG_SPLIT_NO_EMPTY);
        
        $data = array();
        $data[$this->head->text()][0] = str_replace(' ', ' ও ', $this->head3->text());
        $n = count($Values);
        for($i=0; $i<$n; $i++)
        {
            if($Values[$i] == 'চট্টগ্রাম')
            {
                $t = 0;
                // $loc=1;
                $loc='চট্টগ্রাম';
               for ($j=$i+1; $j<($i+12); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=12;
            }

            if($Values[$i] == 'রাজশাহী')
            {
                $t = 0;
                // $loc=1;
                $loc='রাজশাহী';
               for ($j=$i+1; $j<($i+9); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=9;
            }

            if($Values[$i] == 'খুলনা')
            {
                $t = 0;
                // $loc=1;
                $loc='খুলনা';
               for ($j=$i+1; $j<($i+11); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=11;
            }

            if($Values[$i] == 'বরিশাল')
            {
                $t = 0;
                // $loc=1;
                $loc='বরিশাল';
               for ($j=$i+1; $j<($i+7); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=7;
            }

            if($Values[$i] == 'সিলেট')
            {
                $t = 0;
                // $loc=1;
                $loc='সিলেট';
               for ($j=$i+1; $j<($i+5); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=5;
            }

            if($Values[$i] == 'ঢাকা')
            {
                $t = 0;
                // $loc=1;
                $loc='ঢাকা';
               for ($j=$i+1; $j<($i+14); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=14;
            }

            if($Values[$i] == 'রংপুর')
            {
                $t = 0;
                // $loc=1;
                $loc='রংপুর';
               for ($j=$i+1; $j<($i+9); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=9;
            }

            if($Values[$i] == 'ময়মনসিংহ')
            {
                $t = 0;
                // $loc=1;
                $loc='ময়মনসিংহ';
               for ($j=$i+1; $j<($i+5); $j++)
               {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
               }
               $i+=5;
            }
        
        }
        
        return response()->json([
            'data' => $data ? $data : null,
            'Message' =>  $data?'Successfully Received' : 'No Data Found',], 200, [], JSON_UNESCAPED_UNICODE);

    }
}
