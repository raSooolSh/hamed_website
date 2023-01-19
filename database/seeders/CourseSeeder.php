<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Episode;
use App\Models\Section;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $course = Course::create([
            'name_fa' => "پرایس اکشن",
            'name_en' => "price Action",
            'image' => '/storage/courses/41-411947_8k-desktop-wallpaper.jpg',
            'price' => 2500000,
            'description' => "این راست نیست که هرچه عاشق‌ تر باشی بهتر درک می‌کنی. همه‌ی آنچه عشق و عاشقی از من می‌ خواهد",
            'discount_off' => 500000,
            'discount_expire_at' => now()->addDays(3),
            'content' => "<p> مداد رنگی ها مشغول بودند به جز مداد سفید، هیچکس به او کار نمیداد، همه میگفتند : تو به هیچ دردی نمیخوری، یک شب که مداد رنگی ها تو سیاهی شب گم شده بودند، مداد سفید تا صبح ماه کشید مهتاب کشید و انقدر ستاره کشید که کوچک و کوچکتر شد صبح توی جعبه مداد رنگی جای خالی او با هیچ رنگی  پر نشد، به یاد هم باشیم شاید فردا ما هم در کنار هم نباشیم…</p>",
            'teacher' => "حامد حسن زاده",
            'is_active' => 1,
        ]);

        $section = $course->sections()->create([
            'name' => "عاشق‌ تر "
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 0',
            'course_id' => $course->id,
            'number' => 0,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 1',
            'course_id' => $course->id,
            'number' => 1,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 2',
            'course_id' => $course->id,
            'number' => 2,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "عارفانه"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 3',
            'course_id' => $course->id,
            'number' => 3,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 4',
            'course_id' => $course->id,
            'number' => 4,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 5',
            'course_id' => $course->id,
            'number' => 5,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "پیروز"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 6',
            'course_id' => $course->id,
            'number' => 6,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 7',
            'course_id' => $course->id,
            'number' => 7,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 8',
            'course_id' => $course->id,
            'number' => 8,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "طولانی‌ تر"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 9',
            'course_id' => $course->id,
            'number' => 9,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 10',
            'course_id' => $course->id,
            'number' => 10,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 11',
            'course_id' => $course->id,
            'number' => 11,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $course = Course::create([
            'name_fa' => "آر تی ال",
            'name_en' => "RTL",
            'image' => '/storage/courses/41-411947_8k-desktop-wallpaper.jpg',
            'price' => 3500000,
            'description' => "هر نفسی که فرو می‌ بریم، مرگی را که مدام به ما دست‌ اندازی می‌کند پس می‌زند... در نهایت این مرگ است که باید پیروز شود، زیرا از هنگام تولد بخشی از سرنوشت ما شده و فقط مدت کوتاهی پیش از بلعیدن طعمه اش، با آن بازی می کند.",
            'discount_off' => 700000,
            'discount_expire_at' => now()->addDays(5),
            'content' => "<p>هر نفسی که فرو می‌ بریم، مرگی را که مدام به ما دست‌ اندازی می‌کند پس می‌زند... در نهایت این مرگ است که باید پیروز شود، زیرا از هنگام تولد بخشی از سرنوشت ما شده و فقط مدت کوتاهی پیش از بلعیدن طعمه اش، با آن بازی می کند. با این همه، ما تا آنجا که ممکن است، با علاقه فراوان و دلواپسی زیاد به زندگی ادامه می دهیم، همان‌ طور که تا آنجا که ممکن است طولانی‌ تر در یک حباب صابون می‌ دمیم تا بزرگتر شود، گر چه با قطعیتی تمام می‌ دانیم که خواهد ترکید.</p>",
            'teacher' => "حامد حسن زاده",
            'is_active' => 1,
        ]);

        $section = $course->sections()->create([
            'name' => "مدام "
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 0',
            'course_id' => $course->id,
            'number' => 0,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 1',
            'course_id' => $course->id,
            'number' => 1,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 2',
            'course_id' => $course->id,
            'number' => 2,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "کوتاهی"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 3',
            'course_id' => $course->id,
            'number' => 3,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 4',
            'course_id' => $course->id,
            'number' => 4,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 5',
            'course_id' => $course->id,
            'number' => 5,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "سرنوشت"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 6',
            'course_id' => $course->id,
            'number' => 6,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 7',
            'course_id' => $course->id,
            'number' => 7,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 8',
            'course_id' => $course->id,
            'number' => 8,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "بزرگتر"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 9',
            'course_id' => $course->id,
            'number' => 9,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 10',
            'course_id' => $course->id,
            'number' => 10,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 11',
            'course_id' => $course->id,
            'number' => 11,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<


        // >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
        $course = Course::create([
            'name_fa' => "فاندامنتال",
            'name_en' => "fundamental",
            'image' => '/storage/courses/41-411947_8k-desktop-wallpaper.jpg',
            'price' => 5000000,
            'description' => "خالد حسینی تو رمان باد بادک باز مینویسه : ﻣﺮﺩ ﺁﻫﺴﺘﻪ ﺩﺭ ﮔﻮﺵ ﻓﺮﺯﻧﺪ ﺗﺎﺯﻩ ﺑﻪ ﺑﻠﻮﻍ ﺭﺳﯿﺪﻩ ﺍﺵ ﺑﺮﺍﯼ ﭘﻨﺪ ﭼﻨﯿﻦ ﻧﺠﻮﺍ ﮐﺮﺩ : ",
            'discount_off' => null,
            'discount_expire_at' => null,
            'content' => "<p> مداد رنگی ها مشغول بودند به جز مداد سفید، هیچکس به او کار نمیداد، همه میگفتند : تو به هیچ دردی نمیخوری، یک شب که مداد رنگی ها تو سیاهی شب گم شده بودند، مداد سفید تا صبح ماه کشید مهتاب کشید و انقدر ستاره کشید که کوچک و کوچکتر شد صبح توی جعبه مداد رنگی جای خالی او با هیچ رنگی  پر نشد، به یاد هم باشیم شاید فردا ما هم در کنار هم نباشیم…</p>",
            'teacher' => "حامد حسن زاده",
            'is_active' => 1,
        ]);

        $section = $course->sections()->create([
            'name' => "ﺷﺮﺍﻓﺖ"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 0',
            'course_id' => $course->id,
            'number' => 0,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 1',
            'course_id' => $course->id,
            'number' => 1,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 2',
            'course_id' => $course->id,
            'number' => 2,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 1
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "ﺩﺯﺩﯾﺪﻩ"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 3',
            'course_id' => $course->id,
            'number' => 3,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 4',
            'course_id' => $course->id,
            'number' => 4,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 5',
            'course_id' => $course->id,
            'number' => 5,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "ﻧﺪﺍﺷﺘﻪ"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 6',
            'course_id' => $course->id,
            'number' => 6,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 7',
            'course_id' => $course->id,
            'number' => 7,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 8',
            'course_id' => $course->id,
            'number' => 8,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        $section = $course->sections()->create([
            'name' => "ﻟﺒﺨﻨﺪﯼ"
        ]);
        // ---------------------------------------------------
        $section->episodes()->create([
            'name' => 'قسمت 9',
            'course_id' => $course->id,
            'number' => 9,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 10',
            'course_id' => $course->id,
            'number' => 10,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        $section->episodes()->create([
            'name' => 'قسمت 11',
            'course_id' => $course->id,
            'number' => 11,
            'video' => '/courses/دوره اول/laravel_eCommerce_part_1.mp4',
            'is_free' => 0
        ]);
        // ---------------------------------------------------------
        // <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    }
}
