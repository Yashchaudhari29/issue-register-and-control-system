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
use App\Models\rig;

class rig extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['userid', 'rig'];

    /**
     * Create a new user and assign a role.
     *
     * @return void
     */
   

    /**
     * Update users based on a CSV file.
     *
     */
    
    public static function updaterig()
    {
        $filename = public_path('data/user_data.csv');

        if (!file_exists($filename) || !is_readable($filename)) {
            Log::error("File not found or is not readable: $filename");
            return;
        }

        $file = fopen($filename, "r");
        $dataArr = [];
        $i = 0;

        while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
            if ($i++ == 0) continue; // Skip header row
            $dataArr[] = $filedata;
        }

        fclose($file);

        foreach ($dataArr as $value) {
            if (count($value) < 4) {
                Log::warning("Invalid data format in CSV: " . implode(',', $value));
                continue;
            }


            // $user = rig::create([
            //     'username' => $value[0],
            //     'rig'=> $value[3]
            // ]);

        }
    }
} 

