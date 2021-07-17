<?php

namespace App\Http\Controllers;

use App\Helpers\ArrayToXml;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use SimpleXMLElement;

class ProductController extends BaseController
{
    /**
     * @OA\Info(title="Sacoor Task Api", version="0.1")
     * Sacoor API.
     *      *@OA\Server(
     *         description="Development",
     *         url="/api/",
     *     )
     */


    /**
     * @OA\Post(
     *     path="/products/filter",
     *     summary="Filter Json file by name and pvp",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="name",
     *                     title="name",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="pvp",
     *                     title="pvp",
     *                     type="string",
     *                 ),
     *                 @OA\Property(
     *                     property="file",
     *                     title="Json file",
     *                     type="file",
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="XML response",
     *      @OA\JsonContent()
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="invalid file contents",
     *      @OA\JsonContent()
     *     )
     * )
     */
    public static function filter(Request $request)
    {
        try {
            // validating input
            $validated_data = $request->validate([
                'file' => 'required|file|mimetypes:application/json'
            ]);

            // prepare the filters array
            $filters=$request->all();
            unset($filters['file']);

            // converting the json file to array to do processing
            $file=file_get_contents( $validated_data['file']);
            $products=json_decode($file,true);

            //call the filter function
            $output_array=Product::filterProducts($products,$filters);

            // making sure we have result
            if (!count($output_array))
                return response('no data available',500);

            // converting to xml format
            $xml_data = new SimpleXMLElement('<?xml version="1.0"?><products></products>');
            ArrayToXml::array_to_xml($output_array, $xml_data);
            $result = $xml_data->asXML();

            // return the response
            return response($result,200);
        }
        catch (\Exception $exception){
            return  response($exception->getMessage(),500);
        }

    }
}
