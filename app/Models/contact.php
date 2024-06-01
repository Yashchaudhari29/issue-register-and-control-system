<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\LaratrustUserTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use App\Models\contact;


class contact extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['rig', 'fire','hospital','police','location'];
}
