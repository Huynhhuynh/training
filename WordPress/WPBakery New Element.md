# WPBakery New Element Base

#### Required

* Install Plusin js_composer.js (WPBakery Page Builder)

#### Where to include your code

Add the following code in ``function.php`` in your theme. It’s called ``BEFORE`` the Visual Composer initialization:

```PHP
// Before VC Init
add_action( 'vc_before_init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {
     
    //.. Code from other Tutorials ..//
 
    // Require new custom Element
    require_once( get_template_directory().'/vc-elements/my-first-custom-element.php' ); 
     
}
```

#### Initialize your new Element

My Class consists of 3 parts:
* Shortcode Init
* Shortcode Map (parameters)
* Shortcode HTML

But now it’s time to paste the code for the Class structure:

```PHP
/*
Element Description: VC Info Box
*/
 
// Element Class 
class vcInfoBox extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_infobox_mapping' ) );
        add_shortcode( 'vc_infobox', array( $this, 'vc_infobox_html' ) );
    }
     
    // Element Mapping
    public function vc_infobox_mapping() {
         
        //.. the Code is in the next steps ..//                           
        
    } 
     
     
    // Element HTML
    public function vc_infobox_html( $atts ) {
         
        //.. the Code is in the next steps ..//
         
    } 
     
} // End Element Class
 
// Element Class Init
new vcInfoBox();    
```

#### Mapping the Element

It’s time to use the famous ``vc_map()`` function, that allows to add new elements inside Visual Composer and to assign them custom ``params/attributes``.

So we can edit our ``vc_infobox_mapping()`` function:

```PHP
// Element Mapping
public function vc_infobox_mapping() {
         
    // Stop all if VC is not enabled
    if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
    }
         
    // Map the block with vc_map()
    vc_map( 
  
        array(
            'name' => __('VC Infobox', 'text-domain'),
            'base' => 'vc_infobox',
            'description' => __('Another simple VC box', 'text-domain'), 
            'category' => __('My Custom Elements', 'text-domain'),   
            'icon' => get_template_directory_uri().'/assets/img/vc-icon.png',            
            'params' => array(   
                      
                array(
                    'type' => 'textfield',
                    'holder' => 'h3',
                    'class' => 'title-class',
                    'heading' => __( 'Title', 'text-domain' ),
                    'param_name' => 'title',
                    'value' => __( 'Default value', 'text-domain' ),
                    'description' => __( 'Box Title', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'Custom Group',
                ),  
                  
                array(
                    'type' => 'textarea',
                    'holder' => 'div',
                    'class' => 'text-class',
                    'heading' => __( 'Text', 'text-domain' ),
                    'param_name' => 'text',
                    'value' => __( 'Default value', 'text-domain' ),
                    'description' => __( 'Box Text', 'text-domain' ),
                    'admin_label' => false,
                    'weight' => 0,
                    'group' => 'Custom Group',
                )                   
                     
            )
        )
    );                                
        
}
```

#### Element HTML

We are finally ready to work on the frontend layout, so let’s edit our ``vc_infobox_html()`` function:

```PHP
// Element HTML
public function vc_infobox_html( $atts ) {
     
    // Params extraction
    extract(
        shortcode_atts(
            array(
                'title'   => '',
                'text' => '',
            ), 
            $atts
        )
    );
     
    // Fill $html var with data
    $html = '
    <div class="vc-infobox-wrap">
     
        <h2 class="vc-infobox-title">' . $title . '</h2>
         
        <div class="vc-infobox-text">' . $text . '</div>
     
    </div>';      
     
    return $html;
     
}
```

#### Result