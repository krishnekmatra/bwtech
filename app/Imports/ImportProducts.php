<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\SubCategory;
use App\Models\FeatureAttribute;
use App\Models\Feature;
use App\Models\ProductFeture;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use App\Rules\CategoryRule;
use App\Rules\SubCategoryRule;
use App\Rules\FeatureRule;
use App\Rules\ImageRule;
use App\Models\Category;
use App\Models\SubCategoryFeature;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;



class ImportProducts implements OnEachRow, WithValidation,WithHeadingRow, SkipsOnError, SkipsOnFailure, WithBatchInserts, WithChunkReading,ToCollection
{
    use SkipsErrors, Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
   
     public function rules(): array
    
    {
        return [
                 '*.name' => 'required|unique:products,name',
                '*.category' => ['required',new CategoryRule],
                 '*.subcategory' => ['required',new SubCategoryRule],
                // '*.image' => ['required',new ImageRule],
                 '*.warrenty' => 'required|numeric',
               // '*.specification' => ['required',new FeatureRule]
            ];
    }
     public function batchSize(): int
    {
        return 5;
    }
    
    public function chunkSize(): int
    {
        return 5;
    }
     public function model(array $row)
    {
        return new Product([
           'id' => $row[0]
        ]);
    }
   
     public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row      = $row->toArray();
        if ($rowIndex != 1) {
           
        $category_id = Category::where('name',$row['category'])->pluck('id')->first();
        
        $subCategory_id =  SubCategory::where('name',$row['subcategory'])->pluck('id')->first(); 

         $feature_attribute_id =  FeatureAttribute::where('name','EVM')->pluck('id')->first(); 

        $SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$subCategory_id)->get();
    


        $explode_image = explode('product/',$row['image']);
        if(isset($explode_image[1])){
          if (file_exists(public_path('product',$explode_image[1]))){
            $image_name =  $explode_image[1];
           
          }else{
            $image_name = '';
          }
        }
        if(getAuthGaurd() == 'admin'){
            $status = 1;
        }else{
            $status = 0;
        }
       
        $product = Product::create([
            //
            'category_id' => $category_id,
            'sub_category_id' => $subCategory_id,
            'feature_attribute_id' => $feature_attribute_id,
            'name'     => $row['name'],
            'image'    => $image_name,
            'price'    => $row['price'],
            'mrp'      => $row['mrp'],
            'maq'      => $row['moq'],
            'warrenty' => $row['warrenty'],
            'description' => $row['description'],
            'status' => $status,
            'created_by' => \Auth::guard(getAuthGaurd())->user()->id
           ]);
         foreach($SubCategoryFeature as $value){
            $feature_name = $value['featureName']['slug'];
            $str = str_replace("-" , "_", $feature_name);
            $feature_id =  Feature::where('name', $value['featureName']['name'])->first();
            $feature_attibut_id = FeatureAttribute::where('name', $row[$str])->pluck('id')->first();
            
            $products_feature = [
                      'product_id' => $product->id,
                      'category_id' => $category_id,
                      'sub_category_id' => $subCategory_id,
                      'features_id'=> $feature_id['id'],

                      'feature_attribute_id' => ($feature_attibut_id ? $feature_attibut_id : NULL),
                      'value' => ($feature_attibut_id ? NULL : $row[$str]),
                      'type' => $feature_id['feature_type']
            ];
            ProductFeture::Create($products_feature);
            
        }
            
          
        }

        return;
        //return response()->json(['success' => $rec_id]); 

        
    }

    public function startRow(): int
    {
        return 2;
    }
}
    