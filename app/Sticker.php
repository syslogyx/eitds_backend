<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Sticker extends Model
{
  protected $fillable = [
      "tempId","seriesName","finalId",  "id","user_id"
  ];
  private $rules = array(
      "tempId"=> 'required',
      "seriesName"=> 'required',
      "finalId" => 'required',
      "id" => 'required',
      "user_id" => 'required'
  );
  protected $table = 'stickers';
  protected $guarded = [ 'created_at', 'updated_at'];
  protected $hidden = ['created_at', 'updated_at','created_by','updated_by'];
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
