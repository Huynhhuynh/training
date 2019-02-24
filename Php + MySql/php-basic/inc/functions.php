<?php 
/**
 * @since 1.0.0
 * Functions
 * 
 */

/**
 * @since 1.0.0
 * Notice message
 * 
 * @return [html]
 */
function notice() {

    $type = isset( $_SESSION['alert_type'] ) ? $_SESSION['alert_type'] : '';
    $message = isset( $_SESSION['allert_message'] ) ? $_SESSION['allert_message'] : '';

    unset($_SESSION['alert_type']);
    unset($_SESSION['allert_message']);

    if( empty( $message ) ) return;

    alert( $type, $message, true );

}

/**
 * @since 1.0.0
 * Body classes 
 * 
 * @return [string]
 */
function body_class( $classes = '' ) {

    global $configs, $view;

    $arr_classes = array(
        'body-class',
        'view-' . $view,
        isset( $_GET['id'] ) ? 'post-id-' . $_GET['id'] : '',
    );

    print( 'class="'. implode( ' ', $arr_classes ) .'"' );
}

/**
 * @since 1.0.0
 * Alert template
 * 
 * @return [html]
 */
function alert( $type = 'info', $message = '', $echo = false ) {
    
    $output = '<div class="alert alert-'. $type .'" role="alert">'. $message .'</div>';
    
    if( true == $echo ) echo $output;
    else return $output;

}

function redirect( $url = '', $alert = array() ) {

    if( isset( $alert['type'] ) ) $_SESSION['alert_type'] = $alert['type'];
    if( isset( $alert['message'] ) ) $_SESSION['allert_message'] = $alert['message'];

    if (headers_sent() === false)
    {
        header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}

 /**
  * @since 1.0.0
  * Get posts
  * 
  * @return [array]
  */
function get_post( $pid = null ) {

    global $db;

    if( empty( $pid ) )
        # Get all posts

        $query = 'SELECT * FROM `posts` ORDER BY `ID` DESC';
    else 
        # Get a post by ID

        $query = 'SELECT * FROM `posts` WHERE `ID` = '. $pid;

    return $db->query( $query );

}

/**
 * @since 1.0.0
 * Update & add new post 
 * 
 */
function update_post( $fields = array(), $pid = null ) {

    global $db;

    if( empty( $pid ) ) {
        # Insert post

        $new_values = array_map( function( $item ) use ( $db ) {
            return $db->real_escape_string( $item );
        }, $fields );

        $query = 'INSERT INTO `posts` 
        ( '. implode( ', ', array_keys( $fields ) ) .' ) VALUES  ( "'. implode( '", "', $new_values ) .'" )';
        
        
    } else {
        #Update post

        $update_data = array_map( function( $key, $item ) use ( $db ) {
            return "`{$key}`='". $db->real_escape_string( $item ) ."'";
        }, array_keys( $fields ), $fields );
        
        $query = 'UPDATE `posts` SET '. implode( ', ', $update_data ) .' WHERE `ID` = ' . $pid;

    }
    
    $r = $db->query( $query );
    if( $r ) {
        return empty( $pid ) ? $db->insert_id() : $pid;
    } else {
        return;
    }
    
}

/**
 * @since 1.0.0
 * Del post
 * 
 * @return [int]
 */
function del_post( $id = null ) {

    global $db;

    if( is_array( $id ) ) {
        $id = implode( ', ', $id );
    }

    $query = 'DELETE FROM posts WHERE `ID` IN( '. $id .' )';
    return $db->query( $query );
}