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

    /**
     * Makes new Image Featured 
     * 
     * @param string $image
     * 
     * @return boolean true
     */
    private function makeImageFeatured($image)
    {
        $featuredImage = ImageManager::imagefind('image', $image)->first();
        $featuredImage->featured = 1;
        $featuredImage->save();
        return $image;
    }


    /**
     * Remove the featured image and create a new image featured

     * @param string $imageName
     * @param int $productId
     * 
     * @return response $image
     */
    public function featuredImage($imageName, $productId)
    {
        $image = ImageManager::where('product_id', $productId)->where('featured', 1)->first();
        if ($image) {
            $image->featured = 0;
            $image->save();
            $response = $this->makeImageFeatured($imageName);
            return $response;
        } else {
            $response = $this->makeImageFeatured($imageName);
            return $response;
        }
    }

    /**
     * Save image into the server in $folder path
     * 
     * @param array $images
     * @param int $productId
     * @param string $featuredImage
     * 
     * @return json $ajaxResponse
     */
    public function saveImage($images, $productId, $featuredImage)
    {
        $pId = strlen((string)$productId);
        $imageFirstChar = (int)substr($featuredImage, 0, $pId);

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

            if($imageName == $featuredImage){
                $pClass = 'featured-image';
            }else{
                $pClass = '';
            }
            
            if($productId != $imageFirstChar){
                $imageExists = ImageManager::imagefind('image', $productId . $featuredImage)->first();
                if ($imageExists) {
                    $this->featuredImage($imageExists->getOriginal('image'), $productId);
                }
            }else{
                $imageExists = ImageManager::imagefind('image', $featuredImage)->first();
                if ($imageExists) {
                    $this->featuredImage($imageExists->getOriginal('image'), $productId);
                }
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
                        'featured' => $featuredImage,
                        'featureclass'  => $pClass,
                    ]
                ]
            ];
        }
        return response()->json($ajaxResponse);
    }


    /**
     * Fetch all images associated with that product
     * and return array containing all images
     */
    public function getAllRelatedImages($id){
        $icount = 0;
        $images = ImageManager::imagefind('product_id', $id)->get();
        $imageArray = [];
        foreach ($images as $image) {
            $getImageName = explode("/",$image->image);
            $imageName = end($getImageName);
            $url = $this->folder. $imageName;
            $imageArray[$icount]['url'] = $url;
            $imageArray[$icount]['name'] = $imageName;
            $imageArray[$icount]['imageId'] = $image->id;
            $imageArray[$icount]['size'] = $this->fileSizeFormatted(public_path($url));;
            $imageArray[$icount]['thumbnailUrl'] = Croppa::url($url, 80, 80, ['resize']);
            $imageArray[$icount]['deleteType'] =   'DELETE';
            $imageArray[$icount]['deleteUrl'] =   route('product.image.destroy', $image->id);
            if($image->featured == 1){
                $imageArray[$icount]['featured'] = $imageName;
            }
            $icount++;
        }
        return $imageArray;
    }

    /**
     * Delete the specified resource
     * 
     * @param int $id
     */
    public function destroy($id)
    {
        $deleteId = ImageManager::imagefind('id', $id)->delete();
        if($deleteId){
            return 1;
        }
        else{
            return 0;
        }
    }

    /*
     * convert filesize to kb/mb
     * 
     */
    private function fileSizeFormatted($path)
    {
        $size = filesize($path);
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}
