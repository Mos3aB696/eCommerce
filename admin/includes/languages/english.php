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
  'CATEGORIES' => 'Categories',
  'ITEMS' => 'Items',
  'MEMBERS' => 'Members',
  'COMMENTS' => 'Comments',
  'STATISTICS' => 'Statistics',
  'LOGS' => 'Logs',
  'EDIT_PROFILE' => 'Edit Profile',
  'SETTINGS' => 'Settings',
  'LOGOUT' => 'Logout',

  /* Start Dashboard Phrases */
  'DASHBOARD_TITLE' => 'Dashboard',
  'TOTLE_MEMBERS' => 'Total Members',
  'PENDING_MEMBERS' => 'Pending Members',
  'TOTLE_ITEMS' => 'Total Items',
  'TOTLE_COMMENTS' => 'Total Comments',
  'LATEST_MEMBERS' => 'Latest Members',
  'LATEST_ITEMS' => 'Latest Items',
  'LATEST_COMMENTS' => 'Latest Comments',
  /* End Dashboard Phrases */

  /* Start Members Phrases */
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
  'ADD_MEMBER_BTN' => 'Add Member',
  // Adding Placeholders Phrases
  'ADD_USER_PLACEHOLDER' => 'Username Must Be Unique',
  'ADD_PASS_PLACEHOLDER' => 'Password Must Be Hard & Complex',
  'ADD_EMAIL_PLACEHOLDER' => 'Email Must Be Valid',
  'ADD_FULL_PLACEHOLDER' => 'Full Name Must Be Real',

  // Inserting Phrases
  'INSERT_MEMBER' => 'Insert Member',
  'INSERT_SUCCESS_MESSAGE' => 'Inserted Successfully',
  'USER_EXIST' => 'This Username Is Already Exist',

  // Manage Members Phrases
  'MANAGE_MEMBERS' => 'Manage Members',
  'ID_MANAGE' => 'ID',
  'USERNAME_MANAGE' => 'Username',
  'EMAIL_MANAGE' => 'Email',
  'FULLNAME_MANAGE' => 'Full Name',
  'DATE_MANAGE' => 'Registered',
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
  /* End Members Phrases */

  /* Start Categories Phrases */

  'CATEGORIES_TITLE' => 'Categories',

  // Manage Categories Phrases
  'MANAGE_CAT' => 'Manage Categories',
  'MANAGE_CAT_ID' => 'ID',
  'MANAGE_CAT_NAME' => 'Name',
  'MANAGE_CAT_DESC' => 'Description',
  'MANAGE_CAT_ORDER' => 'Order',
  'MANAGE_CAT_VISABLE' => 'Visable',
  'MANAGE_CAT_COMMENT' => 'Comment',
  'MANAGE_CAT_ADS' => 'Ads',
  'MANAGE_CONTROL_CAT' => 'Control',
  'ADD_CATEGORY' => 'Add Category',
  'SORT_ASC' => 'Ascending',
  'SORT_DESC' => 'Descending',
  'SORT_BTN' => 'Sort',

  // Add Categories Phrases
  'ADD_CAT_PAGE' => 'Add Category',
  'CAT_NAME' => 'Category Name',
  'CAT_NAME_PLACEHOLDER' => 'Category Name Must Be Unique',
  'CAT_DESCRIPTION' => 'Category Description',
  'CAT_DESC_PLACEHOLDER' => 'Category Description Must Be Real',
  'CAT_ORDER' => 'Category Order',
  'CAT_ORDER_PLACEHOLDER' => 'Category Order Must Be A Number',
  'CAT_VISABLE' => 'Category Visable',
  'VIS_YES' => 'Yes',
  'VIS_NO' => 'No',
  'CAT_COMMENT' => 'Category Comment',
  'COM_YES' => 'Yes',
  'COM_NO' => 'No',
  'CAT_ADS' => 'Category Ads',
  'ADS_YES' => 'Yes',
  'ADS_NO' => 'No',
  'ADD_CAT_BTN' => 'Add Category',

  // Insert Category Phrases
  'INSERT_CAT' => 'Insert Category',
  'INSERT_CAT_SUCCESS' => 'Category Inserted Successfully',
  'CAT_EXISTS' => 'This Category Is Already Exist',
  'VISIBILITY_ON' => 'Visable',
  'VISIBILITY_OFF' => 'Hidden',
  'COMMENT_ON' => 'Allow',
  'COMMENT_OFF' => 'Disallow',
  'ADS_ON' => 'Allow',
  'ADS_OFF' => 'Disallow',
  'NO_ORDER' => 'Unset',

  // Edit Categories Phrases
  'EDIT_CAT' => 'Edit Category',

  // Update Categories Phrases
  'UPDATE_CAT_PAGE' => 'Update Category',
  'CAT_NAME_EMPTY' => 'Category Name Can\'t Be Empty',
  'CAT_NAME_LESS' => 'Category Name Can\'t Be Less Than 4 Characters',
  'CAT_NAME_MORE' => 'Category Name Can\'t Be More Than 30 Characters',
  'CAT_DESC_EMPTY' => 'Category Description Can\'t Be Empty',
  'UPDATE_CAT_NAME' => 'Category Name Updated Successfully',
  'UPDATE_CAT_DESC' => 'Category Description Updated Successfully',
  'UPDATE_CAT_ORDER' => 'Category Order Updated Successfully',
  'UPDATE_CAT_VISIBILITY' => 'Category Visibility Updated Successfully',
  'UPDATE_CAT_COMMENT' => 'Category Comment Updated Successfully',
  'UPDATE_CAT_ADS' => 'Category Ads Updated Successfully',

  // Delete Categories Phrases
  'DELETE_CAT' => 'Delete Category',
  'DELETE_CAT_CONFIRMATION' => 'Are You Sure You Want To Delete This Category?',
  'DELETE_CAT_SUCCESS' => 'Category Deleted Successfully',

  /* End Categories Phrases */

  /* Start Items Phrases */

  'ITEMS_TITLE' => 'Items',

  // Manage Items Phrases
  'MANAGE_ITEMS' => 'Manage Items',
  'ITEM_ID' => 'ID',
  'MANAGE_ITEM_NAME' => 'Name',
  'MANAGE_ITEM_DESC' => 'Description',
  'MANAGE_ITEM_PRICE' => 'Price',
  'MANAGE_ITEM_COUNTRY' => 'Country',
  'MANAGE_ITEM_STATUS' => 'Status',
  'MANAGE_ITEM_CAT' => 'Category',
  'MANAGE_ITEM_MEMBER' => 'Member',
  'MANAGE_ITEM_DATE' => 'Registered',
  'MANAGE_ITEM_CONTROL' => 'Control',
  'ADD_ITEM' => 'Add Item',
  // Add Items Phrases 
  'ADD_ITEMS_PAGE' => 'Add Item',
  'ITEM_NAME' => 'Item Name',
  'ITEM_NAME_PLACEHOLDER' => 'Item Name Must Be Specific',
  'ITEM_DESCRIPTION' => 'Item Description',
  'ITEM_DESC_PLACEHOLDER' => 'Describe Your Item',
  'ITEM_PRICE' => 'Item Price',
  'ITEM_PRICE_PLACEHOLDER' => 'Enter Your Item Price',
  'ITEM_COUNTRY' => 'Item Country',
  'ITEM_COUNTRY_PLACEHOLDER' => 'Item Made In',
  'ITEM_STATUS' => 'Item Status',
  'NEW_OPT' => 'New',
  'LIKE_NEW_OPT' => 'Like New',
  'USED_OPT' => 'Used',
  'OLD_OPT' => 'Old',
  'CHOOSE_MEMBER' => 'Choose Member',
  'CHOOSE_CATEGORY' => 'Choose Category',

  // Insert Items Phrases
  'INSERT_ITEM' => 'Insert Item',
  'MEMBER_EMPTY' => 'Member Can\'t Be Empty',
  'CATEGORY_EMPTY' => 'Category Can\'t Be Empty',
  'ITEM_NAME_EMPTY' => 'Item Name Can\'t Be Empty',
  'ITEM_NAME_LESS' => 'Item Name Can\'t Be Less Than 4 Characters',
  'ITEM_NAME_MORE' => 'Item Name Can\'t Be More Than 30 Characters',
  'ITEM_DESC_EMPTY' => 'Item Description Can\'t Be Empty',
  'ITEM_PRICE_EMPTY' => 'Item Price Can\'t Be Empty',
  'ITEM_COUNTRY_EMPTY' => 'Item Country Can\'t Be Empty',
  'ITEM_STATUS_EMPTY' => 'Choose Your Item Status',
  'INSERT_ITEM_SUCCESS' => 'Item Inserted Successfully',

  // Edit Items Phrases
  'EDIT_ITEM' => 'Edit Item',

  // Update Items Phrases
  'UPDATE_ITEM' => 'Update Item',
  'UPDATE_ITEM_NAME_SUCCESS' => 'Item Name Updated Successfully',
  'UPDATE_DESCRIPTION_SUCCESS' => 'Item Description Updated Successfully',
  'UPDATE_PRICE_SUCCESS' => 'Item Price Updated Successfully',
  'UPDATE_COUNTRY_SUCCESS' => 'Item Country Updated Successfully',
  'UPDATE_STATUS_SUCCESS' => 'Item Status Updated Successfully',
  'UPDATE_MEMBER_SUCCESS' => 'Item Member Updated Successfully',
  'UPDATE_CATEGORY_SUCCESS' => 'Item Category Updated Successfully',

  // Delete Items Phrases
  'DELETE_ITEM' => 'Delete Item',
  'DELETE_ITEM_CONFIRMATION' => 'Are You Sure You Want To Delete This Item?',
  'DELETE_ITEM_SUCCESS' => 'Deleted Successfully',

  // Approve Items Phrases
  'APPROVE_MEMBER_CONFIRMATION' => 'Are You Sure You Want To Approve This Item?',
  'APPROVE_BTN' => 'Approve',
  'APPROVE_ITEM' => 'Approve Item',
  'APPROVE_ITEM_SUCCESS' => 'Item Approved Successfully',

  /* End Items Phrases */

  /* Start Comments Phrases */
  // Manage Comments Phrases
  'MANAGE_COMMENTS' => 'Manage Comments',
  'COMMENT_ID_MANAGE' => 'ID',
  'COMMENT_CONTENT_MANAGE' => 'Comment',
  'COMMENT_ITEM_MANAGE' => 'Item',
  'COMMENT_USER_MANAGE' => 'Member',
  'COMMENT_DATE_MANAGE' => 'Registered',
  'COMMENT_CONTROL_MANAGE' => 'Control',

  // Edit Comments Phrases
  'EDIT_COMMENTS' => 'Edit Comment',
  'EDIT_COMMENT' => 'Comment',
  'EDIT_COMMENT_PLACDHODER' => 'Edit Your Comment',

  // Update Comments Phrases
  'UPDATE_COMMENT' => 'Update Comment',
  'COMMENT_CONTENT_EMPTY' => 'Comment Can\'t Be Empty',
  'UPDATE_COMMENT_SUCCESS' => 'Comment Updated Successfully',
  'COMMENT_UPDATE_ITEM_SUCCESS' => 'Item Updated Successfully',
  'COMMENT_UPDATE_MEMBER_SUCCESS' => 'Member Updated Successfully',

  // Delete Comments Phrases
  'DELETE_COMMENT' => 'Delete Comment',
  'DELETE_COMMENT_CONFIRMATION' => 'Are You Sure You Want To Delete This Comment?',
  'DELETE_COMMENT_SUCCESS' => 'Comment Deleted Successfully',

  // Approve Comments Phrases
  'ACTIVATE_MEMBER_COMMENT_SUCCESS' => 'Comment Approved Successfully',

  /* End Comments Phrases */

  // Warning Phrases
  'DIRECT_LINK' => 'You can not access this page directly',
  'ID_NOT_FOUND_WARNING' => 'This ID Is Not Found',
  );

  return $lang[$phrase];

}
