<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Ambil semua ID dari tabel posts dan tags
         $postIds = Post::pluck('id')->toArray();
         $tagIds = Tag::pluck('id')->toArray();
 
         // Pastikan ada data di kedua tabel
         if (empty($postIds) || empty($tagIds)) {
             return;
         }
 
         // Hubungkan setiap post dengan beberapa tag secara acak
         foreach ($postIds as $postId) {
             // Misalnya setiap post memiliki 1-3 tag
             $randomTagIds = array_rand(array_flip($tagIds), rand(1, 3));
             if (!is_array($randomTagIds)) {
                 $randomTagIds = [$randomTagIds];
             }
 
             foreach ($randomTagIds as $tagId) {
                PostTag::create([
                    'post_id' => $postId,
                    'tag_id' => $tagId,
                ]);
             }
         }
    }
}
