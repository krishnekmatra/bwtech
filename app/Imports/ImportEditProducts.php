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
    
    public function __construct($id)
    {
        $this->product_subcategory_id = $id;
        $this->SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$this->product_subcategory_id)->get();
    
    }
    
     public function rules(): array
    
    {
        return [
                '*.product_id' => 'required',
                 '*.model_name' => 'required',
                 '*.model_image' => ['required',new ImageRule],
                  '*.supplier_model' => 'required',
                
            ];
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

        $explode_image1 = explode('product/',$row['model_imag1']);
        if(isset($explode_image1[1])){
          if (file_exists(public_path('product',$explode_image1[1]))){
            $image_name1 =  $explode_image1[1];
           
          }else{
            $image_name1 = '';
          }
        }else{
             $image_name1 = '';
        }

        $explode_image2 = explode('product/',$row['model_imag2']);
        if(isset($explode_image1[1])){
          if (file_exists(public_path('product',$explode_image2[1]))){
            $image_name2 =  $explode_image2[1];
           
          }else{
            $image_name2 = '';
          }
        }else{
             $image_name2 = '';
        }

        $explode_image3 = explode('product/',$row['model_imag3']);
        if(isset($explode_image3[1])){
          if (file_exists(public_path('product',$explode_image3[1]))){
            $image_name3 =  $explode_image3[1];
           
          }else{
            $image_name3 = '';
          }
        }else{
             $image_name3 = '';
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
            'image1'    => $image_name1,
            'image2'    => $image_name2,
            'image3'    => $image_name3,
            'price'    => $row['price'],
            'supplier_model' => $row['supplier_model'],
        ]);
        
        foreach($this->SubCategoryFeature as $value){
            $feature_name = $value['featureName']['slug'];
            $str = str_replace("-" , "_", $feature_name);

            $feature_id =  Feature::where('name', $value['featureName']['name'])->first();
            $feature_attibut_id = FeatureAttribute::where('name', $row[$str])->where('feature_id',$feature_id['id'])->pluck('id')->first();
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
           
            
        }
            
          
        }

        return;

        
    }

    public function startRow(): int
    {
        return 2;
    }
}
    