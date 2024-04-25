<?php
$do = (isset($_GET['do']) ? $_GET['do'] : 'Manage');

if ($do == 'Manage'):
  echo 'Welcome You are in Manage Page ';
  echo '<a href="?action=edit">Add New +</a>';
elseif ($do == 'Add'):
  echo 'Welcome You are in Add Page';
elseif ($do == 'Edit'):
  echo 'Welcome You are in Edit Page';
elseif ($do == 'Delete'):
  echo 'Welcome You are in Delete Page';
else:
  echo 'Error 404 Not Found Page';
endif;