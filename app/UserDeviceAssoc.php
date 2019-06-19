<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class UserDeviceAssoc extends Model {

    protected $table = 'user_device_assoc';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    private $rules = array(
        'user_id' => 'required',
        'device_id' => 'required'
    );
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

    public function device() {
      return $this->belongsTo('App\Device');
    }
    public function user() {
      return $this->belongsTo('App\User');
    }


}
