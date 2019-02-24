<?php 
$GLOBALS['configs'] = require( 'configs.php' );
$GLOBALS['view'] = isset( $_GET['view'] ) ? $_GET['view'] : $configs['view_default'];
{
    /**
     * Database
     */
    include 'inc/db.php';
    $GLOBALS['db'] = new db(
        $configs['db']['server'], 
        $configs['db']['user'],
        $configs['db']['pwd'],
        $configs['db']['db_name'] 
    );
}

{
    /**
     * @since 1.0.0
     * Functions
     */
    include 'inc/functions.php';
}
?>

<?php include 'header.php'; ?>

<div id="main">
    <div class="container">

        <?php notice(); ?>

        <?php include 'views/' . $GLOBALS['view'] . '.php'; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
        