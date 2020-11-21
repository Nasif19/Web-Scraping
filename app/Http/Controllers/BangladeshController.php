<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;

class BangladeshController extends Controller
{
    public function index()
    {
        $client = new Client();
        $url = 'https://en.wikipedia.org/wiki/COVID-19_pandemic_in_Bangladesh';
        
        $crawler = $client->request('GET', $url);  
        $crawler->filter('#mw-content-text > div > .plainrowheaders ')->each(function($node){
            $this->head = $node->filter(' tbody ');
            $this->head2 = $node->filter('tr');
        });

        $str = str_replace($this->head2->text(), '', substr($this->head->text(), 0, strpos($this->head->text(), "As")) );
        $str = preg_replace('/[0-9]+/', '', $str);
        $str = str_replace(',(.%)', '', $str);
        $Values = preg_split('/\s+/', $str, -1, PREG_SPLIT_NO_EMPTY);

        $data = array();
        // $dhaka = [];
        // $ctg = [];
        $n = count($Values);
        for($i=0; $i<$n; $i++)
        {
            if(strtolower($Values[$i]) == 'dhaka')
            {
                $t = 0;
                // $loc=1;
                $loc='Dhaka';
               for ($j=$i+1; $j<($i+17); $j++)
               {
                   if(strtolower($Values[$j])=='(district)' || strtolower($Values[$j])=='city')
                   {
                    $data[$loc][$t-1]= $data[$loc][$t-1].' '.$Values[$j];
                   }
                   else
                   {
                    $data[$loc][$t]=$Values[$j];                    
                    $t++;
                   }
               }
               $i+=17;
            }
             
            if(strtolower($Values[$i]) == 'chattogram')
            {
                $t = 0;
                // $loc=2;
                $loc = 'Chattogram';
               for ($j=$i+1; $j<($i+14); $j++)
               {
                   if(strtolower($Values[$j])=='bazar' || strtolower($Values[$j])=='baria')
                   {
                    $data[$loc][$t-1]= $data[$loc][$t-1].' '.$Values[$j];
                   }
                   else
                   {
                    $data[$loc][$t]=$Values[$j];
                   $t++;
                   }
               }
               $i+=14;
            }

            if(strtolower($Values[$i]) == 'sylhet')
            {
                $t = 0;
                // $loc=3;
                $loc = 'Sylhet';
               for ($j=$i+1; $j<($i+6); $j++)
               {
                   if(strtolower($Values[$j])=='bazar')
                   {
                    $data[$loc][$t-1]= $data[$loc][$t-1].' '.$Values[$j];
                   }
                   else
                   {
                    $data[$loc][$t]=$Values[$j];
                   $t++;
                   }
               }
               $i+=6;
            }

            if(strtolower($Values[$i]) == 'rangpur')
            {
                $t = 0;
                // $loc=4;
                $loc = 'Rangpur';
               for ($j=$i+1; $j<($i+9); $j++)
               {
                    $data[$loc][$t]=$Values[$j];
                    $t++;
               }
               $i+=9;
            }

            if(strtolower($Values[$i]) == 'khulna')
            {
                $t = 0;
                // $loc=5;
                $loc ='Khulna';
               for ($j=$i+1; $j<($i+11); $j++)
               {
                    $data[$loc][$t]=$Values[$j];
                    $t++;
               }
               $i+=11;
            }

            if(strtolower($Values[$i]) == 'mymensingh')
            {
                $t = 0;
                // $loc=6;
                $loc = 'Mymensingh';
               for ($j=$i+1; $j<($i+5); $j++)
               {
                    $data[$loc][$t]=$Values[$j];
                    $t++;
               }
               $i+=5;
            }

            if(strtolower($Values[$i]) == 'barishal')
            {
                $t = 0;
                // $loc=7;
                $loc = 'Barishal';
               for ($j=$i+1; $j<($i+7); $j++)
               {
                    $data[$loc][$t]=$Values[$j];
                    $t++;
               }
               $i+=7;
            }

            if(strtolower($Values[$i]) == 'rajshahi')
            {
                $t = 0;
                // $loc=8;
                $loc = 'Rajshahi';
               for ($j=$i+1; $j<($i+9); $j++)
               {
                    $data[$loc][$t]=$Values[$j];
                    $t++;
               }
               $i+=9;
            }
        }
        
        dd($data);
        // return $data;
    }
}
