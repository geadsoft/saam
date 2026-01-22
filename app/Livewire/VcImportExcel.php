<?php

namespace App\Livewire;
use Illuminate\Http\Request;

use DB;
use Excel;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class VcImportExcel extends Component
{   
    use WithFileUploads;
    public Post $post;
    public $select_file;

    public function render()
    {
        return view('livewire.vc-import-excel');
    }

    function import(Request $request) {

        $this->validate([
            'select_file' => [
                'required',
                'mimes:xls,xlsx',
            ],
        ]);

        $contents = Storage::disk('public_uploads')->exists('public/files/planilla.xlsx');
        if ($contents){
            Storage::disk('public_uploads')->delete('public/files/planilla.xlsx');
        }
        
        $name = 'planilla'.'.xlsx';
        $pathfile = $this->select_file->storeAs('public/files', $name,'public_uploads');

        
        $this->cargar($pathfile);

    }

     function cargar($pathfile) {

        $contents = Storage::disk('public_uploads')->exists('public/files/planilla.xlsx');
        $file = Storage::disk('public_uploads')->get('public/files/planilla.xlsx');
    
        
        $filePath = $pathfile;
       
        $customerData = Excel::load($filePath)->get();
        if($customerData->count() > 0) {
        foreach($customerData->toArray() as $key => $value) {
        foreach($value as $row){
        $insertData[] = array(
        'name' => $row['name'],
        'gender' => $row['gender'],
        'city' => $row['city'],
        'country' => $row['country']
        );
        }
        }

        /*if(!empty($insertData)){
        DB::table('customer')->insert($insertData);
        }*/
        }

        return back()->with('success', 'Excel Data Imported successfully.');
    }


}
