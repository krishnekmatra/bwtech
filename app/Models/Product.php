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
    /* set slug*/
	 public function setNameAttribute($value){
      $res = str_replace( array( '\'', '"',
      ',' , ';', '<', '>','/'), '-', $value);
      $this->attributes['name'] = $value;
      $this->attributes['slug'] = Str::slug($res);
    }

    /*
        * save data in products table
    */
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

            /*
                * multiple features i mean fetures type select
            */
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
                    // add time use
                    ProductFeture::Create($products_feature);
                }else{

                    //For edit time

                    $matche = [
                    'product_id' => $id,
                    'category_id' => $post['category_id'],
                    'sub_category_id' => $post['sub_category_id'],
                    'features_id'=> $key,
                    ];
                    $productAvilable =  ProductFeture::where($matche)->first();
                    /*
                        Now check product avilabel if avilable then edit
                    */
                    if($productAvilable){
                         ProductFeture::where($matche)->update(['feature_attribute_id'=>$value]);
                     }else{
                        
                        /*
                            Product Add
                        */
                          ProductFeture::Create($products_feature);
                      }
                   
                }

        		
        		
        	}
        }

         if(@$post['multiplefaeturesText']){
            /*
                use feature_type = text
            */
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
                  /* add products */
        		  ProductFeture::updateOrCreate($products_feature,$products_feature);
                }else{

                    $matche = [
                        'product_id' => $id,
                        'category_id' => $post['category_id'],
                        'sub_category_id' => $post['sub_category_id'],
                        'features_id'=> $key,
                    ];
                    /* check product avilble */
                    $productAvilable =  ProductFeture::where($matche)->first();
                    

                    if($productAvilable){
                        /* edit recored */
                        ProductFeture::where($matche)->update(['value'=>$value]);
                    }else{
                        /* add product */
                        ProductFeture::updateOrCreate($products_feature,$products_feature);
                    }
                }
        		
        	}
        }
       
       

        return $product;
	}

    /*
        * one to one relationship
        * get category details
    */
	public function category(){
	  return $this->belongsTo('App\Models\Category', 'category_id','id');
   }

   /*
        * one to one relationship
        * get subcategory details
   */
   public function subCategory(){
	  return $this->belongsTo('App\Models\SubCategory', 'sub_category_id','id');
   }

   /*
        * get products in admin side
   */
   public static function getProducts($request){
   	$query = Product::with(['createdBy','category','subCategory'])->select(['id','name','image','price','category_id','sub_category_id','created_by','status']);
   	if(getAuthGaurd() != 'admin'){
   		$query->where('created_by',\Auth::guard(getAuthGaurd())->user()->id);
   	}
    /* find product based on category */
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

   /* get user deatils*/
   public function createdBy(){
	  return $this->belongsTo('App\Models\user', 'created_by','id');
   }

   //get Latest Product
   public static function getLatestProduct(){
   	$product = Product::where('status',1)->latest()->take(10)->get();
   	return $product;
   }

   //dont use
   public  function getBrands(){
   		return $this->belongsTo('App\Models\SubCategoryFeature', 'sub_category_feature_id','id');
	}
    /* use one to one relationship 
        * get feature attribute id 
    */
	public function feature_attributes(){
		return $this->belongsTo('App\Models\FeatureAttribute', 'feature_attribute_id','id');
	}
    /*
        get all product features
    */
    public function productFeatures() {
        return $this->hasMany('App\Models\ProductFeture');
    }

}
