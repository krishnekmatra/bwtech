<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\SubCategoryFeature;
use App\Models\SubCategory;
use App\Models\ProductFeture;


class ProductEditExport implements FromCollection,WithHeadings,WithEvents
{
    protected $product_subcategory_id;
    protected $product;
    protected  $selects;
    protected  $row_count;
    protected  $column_count;
    protected $array;
    protected $fetures_name;

    public function __construct($data){
        $explode = explode(',',$data['product_export_id']);
        $this->product = $explode;
        $this->product_subcategory_id = $data['product_subcategory_id'];
         $this->array = [];
        $this->column_count = 0;
         $this->fetures_name = [];
        $SubCategoryFeature = SubCategoryFeature::with('featureName.FeatureAttributes')->where('category_id',$this->product_subcategory_id)->get();
         $current_column = 'I';

        $selects = [];
        foreach($SubCategoryFeature as $value){
            $this->column_count++;
            $feature_array = [];
            $this->fetures_name[] =  ['name' => $value['featureName']['name'],'id' => $value['featureName']['id']];

            if($value['featureName']['feature_type'] == 'select'){
                 foreach($value['featureName']['FeatureAttributes'] as $feature){
                    $feature_array [] = $feature['name'];
                }
                $selects [] = ['columns_name' => $current_column , 'options' => $feature_array];
            }
            $current_column++;
           
        }
      
      
       
        $this->selects=$selects;
         $this->row_count=50;//number of rows that will have the dropdown
        $this->column_count=$this->column_count;//number of columns to be auto sized

    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        
        $this->array  = [
            'Product Id',
            'Model Name',
            'Model Image',
            'Model Imag1',
            'Model Imag2',
            'Model Imag3',
            'Supplier Model',
            'Price',
        ];
        foreach($this->fetures_name as $value){
          $this->array[] = $value['name'];
        }
        return $this->array;
    }
    public function collection()
    {
        $products_array = [];
        foreach($this->product as $value){
            $product_result = Product::with('productFeatures.feature_attribute_name.featuresName','productFeatures.feature_name')->where('id',$value)->get();
            
            $product_array = [];
            
            foreach($product_result as $k=>$v){
                $product_array[] = [
                    'product_id' => $v['id'], 
                    'model_name' => $v['name'],
                    'model_image' => url('public/product')."/".$v['image'],
                    'model_image1' => ($v['image1'] == null ) ? '' : url('public/product')."/".$v['image1'],
                    'model_image2' => ($v['image2'] == null ) ? '' : url('public/product')."/".$v['image2'],
                    'model_image3' =>  ($v['image3'] == null ) ? '' : url('public/product')."/".$v['image3'],
                    'supplier_model' => (empty($v['supplier_model']) ? '' : $v['supplier_model']),
                    'price' => $v['price'],
                   
                ];
                $product_feature_id = Collect($v['productFeatures'])->pluck('features_id')->toArray();

                foreach($this->fetures_name as $value){
                    foreach($product_feature_id as $ids)
                    if($value['id'] != $ids){
                        $key = $value['name'] ;
                         $product_array[$k][$key] = '';
                    }
                }
                foreach($v['productFeatures'] as $features){
                    if($features['type'] == 'text'){
                        $key = $features['feature_name']['name'];
                        $product_array[$k][$key] = $features['value'];
                    }else{
                        
                         if(@$features['feature_attribute_name']['featuresName']['name']){
                             $key = $features['feature_attribute_name']['featuresName']['name'];
                             if(@$features['feature_attribute_name']['name']){
                                $product_array[$k][$key] = $features['feature_attribute_name']['name'];
                            }else{
                                 $product_array[$k][$key] = '';
                            }
                         }
                         
                    }
                }
               
                
            }
            
            $products_array [] = $product_array;
        }
        return collect($products_array);
        //return Product::all();
    }
      public function registerEvents(): array
    {
        return [
            // handle by a closure.
            AfterSheet::class => function(AfterSheet $event) {
                $row_count = $this->row_count;
                $column_count = $this->column_count;
                foreach ($this->selects as $select){
                    $drop_column = $select['columns_name'];
                    $options = $select['options'];
                    // set dropdown list for first data row
                    $validation = $event->sheet->getCell("{$drop_column}2")->getDataValidation();
                    $validation->setType(DataValidation::TYPE_LIST );
                    $validation->setErrorStyle(DataValidation::STYLE_INFORMATION );
                    $validation->setAllowBlank(false);
                    $validation->setShowInputMessage(true);
                    $validation->setShowErrorMessage(true);
                    $validation->setShowDropDown(true);
                    $validation->setErrorTitle('Input error');
                    $validation->setError('Value is not in list.');
                    $validation->setPromptTitle('Pick from list');
                    $validation->setPrompt('Please pick a value from the drop-down list.');
                    $validation->setFormula1(sprintf('"%s"',implode(',',$options)));

                    // clone validation to remaining rows
                    for ($i = 3; $i <= $row_count; $i++) {
                        $event->sheet->getCell("{$drop_column}{$i}")->setDataValidation(clone $validation);
                    }
                    // set columns to autosize
                    for ($i = 1; $i <= $column_count; $i++) {
                        $column = Coordinate::stringFromColumnIndex($i);
                        $event->sheet->getColumnDimension($column)->setAutoSize(true);
                    }
                }

            },
        ];
    }
}
