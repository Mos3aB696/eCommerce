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

  // Navbar Phrases
  'HOME_ADMIN' => 'Admin',
  'SECTIONS' => 'Sections',
  'ITEMS' => 'Items',
  'MEMBERS' => 'Members',
  'STATISTICS' => 'Statistics',
  'LOGS' => 'Logs',
  'EDIT_PROFILE' => 'Edit Profile',
  'SETTINGS' => 'Settings',
  'LOGOUT' => 'Logout',

  // Dashboard Phrases
  'DASHBOARD_TITLE' => 'Dashboard',
  'TOTLE_MEMBERS' => 'Total Members',
  'PENDING_MEMBERS' => 'Pending Members',
  'TOTLE_ITEMS' => 'Total Items',
  'TOTLE_COMMENTS' => 'Total Comments',
  'LATEST_MEMBERS' => 'Latest Members',
  'LATEST_ITEMS' => 'Latest Items',

  // Edit Page Phrases
  'EDIT_MEMBER' => 'Edit Member',
  'EDIT_USER' => 'Username',
  'EDIT_PASS' => 'Password',
  'PASS_MESSAGE' => 'Leave It Empty If You Don\'t Want To Change The Password',
  'EDIT_EMAIL' => 'Email',
  'EDIT_FULL_NAME' => 'Full Name',
  'EDIT_BTN' => 'Edit',
  'UPDATE_BTN' => 'Update',
  'DELETE_BTN' => 'Delete',

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
  'UPDATE_REDIRECT' => 'You Will Be Redirected To Members Page After 5 Seconds.',

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
  'INSERT_SUCCESS_MESSAGE' => 'Inserted Successfully',
  'USER_EXIST' => 'This Username Is Already Exist',
  'INSERT_PAGE_WARNING' => 'You Can\'t Access This Page Directly',

  // Manage Members Phrases
  'MANAGE_MEMBERS' => 'Manage Members',
  'ID_MANAGE' => 'ID',
  'USERNAME_MANAGE' => 'Username',
  'EMAIL_MANAGE' => 'Email',
  'FULLNAME_MANAGE' => 'Full Name',
  'DATE_MANAGE' => 'Registered Date',
  'CONTROL_MANAGE' => 'Control',
  'ACTIVATE_MEMBER_CONFIRMATION' => 'Are You Sure You Want To Activate This Member?',
  'ACTIVATE_BTN' => 'Activate',

  // Delete Member Phrases
  'DELETE_MEMBER' => 'Delete Member',
  'DELETE_MEMBER_CONFIRMATION' => 'Are You Sure You Want To Delete This Member?',
  'DELETE_MEMBER_SUCCESS' => 'Deleted Successfully',
  'DELETE_MEMBER_FAIL' => 'Member Not Deleted Successfully',

  // Activate Member Phrases
  'ACTIVATE_MEMBER' => 'Activate Member',
  'ACTIVATE_MEMBER_SUCCESS' => 'Activated Successfully',

  // Warning Phrases
  'ID_NOT_FOUND_WARNING' => 'This UserID is not found',
  'UPDATE_PAGE_WARNING' => 'You can not access this page directly',
  'DASHBOARD_DIRECT_WARNING' => 'You can not access this page directly',
  );

  return $lang[$phrase];

}
