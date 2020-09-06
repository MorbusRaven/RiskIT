<?php /** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */
/** @noinspection ALL */


include ("config.php");

if (isset($_GET['post_id'])) {

    $id = $_GET['post_id'];

    $estimations_posts = $conn->query("SELECT * FROM estimations WHERE post_id = $id");

    $post_data = $estimations_posts->fetch_assoc();

} else {

    header("Location: index.php");

}

?>

<!doctype html>

<html>

<head>
    <?php require_once( ROOT_PATH . '/includes/head_section.php') ?>


    <title><?php echo $post_data['post_name'] ?>Status Update</title>

    <link rel="stylesheet" type="text/css" href="public_styling.css">

</head>



<body>
<?php include( ROOT_PATH . '/includes/navbar.php') ?>
<div class="body">

    <a href="RoundTable.php">Estimations</a> | <b><?php echo $post_data['post_name'] ?></b>

</div>

<div class="body">

    <div class="post-panel">

        <div class="post-body" style="border: none;">

            <?php echo $post_data['post_msg'] ?>

        </div>

        <div class="post-footer">

            <?php

            $estimations_comments = $conn->query("SELECT * FROM estimations_comments WHERE post_id = $id");

            ?>

            <b><?php echo $estimations_comments->num_rows ?></b> Total comments<br><br>

            <?php

            while ($comment_data = $estimations_comments->fetch_assoc()) { ?>

                <div class="post-panel">

                    <div class="post-header">

                        <b><?php echo $comment_data['username'] ?></b>

                    </div>

                    <div class="post-body">

                        <?php echo $comment_data['user_comment'] ?>

                    </div>

                </div>

            <?php }

            ?>

            <form method="post" action="estimations-comment-action.php?post_id=<?php echo $id ?>">

                <label>Quick Comment:</label><br>

                <textarea name="comment" required></textarea><br>
                <?php echo  $_SESSION['username']; ?>
                <input type="submit" name="post_comment" />

            </form>

        </div>

    </div>

</div>

</body>

</html>