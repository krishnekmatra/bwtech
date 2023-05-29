<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\ProductFeture;
class Product extends Model
{
	use HasFactory;
	protected $fillable = [
		'name',
		'image',
        'image1',
        'image2',
        'image3',
		'price',
		'mrp',
		'maq',
		'warrenty',
		'description',
		'sub_category_feature_id',
		'category_id',
		'sub_category_id',
		'created_by',
		'status',
		'slug',
        'supplier_model',
        'bw_model'
	];
	 public function setNameAttribute($value){
      $res = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','/'), '-', $value);
      $this->attributes['name'] = $value;
      $this->attributes['slug'] = Str::slug($res);
    }

    //public function setDescriptionAttribute($value){
    // 	$explode = explode('key Features:-',$value);
    //   $bullexplode = explode('&bull;',$explode[1]);
    //   $description_text = $explode[0].'</p><b>key Features:- </b>';
    //   foreach($bullexplode as $val){
    //   	$description_text.="<ul>";
    //   	if(!empty($val)){
    //   			$description_text.="<li>";
    //   			$description_text.=$val;
    //   			$description_text.="</li>";
    //   	}
    //    }
    //    $description_text.="</ul>";
    //    $this->attributes['description'] =  $description_text;
    // }
	public static function saveProduct($post){
		 if(isset($post['id'])){
            $id = $post['id'];
            $findproduct = product::where('id',$id)->first();
            if($findproduct['sub_category_id'] != $post['sub_category_id']){
                ProductFeture::where('product_id',$post['id'])->delete();
            }
        }else{
            $id = 0;
        }
        if(getAuthGaurd() == 'admin'){
        	$post['status'] = 1;
        }else{
        	$post['status'] = 0;
        }
        $post['created_by'] = \Auth::guard(getAuthGaurd())->user()->id; 
        $matchThese = ['id'=>$id];

        $product = Product::updateOrCreate($matchThese,$post);
        if(@$post['multiplefaetures']){
        	$multiplefaetures = $post['multiplefaetures'];
        	foreach($multiplefaetures as $key=>$value){
            

        		$products_feature = [
        			  'product_id' => $product->id,
        			  'category_id' => $post['category_id'],
        			  'sub_category_id' => $post['sub_category_id'],
        			  'features_id'=> $key,
        			  'feature_attribute_id' => ($value) ? $value : NULL,
                      'type' => 'select'
        		];

                if($id == 0){
                    ProductFeture::Create($products_feature);
                }else{

                    $matche = [
                    'product_id' => $id,
                    'category_id' => $post['category_id'],
                    'sub_category_id' => $post['sub_category_id'],
                    'features_id'=> $key,
                    ];
                    $productAvilable =  ProductFeture::where($matche)->first();
                    if($productAvilable){
                         ProductFeture::where($matche)->update(['feature_attribute_id'=>$value]);
                     }else{
                        
                        
                          ProductFeture::Create($products_feature);
                      }
                   
                }

        		
        		
        	}
        }

         if(@$post['multiplefaeturesText']){
        	$multiplefaeturesText = $post['multiplefaeturesText'];
        	foreach($multiplefaeturesText as $key=>$value){
        		$products_feature = [
        			  'product_id' => $product->id,
        			  'category_id' => $post['category_id'],
        			  'sub_category_id' => $post['sub_category_id'],
        			  'features_id'=> $key,
        			  'value' => $value,
                       'type' => 'text'
        		];
                if($id == 0){
        		  ProductFeture::updateOrCreate($products_feature,$products_feature);
                }else{
                    $matche = [
                    'product_id' => $id,
                    'category_id' => $post['category_id'],
                    'sub_category_id' => $post['sub_category_id'],
                    'features_id'=> $key,
                    ];
                     $productAvilable =  ProductFeture::where($matche)->first();
                    if($productAvilable){
                             ProductFeture::where($matche)->update(['value'=>$value]);
                    }else{
                        ProductFeture::updateOrCreate($products_feature,$products_feature);
                    }
                }
        		
        	}
        }
       
       

        return $product;
	}

	public function category(){
	  return $this->belongsTo('App\Models\Category', 'category_id','id');
   }

   public function subCategory(){
	  return $this->belongsTo('App\Models\SubCategory', 'sub_category_id','id');
   }

   public static function getProducts($request){
   	$query = Product::with(['createdBy','category','subCategory'])->select(['id','name','image','price','category_id','sub_category_id','created_by','status']);
   	if(getAuthGaurd() != 'admin'){
   		$query->where('created_by',\Auth::guard(getAuthGaurd())->user()->id);
   	}
   	if($request['category']){
   		$search_txt = $request['category'];
   		$query = $query->where(function($q) use($search_txt) {
			$q->whereHas('category', function ($query) use ($search_txt) {
				 $query->where('id',$search_txt);
			 });
			
		});
   	}
   	$query = $query->orderBy('created_at','desc')->get();
   	return $query;
   }

   public function createdBy(){
	  return $this->belongsTo('App\Models\user', 'created_by','id');
   }

   //get Latest Product
   public static function getLatestProduct(){
   	$product = Product::where('status',1)->latest()->take(10)->get();
   	return $product;
   }

   //get Brand
   public  function getBrands(){
   		return $this->belongsTo('App\Models\SubCategoryFeature', 'sub_category_feature_id','id');
	}
	public function feature_attributes(){
		return $this->belongsTo('App\Models\FeatureAttribute', 'feature_attribute_id','id');
	}

    public function productFeatures() {
        return $this->hasMany('App\Models\ProductFeture');
    }

}
