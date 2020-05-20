<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
        	'title'			=>	'Enable Shipping Slot at checkout',
        	'setting_key'	=>	'shipping_slot',
        	'setting_value'	=>	'enable',
            'option_type'   =>  'select',
            'option_values' =>  '["enable","disable"]',
            'description'   =>  'Asks user on checkout for a time slot'
        ]);

        Setting::create([
            'title'         =>  'Enable Cash on delivery',
            'setting_key'   =>  'cash_on_delivery',
            'setting_value' =>  'enable',
            'option_type'   =>  'select',
            'option_values' =>  '["enable","disable"]',
            'description'   =>  'User will able to place order via COD method'
        ]);

        Setting::create([
            'title'         =>  'Enable Online Payment',
            'setting_key'   =>  'pay_online',
            'setting_value' =>  'enable',
            'option_type'   =>  'select',
            'option_values' =>  '["enable","disable"]',
            'description'   =>  'User will able to make payment online'
        ]);

        Setting::create([
            'title'         =>  'Enable Coupons',
            'setting_key'   =>  'coupon',
            'setting_value' =>  'enable',
            'option_type'   =>  'select',
            'option_values' =>  '["enable","disable"]',
            'description'   =>  'User will able to get a discount by entering a valid coupon(promo) code'
        ]);

        Setting::create([
            'title'         =>  'Order Cancellable',
            'setting_key'   =>  'cancel_order',
            'setting_value' =>  'enable',
            'option_type'   =>  'select',
            'option_values' =>  '["enable","disable"]',
            'description'   =>  'User will able cancel any order with he / she placed'
        ]);
    }
}
