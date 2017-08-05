<div class="ufb-each-form-field ufb-relative">
    <span class="ufb-drag-arrow"><i class="fa fa-arrows"></i></span>
    <div class="ufb-form-field-wrap">
        <label class="ufb-field-label-ref"><?php echo ($val[ 'field_label' ] != '') ? esc_attr( $val[ 'field_label' ] ) : __( 'Untitled Custom Texts', UFB_TD ); ?></label>
        <div class="ufb-form-field">
            <?php
            $default_custom_text = __( '<p><strong>Note:</strong>Please double check your <strong>email</strong> and <strong>username</strong> before submitting the form.</p>', UFB_TD );
            echo ($val[ 'custom_text' ] == '') ? $default_custom_text : html_entity_decode( $val[ 'custom_text' ] );
            ?>
        </div>
    </div>
    <div class="ufb-field-controls">
        <a href="javascript:void(0)" class="ufb-field-settings-trigger button-primary"><?php _e( 'Settings', UFB_TD ); ?></a><span>+</span>
        <a href="javascript:void(0)" class="ufb-field-delete-trigger">Delete</a>
    </div>
    <div class="ufb-field-settings-wrap" style="display:none;">
        <span class="ufb-up-arrow"></span>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Field Label', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This label won\'t show up in the form.Its just the reference for you to recognize the field.', UFB_TD ) );
                ?>
            </label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_label]" placeholder="<?php _e( 'Extra Notes', UFB_TD ); ?>" class="ufb-field-label-field ufb-field" value="<?php echo esc_attr( $val[ 'field_label' ] ); ?>"/>
            </div>
        </div>

        <div class="ufb-form-field-wrap ufb-full-width">
            <label><?php _e( 'Custom Text', UFB_TD ); ?><?php echo UFB_Lib::generate_help_text( __( 'You can use basic html tags such as &lt;p>, &lt;strong>,&lt;u>, &lt;em>, &lt;ul> &lt;li>, &lt;quote>, &lt;a> etc. ', UFB_TD ) ); ?></label>
            <div class="ufb-form-field">
                <textarea name="field_data[<?php echo $key; ?>][custom_text]"><?php echo html_entity_decode( $val[ 'custom_text' ] ); ?></textarea>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'ID of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_id]" value="<?php echo esc_attr( $val[ 'field_id' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label><?php _e( 'Class of the field', UFB_TD ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="field_data[<?php echo $key; ?>][field_class]" value="<?php echo esc_attr( $val[ 'field_class' ] ); ?>"/>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Column', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'This is the column wise display of your field.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <?php $column = isset( $val[ 'column' ] ) ? $val[ 'column' ] : '1' ?>
                <select name="field_data[<?php echo $key; ?>][column]">
                    <option value="1" <?php selected( $column, '1' ); ?>>1</option>
                    <option value="2" <?php selected( $column, '2' ); ?>>2</option>
                    <option value="3" <?php selected( $column, '3' ); ?>>3</option>
                    <option value="4" <?php selected( $column, '4' ); ?>>4</option>
                </select>
            </div>
        </div>
        <div class="ufb-form-field-wrap">
            <label>
                <?php _e( 'Hidden by Default', UFB_TD ); ?>
                <?php echo UFB_Lib::generate_help_text( __( 'Check if you want to hide this element at the beginning of the form load. It is useful when you want show with some conditional logic.', UFB_TD ) ); ?>
            </label>
            <div class="ufb-form-field">
                <input type="checkbox" name="field_data[<?php echo $key; ?>][hidden]" value="1" <?php echo (isset( $val[ 'hidden' ] ) && $val[ 'hidden' ] == 1) ? 'checked="checked"' : ''; ?>/>
            </div>
        </div>
        <input type="hidden" name="field_data[<?php echo $key; ?>][field_type]" value="custom-texts" />
    </div>
</div><!--ufb-each-form-field-->


