<?php

namespace Backpack\Settings\database\seeds;

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
        DB::table('settings')->insert([
            'key'           => 'contact_email',
            'name'          => 'Contact form email address',
            'description'   => 'The email address that all emails from the contact form will go to.',
            'value'         => 'admin@updivision.com',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,
        ]);

        DB::table('settings')->insert([
            'key'           => 'contact_cc',
            'name'          => 'Contact form CC field',
            'description'   => 'Email adresses separated by comma, to be included as CC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'contact_bcc',
            'name'          => 'Contact form BCC field',
            'description'   => 'Email adresses separated by comma, to be included as BCC in the email sent by the contact form.',
            'value'         => '',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,

        ]);

        DB::table('settings')->insert([
            'key'           => 'motto',
            'name'          => 'Motto',
            'description'   => 'Website motto',
            'value'         => 'this is the value',
            'field'         => '{"name":"value","label":"Value", "title":"Motto value" ,"type":"textarea"}',
            'active'        => 1,
        ]);
    }
}
