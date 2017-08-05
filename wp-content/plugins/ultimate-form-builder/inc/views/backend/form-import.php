<div class="wrap">
    <?php self::load_view( 'backend/header' ); ?>
    <?php self::print_message(); ?>
    <div class="ufb-clear"></div>
    <h3><?php _e( 'Form Import', UFB_TD ); ?></h3>
    <div class="ufb-new-form-wrap">
        <div class="ufb-extra-note">
            <?php _e( 'Please make sure the <strong>tmp</strong> folder inside the plugin folder is writable. Else form import may not work properly. The import file extension should be <strong>.json</strong> and please make sure you upload the right file else there may cause some error.', UFB_TD ); ?>
        </div>
        <div class="ufb-import-section">
            <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data" class="ufb-import-form">
                <input type="hidden" name="action" value="ufb_import_form_action"/>
                <?php wp_nonce_field( 'ufb-import-nonce', 'ufb_import_nonce_field' ); ?>
                <div class="ufb-add-field-wrap">
                    <label><?php _e( 'Upload Import File', UFB_TD ); ?></label>
                    <div class="ufb-field">
                        <input type="file" name="import_file"/>
                        <input type="submit" value="<?php _e( 'Import Form', UFB_TD ); ?>" class="button-primary"/> 

                    </div>
                </div>
            </form>
        </div>
        <?php
        /**
         * Free Version Form Import
         * 
         * @since 1.0.3
         */
        if ( $free_version_forms != NULL ) {
            ?>
            <div class="ufb-import-section">
                <h3><?php _e( 'Import Free Version Forms', UFB_TD ); ?></h3>

                <div class="ufb-add-field-wrap">
                    <label><?php _e( 'Choose a form to import' ) ?></label>
                    <div class="ufb-field">
                        <select class="ufb-form-id">
                            <?php foreach ( $free_version_forms as $free_form ) { ?>
                                <option value="<?php echo $free_form->form_id; ?>"><?php echo $free_form->form_title; ?></option>
                            <?php } ?>
                        </select>
                        <div class="ufb-field">
                            <input type="button" value="<?php _e( 'Import Form', UFB_TD ); ?>" class="button-primary ufb-free-form-importer  ufb-margin-button"/>
                            <span class="ufb-ajax-loader" style="display: none"></span>
                            <span class="ufb-msg" style="display:none"></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }


        /**
         * Countries Table Import
         */
        ?>
        <div class="ufb-import-section">
            <h3><?php _e( 'Country, State and City Tables Mannual Import', UFB_TD ); ?></h3>
            <p class="description"><?php _e( 'For mannual import, you can use sql file named db_country_state_city.sql file or individual cities.sql, countries.sql states.sql inside our plugin\'s table folder.Once imported please rename the country, state and city table as below names:', UFB_TD ); ?></p>
            <p class="description"><?php _e( 'We recommend you to import manually than using our inbuilt importer because importing city may take more than one hour depending upon your server loading speed and internet speed.', UFB_TD ); ?></p>
            <ul>
                <li><b><?php echo __( 'Countries: ', UFB_TD ) ?></b><?php echo UFB_COUNTRY_TABLE; ?></li>
                <li><b><?php echo __( 'States: ', UFB_TD ) ?></b><?php echo UFB_STATE_TABLE; ?></li>
                <li><b><?php echo __( 'Cities: ' , UFB_TD ) ?></b><?php echo UFB_CITY_TABLE; ?></li>
            </ul>
        </div>
        <h3><?php _e( 'Country, State and City Table import through importer', UFB_TD ); ?></h3>
        <div class="ufb-import-section">
            <h3><?php _e( 'Countries Table Import' ) ?></h3>
            <div class="ufb-add-field-wrap">
                <label><?php _e( 'Status', UFB_TD ); ?></label>
                <div class="ufb-field">
                    <span class="ufb-table-status"><?php echo (!$country_table_flag) ? __( 'Not Imported', UFB_TD ) : __( 'Imported', UFB_TD ); ?></span>
                    <input type="button" value="<?php echo ($country_table_flag) ? __( 'Reimport Country Table' ) : __( 'Import Country Table', UFB_TD ); ?>" class="button-primary ufb-margin-button ufb-import-button" data-import="country"/>
                    <span class="ufb-ajax-loader" style="display: none"></span>
                    <span class="ufb-msg" style="display:none"><?php _e( 'There are total 246 countries to be imported.Please wait, this may take a while.', UFB_TD ); ?></span>
                </div>
            </div>
        </div>
        <?php
        /**
         * State Table Import
         */
        ?>
        <div class="ufb-import-section">
            <h3><?php _e( 'States Table Import' ) ?></h3>
            <div class="ufb-add-field-wrap">
                <label><?php _e( 'Status', UFB_TD ); ?></label>
                <div class="ufb-field">
                    <span class="ufb-table-status"><?php echo (!$state_table_flag) ? __( 'Not Imported', UFB_TD ) : __( 'Imported', UFB_TD ); ?></span>
                    <input type="button" value="<?php echo ($state_table_flag) ? __( 'Reimport States Table' ) : __( 'Import States Table', UFB_TD ); ?>" class="button-primary ufb-margin-button ufb-import-button" data-import="state"/>
                    <span class="ufb-ajax-loader" style="display: none"></span>
                    <span class="ufb-msg" style="display:none"><?php _e( 'There are total 4120 states to be imported. Please wait, this may take a while', UFB_TD ); ?></span>
                </div>
            </div>
        </div>
        <?php
        /**
         * City Table Import
         */
        ?>
        <div class="ufb-import-section">
            <h3><?php _e( 'Cities Table Import' ) ?></h3>
            <div class="ufb-add-field-wrap">
                <label><?php _e( 'Status', UFB_TD ); ?></label>
                <div class="ufb-field">
                    <span class="ufb-table-status"><?php echo (!$city_table_flag) ? __( 'Not Imported', UFB_TD ) : __( 'Imported', UFB_TD ); ?></span>
                    <input type="button" value="<?php echo ($city_table_flag) ? __( 'Reimport City Table' ) : __( 'Import City Table', UFB_TD ); ?>" class="button-primary ufb-margin-button ufb-import-button" data-import="city"/>
                    <span class="ufb-ajax-loader" style="display: none"></span>
                    <span class="ufb-msg" style="display:none"><?php _e('Please don\'t close the browser until the import is completed.',UFB_TD);?></span>
                    
                </div>
                <p class="description"><?php _e('Please note that it can take upto hour due to huge number of approximately 48,314 cities to be imported.',UFB_TD);?></p>
            </div>
        </div>



    </div>
</div>