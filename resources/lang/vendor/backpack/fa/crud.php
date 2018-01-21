<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Backpack Crud Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the CRUD interface.
    | You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    // Forms
    'save_action_save_and_new' => 'ذخیره و اضافه کردن آیتم جدید',
    'save_action_save_and_edit' => 'ذخیره و ادیت آیتم',
    'save_action_save_and_back' => 'ذخیره و بازگشت',
    'save_action_changed_notification' => 'رفتار پیشفرض پس از ذخیره تغییر کرد',

    // Create form
    'add'                 => 'اضافه کردن',
    'back_to_all'         => 'بازگشت به همه ',
    'cancel'              => 'کنسل',
    'add_a_new'           => 'اضافه کردن  ',

    // Edit form
    'edit'                 => 'ویرایش',
    'add_employee'                 => 'افزودن ',
    'save'                 => 'ذخیره',

    // Revisions
    'revisions'            => 'اصلاحات',
    'no_revisions'         => 'اصلاحی یافت نشد',
    'created_this'         => 'این را ایجاد کرد',
    'changed_the'          => 'این را تغییر داد',
    'restore_this_value'   => 'بازیابی این مقدار',
    'from'                 => 'از',
    'to'                   => 'به',
    'undo'                 => 'لغو',
    'revision_restored'    => 'اصلاحات با موفقیت بازیابی شد',
    'guest_user'           => 'کاربر مهمان',

    // Translatable models
    'edit_translations' => 'ادیت تراکنش',
    'language'          => 'زبان',

    // CRUD table view
    'all'                       => 'همه ',
    'in_the_database'           => 'در سیستم',
    'list'                      => 'لیست',
    'actions'                   => 'عملیات ها',
    'preview'                   => 'بازبینی',
    'delete'                    => 'حذف',
    'admin'                     => 'مدیر',
    'details_row'               => 'این توضیحات جزعی می باشد',
    'details_row_loading_error' => 'در لود اطلاعات خطایی رخ داده . دوباره تلاش کنید',

    // Confirmation messages and bubbles
    'delete_confirm'                              => 'آیا از حذف این آیتم اطمینان دارید؟',
    'delete_confirmation_title'                   => 'آیتم حذف شد',
    'delete_confirmation_message'                 => 'آیتم با موفقیت حذف شد.',
    'delete_confirmation_not_title'               => 'حذف نشد',
    'delete_confirmation_not_message'             => "خطایی رخ داده . مورد حذف نشد!",
    'delete_confirmation_not_deleted_title'       => 'حذف نشد!',
    'delete_confirmation_not_deleted_message'     => 'هیچ اتفاقی نیفتاد . آیتم جاری امن است!',

    'ajax_error_title' => 'خطا',
    'ajax_error_text'  => 'در لود صفحه خطایی رخ داده . مجدد سعی کنید',

    // DataTables translation
    'emptyTable'     => 'هیچ دیتایی در جدول وجود ندارد',
    'info'           => 'نمایش _START_ تا _END_ از _TOTAL_ صفحه',
    'infoEmpty'      => 'نمایش 0 تا 0 از 0 صفحه',
    'infoFiltered'   => '(فیلتر شده از _MAX_ جمعا صفحه)',
    'infoPostFix'    => '',
    'thousands'      => ',',
    'lengthMenu'     => '_MENU_ رکورد در هر صفحه',
    'loadingRecords' => 'لودینگ...',
    'processing'     => 'در حال پردازش...',
    'search'         => 'جستجو: ',
    'zeroRecords'    => 'هیچ رکوردی یافت نشد',
    'paginate'       => [
        'first'    => 'ابتدا',
        'last'     => 'آخر',
        'next'     => 'بعدی',
        'previous' => 'قبلی',
    ],
    'aria' => [
        'sortAscending'  => ': فعال سازی مرتب سازی صعودی',
        'sortDescending' => ': فعال سازی مرتب سازی صعودی',
    ],
    'export' => [
        'copy'              => 'کپی',
        'excel'             => 'Excel',
        'csv'               => 'CSV',
        'pdf'               => 'PDF',
        'print'             => 'پرینت',
        'column_visibility' => 'دید ستونی',
    ],

    // global crud - errors
    'unauthorized_access' => 'دسترسی غیر مجاز: شما دسترسی های مجاز برای مشاهده این صفحه را دارا نمی باشید',
    'please_fix' => 'لطفا خطاهای زیر را برطرف کنید:',

    // global crud - success / error notification bubbles
    'insert_success' => 'آیتم با موفقیت اضافه شد.',
    'update_success' => 'آیتم با موفقیت تغییر یافت.',

    // CRUD reorder view
    'reorder'                      => 'تنظیم مجدد',
    'reorder_text'                 => 'Use drag&drop to reorder.',
    'reorder_success_title'        => 'انجام شد',
    'reorder_success_message'      => 'درخواست شما ذخیره شد.',
    'reorder_error_title'          => 'خطا',
    'reorder_error_message'        => 'در خواست شما ذخیره نشد.',

    // CRUD yes/no
    'yes' => 'بله',
    'no' => 'خیر',

    // CRUD filters navbar view
    'filters' => 'فیلترها',
    'toggle_filters' => 'تغییر فیلتر',
    'remove_filters' => 'حذف فیلتر',

    // Fields
    'browse_uploads' => 'Browse uploads',
    'clear' => 'پاک سازی',
    'page_link' => 'لینک صفحه',
    'page_link_placeholder' => 'http://example.com/your-desired-page',
    'internal_link' => 'لینک داخلی',
    'internal_link_placeholder' => 'Internal slug. Ex: \'admin/page\' (no quotes) for \':url\'',
    'external_link' => 'لینک خارجی',
    'choose_file' => 'انتخاب فایل',

    //Table field
    'table_cant_add' => 'Cannot add new :entity',
    'table_max_reached' => 'Maximum number of :max reached',

    // File manager
    'file_manager' => 'مدیریت فایل',
];
