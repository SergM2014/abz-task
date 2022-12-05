<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function store(Request $request)
    {
      $data = array();

      $validator = Validator::make($request->all(), [
         'image' => 'required|image|mimes:png,jpg,jpeg|max:5124|dimensions:min_width=300,min_height=300'
      ]);

      if ($validator->fails()) {

         $data['success'] = 0;
         $data['error'] = $validator->errors()->first('image');// Error response

      }else{
         if($request->file('image')) {

             $image = $request->file('image');
             $extension = $image->getClientOriginalExtension();
           //   $fileName = time().'.'.$extension;
             $fileName = 'photo_'.time().'.jpg';
             $destinationPath = storage_path('app/public/uploads/thumbs');
             $savedFile = $destinationPath.'/'.$fileName;
             $img = Image::make($image->getRealPath());
             $img->resize(300,300);
             $img->save($savedFile, 80);
    
             chmod($savedFile, 0775);

             // Response
             $data['success'] = 1;
             $data['message'] = 'Uploaded Successfully!';
            
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

    public function rotate()
    {
      $photo = request('photo');
      $degree = request('degree');
      $rotatedPhoto = 'rotated_'.$photo;

      $source = imagecreatefromjpeg(storage_path('app/public/uploads/thumbs/'.$photo));
      $rotate = imagerotate($source, $degree, 0);
      imagejpeg($rotate, storage_path('app/public/uploads/thumbs/'.$rotatedPhoto));

      $data['success'] = 1;
      $data['message'] = 'Rotated Successfully!';
      $data['photo'] = $rotatedPhoto;

      return response()->json($data);
    }
}
