<?php 
$pid = isset( $_GET['id'] ) ? $_GET['id'] : die( 'Post not exist!!!!' );

$result = get_post( $pid );
$result = $result->num_rows ? $result->fetch_array( MYSQLI_ASSOC ) : [];

$post_data = (object) array_merge(
    array(
        'ID' => 0,
        'title' => '',
        'content' => '',
        'author' => '',
        'tag' => '',
    ), 
    $result
);
?>


<div class="row">
    <div class="col-6">
        <a class="back-to-home" href="/php-basic">Back to Home</a>
    </div>
    <div class="col-6 text-right">
        <a class="edit-post" href="?view=edit&id=<?php print( $post_data->ID ); ?>">
            Edit #<?php print( $post_data->ID ); ?>
        </a>
    </div>
</div>

<div class="single-post-container">
    <h2 class="title"><?php print( $post_data->title );?></h2>
    <ul class="post-meta-tag">
        <li>Author: <?php print( $post_data->author ); ?></li>
        <li>Tag: <?php print( $post_data->tag ); ?></li>
    </ul>
    <div class="entry-content">
        <?php print( $post_data->content ); ?>
    </div>
</div>
