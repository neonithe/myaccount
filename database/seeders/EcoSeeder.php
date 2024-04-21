<?php

namespace Database\Seeders;

use App\Models\econmony\EcoCategory;
use App\Models\econmony\Expense;
use App\Models\econmony\Income;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories
        EcoCategory::create([ 'name'=>'Abonnemang']);
        EcoCategory::create([ 'name'=>'Levende']);
        EcoCategory::create([ 'name'=>'Lån']);
        EcoCategory::create([ 'name'=>'Transport']);
        EcoCategory::create([ 'name'=>'Boende']);
        EcoCategory::create([ 'name'=>'Övrigt']);
        EcoCategory::create([ 'name'=>'Försäkringar']);
        EcoCategory::create([ 'name'=>'Övriga skulder']);
        EcoCategory::create([ 'name'=>'Spara']);

        // Income
        Income::create(['user_id'=>1,'name'=>'Inkomst 1', 'sum'=>25000]);

        // Expenses
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'HBO', 'sum'=>-100]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'Apple', 'sum'=>-40]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'Youtube', 'sum'=>-180]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'PHPStorm', 'sum'=>-140]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'Loopia', 'sum'=>-300]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'ChatGPT', 'sum'=>-300]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'Snus', 'sum'=>-600]);

        Expense::create(['user_id'=>1,'cat_id'=>6,'name'=>'Underhåll', 'sum'=>-1673]);

        Expense::create(['user_id'=>1,'cat_id'=>3,'name'=>'IKEA', 'sum'=>-900]);
        Expense::create(['user_id'=>1,'cat_id'=>3,'name'=>'Klarna', 'sum'=>-1080]);
        Expense::create(['user_id'=>1,'cat_id'=>3,'name'=>'ICA', 'sum'=>-2100]);

        Expense::create(['user_id'=>1,'cat_id'=>2,'name'=>'Mat', 'sum'=>-4000]);

        Expense::create(['user_id'=>1,'cat_id'=>7,'name'=>'Försäkringar', 'sum'=>-900]);
        Expense::create(['user_id'=>1,'cat_id'=>7,'name'=>'Unionen', 'sum'=>-200]);

        Expense::create(['user_id'=>1,'cat_id'=>4,'name'=>'Bensin', 'sum'=>-1000]);
        Expense::create(['user_id'=>1,'cat_id'=>4,'name'=>'Parkering', 'sum'=>-400]);

        Expense::create(['user_id'=>1,'cat_id'=>5,'name'=>'Sofia', 'sum'=>-2900]);
        Expense::create(['user_id'=>1,'cat_id'=>1,'name'=>'Bredband', 'sum'=>-350]);
        Expense::create(['user_id'=>1,'cat_id'=>5,'name'=>'Elräkning', 'sum'=>-300]);

        Expense::create(['user_id'=>1,'cat_id'=>6,'name'=>'Sätta över på LF', 'sum'=>-6106]);


    }
}
