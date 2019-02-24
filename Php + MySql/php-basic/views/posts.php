<?php 
global $configs;

if( isset( $_POST['action'] ) && 'delete-post' == $_POST['action'] ) {
    $r = del_post( $_POST['pid'] );
    
    redirect( $configs['site_url'], array(
        'type' => ! empty( $r ) ? 'success' : 'danger',
        'message' => ! empty( $r ) ? 'Delete post #'. $_POST['pid'] .' success!' : 'Delete post #'. $_POST['pid'] .' fail!',
    ) );
}

$posts = get_post();
?>

<div class="row">
    <div class="col-6">
        <div class="tool-links">
            <a class="new-post" href="?view=edit">
                + New Post
            </a>
        </div>
    </div>
    <div class="col-6"></div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col" style="width: 40%">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Tag</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach( $posts->fetch_all( MYSQLI_ASSOC ) as $post ) : ?>
        <tr>
            <th scope="row"><?php print( $post['ID'] ); ?></th>
            <td>
                <p><a href="?view=single&id=<?php echo $post['ID']; ?>"><?php print( $post['title'] ); ?></a></p>
                <div class="btn-actions">
                    <form class="form-delele-post" action="" method="POST" onsubmit="return confirm('Delete this post?');">
                        <input type="hidden" name="pid" value="<?php print( $post['ID'] ); ?>">
                        <input type="hidden" name="action" value="delete-post">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                    <a href="?view=edit&id=<?php echo $post['ID']; ?>" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">Edit</a>
                </div>
            </td>
            <td><?php print( $post['author'] ); ?></td>
            <td><?php print( $post['tag'] ); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>