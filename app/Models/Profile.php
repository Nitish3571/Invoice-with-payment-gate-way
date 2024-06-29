<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'email',
      'role',
      'phoneNumber',
      'alternateNumber',
      'address',
      'district',
      'state',
      'zipCode',
      'country',
      'language',
      'gstNumber',
      'remarks',
      'profileImg',
      'status',
      'contact_id',

];
}