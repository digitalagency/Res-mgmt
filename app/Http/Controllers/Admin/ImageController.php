<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ImageManager;
use Croppa;

class ImageController extends Controller
{
    //path for the products folder
    private $folder = '/uploads/products/';
    private $productImagePath = "http://127.0.0.1:8000/uploads/products/";

    public function saveImage($images, $productId, $featuredImage){

        //get file details indivdually using loop
        foreach ($images as $file) {

            //get file name and prefix if with an id and generate path for the image
            //get all the details of the file
            $imageName = $file->getClientOriginalName();
            $newImageName = $productId.$imageName;
            $url = $this->productImagePath . $newImageName;
            $fileSize = $file->getClientSize();
            $fileMimeType = $file->getMimeType();

            //copy file from user's hardisk to upload/products path
            $file->move(public_path($this->folder), $newImageName);

            //save image into the database
            $image = ImageManager::create([
                'image' => $newImageName,
                'product_id' => $productId
            ]);

            $imageExists = ImageManager::where('image', $productId.$featuredImage)->first();
            // dd($imageExists);
            if($imageExists){
                $imageExists->featured = 1;
                $imageExists->save();
            }
            

            //prepare json response for the request
            $ajaxResponse = [
                'files' => [
                    0 => [
                        "deleteType" => "DELETE",
                        "deleteUrl" => route('product.image.destroy', $image->id),
                        "name" => $imageName,
                        'size' => $fileSize,
                        'thumbnailUrl' => Croppa::url($url, 80, 80, ['resize']),
                        'type' => $fileMimeType,
                        'url' => $url,
                        'featured' => $featuredImage
                    ]
                ]
            ];
        }
        return response()->json($ajaxResponse);
    }
    

    //fetch all images associated with that product
    public function getAllRelatedImages($id){
        $icount = 0;
        $images = ImageManager::where('product_id', $id)->get();
        $imageArray = [];
        foreach ($images as $image) {
            $getImageName = explode("/",$image->image);
            $imageName = end($getImageName);
            $url = $image->image;
            $imageArray[$icount]['url'] = $url;
            $imageArray[$icount]['name'] = $imageName;
            $imageArray[$icount]['imageId'] = $image->id;
            $imageArray[$icount]['size'] = $this->fileSizeFormatted(public_path($url));;
            $imageArray[$icount]['thumbnailUrl'] = Croppa::url($url, 80, 80, ['resize']);
            $imageArray[$icount]['deleteType'] =   'DELETE';
            $imageArray[$icount]['deleteUrl'] =   route('product.image.destroy', $image->id);
            $icount++;
        }
        return $imageArray;
    }


    //delete image
    public function destroy($id){
        $deleteId = ImageManager::find($id)->delete();
        if($deleteId){
            return 1;
        }
        else{
            return 0;
        }
    }

    /*
     * convert filesize to kb/mb
     */
    public function fileSizeFormatted($path)
    {
        $size = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
