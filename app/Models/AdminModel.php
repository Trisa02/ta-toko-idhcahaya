<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class AdminModel extends Model
{
    use HasFactory;
    protected $table = "admins";
    protected $primaryKey = "id_admin";
    public $timestamps = false;

    public static function CheckLoginAdmin ($username, $password){
        $data_admin = DB::table('admins')->where("username", $username)->first();
        if($data_admin == TRUE){
            if(password_verify($password, $data_admin->password)){
                return $data_admin;
            }
            else{
                return false;
            }
        }
    }
}
