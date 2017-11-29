<?php
//comment
// comment 2
add_filter( 'vc_grid_item_shortcodes', 'my_module_add_grid_shortcodes' );
function my_module_add_grid_shortcodes( $shortcodes ) {
   $shortcodes['vc_post_id'] = array(
     'name' => __( 'Post id', 'my-text-domain' ),
     'base' => 'vc_post_id',
     'category' => __( 'Content', 'my-text-domain' ),
     'description' => __( 'Show current post id', 'my-text-domain' ),
     'post_type' => Vc_Grid_Item_Editor::postType(),
  );


   return $shortcodes;
}
// output function
add_shortcode( 'vc_post_id', 'vc_post_id_render' );
function vc_post_id_render() {
   return '<h2>{{ post_data:ID }}</h2>'; // usage of template variable post_data with argument "ID"
}

//
//
//
// add_action( 'vc_before_init', 'your_name_integrateWithVC' );
// function your_name_integrateWithVC() {
//    vc_map( array(
//       "name" => __( "Bar tag test", "my-text-domain" ),
//       "base" => "bartag",
//       "params" => array(
//         array(
//             'type' => 'css_editor',
//             'heading' => __( 'Css', 'my-text-domain' ),
//             'param_name' => 'css',
//             'group' => __( 'Design options', 'my-text-domain' ),
//         ),
//       ),
//    ) );
// }
// class WPBakeryShortCode_Bartag extends WPBakeryShortCode {
// }
?>
