<?php

    /*
    *
    *	Swift Framework Permalinks Class
    *	------------------------------------------------
    *	Swift Framework v2.0
    * 	Copyright Swift Ideas 2014 - http://www.swiftideas.net
    *
    */

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    } // Exit if accessed directly

    if ( ! class_exists( 'sf_post_type_permalinks' ) ) :

        class sf_post_type_permalinks {

            public function __construct() {
                add_action( 'admin_init', array( $this, 'settings_init' ) );
                add_action( 'admin_init', array( $this, 'settings_save' ) );
            }

            public function settings_init() {

                // Add portfolio section to the permalinks page
                add_settings_section( 'sf-portfolio-permalink', __( 'Portfolio permalink base', 'swift-framework-admin' ), array(
                        $this,
                        'portfolio_settings'
                    ), 'permalink' );

                // Add portfolio settings
                add_settings_field( 'portfolio_category_slug', __( 'Portfolio category base', 'swift-framework-admin' ), array(
                        $this,
                        'portfolio_category_slug_input'
                    ), 'permalink', 'optional' );

                // Add team section to the permalinks page
                add_settings_section( 'sf-team-permalink', __( 'Team permalink base', 'swift-framework-admin' ), array(
                        $this,
                        'team_settings'
                    ), 'permalink' );

                // Add team settings
                add_settings_field( 'team_category_slug', __( 'Team category base', 'swift-framework-admin' ), array(
                        $this,
                        'team_category_slug_input'
                    ), 'permalink', 'optional' );

            }

            public function portfolio_category_slug_input() {
                $port_permalinks = get_option( 'sf_portfolio_permalinks' );
                ?>
                <input name="portfolio_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $port_permalinks['category_base'] ) ) {
                           echo esc_attr( $port_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'portfolio-category', 'swift-framework-admin' ) ?>"/>
            <?php
            }

            public function galleries_category_slug_input() {
                $gallery_permalinks = get_option( 'sf_galleries_permalinks' );
                ?>
                <input name="galleries_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $gallery_permalinks['category_base'] ) ) {
                           echo esc_attr( $gallery_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'galleries-category', 'swift-framework-admin' ) ?>"/>
            <?php
            }

            public function team_category_slug_input() {
                $team_permalinks = get_option( 'sf_team_permalinks' );
                ?>
                <input name="team_category_slug" type="text" class="regular-text code"
                       value="<?php if ( isset( $team_permalinks['category_base'] ) ) {
                           echo esc_attr( $team_permalinks['category_base'] );
                       } ?>" placeholder="<?php echo __( 'team-category', 'swift-framework-admin' ) ?>"/>
            <?php
            }
            
            public function portfolio_settings() {
                echo wpautop( __( 'These settings control the permalinks used for portfolio items. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swift-framework-admin' ) );

                // Get current permalinks
                $permalinks          = get_option( 'sf_portfolio_permalinks' );
                $portfolio_permalink = $permalinks['portfolio_base'];

                // Get portfolio page
                global $sf_options;
                $portfolio_page = __( $sf_options['portfolio_page'], 'swiftframework' );
                $base_slug      = ( $portfolio_page > 0 && get_page( $portfolio_page ) ) ? get_page_uri( $portfolio_page ) : __( 'portfolio', 'swift-framework-admin' );
                $portfolio_base = __( 'portfolio', 'swift-framework-admin' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $portfolio_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%portfolio-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_port_tog" <?php checked( $structures[0], $portfolio_permalink ); ?> /> <?php _e( 'Default', 'swift-framework-admin' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?portfolio=sample-portfolio-item</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_port_tog" <?php checked( $structures[1], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio', 'swift-framework-admin' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $portfolio_base; ?>/sample-portfolio-item/</code>
                        </td>
                    </tr>
                    <?php if ( $portfolio_page ) : ?>
                        <tr>
                            <th><label><input name="portfolio_permalink" type="radio"
                                              value="<?php echo $structures[2]; ?>"
                                              class="sf_port_tog" <?php checked( $structures[2], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base', 'swift-framework-admin' ); ?>
                                </label></th>
                            <td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/sample-portfolio-item/</code>
                            </td>
                        </tr>
                        <!--<tr>
							<th><label><input name="portfolio_permalink" type="radio" value="<?php echo $structures[3]; ?>" class="sftog" <?php checked( $structures[3], $portfolio_permalink ); ?> /> <?php _e( 'Portfolio base with category', 'swift-framework-admin' ); ?></label></th>
							<td><code><?php echo home_url(); ?>/<?php echo $base_slug; ?>/portfolio-category/sample-portfolio-item/</code></td>
						</tr>-->
                    <?php endif; ?>
                    <tr>
                        <th><label><input name="portfolio_permalink" id="sf_portfolio_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_port_tog" <?php checked( in_array( $portfolio_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swift-framework-admin' ); ?></label></th>
                        <td>
                            <input name="portfolio_permalink_structure" id="sf_portfolio_permalink_structure"
                                   type="text" value="<?php echo esc_attr( $portfolio_permalink ); ?>"
                                   class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swift-framework-admin' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_port_tog' ).change(
                                function() {
                                    jQuery( '#sf_portfolio_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_portfolio_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_portfolio_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function team_settings() {
                echo wpautop( __( 'These settings control the permalinks used for team members. These settings only apply when <strong>not using "default" permalinks above</strong>.', 'swift-framework-admin' ) );

                // Get current permalinks
                $permalinks     = get_option( 'sf_team_permalinks' );
                $team_permalink = $permalinks['team_base'];

                // Set base slug & team base
                $base_slug = __( 'team', 'swift-framework-admin' );
                $team_base = __( 'team', 'swift-framework-admin' );

                $structures = array(
                    0 => '',
                    1 => '/' . trailingslashit( $team_base ),
                    2 => '/' . trailingslashit( $base_slug ),
                    3 => '/' . trailingslashit( $base_slug ) . trailingslashit( '%team-category%' )
                );
                ?>
                <table class="form-table">
                    <tbody>
                    <tr>
                        <th><label><input name="team_permalink" type="radio" value="<?php echo $structures[0]; ?>"
                                          class="sf_team_tog" <?php checked( $structures[0], $team_permalink ); ?> /> <?php _e( 'Default', 'swift-framework-admin' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/?team=sample-team-member</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="team_permalink" type="radio" value="<?php echo $structures[1]; ?>"
                                          class="sf_team_tog" <?php checked( $structures[1], $team_permalink ); ?> /> <?php _e( 'Team', 'swift-framework-admin' ); ?>
                            </label></th>
                        <td><code><?php echo home_url(); ?>/<?php echo $team_base; ?>/sample-team-member/</code></td>
                    </tr>
                    <tr>
                        <th><label><input name="team_permalink" id="sf_team_custom_selection" type="radio"
                                          value="custom"
                                          class="sf_team_tog" <?php checked( in_array( $team_permalink, $structures ), false ); ?> />
                                <?php _e( 'Custom Base', 'swift-framework-admin' ); ?></label></th>
                        <td>
                            <input name="team_permalink_structure" id="sf_team_permalink_structure" type="text"
                                   value="<?php echo esc_attr( $team_permalink ); ?>" class="regular-text code"> <span
                                class="description"><?php _e( 'Enter a custom base to use. A base <strong>must</strong> be set or WordPress will use default instead.', 'swift-framework-admin' ); ?></span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <script type="text/javascript">
                    jQuery(
                        function() {
                            jQuery( 'input.sf_team_tog' ).change(
                                function() {
                                    jQuery( '#sf_team_permalink_structure' ).val( jQuery( this ).val() );
                                }
                            );

                            jQuery( '#sf_team_permalink_structure' ).focus(
                                function() {
                                    jQuery( '#sf_team_custom_selection' ).click();
                                }
                            );
                        }
                    );
                </script>
            <?php
            }

            public function settings_save() {
                if ( ! is_admin() ) {
                    return;
                }

                // Save options
                if ( isset( $_POST['permalink_structure'] ) || isset( $_POST['category_base'] ) && isset( $_POST['portfolio_permalink'] ) ) {

                    // Cat and tag bases
                    $sf_portfolio_category_slug = sanitize_text_field( $_POST['portfolio_category_slug'] );
                    $sf_team_category_slug = sanitize_text_field( $_POST['team_category_slug'] );
                    
                    $port_permalinks = get_option( 'sf_portfolio_permalinks' );
                    if ( ! $port_permalinks ) {
                        $port_permalinks = array();
                    }
                    $port_permalinks['category_base'] = untrailingslashit( $sf_portfolio_category_slug );

                    $team_permalinks = get_option( 'sf_team_permalinks' );
                    if ( ! $team_permalinks ) {
                        $team_permalinks = array();
                    }
                    $team_permalinks['category_base'] = untrailingslashit( $sf_team_category_slug );

                    // Permalink bases
                    $portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink'] );
                    $team_permalink      = sanitize_text_field( $_POST['team_permalink'] );

                    if ( $portfolio_permalink == 'custom' ) {
                        $portfolio_permalink = sanitize_text_field( $_POST['portfolio_permalink_structure'] );
                    } elseif ( empty( $portfolio_permalink ) ) {
                        $portfolio_permalink = false;
                    }
  			        if ( $team_permalink == 'custom' ) {
                        $team_permalink = sanitize_text_field( $_POST['team_permalink_structure'] );
                    } elseif ( empty( $team_permalink ) ) {
                        $team_permalink = false;
                    }
                    
                    // Set base for each permalinks variable
                    $port_permalinks['portfolio_base']      = untrailingslashit( $portfolio_permalink );
                    $team_permalinks['team_base'] = untrailingslashit( $team_permalink );

                    // Update permalinks
                    update_option( 'sf_portfolio_permalinks', $port_permalinks );
                    update_option( 'sf_team_permalinks', $team_permalinks );
                }
            }
        }

    endif;

    return new sf_post_type_permalinks();

?>