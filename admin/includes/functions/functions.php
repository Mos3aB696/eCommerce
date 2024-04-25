<?php

/**
 * getTile Function => Get Page Title From $pageTitle Variable
 * If $pageTitle Is Set Echo $pageTitle
 * Else Echo Default Title
 */

function getTitle()
{
  global $pageTitle;
  if (isset($pageTitle)) {
    echo $pageTitle;
  } else {
    echo 'Admin';
  }
}