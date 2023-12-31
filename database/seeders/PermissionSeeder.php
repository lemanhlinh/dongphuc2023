<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use App\Models as Database;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = static::getDefaultPermission();

        foreach($permissions as $permission ) {
            Permission::updateOrCreate($permission);
        }

        $allPermissionNames = Database\Permission::pluck('name')->toArray();

        $roleAdmin = Database\Role::updateOrCreate([
            'name' => 'admin',
            'display_name' => 'Admin',
            'guard_name' => 'web',
        ]);

        $roleAdmin->givePermissionTo($allPermissionNames);

        $user = Database\User::find(1);

        if ($user) {
            $user->assignRole($roleAdmin);
        }
    }

    public static function getDefaultPermission()
    {
        return [
            ['name' => 'view_user', 'display_name' => 'Xem danh sách người dùng', 'guard_name' => 'web'],
            ['name' => 'create_user', 'display_name' => 'Thêm mới người dùng', 'guard_name' => 'web'],
            ['name' => 'edit_user', 'display_name' => 'Sửa thông tin người dùng', 'guard_name' => 'web'],
            ['name' => 'delete_user', 'display_name' => 'Xóa người dùng', 'guard_name' => 'web'],

            ['name' => 'view_role', 'display_name' => 'Xem danh sách phân quyền', 'guard_name' => 'web'],
            ['name' => 'create_role', 'display_name' => 'Thêm mới phân quyền', 'guard_name' => 'web'],
            ['name' => 'edit_role', 'display_name' => 'Sửa thông tin phân quyền', 'guard_name' => 'web'],
            ['name' => 'delete_role', 'display_name' => 'Xóa phân quyền', 'guard_name' => 'web'],

            ['name' => 'view_contact', 'display_name' => 'Xem danh sách liên hệ', 'guard_name' => 'web'],

            ['name' => 'view_menu_categories', 'display_name' => 'Xem danh sách nhóm menu', 'guard_name' => 'web'],
            ['name' => 'create_menu_categories', 'display_name' => 'Thêm mới nhóm menu', 'guard_name' => 'web'],
            ['name' => 'edit_menu_categories', 'display_name' => 'Sửa nhóm menu', 'guard_name' => 'web'],
            ['name' => 'delete_menu_categories', 'display_name' => 'Xóa nhóm menu', 'guard_name' => 'web'],

            ['name' => 'view_menu', 'display_name' => 'Xem danh sách menu', 'guard_name' => 'web'],
            ['name' => 'create_menu', 'display_name' => 'Thêm mới menu', 'guard_name' => 'web'],
            ['name' => 'edit_menu', 'display_name' => 'Sửa menu', 'guard_name' => 'web'],
            ['name' => 'delete_menu', 'display_name' => 'Xóa menu', 'guard_name' => 'web'],

            ['name' => 'view_setting', 'display_name' => 'Xem danh sách cài đặt', 'guard_name' => 'web'],
            ['name' => 'create_setting', 'display_name' => 'Thêm mới cài đặt', 'guard_name' => 'web'],
            ['name' => 'edit_setting', 'display_name' => 'Sửa cài đặt', 'guard_name' => 'web'],
            ['name' => 'delete_setting', 'display_name' => 'Xóa cài đặt', 'guard_name' => 'web'],

            ['name' => 'view_article_categories', 'display_name' => 'Xem danh mục tin tức', 'guard_name' => 'web'],
            ['name' => 'create_article_categories', 'display_name' => 'Thêm mới danh mục tin tức', 'guard_name' => 'web'],
            ['name' => 'edit_article_categories', 'display_name' => 'Sửa danh mục tin tức', 'guard_name' => 'web'],
            ['name' => 'delete_article_categories', 'display_name' => 'Xóa danh mục tin tức', 'guard_name' => 'web'],

            ['name' => 'view_article', 'display_name' => 'Xem danh sách tin tức', 'guard_name' => 'web'],
            ['name' => 'create_article', 'display_name' => 'Thêm mới tin tức', 'guard_name' => 'web'],
            ['name' => 'edit_article', 'display_name' => 'Sửa tin tức', 'guard_name' => 'web'],
            ['name' => 'delete_article', 'display_name' => 'Xóa tin tức', 'guard_name' => 'web'],

            ['name' => 'view_product_categories', 'display_name' => 'Xem danh mục sản phẩm', 'guard_name' => 'web'],
            ['name' => 'create_product_categories', 'display_name' => 'Thêm mới danh mục sản phẩm', 'guard_name' => 'web'],
            ['name' => 'edit_product_categories', 'display_name' => 'Sửa danh mục sản phẩm', 'guard_name' => 'web'],
            ['name' => 'delete_product_categories', 'display_name' => 'Xóa danh mục sản phẩm', 'guard_name' => 'web'],

            ['name' => 'view_product', 'display_name' => 'Xem danh sách sản phẩm', 'guard_name' => 'web'],
            ['name' => 'create_product', 'display_name' => 'Thêm mới sản phẩm', 'guard_name' => 'web'],
            ['name' => 'edit_product', 'display_name' => 'Sửa sản phẩm', 'guard_name' => 'web'],
            ['name' => 'delete_product', 'display_name' => 'Xóa sản phẩm', 'guard_name' => 'web'],

            ['name' => 'view_product_orders', 'display_name' => 'Xem danh sách đặt hàng', 'guard_name' => 'web'],
            ['name' => 'create_product_orders', 'display_name' => 'Thêm mới đặt hàng', 'guard_name' => 'web'],
            ['name' => 'edit_product_orders', 'display_name' => 'Sửa đặt hàng', 'guard_name' => 'web'],
            ['name' => 'delete_product_orders', 'display_name' => 'Xóa đặt hàng', 'guard_name' => 'web'],

            ['name' => 'view_page', 'display_name' => 'Xem danh sách pages', 'guard_name' => 'web'],
            ['name' => 'create_page', 'display_name' => 'Thêm mới pages', 'guard_name' => 'web'],
            ['name' => 'edit_page', 'display_name' => 'Sửa pages', 'guard_name' => 'web'],
            ['name' => 'delete_page', 'display_name' => 'Xóa pages', 'guard_name' => 'web'],

            ['name' => 'view_slider', 'display_name' => 'Xem danh sách slide', 'guard_name' => 'web'],
            ['name' => 'create_slider', 'display_name' => 'Thêm mới slide', 'guard_name' => 'web'],
            ['name' => 'edit_slider', 'display_name' => 'Sửa slide', 'guard_name' => 'web'],
            ['name' => 'delete_slider', 'display_name' => 'Xóa slide', 'guard_name' => 'web'],

            ['name' => 'view_product_contact', 'display_name' => 'Xem danh sách nhận báo giá', 'guard_name' => 'web'],
            ['name' => 'create_product_contact', 'display_name' => 'Thêm mới nhận báo giá', 'guard_name' => 'web'],
            ['name' => 'edit_product_contact', 'display_name' => 'Sửa nhận báo giá', 'guard_name' => 'web'],
            ['name' => 'delete_product_contact', 'display_name' => 'Xóa nhận báo giá', 'guard_name' => 'web'],

            ['name' => 'view_banner', 'display_name' => 'Xem danh sách banner', 'guard_name' => 'web'],
            ['name' => 'create_banner', 'display_name' => 'Thêm mới banner', 'guard_name' => 'web'],
            ['name' => 'edit_banner', 'display_name' => 'Sửa banner', 'guard_name' => 'web'],
            ['name' => 'delete_banner', 'display_name' => 'Xóa banner', 'guard_name' => 'web'],

            ['name' => 'view_student', 'display_name' => 'Xem danh sách khách hàng', 'guard_name' => 'web'],
            ['name' => 'create_student', 'display_name' => 'Thêm mới khách hàng', 'guard_name' => 'web'],
            ['name' => 'edit_student', 'display_name' => 'Sửa khách hàng', 'guard_name' => 'web'],
            ['name' => 'delete_student', 'display_name' => 'Xóa khách hàng', 'guard_name' => 'web'],

            ['name' => 'view_partner', 'display_name' => 'Xem danh sách đối tác', 'guard_name' => 'web'],
            ['name' => 'create_partner', 'display_name' => 'Thêm mới đối tác', 'guard_name' => 'web'],
            ['name' => 'edit_partner', 'display_name' => 'Sửa đối tác', 'guard_name' => 'web'],
            ['name' => 'delete_partner', 'display_name' => 'Xóa đối tác', 'guard_name' => 'web'],

        ];
    }
}
