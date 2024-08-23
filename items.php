<?php
ob_start();
session_start();
$pageTitle = 'Show Items';
include 'init.php';
global $connect;

// Check If Get Request itemid Is Numeric & Get The Integer Value Of It
$itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;
// Prepare The Statement To Execute It [1]
$stmt = $connect->prepare('SELECT 
                              items.*,
                              categories.cat_name AS cat_name,
                              users.user_name AS username
                            FROM
                              items
                            INNER JOIN
                              categories
                            ON
                              categories.cat_id = items.category_connect
                            INNER JOIN
                              users
                            ON
                              users.user_id = items.user_connect
                            WHERE
                              item_id = ?
                            AND
                              item_approve = 1');
$stmt->execute([$itemid]); // Execute The Statement [2]
$rowCount = $stmt->rowCount(); // Get The Count Of The Rows [4]

// Check If The Item Is Available In The Database
if ($rowCount > 0):
  $item = $stmt->fetch(); // Fetch The Data [3]
?>
  <h1><?= $item['item_name'] ?></h1>
  <div class="container">
    <div class="row">
      <div class="col-md-3">
        <img src="img.png" alt="Item Image" class='mw-100 img-thumbnail item-image'>
      </div>
      <div class="col-md-9 item-info">
        <p class="description">
          <span>
            <?= lang("MANAGE_ITEM_DESC") ?>:
          </span>
          <?= $item['item_description'] ?>
        </p>
        <ul class="list-unstyled">
          <li>
            <span>
              <i class="fa fa-calendar fa-fw"></i>
              <?= lang('MANAGE_ITEM_DATE') ?>
            </span>:
            <?= $item['add_date'] ?>
          </li>
          <li>
            <span>
              <i class="fa fa-money fa-fw"></i>
              <?= lang("MANAGE_ITEM_PRICE") ?>
            </span>:
            $<?= $item['item_price'] ?>
          </li>
          <li>
            <span>
              <i class="fa fa-globe fa-fw"></i>
              <?= lang("MANAGE_ITEM_COUNTRY") ?>
            </span>:
            <?= $item['country_made'] ?>
          </li>
          <li>
            <span>
              <i class="fa fa-tags fa-fw"></i>
              <?= lang('MANAGE_ITEM_CAT') ?>
            </span>:
            <a class="link" href="categories.php?pageid=<?= $item['category_connect'] ?>"><?= $item['cat_name'] ?></a>
          </li>
          <li>
            <span>
              <i class="fa fa-user fa-fw"></i>
              <?= lang('MANAGE_ITEM_MEMBER') ?>
            </span>:
            <a class="link" href="#"><?= $item['username'] ?></a>
          </li>
        </ul>
      </div>
    </div>
    <hr>
    <!-- Start Comment Setion -->
    <?php if (isset($_SESSION['user_name'])): ?>
      <div class="row">
        <div class=" col-md-9 offset-md-3">
          <div class="comment">
            <h3><?= lang("ADD_COMMENT") ?></h3>
            <form action="<?= $_SERVER['PHP_SELF'] . '?itemid=' . $item['item_id'] ?>" method="POST">
              <textarea name="comment" class="form-control  mb-3" required></textarea>
              <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-plus"></i> <?= lang("ADD_COMMENT") ?></button>
            </form>
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST'):
              $comment = strip_tags($_POST['comment']);
              $userid = $_SESSION['user_id'];
              $itemid = $item['item_id'];
              if (!empty($comment)):
                $stmt = $connect->prepare('INSERT INTO 
                                          comments(comment_content, add_date, item_connect, user_connect) 
                                        VALUES(:zcomment, now(), :zitem, :zuser)');
                $stmt->execute([
                  'zcomment' => $comment,
                  'zitem' => $itemid,
                  'zuser' => $userid
                ]);
                if ($stmt):
                  redirectFuncSuccess(lang('ADDED_COMMENT'), 'back');
                endif;
              else:
                redirectFuncError(lang("EMPTY_COMMENT"), 'index.php');
              endif;
            endif;
            ?>
          </div>
        </div>
      </div>
    <?php else:
      echo '<div class="col-md-9 offset-md-3 alert alert-warning">';
      echo '<a href="login.php" class="link">Login</a> or <a href="signup.php" class="link">Register</a> To Add Comment';
      echo '</div>';
    endif; ?>
    <!-- End Comment Setion -->
    <hr>
    <!-- Start Latest Comment -->
    <div class="latest">
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default mb-4">
            <div class="panel-heading">
              <i class="fa fa-comments"></i>
              <?= lang('LATEST_COMMENTS') ?>
            </div>
            <div class="panel-body">
              <?php
              $stmt = $connect->prepare("SELECT
                                      comments.*,
                                      users.user_name AS user
                                    FROM
                                      comments
                                    INNER JOIN
                                      users
                                    ON
                                      users.user_id = comments.user_connect
                                    WHERE
                                      item_connect = ?
                                    AND
                                      comment_status = 1
                                    ORDER BY
                                      comment_id 
                                    DESC");
              $stmt->execute([$item['item_id']]);
              $comments = $stmt->fetchAll();
              if (!empty($comments)) :
                foreach ($comments as $comment) :
                  if ($comment['comment_status'] == 1) :
                    echo '<div class="comment-box ">';
                    echo '<a href="members.php?do=Edit&id=' . $comment['user_connect'] .
                      '"class="member-name list-group-item list-group-item-action">' . $comment['user'] . '</a>';
                    echo '<span class="member-comment list-group-item list-group-item-action">' . $comment['comment_content'] . '</span>';
                    echo '</div>';
                  endif;
                endforeach;
              else :
                echo '<div class="alert alert-info m-0">' . lang('NO_COMMENTS') . '</div>';
              endif;
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Latest Comment -->
  </div>
<?php
else:
  redirectFuncError(lang("ID_NOT_FOUND_WARNING"), 'index.php');
endif;
include "{$temp}footer.php";
ob_end_flush();
?>