<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class PdfSetting extends Model
{
    protected $table = 'pdf_settings';

    protected $fillable = [
        'logo', 'header_heading',"footer_heading",'status','selected_columns'
    ];
    private $rules = array(
        'header_heading' => 'required',
        'logo' => 'required',
        'status' => 'required',
        'footer_heading' => 'required',
        'selected_columns'=>'required'
    );

    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $hidden = ['created_at', 'updated_at'];
    private $errors;

    public function validate($data) {

        $validator = Validator::make($data, $this->rules);

        if ($validator->fails()) {
            $this->errors = $validator->errors();
            return false;
        }
        return true;
    }

    public function errors() {
        return $this->errors;
    }


}
