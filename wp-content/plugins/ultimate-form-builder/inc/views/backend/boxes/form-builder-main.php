<div class="ufb-tab-content" id="ufb-form-builder-tab">
    <?php
    $form_detail = maybe_unserialize( $form_row['form_detail'] );
    if ( $form_row['form_type'] == 'multi' ) {
        ?>
    
        <div class="ufb-step-wrap">
            <ul class="ufb-form-steps">
                <?php
                $total_steps = isset( $form_detail['field_steps']['total_steps'] ) ? esc_attr( $form_detail['field_steps']['total_steps'] ) : 1;
                for ( $j = 1; $j <= $total_steps; $j++ ) {
                    ?>
                    <li data-step-ref='<?php echo $j; ?>' class="ufb-step-trigger<?php if ( $j == 1 ) { ?> ufb-step-active-trigger<?php } ?>"><?php _e( 'Step', UFB_TD ); ?> <?php echo $j; ?></li>
                    <?php
                }
                ?>
            </ul>
            <input type="button" class="button button-primary ufb-step-adder" value="<?php _e( 'Add another step' ); ?>"/>
            <input type="button" class="button button-primary ufb-step-remover" value="<?php _e( 'Delete step' ); ?>" data-confirm-message="<?php _e( 'Are you sure you want to delete the step?', UFB_TD ); ?>"/>
        </div>
    <div class="ufb-field-note"><?php _e('Note: Please don\'t include submit button in the multistep form. Enable next button from the step details for the last step which will work as the submit button.',UFB_TD);?></div>
    <?php } ?>
    <ul class="ufb-form-element-groups">
        <li class="ufb-group-trigger ufb-group-active-trigger" data-group-ref="html"><?php _e( 'HTML Elements', UFB_TD ); ?></li>
        <li class="ufb-group-trigger" data-group-ref="ui"><?php _e( 'UI Elements', UFB_TD ); ?></li>
        <li class="ufb-group-trigger" data-group-ref="custom"><?php _e( 'Custom Elements', UFB_TD ); ?></li>
        <li class="ufb-group-trigger" data-group-ref="survey"><?php _e( 'Survey Elements', UFB_TD ); ?></li>
        
    </ul>
    <div class="ufb-form-element-outerwrap">
        <div class="ufb-form-elements-wrap">
            <div class="ufb-form-elements-inner-wrap ufb-relative">
                <div class="ufb-elements-group" data-group-type="html">
                    <span class="ufb-form-element-title"><?php _e( 'HTML Elements', UFB_TD ); ?></span>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Single Line Textfield', UFB_TD ); ?>" data-field-type="textfield">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Multiple Line Textfield', UFB_TD ); ?>" data-field-type="textarea">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Email Address', UFB_TD ); ?>" data-field-type="email">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Dropdown Menu', UFB_TD ); ?>" data-field-type="dropdown">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Radio Button', UFB_TD ); ?>" data-field-type="radio">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Checkbox', UFB_TD ); ?>" data-field-type="checkbox">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Password', UFB_TD ); ?>" data-field-type="password">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Hidden Field', UFB_TD ); ?>" data-field-type="hidden">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Number Field', UFB_TD ); ?>" data-field-type="number">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Submit Button', UFB_TD ); ?>" data-field-type="submit">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Captcha', UFB_TD ); ?>" data-field-type="captcha">
                </div>
                <div class="ufb-elements-group" data-group-type="ui" style="display:none;">
                    <span class="ufb-form-element-title"><?php _e( 'UI Elements', UFB_TD ); ?></span>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Datepicker', UFB_TD ); ?>" data-field-type="datepicker">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Datepicker Date Range', UFB_TD ); ?>" data-field-type="datepicker-daterange">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Dropdown Date', UFB_TD ); ?>" data-field-type="dropdown-date">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Dropdown Date Range', UFB_TD ); ?>" data-field-type="dropdown-daterange">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'UI Slider', UFB_TD ); ?>" data-field-type="ui-slider">
                </div>
                <div class="ufb-elements-group" data-group-type="custom" style="display:none;">
                    <span class="ufb-form-element-title"><?php _e( 'Custom Elements', UFB_TD ); ?></span>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'File Uploader', UFB_TD ); ?>" data-field-type="file-uploader">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Custom Texts', UFB_TD ); ?>" data-field-type="custom-texts">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Agreement Block', UFB_TD ); ?>" data-field-type="agreement-block">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'URL Field', UFB_TD ); ?>" data-field-type="url"> 
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'WYSIWYG', UFB_TD ); ?>" data-field-type="wysiwyg"> 

                    <?php 
                    if($country_table_flag == 1){
                        ?>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Countries Dropdown', UFB_TD ); ?>" data-field-type="country-dropdown"> 
                    <?php } ?>
                    <?php
                    
                     if($state_table_flag == 1){ ?>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'States Dropdown', UFB_TD ); ?>" data-field-type="states-dropdown"> 
                    <?php } ?>
                    <?php
                    
                     if($city_table_flag == 1){ ?>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'City Dropdown', UFB_TD ); ?>" data-field-type="city-dropdown"> 
                    <?php } ?>
                </div>
                <div class="ufb-elements-group" data-group-type="survey" style="display:none;">
                    <span class="ufb-form-element-title"><?php _e( 'Survey Elements', UFB_TD ); ?></span>
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Star Ratings', UFB_TD ); ?>" data-field-type="star-rating">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Like Dislike Thumb', UFB_TD ); ?>" data-field-type="like-dislike">
                    <input type="button" class="button-primary ufb-form-element" value="<?php _e( 'Choice Matrix', UFB_TD ); ?>" data-field-type="choice-matrix">
                </div>
               </div>
        </div>

        <input type="hidden" name="action" value="ufb_form_action"/>
        <div class="ufb-form-wrap">
            <div class="ufb-form-innner-wrap ufb-relative">
                <span class="ufb-form-title"><?php echo esc_attr( $form_row['form_title'] ); ?></span>
                <div class="ufb-form-field-holder">
                    <?php
                    if ( $form_row['form_type'] == 'multi' ) {
                        for ( $j = 1; $j <= $total_steps; $j++ ) {
                            ?> 
                            <div class="ufb-each-step-wrap" data-step-ref="<?php echo $j; ?>" <?php if ( $j != 1 ) { ?>style="display: none;"<?php } ?>>
                                <div class="ufb-step-title"><?php echo _e( 'Step', UFB_TD ); ?> <?php echo $j; ?></div>
                                <ul class="ufb-step-details-actions">
                                    <li class="ufb-step-actions-triggers ufb-active-step-action" data-action="fields"><?php _e( 'Fields', UFB_TD ); ?></li>
                                    <li class="ufb-step-actions-triggers" data-action="details"><?php _e( 'Step Details', UFB_TD ); ?></li>
                                </ul>
                                <div class="ufb-step-fields-wrap">
                                    <?php
                                    $step_fields = isset($form_detail['field_steps']['step' . $j . '_fields'])?$form_detail['field_steps']['step' . $j . '_fields']:'';
                                    $step_fields_array = explode( ',', $step_fields );
                                    foreach ( $step_fields_array as $field_key ) {
                                        $key = $field_key;
                                        if(isset($form_detail['field_data'][$field_key])){
                                        $val = $form_detail['field_data'][$field_key];
                                        $field_type = $val['field_type'];
                                        include(UFB_PATH . '/inc/views/backend/fields-type-switch.php');
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="ufb-step-details-wrap" style="display:none">
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Show Step Title', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php
                                            $show_step_title = (isset( $form_detail['field_steps']['step' . $j . '_details']['show_step_title'] )) ? 1 : 0;
                                            ?>
                                            <input type="checkbox" name="field_steps[step<?php echo $j; ?>_details][show_step_title]" value="1" <?php checked( $show_step_title, true ); ?>/>
                                        </div>
                                    </div>
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Step Title', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php $step_title = isset( $form_detail['field_steps']['step' . $j . '_details']['step_title'] ) ? $form_detail['field_steps']['step' . $j . '_details']['step_title'] : ''; ?>
                                            <input type="text" name="field_steps[step<?php echo $j; ?>_details][step_title]" value="<?php echo esc_attr( $step_title ); ?>"/>
                                        </div>
                                    </div>
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Show Back Button', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php $show_back_button = (isset( $form_detail['field_steps']['step' . $j . '_details']['show_back'] )) ? 1 : 0; ?>
                                            <input type="checkbox" name="field_steps[step<?php echo $j; ?>_details][show_back]" value="1" <?php checked( $show_back_button, true ); ?>/>
                                        </div>
                                    </div>
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Back Button Label', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php $back_button_label = isset( $form_detail['field_steps']['step' . $j . '_details']['back_button_label'] ) ? $form_detail['field_steps']['step' . $j . '_details']['back_button_label'] : ''; ?>
                                            <input type="text" name="field_steps[step<?php echo $j; ?>_details][back_button_label]" placeholder="<?php _e( 'Back', UFB_TD ); ?>" value="<?php echo esc_attr( $back_button_label ); ?>"/>
                                        </div>
                                    </div>
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Show Next Step Button', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php $show_next_button = (isset( $form_detail['field_steps']['step' . $j . '_details']['show_next'] )) ? 1 : 0; ?>
                                            <input type="checkbox" name="field_steps[step<?php echo $j; ?>_details][show_next]" value="1" <?php checked( $show_next_button, true ); ?>/>
                                        </div>
                                    </div>
                                    <div class="ufb-form-field-wrap">
                                        <label><?php _e( 'Next Button Label', UFB_TD ); ?></label>
                                        <div class="ufb-form-field">
                                            <?php $next_button_label = isset( $form_detail['field_steps']['step' . $j . '_details']['next_button_label'] ) ? $form_detail['field_steps']['step' . $j . '_details']['next_button_label'] : ''; ?>
                                            <input type="text" name="field_steps[step<?php echo $j; ?>_details][next_button_label]"  placeholder="<?php _e( 'Next', UFB_TD ); ?>" value="<?php echo esc_attr( $next_button_label ) ?>"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        if ( !empty( $form_detail ) ) {
                            foreach ( $form_detail['field_data'] as $key => $val ) {
                                $field_type = $val['field_type'];
                                include(UFB_PATH . '/inc/views/backend/fields-type-switch.php');
                            }
                        }
                    }
                    ?>

                </div>
                <input type="hidden" name="form_title" value="<?php echo esc_attr( $form_row['form_title'] ); ?>" class="ufb-form-title-field"/>
                <input type="hidden" name="form_id" value="<?php echo esc_attr( $form_row['form_id'] ); ?>" class="ufb-form-id"/>
                <input type="hidden" name="form_key_count" value="<?php echo (isset( $form_detail['form_key_count'] ) && $form_detail['form_key_count'] != '') ? $form_detail['form_key_count'] : 0; ?>" class="ufb-form-key-count"/>
                <input type="hidden" class="ufb-form-type" value="<?php echo isset( $form_row['form_type'] ) ? esc_attr( $form_row['form_type'] ) : 'single'; ?>"/>


                <?php
                if ( $form_row['form_type'] == 'multi' ) {
                    ?>
                    <!--Field Step Data -->
                    <input type="hidden" name="field_steps[total_steps]" value="<?php echo $total_steps; ?>" class="ufb-field-total-steps"/>
                    <?php
                    for ( $j = 1; $j <= $total_steps; $j++ ) {
                        ?>
                        <input type="hidden" name="field_steps[step<?php echo $j; ?>_fields]" data-step-fields-ref='<?php echo $j; ?>' value="<?php echo isset( $form_detail['field_steps']['step' . $j . '_fields'] ) ? esc_attr( $form_detail['field_steps']['step' . $j . '_fields'] ) : ''; ?>"/>
                        <?php
                    }
                }
                ?>

                <!--Field Step Data -->
            </div>
        </div>
        <?php wp_nonce_field( 'ufb-form-nonce', 'ufb_form_nonce_field' ); ?>

        <div class="ufb-clear"></div>
        <div class="ufb-form-controls ufb-text-align-right">
            <input type="button" class="button-primary ufb-save-form" value="<?php _e( 'Save Form', UFB_TD ); ?>"/>
            <a href="<?php echo site_url( '?ufb_form_preview=true&ufb_form_id=' . $form_row['form_id'] ); ?>" target="_blank"><input type="button" class="button-primary" value="<?php _e( 'Preview', UFB_TD ); ?>"/></a>
            <div class="ufb-field-note"><?php _e( 'Note: Please save form before preview.', UFB_TD ); ?></div>
        </div>
        <div class="ufb-clear"></div>
    </div>

</div>