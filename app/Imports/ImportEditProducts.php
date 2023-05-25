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
use InvalidInputException;
use Illuminate\Validation\Factory as Validator;




class ImportEditProducts implements OnEachRow, WithValidation,WithHeadingRow, SkipsOnError, SkipsOnFailure, WithBatchInserts, WithChunkReading
{
    use SkipsErrors, Importable, SkipsFailures;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    protected  $product_subcategory_id;
    protected $SubCategoryFeature ;
    protected $validator;
    
    public function __construct($id,Validator $validator)
    {
        $this->product_subcategory_id = $id;
        $this->SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$this->product_subcategory_id)->get();
    
    }
    
     public function rules($id): array
    
    {
        return [
                '*.product_id' => 'required',
                 '*.model_name' => 'required',
                // '*.model_image' => ['required',new ImageRule],
                 '*.warrenty' => 'required|numeric'
            ];
    }
    public function validate(array $input, $id = 0)
    {
        $validator = $this->validator->make($input, $this->rules($id));
        
        if($validator->fails()) throw new InvalidInputException();
    }
     public function batchSize(): int
    {
        return 2;
    }
    
    public function chunkSize(): int
    {
        return 2;
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
           
          $product_id = $row['product_id'];

          


        $explode_image = explode('product/',$row['model_image']);
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
       
        $product = Product::where('id',$product_id)->update([
            //
            'name'     => $row['model_name'],
            'image'    => $image_name,
            'price'    => $row['price'],
            'mrp'      => $row['mrp'],
            'maq'      => $row['moq'],
            'warrenty' => $row['warrenty'],
            'description' => $row['description'],
        ]);
        
        foreach($this->SubCategoryFeature as $value){
            $feature_name = $value['featureName']['slug'];
            $str = str_replace("-" , "_", $feature_name);

            $feature_id =  Feature::where('name', $value['featureName']['name'])->first();
            $feature_attibut_id = FeatureAttribute::where('name', $row[$str])->pluck('id')->first();
             $matche = [
                    'product_id' => $product_id,
                    'category_id' => $value['category_id'],
                    'sub_category_id' => $value['sub_category_id'],
                    'features_id'=>  $feature_id['id'],
            ];
            $productAvilable =  ProductFeture::where($matche)->first();
            if( $feature_id['feature_type'] == 'select'){
                $products_feature = [
                      'product_id' => $product_id,
                      'category_id' => $value['category_id'],
                      'sub_category_id' => $value['sub_category_id'],
                      'features_id'=> $feature_id['id'],
                      'feature_attribute_id' => $feature_attibut_id,
                      'type' => 'select'
                ];
                if( $productAvilable){
                    ProductFeture::where($matche)->update(['feature_attribute_id'=>$feature_attibut_id]);
                }else{
                 ProductFeture::create($products_feature);   
                }
            }else{
                $products_feature = [
                      'product_id' => $product_id,
                      'category_id' => $value['category_id'],
                      'sub_category_id' => $value['sub_category_id'],
                      'features_id'=> $feature_id['id'],
                      'value' => $row[$str],
                       'type' => 'text'
                ];
                if($productAvilable){
                     ProductFeture::where($matche)->update(['value'=>$row[$str]]);
                }else{
                    ProductFeture::create($products_feature); 
                }
            }
            // $products_feature = [
            //           'product_id' => $product_id,
            //           'category_id' => $value['category_id'],
            //           'sub_category_id' => $value['sub_category_id'],
            //           'features_id'=> $feature_id['id'],

            //           'feature_attribute_id' => ($feature_attibut_id ? $feature_attibut_id : NULL),
            //           'value' => ($feature_attibut_id ? NULL : $row[$str]),
            //           'type' => $feature_id['feature_type']
            // ];
            // ProductFeture::Create($products_feature);
            
        }
            
          
        }

        return;

        
    }

    public function startRow(): int
    {
        return 2;
    }
}
    