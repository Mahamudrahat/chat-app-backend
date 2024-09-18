<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' =>'mahamud',
            'email'=>'mahamud.rahat@gmail.com',
            'password'=>Hash::make('12345'),
            'avatar'=>'me.jpg'
            ]);
            User::create([
                'name' =>'hasan',
                'email'=>'mahamud@gmail.com',
                'password'=>Hash::make('12345'),
                'avatar'=>'me.jpg'
                ]);
            foreach(range(start:1,end:10)as $i){
                User::factory()->create();
            }
        }
    }

