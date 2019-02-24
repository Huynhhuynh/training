<?php 
global $db;

if( isset( $_POST['pid'] ) ) { 

    $pid = $_POST['pid'];
    unset( $_POST['pid'] ); // remove pid from $_POST array

    if( ! empty( $pid ) ) {
        $pid = update_post( $_POST, $pid );
        $pre_message = 'Update';
    } else {
        $pid = update_post( $_POST );
        $pre_message = 'Add new';
    }
  
    redirect( '?view=edit&id=' . $pid, array(
        'type' => ! empty( $pid ) ? 'success' : 'danger',
        'message' => ! empty( $pid ) ? $pre_message . ' post success!' : $pre_message . ' post fail!',
    ) );
}

$pid = isset( $_GET['id'] ) ? $_GET['id'] : 0;
$result = [];

if( ! empty( $pid ) ) {
    $result = get_post( $pid );
    $result = $result->num_rows ? $result->fetch_array( MYSQLI_ASSOC ) : [];

    $db->free();
}

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
        <div class="tool-links">
            <a class="new-post" href="?view=edit">
                New Post
            </a>
            <?php if( ! empty( $post_data->ID ) ) : ?>
            <a class="view-post" href="?view=single&id=<?php print( $post_data->ID ); ?>">
                View Post
            </a>
            <a class="del-post" href="?view=single">
                Delete
            </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="post-edit">
    <h2 class="title"><?php echo ! empty( $post_data->ID ) ? 'Edit #' . $post_data->ID : 'Add new'; ?></h2>
    <form class="" action="" method="POST">
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="<?php print( $post_data->title ); ?>" required>
            <small id="title" class="form-text text-muted"></small>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="author">Author</label>
                <input type="text" class="form-control" id="author" name="author" placeholder="Author" value="<?php print( $post_data->author ); ?>" required>
            </div>
            <div class="form-group col-md-6">
                <label for="tag">Tag</label>
                <input type="text" class="form-control" id="tag" name="tag" placeholder="Tag" value="<?php print( $post_data->tag ); ?>">
            </div>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea class="form-control" id="content" name="content" rows="7"><?php print( $post_data->content ); ?></textarea>
        </div>
        <input type="hidden" name="pid" value="<?php print( $post_data->ID ); ?>">
        <button type="submit" class="btn btn-primary"><?php echo ! empty( $post_data->ID ) ? 'Update' : 'Submit'; ?></button>
    </form>
</div>