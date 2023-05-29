<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;
use App\Models\SubCategoryFeature;
use App\Models\SubCategory;


class ExportSubcategoryFeature implements FromCollection,WithHeadings,WithEvents
{
    protected  $users;
    protected  $selects;
    protected  $row_count;
    protected  $column_count;
     protected $subcat_id;
    protected $array;
    
    public function __construct($id)
    {
        $this->subcat_id = $id;
        $this->array = [];
        $this->column_count = 0;
        $SubCategoryFeature = SubCategoryFeature::with('featureName.FeatureAttributes')->where('sub_category_id',$this->subcat_id)->get();
        $current_column = 'I';

        $selects = [];
        foreach($SubCategoryFeature as $value){
            $this->column_count++;
            $feature_array = [];
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

   
    public function headings(): array
    {
         $SubCategoryFeature = SubCategoryFeature::with('featureName')->where('sub_category_id',$this->subcat_id)->get();
        $this->array  = [
            'Category',
            'Model Name',
            'Model Image',
            'Model Imag1',
            'Model Imag2',
            'Model Imag3',
            'Supplier Model',
            'Price',
        ];
        foreach($SubCategoryFeature as $value){
          $this->array[] = $value['featureName']['name'];
        }
        return $this->array;
    }

    /**
     * @return array
     */
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
    public function collection()
    {
        $subcat = SubCategory::where('id',$this->subcat_id)->first();
        $array1[] = [
            $subcat['name'],
            "Demo",
            "http://127.0.0.1:8000/product/168481889762530.png",
            "http://127.0.0.1:8000/product/168481889762530.png",
            "http://127.0.0.1:8000/product/168481889762530.png",
            "http://127.0.0.1:8000/product/168481889762530.png",
            "Supplier1",
            "300",

        ]; 
        return collect(
           $array1
        );
       // return SubCategoryFeature::all();
    }
}