<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $data = array();

      $validator = Validator::make($request->all(), [
         'image' => 'required|mimes:png,jpg,jpeg|max:2048'
      ]);

      if ($validator->fails()) {

         $data['success'] = 0;
         $data['error'] = $validator->errors()->first('image');// Error response

      }else{
         if($request->file('image')) {

             $image = $request->file('image');
             $extension = $image->getClientOriginalExtension();
             $fileName = time().'.'.$extension;
             $destinationPath = storage_path('app/public/uploads/thumbs');
             $savedFile = $destinationPath.'/'.$fileName;
             $img = Image::make($image->getRealPath());
             $img->resize(150,150)->save($savedFile);

             chmod($savedFile, 0775);

             // Response
             $data['success'] = 1;
             $data['message'] = 'Uploaded Successfully!';
            //  $data['savedFile'] = $savedFile;
            $data['savedFile'] = $fileName;
             $data['extension'] = $extension;
         }else{
             // Response
             $data['success'] = 2;
             $data['message'] = 'File not uploaded.'; 
         }
      }

      return response()->json($data);

    }
}
