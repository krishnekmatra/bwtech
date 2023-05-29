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




class ImportProducts implements OnEachRow, WithValidation,WithHeadingRow, SkipsOnError, SkipsOnFailure, WithBatchInserts, WithChunkReading
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
				 '*.model_name' => 'required|unique:products,name',
				'*.category' => ['required',new SubCategoryRule],
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
		   
		   $subCategory =  SubCategory::where('name',$row['category'])->first();

		  $category_id = $subCategory['category_id'];
		  $subCategory_id = $subCategory['id'];

		  $SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$subCategory_id)->get();
	


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
	   
		$product = Product::create([
			//
			'category_id' => $category_id,
			'sub_category_id' => $subCategory_id,
			'name'     => $row['model_name'],
			'image'    => $image_name,
			'image1'    => $image_name1,
      'image2'    => $image_name2,
      'image3'    => $image_name3,
      'supplier_model' => $row['supplier_model'],
			'price'    => $row['price'],
			'status' => $status,
			'created_by' => \Auth::guard(getAuthGaurd())->user()->id
		]);
		
		foreach($SubCategoryFeature as $value){
			$feature_name = $value['featureName']['slug'];
			$str = str_replace("-" , "_", $feature_name);
			$feature_id =  Feature::where('name', $value['featureName']['name'])->first();
			$feature_attibut_id = FeatureAttribute::where('name', $row[$str])->where('feature_id',$feature_id['id'])->pluck('id')->first();
			
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

		
	}

	public function startRow(): int
	{
		return 2;
	}
}
	