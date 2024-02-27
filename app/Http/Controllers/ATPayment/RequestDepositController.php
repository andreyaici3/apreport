<?php

namespace App\Http\Controllers\ATPayment;

use App\Http\Controllers\Controller;
use App\Models\ATPayment\Modul;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use PhpParser\Node\Stmt\Echo_;

class RequestDepositController extends Controller
{
    public function index()
    {
        
        return view('atp.request.index', [
            'modul' => Modul::get()
        ]);
    }

    public function store(Request $request)
    {
        $modul = Modul::find($request->modul);
        $format = $modul->format_request;

        if ($format == null) {
            $data = [
                "modul" => $modul->nama_modul,
                'result' => false,
            ];            
            return view("atp.request.result", $data);
        }

        if ($modul->ipcenter != null && $modul->memberid != null && $modul->pin != null && $modul->password != null) {
            $format = str_replace("[ipcenter]", $modul->ipcenter, $format);
            $format = str_replace("[memberid]", $modul->memberid, $format);
            $format = str_replace("[pin]", $modul->pin, $format);
            $format = str_replace("[password]", $modul->password, $format);
        } else {
            $data = [
                "modul" => $modul->nama_modul,
                'result' => false,
            ];
            return view("atp.request.result", $data);
        }

        if ($request->amount <= 1000) {
            $data = [
                "modul" => $modul->nama_modul,
                'result' => false,
            ];
            return view("atp.request.result", $data);
        }

        $format = str_replace("[amount]", $request->amount, $format);
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->get($format);
            $input_lines = $response->getBody();
            preg_match_all("/$modul->format_response/", $input_lines, $output_array);
            $data = [
                'result' => $output_array['nominal'] == [] ? false : true,
                "modul" => $modul->nama_modul,
                'bri' => @$output_array["bri"] == [] ? null : $output_array["bri"][0],
                "mandiri" => @$output_array["mandiri"] == [] ? null : $output_array["mandiri"][0],
                "bni" => @$output_array["bni"] == [] ? null : $output_array["bni"][0],
                "bca" => @$output_array["bca"] == [] ? null : $output_array["bca"][0],
                "bsi" => @$output_array["bsi"] == [] ? null : $output_array["bsi"][0],
                "nominal" => @$output_array["nominal"] == [] ? 0 : str_replace(",","", str_replace(".", "", $output_array["nominal"]))[0],
                "nama" => @$output_array["atasnama"] == [] ? null : $output_array["atasnama"][0],
            ];
                        
            return view("atp.request.result", $data);
        } catch (RequestException $e) {
            return $e;
            if ($e->hasResponse()) {
                if ($e->getResponse()->getStatusCode() == '403') {
                    echo "Gagal";
                }
            }
        }
    }
}
