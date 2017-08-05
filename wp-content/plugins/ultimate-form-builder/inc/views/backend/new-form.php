<div class="wrap">
    <?php self::load_view( 'backend/header' ); ?>
    <h3><?php _e( 'New Form', UFB_TD ); ?></h3>
    <div class="ufb-new-form-wrap">
        <div class="ufb-add-field-wrap">
            <label><?php _e( 'Form Title', UFB_TD ); ?></label>
            <div class="ufb-field"><input type="text" class="ufb-form-title" placeholder="<?php _e( 'Contact Form', UFB_TD ); ?>"></div>
            <div class="ufb-field-note"><?php _e( 'Please enter the form title', UFB_TD ); ?></div>
        </div>
        <div class="ufb-add-field-wrap">
            <label><?php _e( 'Form Type', UFB_TD ); ?></label>
            <div class="ufb-field">
                <select class="ufb-form-type">
                    <option value="single"><?php _e( 'Single Step Form', UFB_TD ); ?></option>
                    <option value="multi"><?php _e( 'Multi Step Form', UFB_TD ); ?></option>
                </select>
            </div>
            <div class="ufb-field-note"><?php _e( 'Please choose form type.', UFB_TD ); ?></div>
        </div>
        <div class="ufb-add-field-wrap ufb-add-submit-wrap">
            <input type="button" class="ufb-form-add-btn button-primary" value="Add Form"><span class="ufb-ajax-loader" style="display: none"></span><span class="ufb-msg" style="display:none;">Form Created.Redirecting...</span>
            <div class="ufb-add-error ufb-error" style="display: none;"></div>
        </div>
    </div>

</div>

