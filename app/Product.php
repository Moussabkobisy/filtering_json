<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    /**
     * @param array $products products array that needed to be filtered
     * @param array $filters the filters array
     * @return array array of products that meets the needed filter
     */
    public static function filterProducts(array $products,array $filters):array
    {
        // prepare the output array
        $output_array=[];
        // count the filters number to do the filters checksum
        $filters_count=count($filters);

        foreach ($products as $product) {
            // counter used to make the checksum
            $fill=0;
            // loop on filters
            foreach ($filters as $index => $filter){
                // if the product object didn't have this field , then jump to the next product
                if (!isset($product[$index])) break;
                // if the product meets the current filter , increase the matches counter
                if ($product[$index] == $filter) $fill++;
            }
            // if the product meets all filters , then add to the output array
            if ($fill == $filters_count){
                $output_array[] = $product;
            }
        }
        return $output_array;
    }
}
