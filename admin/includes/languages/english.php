<?php

function lang($phrase)
{

  static $lang = array(
  // Page Title Phrases
  // 'DEFAULT_TITLE' => 'Admin Panel',
  // 'TITLE_LOGIN' => 'Login',
  // 'TITLE_DASHBOARD' => 'Dashboard',

  // Login Page Phrases
  'ADMIN_LOGIN' => 'Admin Login',
  'ADMIN_USER' => 'Username',
  'ADMIN_PASS' => 'Password',
  'LOG_BTN' => 'Login',

  // Dashboard Phrases
  'HOME_ADMIN' => 'Admin',
  'SECTIONS' => 'Sections',
  'ITEMS' => 'Items',
  'MEMBERS' => 'Members',
  'STATISTICS' => 'Statistics',
  'LOGS' => 'Logs',
  'EDIT_PROFILE' => 'Edit Profile',
  'SETTINGS' => 'Settings',
  'LOGOUT' => 'Logout',

  // Edit Page Phrases
  'EDIT_MEMBER' => 'Edit Member',
  'EDIT_USER' => 'Username',
  'EDIT_PASS' => 'Password',
  'PASS_MESSAGE' => 'Leave It Empty If You Don\'t Want To Change The Password',
  'EDIT_EMAIL' => 'Email',
  'EDIT_FULL_NAME' => 'Full Name',
  'EDIT_BTN' => 'Update',

  // Validation Phrases [Errors]
  'USERNAME_EMPTY' => 'Username Can\'t Be Empty',
  'USERNAME_LESS' => 'Username Can\'t Be Less Than 4 Characters',
  'USERNAME_MORE' => 'Username Can\'t Be More Than 20 Characters',
  'PASSWORD_EMPTY' => 'Password Can\'t Be Empty',
  'FULLNAME_EMPTY' => 'Full Name Can\'t Be Empty',
  'EMAIL_EMPTY' => 'Email Can\'t Be Empty',
  // Updateing Phrases [Success]
  'UPDATE_MEMBER' => 'Update Member',
  'UPDATE_USERNAME_SUCCESS' => 'Username Updated Successfully',
  'UPDATE_PASS_SUCCESS' => 'Password Updated Successfully',
  'UPDATE_EMAIL_SUCCESS' => 'Email Updated Successfully',
  'UPDATE_FULLNAME_SUCCESS' => 'Full Name Updated Successfully',

  // Add Members Phrases
  'ADD_MEMBER' => 'Add Member',
  'ADD_USER' => 'Username',
  'ADD_PASS' => 'Password',
  'ADD_EMAIL' => 'Email',
  'ADD_FULL_NAME' => 'Full Name',
  'ADD_BTN' => 'Add Member',
  // Adding Placeholders Phrases
  'ADD_USER_PLACEHOLDER' => 'Username Must Be Unique',
  'ADD_PASS_PLACEHOLDER' => 'Password Must Be Hard & Complex',
  'ADD_EMAIL_PLACEHOLDER' => 'Email Must Be Valid',
  'ADD_FULL_PLACEHOLDER' => 'Full Name Must Be Real',

  // Inserting Phrases
  'INSERT_MEMBER' => 'Insert Member',

  // Warning Phrases
  'ID_NOT_FOUND_WARNING' => 'This UserID is not found, Redirecting...',
  'UPDATE_PAGE_WARNING' => 'This page is not found, Redirecting...',
  'DASHBOARD_DIRECT_WARNING' => 'You can not access this page directly, Redirecting...',
  );

  return $lang[$phrase];

}
