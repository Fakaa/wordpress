<div class="wrap">
    <?php self::load_view( 'backend/header' ); ?>
    <?php // UFB_Lib::print_array($ufb_settings);?>
    <h3><?php _e( 'Global Settings', UFB_TD ); ?></h3>
    <div class="ufb-new-form-wrap">
        <div class="ufb-add-field-wrap">
            <label class="ufb-settings-label"><?php _e( 'Disable jQuery UI CSS', UFB_TD ); ?></label>
            <div class="ufb-field ufb-settings-field">
                <input type="checkbox" class="ufb-ui-disable" <?php checked( $ufb_settings['disable_ui'], true ); ?>>
                <div class="ufb-field-note ufb-setting-note"><?php _e( 'Please check if you want to disable jQuery UI CSS in frontend. It will be useful if your active theme has already included the jQuery UI CSS', UFB_TD ); ?></div>
            </div>

        </div>
        <div class="ufb-add-field-wrap">
            <label class="ufb-settings-label"><?php _e( 'Disable Font Awesome CSS', UFB_TD ); ?></label>
            <div class="ufb-field ufb-settings-field">
                <input type="checkbox" class="ufb-fa-disable" <?php checked( $ufb_settings['disable_fa'], true ); ?>>
                <div class="ufb-field-note ufb-setting-note"><?php _e( 'Please check if you want to disable font awesome css in frontend. It will be useful if your active theme has already included the font awesome CSS', UFB_TD ); ?></div>
            </div>

        </div>

        <div class="ufb-add-field-wrap">
            <label class="ufb-settings-label"></label>
            <div class="ufb-field ufb-settings-field">
                <input type="button" class="ufb-save-settings-btn button-primary" value="Save Changes">
                <span class="ufb-ajax-loader" style="display: none"></span>
                <span class="ufb-msg" style="display:none;"><?php _e( 'Settings saved successfully', UFB_TD ); ?></span>
            </div>
        </div>
    </div>

</div>

