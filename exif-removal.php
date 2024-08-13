<?php
/**
 * Plugin Name:     EXIF Removal
 * Description:     Removes EXIF data from image uploads
 * Author:          Bob Matyas
 * Author URI:      https://www.bobmatyas.com
 * Text Domain:     exif-removal
 * Version:         1.0.0
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package         EXIF_Removal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action(
	'wp_handle_upload',
	function ( $upload ) {
		if ( 'image/jpeg' === $upload['type'] || 'image/jpg' === $upload['type'] ) {
			$filename = $upload['file'];
			// Check for Imagick.
			if ( class_exists( 'Imagick' ) ) {

				$image = new Imagick( $filename );

				if ( ! $image->valid() ) {
					return $upload;
				}

				try {
					// Preserve image orientation.
					$orientation = $image->getImageOrientation();
					switch ( $orientation ) {
						case Imagick::ORIENTATION_BOTTOMRIGHT:
							$image->rotateImage( new ImagickPixel(), 180 );
							break;
						case Imagick::ORIENTATION_RIGHTTOP:
							$image->rotateImage( new ImagickPixel(), 90 );
							break;
						case Imagick::ORIENTATION_LEFTBOTTOM:
							$image->rotateImage( new ImagickPixel(), -90 );
							break;
					}

					$image->stripImage();
					$image->writeImage( $filename );
					$image->clear();
					$image->destroy();
				} catch ( Exception $e ) {
					if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
						// phpcs:ignore WordPress.Security.Debug.Log
						error_log( 'Unable to strip EXIF data with Imagick: ' . $filename );
					}
				}
			} elseif ( function_exists( 'imagecreatefromjpeg' ) ) {
				// Fallback to GD.
				$image = imagecreatefromjpeg( $filename );

				if ( $image ) {
					try {
						// Check image orientation using EXIF data.
						$exif = exif_read_data( $filename );
						if ( ! empty( $exif['Orientation'] ) ) {
							switch ( $exif['Orientation'] ) {
								case 3:
									$image = imagerotate( $image, 180, 0 );
									break;
								case 6:
									$image = imagerotate( $image, -90, 0 );
									break;
								case 8:
									$image = imagerotate( $image, 90, 0 );
									break;
							}
						}
						imagejpeg( $image, $filename, 100 );
						imagedestroy( $image );
					} catch ( Exception $e ) {
						if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
							// phpcs:ignore WordPress.Security.Debug.Log
							error_log( 'Unable to read EXIF data via GD for: ' . $filename . ' - ' . $e->getMessage() );
						}
					}
				}
			}
		}

		return $upload;
	}
);
