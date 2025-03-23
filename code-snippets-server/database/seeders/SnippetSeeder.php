<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Snippet;

class SnippetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::factory(10)->create();
        Snippet::factory(10)->create()->each(function ($snippet) {
            $tagIds = Tag::inRandomOrder()->take(rand(1, 4))->pluck('id');
            $snippet->tags()->attach($tagIds);
        });
    }
}
