<?php

function lang($phrase)
{

  static $lang = array(

  // Page Title Phrases
  'DEFAULT_TITLE' => 'لوحه التحكم',
  'TITLE_LOGIN' => 'تسجيل الدخول',
  'TITLE_DASHBOARD' => 'لوحه التحكم',
  // Login Page Phrases

  'ADMIN_LOGIN' => 'تسجيل الدخول للوحه التحكم',
  'ADMIN_USER' => 'اسم المستخدم',
  'ADMIN_PASS' => 'كلمه المرور',
  'LOG_BTN' => 'تسجيل الدخول',

  // Navbar Phrases
  'HOME_ADMIN' => 'لوحه التحكم',
  'CATEGORIES' => 'الاقسام',
  'ITEMS' => 'المنتجات',
  'MEMBERS' => 'الاعضاء',
  'STATISTICS' => 'الاحصائيات',
  'LOGS' => 'السجلات',
  'EDIT_PROFILE' => 'تعديل البروفايل',
  'SETTINGS' => 'الاعدادات',
  'LOGOUT' => 'تسجيل الخروج',


  // Start Dashboard Phrases
  'DASHBOARD_TITLE' => 'لوحه التحكم',
  'TOTLE_MEMBERS' => 'اجمالي الاعضاء',
  'PENDING_MEMBERS' => 'الاعضاء المعلقين',
  'TOTLE_ITEMS' => 'اجمالي المنتجات',
  'TOTLE_COMMENTS' => 'اجمالي التعليقات',
  'LATEST_MEMBERS' => 'اخر الاعضاء',
  'LATEST_ITEMS' => 'اخر المنتجات',
  // End Dashboard Phrases

  // Start Members Phrases
  // Edit Page Phrases
  'EDIT_MEMBER' => 'تعديل العضو',
  'EDIT_USER' => 'اسم المستخدم',
  'PASS_MESSAGE' => 'اتركه فارغا اذا لم ترغب في تغيير كلمه المرور',
  'EDIT_PASS' => 'كلمه المرور',
  'EDIT_EMAIL' => 'البريد الالكتروني',
  'EDIT_FULL_NAME' => 'الاسم الكامل',
  'EDIT_BTN' => 'تعديل',
  'UPDATE_BTN' => 'تحديث',
  'DELETE_BTN' => 'حذف',

  // Validation Phrases [Errors]
  'USERNAME_EMPTY' => 'اسم المستخدم لا يمكن ان يكون فارغ',
  'USERNAME_LESS' => 'اسم المستخدم لا يمكن ان يكون اقل من 4 احرف',
  'USERNAME_MORE' => 'اسم المستخدم لا يمكن ان يكون اكثر من 20 حرف',
  'PASSWORD_EMPTY' => 'كلمه المرور لا يمكن ان تكون فارغه',
  'FULLNAME_EMPTY' => 'الاسم الكامل لا يمكن ان يكون فارغ',
  'EMAIL_EMPTY' => 'البريد الالكتروني لا يمكن ان يكون فارغ',
  // Updating Phrases [Success]
  'UPDATE_MEMBER' => 'تحديث العضو',
  'UPDATE_USERNAME_SUCCESS' => 'تم تحديث اسم المستخدم بنجاح',
  'UPDATE_PASS_SUCCESS' => 'تم تحديث كلمه المرور بنجاح',
  'UPDATE_EMAIL_SUCCESS' => 'تم تحديث البريد الالكتروني بنجاح',
  'UPDATE_FULLNAME_SUCCESS' => 'تم تحديث الاسم الكامل بنجاح',
  'UPDATE_REDIRECT' => 'سوف يتم تحويلك الى صفحه الاعضاء بعد 5 ثواني.',

  // Add Members Phrases
  'ADD_MEMBER' => 'اضافه عضو',
  'ADD_USER' => 'اسم المستخدم',
  'ADD_PASS' => 'كلمه المرور',
  'ADD_EMAIL' => 'البريد الالكتروني',
  'ADD_FULL_NAME' => 'الاسم الكامل',
  'ADD_MEMBER_BTN' => 'اضافه عضو',
  // Adding Placeholders Phrases
  'ADD_USER_PLACEHOLDER' => 'اسم المستخدم يجب ان يكون فريد',
  'ADD_PASS_PLACEHOLDER' => 'كلمه المرور يجب ان تكون صعبه ومعقده',
  'ADD_EMAIL_PLACEHOLDER' => 'البريد الالكتروني يجب ان يكون صحيح',
  'ADD_FULL_PLACEHOLDER' => 'الاسم الكامل يجب ان يكون باللغه العربيه',

  // Inserting Phrases 
  'INSERT_MEMBER' => 'اضافه عضو',
  'INSERT_SUCCESS_MESSAGE' => 'تم اضافه العضو بنجاح',
  'USER_EXIST' => 'اسم المستخدم موجود بالفعل',
  // Manage Members Phrases
  'MANAGE_MEMBERS' => 'اداره الاعضاء',
  'ID_MANAGE' => 'الرقم التعريفي',
  'USERNAME_MANAGE' => 'اسم المستخدم',
  'EMAIL_MANAGE' => 'البريد الالكتروني',
  'FULLNAME_MANAGE' => 'الاسم الكامل',
  'DATE_MANAGE' => 'تاريخ الاضافه',
  'CONTROL_MANAGE' => 'التحكم',
  'ACTIVATE_MEMBER_CONFIRMATION' => 'هل  انت متاكد  من تفعيل هذا العضو؟',
  'ACTIVATE_BTN' => 'تفعيل',

  // Delete Member Phrases
  'DELETE_MEMBER' => 'حذف العضو',
  'DELETE_MEMBER_CONFIRMATION' => 'هل  انت متاكد  من    حذف هذا العضو؟',
  'DELETE_MEMBER_SUCCESS' => 'تم حذف العضو بنجاح',
  'DELETE_MEMBER_FAIL' => 'فشل حذف العضو',

  // Activate Member Phrases
  'ACTIVATE_MEMBER' => 'تفعيل العضو',
  'ACTIVATE_MEMBER_SUCCESS' => 'تم تفعيل العضو بنجاح',

  // End Members Phrases

  // Start Categories Phrases

  // Manage Categories Phrases
  'MANAGE_CAT' => 'اداره الاقسام',
  'MANAGE_CAT_ID' => 'الرقم التعريفي',
  'MANAGE_CAT_NAME' => 'الاسم',
  'MANAGE_CAT_DESC' => 'الوصف',
  'MANAGE_CAT_ORDER' => 'الترتيب',
  'MANAGE_CAT_VISABLE' => 'الظهور',
  'MANAGE_CAT_COMMENT' => 'التعليقات',
  'MANAGE_CAT_ADS' => 'الاعلانات',
  'MANAGE_CONTROL_CAT' => 'التحكم',
  'ADD_CATEGORY' => 'اضافه قسم',

  // Add Page Phrases
  'ADD_CAT_PAGE' => 'اضافه قسم جديد',
  'CAT_NAME' => 'اسم القسم',
  'CAT_NAME_PLACEHOLDER' => 'اسم القسم يجب ان يكون فريد',
  'CAT_DESCRIPTION' => 'وصف القسم',
  'CAT_DESC_PLACEHOLDER' => 'وصف القسم يجب ان يكون حقيقي',
  'CAT_ORDER' => 'ترتيب القسم',
  'CAT_ORDER_PLACEHOLDER' => 'ترتيب القسم يجب ان يكون رقم',
  'CAT_VISABLE' => 'ظهور القسم',
  'VIS_YES' => 'نعم',
  'VIS_NO' => 'لا',
  'CAT_COMMENT' => 'التعليقات',
  'COM_YES' => 'نعم',
  'COM_NO' => 'لا',
  'CAT_ADS' => 'الاعلانات',
  'ADS_YES' => 'نعم',
  'ADS_NO' => 'لا',
  'ADD_CAT_BTN' => 'اضافه قسم',

  // Insert Category Phrases
  'INSERT_CAT' => 'اضافه قسم',
  'INSERT_CAT_SUCCESS' => 'تم اضافه القسم بنجاح',
  'CAT_EXISTS' => 'هذا القسم موجود بالفعل',
  'VISIBILITY_ON' => 'ظاهر',
  'VISIBILITY_OFF' => 'مخفي',
  'COMMENT_ON' => 'مفتوح',
  'COMMENT_OFF' => 'مغلق',
  'ADS_ON' => 'مفتوح',
  'ADS_OFF' => 'مغلق',
  'NO_ORDER' => 'غير محدد',

  // Edit Category Phrases
  'EDIT_CAT' => 'تعديل القسم',

  // Update Category Phrases
  'UPDATE_CAT_PAGE' => 'تحديث القسم',
  'CAT_NAME_EMPTY' => 'اسم القسم لا يمكن ان يكون فارغ',
  'CAT_NAME_LESS' => 'اسم القسم لا يمكن ان يكون اقل من 4 احرف',
  'CAT_NAME_MORE' => 'اسم القسم لا يمكن ان يكون اكثر من 30 حرف',
  'CAT_DESC_EMPTY' => 'وصف القسم لا يمكن ان يكون فارغ',
  'UPDATE_CAT_NAME' => 'تم تحديث اسم القسم بنجاح',
  'UPDATE_CAT_DESC' => 'تم تحديث وصف القسم بنجاح',
  'UPDATE_CAT_ORDER' => 'تم تحديث ترتيب القسم بنجاح',
  'UPDATE_CAT_VISIBILITY' => 'تم تحديث ظهور القسم بنجاح',
  'UPDATE_CAT_COMMENT' => 'تم تحديث التعليقات بنجاح',
  'UPDATE_CAT_ADS' => 'تم تحديث الاعلانات بنجاح',

  // Delete Category Phrases
  'DELETE_CAT' => 'حذف القسم',
  'DELETE_CAT_CONFIRMATION' => 'هل  انت متاكد  من    حذف هذا القسم؟',
  'DELETE_CAT_SUCCESS' => 'تم حذف القسم بنجاح',

  // End Categories Phrases
  // Warning Phrases
  'ID_NOT_FOUND_WARNING' => 'هذا المستخدم غير موجود',
  'DIRECT_LINK' => 'لا يمكنك الوصول الى هذه الصفحه مباشره',
  );

  return $lang[$phrase];
}
