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
use App\Models\User;
use App\Models\rig;

class user extends Authenticatable
{
    use LaratrustUserTrait, HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['username', 'password','role','mob_number','rig'];
    protected $hidden = ['password', 'remember_token'];

    /**
     * Create a new user and assign a role.
     *
     * @return void
     */
    public static function createUser()
    {
        $roleName = 'owner';
        $role = Role::firstOrCreate(
            ['name' => $roleName],
            ['display_name' => 'Project Owner', 'description' => 'User is the owner of a given project']
        );

    }

    /**
     * Update users based on a CSV file.
     *
     */
    public static function updateUser()
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
            if (count($value) < 5) {
                Log::warning("Invalid data format in CSV: " . implode(',', $value));
                continue;
            }

            $user = User::firstOrCreate([
                'username' => $value[0],
                'password' => bcrypt($value[1]),
                'role'=>$value[2],
                'mob_number'=>$value[4],
                'rig'=> $value[3],
            ]);

            $roleName = $value[2];
            
            $role = Role::firstOrCreate(
                ['name' => $roleName],
                ['display_name' => $roleName, 'description' => 'User can access ' . $value[0]],
            );

            // $role = Role::firstOrCreate(
            //     ['name' => $roleName],
            //     ['display_name' => $roleName, 'description' => 'User can access ' . $value[0]],
            // );


            $user->attachRole($role);
            echo ("User with username {$user->username} added successfully");

            //     echo ($user->id);

            $rig = rig::create([
                'userid' => $user->id,
                'rig'=> $value[3],
            ]);
            
        }
    }
} 

