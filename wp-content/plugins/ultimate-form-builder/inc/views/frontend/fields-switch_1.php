<?php
$hidden = isset( $val[ 'hidden' ] ) ? 'style="display:none"' : '';

$condition_class = (isset( $display_conditions[ 'change_field' ] ) && in_array( $key, $display_conditions[ 'change_field' ] )) ? 'ufb-condition-trigger' : '';
//var_dump($condition_class);
if ( $condition_class != '' ) {
    $condition_keys = array_keys( $display_conditions[ 'change_field' ], $key );
//    UFB_Lib::print_array( $condition_keys );
//    $logic_key = array_search( $key, $display_conditions[ 'change_field' ] );
//
//    $logic = $display_conditions[ 'logic' ][ $logic_key ];
//    $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
//    $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
//    $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
}
//else {
//    $logic = '';
//    $logic_check_value = '';
//    $logic_action = '';
//    $effect_field = '';
//}

switch ( $field_type ) {
    case 'textfield':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <?php if($val['field_notes']!='0' && $val['note_text']!=''){?><div class="ufb-notes"></div><?php }?>
            <div class="ufb-form-field">
                <input type="text" name="<?php echo $key; ?>" class="ufb-form-textfield <?php echo $condition_class; ?>" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>" />
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>


                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'textarea':
        $rows = ($val[ 'textarea_rows' ] == '') ? 5 : $val[ 'textarea_rows' ];
        $cols = ($val[ 'textarea_columns' ] == '') ? 10 : $val[ 'textarea_columns' ];
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?> >
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <textarea name="<?php echo $key; ?>" class="ufb-form-textarea <?php echo $condition_class; ?>"  rows="<?php echo $rows; ?>" placeholder="<?php echo $val[ 'placeholder' ]; ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"><?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?></textarea>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'email':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <input type="email" name="<?php echo $key; ?>" class="ufb-email-field <?php echo $condition_class; ?>" data-error-message="<?php esc_attr( $val[ 'error_message' ] ); ?>" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'dropdown':
        $multiple = (isset( $val[ 'multiple' ] ) && $val[ 'multiple' ] == 1) ? 'multiple' : '';
        $name = (isset( $val[ 'multiple' ] ) && $val[ 'multiple' ] == 1) ? $key . '[]' : $key;
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <select name="<?php echo $name; ?>" class="ufb-form-dropdown <?php echo $condition_class; ?>" <?php echo $multiple; ?> data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>">
                    <?php
                    if ( isset( $val[ 'option' ] ) && count( $val[ 'option' ] ) > 0 ) {
                        $count = 0;
                        foreach ( $val[ 'option' ] as $option ) {
                            ?>
                            <option value="<?php echo $val[ 'value' ][ $count ] ?>"><?php echo $option; ?></option>
                            <?php
                            $count++;
                        }
                    }
                    ?>
                </select>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error" data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'radio':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php
                if ( isset( $val[ 'option' ] ) && count( $val[ 'option' ] ) > 0 ) {
                    $count = 0;
                    foreach ( $val[ 'option' ] as $option ) {
                        $for_id = $form_row[ 'form_id' ] . '-' . $key . '-' . $count;
                        ?>
                        <div class="ufb-sub-field-wrap">
                            <input type="radio" value="<?php echo $val[ 'value' ][ $count ] ?>" name="<?php echo $key ?>" class="ufb-form-radio <?php echo $condition_class; ?>" id="<?php echo $for_id; ?>"  data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <label for="<?php echo $for_id; ?>"><?php echo $option; ?></label>
                        </div>
                        <?php
                        $count++;
                    }
                }
                ?>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'checkbox':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php
                if ( isset( $val[ 'option' ] ) && count( $val[ 'option' ] ) > 0 ) {
                    $count = 0;
                    foreach ( $val[ 'option' ] as $option ) {
                        $for_id = $form_row[ 'form_id' ] . '-' . $key . '-' . $count;
                        ?>
                        <div class="ufb-sub-field-wrap">
                            <input type="checkbox" value="<?php echo $val[ 'value' ][ $count ] ?>" name="<?php echo $key ?>[]" class="ufb-form-checkbox <?php echo $condition_class; ?>" id="<?php echo $for_id; ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <label for="<?php echo $for_id; ?>"><?php echo $option; ?></label>
                        </div>
                        <?php
                        $count++;
                    }
                }
                ?>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error" data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'password':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <input type="password" name="<?php echo $key; ?>" class="ufb-form-password <?php echo $condition_class; ?>"  placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'hidden':
        ?>
        <input type="hidden" name="<?php echo $key ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>" id="<?php echo esc_attr( $val[ 'field_id' ] ); ?>" class="<?php echo esc_attr( $val[ 'field_class' ] ); ?>"/>
        <?php
        break;
    case 'number':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <input type="number" name="<?php echo $key; ?>" class="ufb-number-field <?php echo $condition_class; ?>" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>"  data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error" data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'submit':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <div class="ufb-form-field">
                <input type="submit" class="ufb-form-submit" name="<?php echo $key; ?>" value="<?php echo (isset( $val[ 'button_label' ] ) && $val[ 'button_label' ] != '') ? esc_attr( $val[ 'button_label' ] ) : __( 'Submit', UFB_TD ); ?>"/>
                <?php if ( isset( $val[ 'show_reset_button' ] ) ) { ?>
                    <input type="reset" class="ufb-form-reset" value="<?php echo (isset( $val[ 'reset_label' ] ) && $val[ 'reset_label' ] != '') ? esc_attr( $val[ 'reset_label' ] ) : __( 'Reset', UFB_TD ); ?>"/>
                <?php } ?>
                <span class="ufb-form-loader" style="display:none"></span>
            </div>
        </div>
        <?php
        break;
    case 'captcha':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php
                if ( $val[ 'captcha_type' ] == 'mathematical' ) {
                    $num1 = rand( 0, 9 );
                    $num2 = rand( 0, 9 );
                    ?>
                    <div class="ufb-math-captcha-wrap">
                        <span class="ufb-captcha-num"><?php echo $num1; ?></span> + <span><?php echo $num2; ?></span> = <input type="text" name="<?php echo $key; ?>" class="ufb-math-captcha-ans" placeholder="<?php echo (isset( $val[ 'placeholder' ] ) && $val[ 'placeholder' ] != '') ? esc_attr( $val[ 'placeholder' ] ) : __( 'Enter Sum', UFB_TD ); ?>"/>
                        <input type="hidden" name="<?php echo $key ?>_num_1" value="<?php echo $num1 ?>"/>
                        <input type="hidden" name="<?php echo $key ?>_num_2" value="<?php echo $num2 ?>"/>
                    </div>
                <?php } else {
                    ?>
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                    <div class="g-recaptcha" data-sitekey="<?php echo esc_attr( $val[ 'site_key' ] ); ?>"></div>
                    <input type="hidden" name="<?php echo $key ?>"/>
                <?php }
                ?>

                <div class="ufb-error" data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'datepicker':
        $date_format = ($val[ 'date_format_type' ] == 'pre_available') ? esc_attr( $val[ 'date_format' ] ) : esc_attr( $val[ 'custom' ] );
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="<?php echo $key; ?>" class="ufb-form-datepicker <?php echo $condition_class; ?>" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>" data-date-format = "<?php echo $date_format; ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'datepicker-daterange':
        $date_format = ($val[ 'date_format_type' ] == 'pre_available') ? esc_attr( $val[ 'date_format' ] ) : esc_attr( $val[ 'custom' ] );
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <div class="ufb-datepicker-daterange-wrap">
                    <span class="ufb-datepicker-daterange-label"><?php echo ($val[ 'from_label' ] != '') ? esc_attr( $val[ 'from_label' ] ) : __( 'From', UFB_TD ); ?></span>
                    <input type="text" name="<?php echo $key; ?>_from" class="ufb-form-datepicker" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>"  data-date-format = "<?php echo $date_format; ?>"/>
                </div>
                <div class="ufb-datepicker-daterange-wrap">
                    <span class="ufb-datepicker-daterange-label"><?php echo ($val[ 'to_label' ] != '') ? esc_attr( $val[ 'to_label' ] ) : __( 'To', UFB_TD ); ?></span>
                    <input type="text" name="<?php echo $key; ?>_to" class="ufb-form-datepicker" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>"  data-date-format = "<?php echo $date_format; ?>"/>
                </div>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'dropdown-date':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php if ( isset( $val[ 'show_date_block' ] ) ) {
                    ?>
                    <div class="ufb-date-wrap">
                        <?php
                        foreach ( $val[ 'date_fields_order' ] as $date_field ) {
                            if ( in_array( $date_field, $val[ 'date_fields' ] ) ) {
                                switch ( $date_field ) {
                                    case 'year':
                                        $from_year = ($val[ 'minimum_year' ] != '') ? esc_attr( $val[ 'minimum_year' ] ) : 1915;
                                        $to_year = ($val[ 'maximum_year' ] != '') ? esc_attr( $val[ 'maximum_year' ] ) : date( 'Y' );
                                        ?>
                                        <select name="<?php echo $key; ?>_year">
                                            <option value=""><?php _e( 'Year', UFB_TD ); ?></option>
                                            <?php
                                            for ( $year = $to_year; $year >= $from_year; $year-- ) {
                                                ?>
                                                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        break;
                                    case 'month':
                                        ?>
                                        <select name="<?php echo $key; ?>_month">
                                            <option value=""><?php _e( 'Month', UFB_TD ); ?></option>
                                            <?php
                                            for ( $month = 1; $month <= 12; $month++ ) {
                                                ?>
                                                <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        break;
                                    case 'day':
                                        ?>
                                        <select name="<?php echo $key; ?>_day">
                                            <option value=""><?php _e( 'Day', UFB_TD ); ?></option>
                                            <?php
                                            for ( $day = 1; $day <= 31; $day++ ) {
                                                ?>
                                                <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        break;
                                }
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
                if ( isset( $val[ 'show_time_block' ] ) ) {
                    ?>
                    <div class="ufb-time-wrap">
                        <select name="<?php echo $key; ?>_hour">
                            <option value=""><?php _e( 'HH', UFB_TD ); ?></option>
                            <?php
                            for ( $i = 1; $i <= $val[ 'time_format' ]; $i++ ) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <select name="<?php echo $key; ?>_minute">
                            <option value=""><?php _e( 'MM', UFB_TD ); ?></option>
                            <?php
                            for ( $i = 1; $i <= 60; $i++ ) {
                                ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php if ( $val[ 'time_format' ] == 12 ) {
                            ?>
                            <select name="<?php echo $key; ?>_time_format">
                                <option value="AM"><?php _e( 'AM', UFB_TD ); ?>
                                <option value="PM"><?php _e( 'PM', UFB_TD ); ?>
                            </select>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>

                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'dropdown-daterange':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <div class="ufb-form-from-wrap">
                    <span class="ufb-date-sub-label"><?php echo ($val[ 'from_label' ] == '') ? __( 'From', UFB_TD ) : esc_attr( $val[ 'from_label' ] ); ?></span>
                    <?php if ( isset( $val[ 'show_date_block' ] ) ) {
                        ?>
                        <div class="ufb-date-wrap">
                            <?php
                            foreach ( $val[ 'date_fields_order' ] as $date_field ) {
                                if ( in_array( $date_field, $val[ 'date_fields' ] ) ) {
                                    switch ( $date_field ) {
                                        case 'year':
                                            $from_year = ($val[ 'minimum_year' ] != '') ? esc_attr( $val[ 'minimum_year' ] ) : 1915;
                                            $to_year = ($val[ 'maximum_year' ] != '') ? esc_attr( $val[ 'maximum_year' ] ) : date( 'Y' );
                                            ?>
                                            <select name="<?php echo $key; ?>_from_year">
                                                <option value=""><?php _e( 'Year', UFB_TD ); ?></option>
                                                <?php
                                                for ( $year = $to_year; $year >= $from_year; $year-- ) {
                                                    ?>
                                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                        case 'month':
                                            ?>
                                            <select name="<?php echo $key; ?>_from_month">
                                                <option value=""><?php _e( 'Month', UFB_TD ); ?></option>
                                                <?php
                                                for ( $month = 1; $month <= 12; $month++ ) {
                                                    ?>
                                                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                        case 'day':
                                            ?>
                                            <select name="<?php echo $key; ?>_from_day">
                                                <option value=""><?php _e( 'Day', UFB_TD ); ?></option>
                                                <?php
                                                for ( $day = 1; $day <= 31; $day++ ) {
                                                    ?>
                                                    <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                    }
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                    if ( isset( $val[ 'show_time_block' ] ) ) {
                        ?>
                        <div class="ufb-time-wrap">
                            <select name="<?php echo $key; ?>_from_hour">
                                <option value=""><?php _e( 'HH', UFB_TD ); ?></option>
                                <?php
                                for ( $i = 1; $i <= $val[ 'time_format' ]; $i++ ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="<?php echo $key; ?>_from_minute">
                                <option value=""><?php _e( 'MM', UFB_TD ); ?></option>
                                <?php
                                for ( $i = 1; $i <= 60; $i++ ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php if ( $val[ 'time_format' ] == 12 ) {
                                ?>
                                <select name="<?php echo $key; ?>_from_time_format">
                                    <option value="AM"><?php _e( 'AM', UFB_TD ); ?>
                                    <option value="PM"><?php _e( 'PM', UFB_TD ); ?>
                                </select>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>


                </div>
                <div class="ufb-date-from-wrap">
                    <span class="ufb-date-sub-label"><?php echo ($val[ 'to_label' ] == '') ? __( 'To', UFB_TD ) : esc_attr( $val[ 'to_label' ] ); ?></span>
                    <?php if ( isset( $val[ 'show_date_block' ] ) ) {
                        ?>
                        <div class="ufb-date-wrap">
                            <?php
                            foreach ( $val[ 'date_fields_order' ] as $date_field ) {
                                if ( in_array( $date_field, $val[ 'date_fields' ] ) ) {
                                    switch ( $date_field ) {
                                        case 'year':
                                            $from_year = ($val[ 'minimum_year' ] != '') ? esc_attr( $val[ 'minimum_year' ] ) : 1915;
                                            $to_year = ($val[ 'maximum_year' ] != '') ? esc_attr( $val[ 'maximum_year' ] ) : date( 'Y' );
                                            ?>
                                            <select name="<?php echo $key; ?>_to_year">
                                                <option value=""><?php _e( 'Year', UFB_TD ); ?></option>
                                                <?php
                                                for ( $year = $to_year; $year >= $from_year; $year-- ) {
                                                    ?>
                                                    <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                        case 'month':
                                            ?>
                                            <select name="<?php echo $key; ?>_to_month">
                                                <option value=""><?php _e( 'Month', UFB_TD ); ?></option>
                                                <?php
                                                for ( $month = 1; $month <= 12; $month++ ) {
                                                    ?>
                                                    <option value="<?php echo $month; ?>"><?php echo $month; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                        case 'day':
                                            ?>
                                            <select name="<?php echo $key; ?>_to_day">
                                                <option value=""><?php _e( 'Day', UFB_TD ); ?></option>
                                                <?php
                                                for ( $day = 1; $day <= 31; $day++ ) {
                                                    ?>
                                                    <option value="<?php echo $day; ?>"><?php echo $day; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <?php
                                            break;
                                    }
                                }
                            }
                            ?>
                        </div>
                        <?php
                    }
                    if ( isset( $val[ 'show_time_block' ] ) ) {
                        ?>
                        <div class="ufb-time-wrap">
                            <select name="<?php echo $key; ?>_to_hour">
                                <option value=""><?php _e( 'HH', UFB_TD ); ?></option>
                                <?php
                                for ( $i = 1; $i <= $val[ 'time_format' ]; $i++ ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="<?php echo $key; ?>_to_minute">
                                <option value=""><?php _e( 'MM', UFB_TD ); ?></option>
                                <?php
                                for ( $i = 1; $i <= 60; $i++ ) {
                                    ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <?php if ( $val[ 'time_format' ] == 12 ) {
                                ?>
                                <select name="<?php echo $key; ?>_to_time_format">
                                    <option value="AM"><?php _e( 'AM', UFB_TD ); ?>
                                    <option value="PM"><?php _e( 'PM', UFB_TD ); ?>
                                </select>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>


                </div>
            </div>
            <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
        </div>	
        <?php
        break;
    case 'ui-slider':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php if ( $val[ 'slider_type' ] == 'default' ) { ?>
                    <div class="ufb-ui-slider" data-min-value="<?php echo ($val[ 'min_value' ] != '') ? esc_attr( $val[ 'min_value' ] ) : 0; ?>" data-max-value="<?php echo ($val[ 'max_value' ] != '') ? esc_attr( $val[ 'max_value' ] ) : 100; ?>" data-step="<?php echo ($val[ 'slider_step' ] != '') ? esc_attr( $val[ 'slider_step' ] ) : 100; ?>" data-pre-value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"></div>
                    <span class="ufb-slider-value"><?php echo ($val[ 'pre_selected_value' ] != '') ? esc_attr( $val[ 'pre_selected_value' ] ) : 0; ?></span>

                <?php } else {
                    ?>
                    <div class="ufb-range-slider" data-min-value="<?php echo ($val[ 'min_value' ] != '') ? esc_attr( $val[ 'min_value' ] ) : 0; ?>" data-max-value="<?php echo ($val[ 'max_value' ] != '') ? esc_attr( $val[ 'max_value' ] ) : 100; ?>" data-step="<?php echo ($val[ 'slider_step' ] != '') ? esc_attr( $val[ 'slider_step' ] ) : 100; ?>" data-pre-value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"></div>
                    <span class="ufb-slider-value"><?php echo ($val[ 'pre_selected_value' ] != '') ? esc_attr( $val[ 'pre_selected_value' ] ) : '0-0'; ?></span>
                <?php }
                ?>
                <input type="hidden" name="<?php echo $key; ?>" class="ufb-ui-slider-value" value="<?php echo esc_attr( $val[ 'pre_selected_value' ] ); ?>"/>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'file-uploader':
        $upload_button_label = ($val[ 'upload_button_label' ] == '') ? __( 'Upload a file', UFB_TD ) : esc_attr( $val[ 'upload_button_label' ] );
        $extensions = isset( $val[ 'extension' ] ) ? implode( ',', $val[ 'extension' ] ) : 'jpg,jpeg,JPG,JPEG,gif,GIF,png,PNG';
        $custom_extensions = esc_attr( $val[ 'custom_extension' ] );
        $extensions = ($custom_extensions != '') ? $extensions . ',' . $custom_extensions : $extensions;
        $extension_error_msg = ($val[ 'extension_error_message' ] == '') ? __( '{file} has invalid extension. Only {extensions} are allowed.', UFB_TD ) : esc_attr( $val[ 'extension_error_message' ] );
        $multiple_uploads = isset( $val[ 'multiple_uploads' ] ) ? 'true' : 'false';
        $multiple_upload_limit = ($val[ 'allowed_number' ] == '') ? '-1' : esc_attr( $val[ 'allowed_number' ] );
        $multiple_upload_error_message = ($val[ 'upload_limit_error_message' ] == '') ? __( 'Maximum number for file uploads exceeded', UFB_TD ) : esc_attr( $val[ 'upload_limit_error_message' ] );
        $max_upload_size = ($val[ 'max_upload_size' ] == '') ? 8 * 1000000 : esc_attr( $val[ 'max_upload_size' ] ) * 1000000;
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <div class="ufb-file-uploader" id="ufb-file-uploader-<?php echo rand( 1000, 9999 ); ?>" data-upload-label="<?php echo $upload_button_label; ?>" data-extensions="<?php echo $extensions; ?>" data-multiple-uploads="<?php echo $multiple_uploads; ?>" data-multiple-upload-limit="<?php echo $multiple_upload_limit; ?>" data-multiple-upload-error-message="<?php echo $multiple_upload_error_message; ?>" data-max-upload-size="<?php echo $max_upload_size; ?>" data-extension-error-message="<?php echo $extension_error_msg; ?>"></div>
                <div class="ufb-file-preview">

                </div>
                <input type="hidden" name="<?php echo $key; ?>" class="ufb-uploaded-files"/>
                <input type="hidden" class="ufb-multiple-upload-limit" value="0"/>

                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'custom-texts':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <div class="ufb-form-field">
                <?php echo $val[ 'custom_text' ]; ?>
            </div>
        </div>	
        <?php
        break;
    case 'agreement-block':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <div class="ufb-form-field">
                <input type="checkbox" name="<?php echo $key; ?>" value="1"/><div class="ufb-agreement-text"><?php echo $val[ 'agreement_text' ]; ?></div>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'google-map-address':
        break;
    case 'url':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <input type="text" name="<?php echo $key; ?>" class="ufb-form-textfield <?php echo $condition_class; ?>" placeholder="<?php echo esc_attr( $val[ 'placeholder' ] ); ?>" value="<?php echo esc_attr( $val[ 'pre_filled_value' ] ); ?>" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                <?php
                if ( $condition_class != '' ) {
                    ?>
                    <div class="ufb-conditions-wrap" style="display:none;">
                        <?php
                        foreach ( $condition_keys as $logic_key ) {
                            $logic = $display_conditions[ 'logic' ][ $logic_key ];
                            $logic_check_value = $display_conditions[ 'logic_check_field' ][ $logic_key ];
                            $logic_action = $display_conditions[ 'logic_action' ][ $logic_key ];
                            $effect_field = $display_conditions[ 'effect_field' ][ $logic_key ];
                            ?>
                            <input type="hidden" class="ufb-logic-refs" data-logic="<?php echo $logic; ?>" data-logic-check-value="<?php echo $logic_check_value; ?>" data-logic-action="<?php echo $logic_action; ?>" data-effect-field="<?php echo $effect_field; ?>"/>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'wysiwyg':
        $editor_type = $val[ 'editor_type' ];
        switch ( $editor_type ) {
            case 'rich':
                $teeny = false;
                $show_quicktags = true;
                break;
            case 'visual':
                $teeny = false;
                $show_quicktags = false;
                break;
            case 'text':
                $teeny = true;
                $show_quicktags = true;
                add_filter( 'user_can_richedit', create_function( '', 'return false;' ), 50 );
                break;
        }
        $settings = array(
            'textarea_name' => $key,
            'media_buttons' => false,
            'teeny' => $teeny,
            'wpautop' => true,
            'quicktags' => $show_quicktags,
            'editor_class' => 'ufb-wp-editor',
            'textarea_rows' => ($val[ 'total_rows' ] == '') ? 10 : esc_attr( $val[ 'total_rows' ] )
        );
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <?php wp_editor( $val[ 'pre_filled_value' ], $key, $settings ); ?>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>	
        <?php
        break;
    case 'star-rating':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <fieldset class="rating">
                    <?php
                    $count = 0;
                    foreach ( $val[ 'value' ] as $star_value ) {
                        ?>
                        <input type="radio" id="<?php echo $key; ?>_star<?php echo $count + 1; ?>" name="<?php echo $key; ?>" value="<?php echo esc_attr( $star_value ); ?>" />
                        <label class = "full" for="<?php echo $key; ?>_star<?php echo $count + 1; ?>" title="<?php echo esc_attr( $val[ 'label' ][ $count ] ); ?>"></label>
                        <?php
                        $count++;
                    }
                    ?>
                </fieldset>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>

        <?php
        break;

    case 'like-dislike':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <span class="ufb-thumb ufb-like"><i class="fa fa-thumbs-up"></i><span class="ufb-thumb-value"><?php echo ($val[ 'like_thumb_value' ] != '') ? esc_attr( $val[ 'like_thumb_value' ] ) : __( 'Like', UFB_TD ); ?></span></span>
                <span class="ufb-thumb ufb-dislike"><i class="fa fa-thumbs-down"></i><span class="ufb-thumb-value"><?php echo ($val[ 'dislike_thumb_value' ] != '') ? esc_attr( $val[ 'dislike_thumb_value' ] ) : __( 'Dislike', UFB_TD ); ?></span></span>
                <input type="hidden" name="<?php echo $key; ?>" class="ufb-thumb-store-value"/>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    case 'choice-matrix':
        ?>
        <div data-field-id="<?php echo $key; ?>" class="ufb-form-field-wrap <?php echo ($val[ 'field_class' ] != '') ? esc_attr( $val[ 'field_class' ] ) : ''; ?>" <?php echo ($val[ 'field_id' ] != '') ? 'id="' . esc_attr( $val[ 'field_id' ] ) . '"' : ''; ?> <?php echo $hidden; ?>>
            <label class="ufb-choice-matrix-label"><?php echo esc_attr( $val[ 'field_label' ] ); ?></label>
            <div class="ufb-form-field">
                <table class="ufb-choice-matrix-table">
                    <thead>
                    <td></td>
                    <?php
                    $count = 0;
                    foreach ( $val[ 'matrix_column_label' ] as $column_label ) {
                        $count++;
                        ?>
                        <td><?php echo ($column_label != '') ? esc_attr( $column_label ) : __( 'Heading', UFB_TD ) . ' ' . $i; ?></td>
                        <?php
                        if($val[ 'matrix_column' ]==$count)
                            break;
                    }
                    ?>

                    </thead>
                    <?php
                    $row_count = 0;
                    foreach ( $val[ 'matrix_row_value' ] as $matrix_row_label ) {
                        $row_count++;
                        ?>
                        <tr>
                            <td><?php echo esc_attr( $matrix_row_label ); ?></td>
                            <?php for ( $i = 1; $i <= $val[ 'matrix_column' ]; $i++ ) {
                                ?>
                                <td>
                                    <input type="radio" name="<?php echo $key; ?>_matrix_row_<?php echo $row_count; ?>" value="<?php echo $val[ 'matrix_column_label' ][ 'heading' . $i ]; ?>"/>
                                </td>
                                <?php
                            }
                            ?>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <div class="ufb-error"  data-error-key="<?php echo $key; ?>"></div>
            </div>
        </div>
        <?php
        break;
    default:
        break;
} //switch close