<?php

namespace App\Exports;

use App\Models\SubCategoryFeature;
use App\Models\SubCategory;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportSubcategoryFeature implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $subcat_id;
    protected $array;

    public function __construct($id){
        $this->subcat_id = $id;
         $this->array = [];
    }
     public function headings(): array
    {
        $SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$this->subcat_id)->get();
        $this->array  = [
            'Category',
            'SubCategory',
            'Name',
            'Image',
            'Price',
            'Mrp',
            'MOQ',
            'Warrenty',
            'Description'
        ];
        foreach($SubCategoryFeature as $value){
          $this->array[] = $value['featureName']['name'];
        }
        return $this->array;
    }
  
    public function collection()
    {
        $subcat = SubCategory::with('category')->where('id',$this->subcat_id)->first();
        $array1[] = [
            $subcat['category']['name'],
            $subcat['name'],
            "Demo",
            "http://127.0.0.1:8000/product/168481889762530.png",
            "300",
            "400",
            "20",
            "1",
            "test"

        ]; 
        return collect(
           $array1
        );
       // return SubCategoryFeature::all();
    }
}
