<?php

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::unguard();
        $now = Carbon::now()->toDateTimeString();
        $options = [
            [
                'id' => 1,
                'name' => 'Tin công nghệ',
                'slug' => Str::slug('Tin công nghệ'),
                'parent_id' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 2,
                'name' => 'Tin thời sự',
                'slug' => Str::slug('Tin thời sự'),
                'parent_id' => 0,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 3,
                'name' => 'Thời sự trong nước',
                'slug' => Str::slug('Thời sự trong nước'),
                'parent_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 4,
                'name' => 'Thời sự quốc tế',
                'slug' => Str::slug('Thời sự quốc tế'),
                'parent_id' => 2,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 5,
                'name' => 'Thời trang công nghệ',
                'slug' => Str::slug('Thời trang công nghệ'),
                'parent_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 6,
                'name' => 'Công nghệ mới',
                'slug' => Str::slug('Công nghệ mới'),
                'parent_id' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'id' => 7,
                'name' => 'Đánh giá sản phẩm',
                'slug' => Str::slug('Đánh giá sản phẩm'),
                'parent_id' => 6,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        Category::insert($options);
        Category::reguard();
    }
}
