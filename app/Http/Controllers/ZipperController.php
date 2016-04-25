<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Chumper\Zipper\Zipper;
use Response;
use DB;
use Helper;

class ZipperController extends Controller
{
    public function generateLinkShare()
    {
        $zipper = new Zipper;
        $share_val = Input::get('d');

        $link = explode('-', Helper::base64url_decode($share_val));
        $segment_1 = $link[0];
        $segment_2 = $link[1];
        $segment_3 = end($link);

        if($segment_1 == 'sharegal' && $segment_3 == 'down'){
            $zip_name = $link[2].'-'.date('d-m-Y').'.zip';
            $zip_files= $this->getGalleryById($segment_2);

            if(!empty($zip_files)){
                $headers = array('Content-Type' => 'application/octet-stream');
                
                $zipper->make('public/_images/'.$zip_name)->add($zip_files);
                $zipper->close();

                return Response::download('./public/_images/'.$zip_name, $zip_name, $headers)->deleteFileAfterSend(true);
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
    }

    public function getGalleryById($gal_id=null)
    {
        $gallery = DB::table('tbl_image')
                    ->select('img_name')
                    ->where('conditional_id', '=', $gal_id)
                    ->where('conditional_type', '=', 3)
                    ->orderBy('img_id', 'desc')
                    ->get();
      
        if(!empty($gallery)){
            for($i=0; $i<count($gallery); $i++){
                $gal_arr[$i] = 'public/gallery/'.$gallery[$i]->img_name; 
            }

            return array_values($gal_arr);
        }
    }

    public function test()
    {
        $zipper = new Zipper;

        #$zipper->make('public/gallery/test.zip')->folder('test')->add('public/gallery/tola');
        #$zipper->zip('public/gallery/test.zip')->folder('test')->add('public/gallery/g_1459917206.png','test');

        //$zipper->remove('composer.lock');

        $zipper->make('public/download/tola1.zip')->add(
            array(
                'public/gallery/g_1459917206.png',
                'public/gallery/g_1459917219.png',
                'public/gallery/g_1459917230.png',
                'public/gallery/g_1459917240.png'
            ));
        dd($zipper);
/*        $zipper->folder('tola')->add(
            array(
                'public/gallery/g_1459917206.png',
                'public/gallery/g_1459917219.png',
                'public/gallery/g_1459917230.png'
            )
        );*/

    }
}
