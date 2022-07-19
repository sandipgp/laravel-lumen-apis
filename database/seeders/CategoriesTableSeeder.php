<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Categories;
class CategoriesTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
        Categories::create([
            "title"=>"politics", //, sports, entertainment, technology
            "description"=>"politics news"
         ]);
      
    }
}