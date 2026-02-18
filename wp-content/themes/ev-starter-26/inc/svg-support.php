<?php
/**
 * Enable SVG Support
 *
 * A class to add SVG support to WordPress media uploads.
 *
 * @package YourThemeOrPlugin
 */

if ( ! class_exists( 'WP_SVG_Support' ) ) {

    /**
     * Class WP_SVG_Support
     */
    class WP_SVG_Support {

        /**
         * Constructor
         */
        public function __construct() {
            // Add SVG to allowed mime types
            add_filter( 'upload_mimes', array( $this, 'add_svg_mime_types' ) );
            
            // Ensure thumbnails are generated correctly for SVGs
            add_filter( 'wp_check_filetype_and_ext', array( $this, 'fix_svg_filetype' ), 10, 5 );
            
            // Fix SVG dimensions
            add_filter( 'wp_get_attachment_image_src', array( $this, 'fix_svg_size_attributes' ), 10, 4 );
            
            // Fix SVG in media library
            add_action( 'admin_head', array( $this, 'fix_svg_media_library' ) );
            
            // Fix upload validation issues
            add_filter( 'wp_prepare_attachment_for_js', array( $this, 'fix_svg_js_response' ), 10, 3 );
        }

        /**
         * Add SVG mime types to allowed uploads
         *
         * @param array $mimes Array of allowed mime types.
         * @return array
         */
        public function add_svg_mime_types( $mimes ) {
            $mimes['svg']  = 'image/svg+xml';
            $mimes['svgz'] = 'image/svg+xml';

            return $mimes;
        }

        /**
         * Fix SVG file type detection
         *
         * @param array  $data           File data.
         * @param string $file           Full path to the file.
         * @param string $filename       The name of the file.
         * @param array  $mimes          Array of mime types.
         * @param string $real_mime      Real mime type.
         * @return array
         */
        public function fix_svg_filetype( $data, $file, $filename, $mimes, $real_mime = '' ) {
            // WP 5.1+
            if ( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ) {
                $dosvg = in_array( $real_mime, array( 'image/svg', 'image/svg+xml' ), true );
            } else {
                $dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
            }

            if ( $dosvg ) {
                // Check if it's actually an SVG file
                if ( $this->is_valid_svg( $file ) ) {
                    // Force correct mime type for SVG
                    $data['type']  = 'image/svg+xml';
                    $data['ext']   = 'svg';
                    $data['proper_filename'] = $filename;
                } else {
                    // If not a valid SVG, reject it
                    $data['type'] = false;
                    $data['ext']  = false;
                }
            }

            return $data;
        }

        /**
         * Check if an SVG file is valid by checking for XML structure and SVG root tag
         *
         * @param string $file Path to the SVG file.
         * @return bool
         */
        private function is_valid_svg( $file ) {
            if ( ! file_exists( $file ) ) {
                return false;
            }

            // Attempt to read file content
            $content = file_get_contents( $file );
            if ( ! $content ) {
                return false;
            }

            // Check if it's an SVG (contains SVG tag and XML declaration)
            if ( preg_match( '/<svg[\s|\S]*?>[\s|\S]*?<\/svg>/i', $content ) ) {
                // Additional security: basic check for any script tags
                if ( preg_match( '/<script[\s|\S]*?>[\s|\S]*?<\/script>/i', $content ) ) {
                    return false; // Contains script tags, potentially unsafe
                }
                return true; // Valid SVG file
            }

            return false;
        }

        /**
         * Fix SVG size attributes for thumbnails
         *
         * @param array|false  $image         Array of image data, or boolean false if no image.
         * @param int          $attachment_id Attachment ID.
         * @param string|array $size          Image size.
         * @param bool         $icon          Whether the image should be treated as an icon.
         * @return array|false
         */
        public function fix_svg_size_attributes( $image, $attachment_id, $size, $icon ) {
            if ( $image && 'image/svg+xml' === get_post_mime_type( $attachment_id ) ) {
                // If width and height are 0 or 1, set a default size
                if ( empty( $image[1] ) || empty( $image[2] ) || 1 === $image[1] || 1 === $image[2] ) {
                    // Set default dimensions for SVG
                    $image[1] = 100;
                    $image[2] = 100;
                }
            }
            return $image;
        }

        /**
         * Add style for SVG in Media Library
         */
        public function fix_svg_media_library() {
            echo '<style>
                .media-icon img[src$=".svg"], 
                img[src$=".svg"].attachment-post-thumbnail {
                    width: 100% !important;
                    height: auto !important;
                }
            </style>';
        }

        /**
         * Fix SVG in media library preview response
         *
         * @param array      $response   Array of prepared attachment data.
         * @param WP_Post    $attachment Attachment object.
         * @param array|bool $meta       Array of attachment meta data, or boolean false if there is none.
         * @return array
         */
        public function fix_svg_js_response( $response, $attachment, $meta ) {
            if ( 'image/svg+xml' === $response['mime'] ) {
                // Set dimensions for SVG preview
                if ( empty( $response['width'] ) || empty( $response['height'] ) ) {
                    $response['width']  = 100;
                    $response['height'] = 100;
                }

                // Set URL for SVG preview
                $response['image'] = array(
                    'src' => $response['url'],
                );
            }

            return $response;
        }
    }

    // Initialize the class
    new WP_SVG_Support();
}
