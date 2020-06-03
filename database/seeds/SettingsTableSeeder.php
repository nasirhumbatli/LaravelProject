<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert(
            [
                [
                    'settings_description' => 'Başlıq',
                    'settings_key' => 'title',
                    'settings_value' => 'Laravel 7 ECMS',
                    'settings_type' => 'text',
                    'settings_must' => 0,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Açıqlama',
                    'settings_key' => 'description',
                    'settings_value' => 'Laravel 7 ECMS description',
                    'settings_type' => 'text',
                    'settings_must' => 1,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Logo',
                    'settings_key' => 'logo',
                    'settings_value' => 'logo.png',
                    'settings_type' => 'file',
                    'settings_must' => 2,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Icon',
                    'settings_key' => 'icon',
                    'settings_value' => 'icon.ico',
                    'settings_type' => 'file',
                    'settings_must' => 3,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Açar Sözlər',
                    'settings_key' => 'keywords',
                    'settings_value' => 'laravel,ecms,nesir humbetli',
                    'settings_type' => 'text',
                    'settings_must' => 4,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Telefon',
                    'settings_key' => 'phone',
                    'settings_value' => '994 55 XXX XX XX',
                    'settings_type' => 'text',
                    'settings_must' => 5,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Telefon Faks',
                    'settings_key' => 'phone_faks',
                    'settings_value' => '994 12 XXX XX XX',
                    'settings_type' => 'text',
                    'settings_must' => 6,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Elektron Poçt',
                    'settings_key' => 'mail',
                    'settings_value' => 'Nesir.Humbetli@gmail.com',
                    'settings_type' => 'text',
                    'settings_must' => 7,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Şəhər',
                    'settings_key' => 'city',
                    'settings_value' => 'Bakı',
                    'settings_type' => 'text',
                    'settings_must' => 8,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Rayon',
                    'settings_key' => 'district',
                    'settings_value' => 'Suraxanı',
                    'settings_type' => 'text',
                    'settings_must' => 9,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ],
                [
                    'settings_description' => 'Adres',
                    'settings_key' => 'adres',
                    'settings_value' => 'Suraxanı ray Suraxanı küç',
                    'settings_type' => 'text',
                    'settings_must' => 10,
                    'settings_delete' => '0',
                    'settings_status' => '1'
                ]
                
            ]
        );
    }
}
