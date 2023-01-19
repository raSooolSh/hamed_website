<?php

namespace Database\Seeders;

use App\Models\Premission;
use Illuminate\Database\Seeder;

class PremissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // this premission used in code, please becarefull
        Premission::insert([
            [
                'name'=>'users-show',
                'label'=>'نمایش کاربران',
            ],
            [
                'name'=>'users-edit',
                'label'=>'ویرایش کاربران',
            ],
            [
                'name'=>'users-block',
                'label'=>'بلاک کردن کاربران',
            ],
            [
                'name'=>'users-unblock',
                'label'=>'آنبلاک کردن کاربران',
            ],
            [
                'name'=>'users-premission',
                'label'=>'دسترسی دادن به کاربران',
            ],
            [
                'name'=>'roles-show',
                'label'=>'نمایش نقش ها',
            ],
            [
                'name'=>'roles-create',
                'label'=>'ایجاد نقش',
            ],
            [
                'name'=>'roles-delete',
                'label'=>'حذف نقش',
            ],
            [
                'name'=>'roles-edit',
                'label'=>'ویرایش نقش',
            ],
            [
                'name'=>'courses-show',
                'label'=>'نمایش دوره',
            ],
            [
                'name'=>'courses-create',
                'label'=>'ایجاد دوره',
            ],
            [
                'name'=>'courses-delete',
                'label'=>'حذف دوره',
            ],
            [
                'name'=>'courses-edit',
                'label'=>'ویرایش دوره',
            ],
            [
                'name'=>'file-manager',
                'label'=>'دسترسی به فایل منیجر',
            ],
            [
                'name'=>'discounts-show',
                'label'=>'نمایش تخفیف ها',
            ],
            [
                'name'=>'discounts-edit',
                'label'=>'ویرایش تخفیف',
            ],
            [
                'name'=>'discounts-create',
                'label'=>'افزودن تخفیف',
            ],
            [
                'name'=>'discounts-delete',
                'label'=>'حذف تخفیف',
            ],
            [
                'name'=>'articles-show',
                'label'=>'نمایش مقاله و خبر',
            ],
            [
                'name'=>'articles-edit',
                'label'=>'ویرایش مقاله و خبر',
            ],
            [
                'name'=>'articles-create',
                'label'=>'افزودن مقاله و خبر',
            ],
            [
                'name'=>'articles-delete',
                'label'=>'حذف مقاله و خبر',
            ],
            [
                'name'=>'comments-manage',
                'label'=>'مدیریت کامنت ها',
            ],
            [
                'name'=>'tickets-manage',
                'label'=>'مدیریت نیکت ها',
            ],
        ]);
    }
}
