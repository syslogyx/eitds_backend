<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;

class Device extends Model {

  protected $table = 'devices';
  protected $guarded = ['id','created_at', 'updated_at'];
  private $rules = array(
      'device_id' => 'required:unique:devices,device_id'
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
  public function deviceInfo() {
    return $this->hasMany('App\UserDeviceAssoc','device_id');
  }

}
