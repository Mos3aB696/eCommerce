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
  // Dashboard Phrases

  'HOME_ADMIN' => 'لوحه التحكم',
  'SECTIONS' => 'الاقسام',
  'ITEMS' => 'المنتجات',
  'MEMBERS' => 'الاعضاء',
  'STATISTICS' => 'الاحصائيات',
  'LOGS' => 'السجلات',
  'EDIT_PROFILE' => 'تعديل البروفايل',
  'SETTINGS' => 'الاعدادات',
  'LOGOUT' => 'تسجيل الخروج',

  // Edit Page Phrases
  'EDIT_MEMBER' => 'تعديل العضو',
  'EDIT_USER' => 'اسم المستخدم',
  'PASS_MESSAGE' => 'اتركه فارغا اذا لم ترغب في تغيير كلمه المرور',
  'EDIT_PASS' => 'كلمه المرور',
  'EDIT_EMAIL' => 'البريد الالكتروني',
  'EDIT_FULL_NAME' => 'الاسم الكامل',
  'EDIT_BTN' => 'تحديث',

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

  // Add Members Phrases
  'ADD_MEMBER' => 'اضافه عضو',
  'ADD_USER' => 'اسم المستخدم',
  'ADD_PASS' => 'كلمه المرور',
  'ADD_EMAIL' => 'البريد الالكتروني',
  'ADD_FULL_NAME' => 'الاسم الكامل',
  'ADD_BTN' => 'اضافه عضو',
  // Adding Placeholders Phrases
  'ADD_USER_PLACEHOLDER' => 'اسم المستخدم يجب ان يكون فريد',
  'ADD_PASS_PLACEHOLDER' => 'كلمه المرور يجب ان تكون صعبه ومعقده',
  'ADD_EMAIL_PLACEHOLDER' => 'البريد الالكتروني يجب ان يكون صحيح',
  'ADD_FULL_PLACEHOLDER' => 'الاسم الكامل يجب ان يكون باللغه العربيه',


  // Warning Phrases
  'ID_NOT_FOUND_WARNING' => 'هذا المستخدم غير موجود, جاري التحويل...',
  'UPDATE_PAGE_WARNING' => 'هذه الصفحه غير موجوده, جاري التحويل...',
  'DASHBOARD_DIRECT_WARNING' => 'لا يمكنك الوصول الى هذه الصفحه مباشره, جاري التحويل...',

  );

  return $lang[$phrase];
}
