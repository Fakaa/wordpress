<div class="wrap">
    <?php self::load_view( 'backend/header' ); ?>
    <h3><?php _e( 'Form Export', UFB_TD ); ?></h3>
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
        <input type="hidden" name="action" value="ufb_export_form_action"/>
        <?php wp_nonce_field( 'ufb-export-nonce', 'ufb_export_nonce_field' ); ?>
        <div class="ufb-new-form-wrap">
            <div class="ufb-add-field-wrap">
                <label><?php _e( 'Choose Form to Export', UFB_TD ); ?></label>
                <div class="ufb-field">
                    <select name="form_id">
                        <option value=""><?php _e( 'Select one', UFB_TD ); ?></option>
                        <?php foreach ( $forms as $form ) {
                            ?>
                            <option value="<?php echo $form['form_id']; ?>"><?php echo $form['form_title']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <input type="submit" name="export_submit" value="<?php _e('Export',UFB_TD);?>" class="button-primary"/>
                </div>
            </div>
        </div>
    </form>
    
</div>