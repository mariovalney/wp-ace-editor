<?php

/*
Plugin Name: WP Ace Editor
Description: Use o Ace para editar os seus posts do WordPress!
Version: 1.0.0 ALFA
Author: Mário Valney
Author URI: http://www.mariovalney.com
Text Domain: wp-ace-editor
*/

if ( !defined( 'ABSPATH' ) ) {
    exit; // Impede o acesso direto
}

add_action( 'edit_form_after_title', 'wae_edit_form_after_title' );

function wae_edit_form_after_title( $post ) {
    if ( post_type_supports( $post->post_type, 'editor' ) ) : ?>

        <div id="wp-ace-editor-wrapper">
            <div id="wp-ace-editor"><?php echo esc_attr( $post->post_content ); ?></div>
        </div>
            
        <style type="text/css" media="screen">
            #wp-ace-editor-wrapper {
                display: block;
                position: relative;
                width: 100%;
                height: 400px;
                background: #FFFFFF;
                margin: 30px 0 20px 0;
            }

            #wp-ace-editor { 
                position: absolute;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
            }

            #postdivrich {
                display: none;
            }
        </style>

        <script src="<?php echo plugins_url( '/ace-builds/src-noconflict/ace.js', __FILE__ ); ?>" type="text/javascript"></script>
        <script>
            jQuery(document).ready(function($) {
                var AceEditor = ace.edit("wp-ace-editor");
                AceEditor.setTheme("ace/theme/monokai");
                AceEditor.setShowPrintMargin(false);

                AceEditor.getSession().setMode("ace/mode/html");
                AceEditor.getSession().on('change', function(e) {
                    $('#content').val( AceEditor.getValue() );
                });

            });
        </script>
        
    <?php
    endif;
}