<?php
$form_detail = maybe_unserialize( $form_row['form_detail'] );
$form_design = $form_detail['form_design'];
$display_conditions = isset( $form_detail['conditional_logic']['display_logic'] ) ? $form_detail['conditional_logic']['display_logic'] : array();
$form_design['form_template'] = str_replace('ufbl','ufb',$form_design['form_template']);
$form_template_class = (!isset( $form_design['disable_plugin_style'] )) ? $form_design['form_template'] : 'ufb-no-design-template';
$form_width = (isset( $form_design['form_width'] ) && $form_design['form_width'] != '') ? esc_attr( $form_design['form_width'] ) : '100%';

?>
<div class="ufb-form-wrapper <?php echo $form_template_class; ?>" style="width:<?php echo $form_width; ?>;">
    <form method="post" action="" class="ufb-front-form">
        <div class="ufb-inner-form-wrap">
        <?php if ( !isset( $form_design['hide_form_title'] ) ) { ?><div class="ufb-form-title"><?php echo (isset( $form_row['form_title'] ) && $form_row['form_title'] != '') ? esc_attr( $form_row['form_title'] ) : __( 'Contact Form', UFB_TD ); ?></div><?php } ?>
        <?php do_action( 'ufb_form_start' ); ?>
        <input type="hidden" name="form_id" value="<?php echo $form_row['form_id']; ?>" class="form-id"/>
        <?php
        if ( $form_row['form_type'] == 'multi' ) {
            $total_steps = isset( $form_detail['field_steps']['total_steps'] ) ? esc_attr( $form_detail['field_steps']['total_steps'] ) : 1;
            
            if ( !isset( $form_design['hide_multi_heading'] ) ) {
                ?>
                <div class="ufb-steps-heading-wrap">
                    <?php
                    for ( $j = 1; $j <= $total_steps; $j++ ) {
                        $step_details = $form_detail['field_steps']['step' . $j . '_details'];
                        $step_title = ($step_details['step_title'] != '') ? esc_attr( $step_details['step_title'] ) : __( 'Step', UFB_TD ) . ' ' . $j;
                        ?>
                        <div class="ufb-each-step-heading <?php echo ($j==1)?'ufb-complete-step ufb-first-step':'ufb-incomplete-step';?>" data-step-ref="<?php echo $j;?>">
                            <span class="ufb-step-title"><?php echo $step_title;?></span>
                            <span class="ufb-step-radio"></span>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            }
           // echo $total_steps;
            for ( $j = 1; $j <= $total_steps; $j++ ) {
                ?>
                <div class="ufb-each-step-wrap" data-step-ref='<?php echo $j; ?>' <?php if ( $j != 1 ) { ?>style="display: none;"<?php } ?>>
                    <?php
                    $step_details = $form_detail['field_steps']['step' . $j . '_details'];
                    $step_fields = $form_detail['field_steps']['step' . $j . '_fields'];
                    $step_fields_array = explode( ',', $step_fields );
                    if ( isset( $step_details['show_step_title'] ) ) {
                        $step_title = ($step_details['step_title'] != '') ? esc_attr( $step_details['step_title'] ) : __( 'Step', UFB_TD ) . ' ' . $j;
                        ?>
                        <div class="ufb-step-title"><?php echo $step_title; ?></div>
                        <?php
                    }
                    if ( !empty( $step_fields_array ) ) {
                        foreach ( $step_fields_array as $key ) {
                            if(isset($form_detail['field_data'][$key])){
                                $val = $form_detail['field_data'][$key];
                            $field_type = $val['field_type'];
                            include(UFB_PATH . '/inc/views/frontend/fields-switch.php');
                            }
                            
                        }
                    }
                    ?>
                    <div class="ufb-step-actions-wrap">
                        <?php
                                      //      UFB_Lib::print_array($step_details);
                        if ( $j != 1 && isset( $step_details['show_back'] ) ) {
                            $back_button_label = ($step_details['back_button_label'] != '') ? esc_attr( $step_details['back_button_label'] ) : __( 'Back', UFB_TD );
                            ?>
                            <input type="button" class="ufb-back-step" value="<?php echo $back_button_label; ?>" data-back-ref="<?php echo $j - 1; ?>"/>
                            <?php
                        }
                        if ( isset( $step_details['show_next'] ) ) {
                            $next_button_label = ($step_details['next_button_label'] != '') ? esc_attr( $step_details['next_button_label'] ) : __( 'Next', UFB_TD );
                            $step_class = ($j == $total_steps ) ? 'ufb-final-step' : 'ufb-next-step';
                            ?>
                            <input type="button" class="<?php echo $step_class; ?>" value="<?php echo $next_button_label; ?>" data-step-ref="<?php echo $j; ?>"/>
                            <span class="ufb-form-loader" style="display:none;"></span>
                            <?php
                        }
                        ?>

                    </div>
                        <div class="ufb-step-error" data-step-ref="<?php echo $j; ?>" data-step-error-message="<?php echo $form_design['form_error_message']?>" style="display:none"></div>
                </div>
                <?php
            }
        } else {
            foreach ( $form_detail['field_data'] as $key => $val ) {
                if ( isset( $val['field_type'] ) ) {
                    $field_type = $val['field_type'];
                    include(UFB_PATH . '/inc/views/frontend/fields-switch.php');
                }//foreach close
            }
        }
        ?>
        </div>
        <div class="ufb-form-message" style="display: none;"></div>
        <input type="hidden" name="user_ip" value="<?php echo UFB_Lib::get_client_ip(); ?>"/>
        <input type="hidden" name="page_url" value="<?php echo UFB_Lib::currentPageURL(); ?>"/>
        <input type="hidden" name="user_logged_in" value="<?php echo (is_user_logged_in()) ? __( 'Yes', UFB_TD ) : __( 'No', UFB_TD ); ?>"/>
        <input type="hidden" name="loggedin_username" value="<?php echo UFB_Lib::get_loggedin_username(); ?>"/>
        <input type="hidden" name="loggedin_user_email" value="<?php echo UFB_Lib::get_loggedin_user_email(); ?>"/>
        <?php do_action( 'ufb_form_end' ); ?>
    </form>
 
</div>


