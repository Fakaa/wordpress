<div class="ufb-entry-detail-wrap">
    <div class="ufb-relative">
        <span class="ufb-entry-detail-close">X</span>
        <?php
        if ( $entry_row != NULL && !empty( $entry_row ) ) {
            ?>
            <h3><?php echo esc_attr( $entry_row['form_title'] ); ?></h3>
            <ul class="ufb-entry-detail-tab">
                <li class="ufb-active-entry-tab" data-entry-tab="basic"><a href="javascript:void(0)"><?php _e( 'Entry Detail', UFB_TD ); ?></a></li>
                <li><a href="javascript:void(0)" data-entry-tab="extra"><?php _e( 'Extra Detail', UFB_TD ); ?></a></li>
            </ul>
            <div class="ufb-entry-inner-wrap">
                <div class="ufb-entry-detail-block ufb-entry-block">
                    <?php
                    $form_detail = maybe_unserialize( $entry_row['form_detail'] );
                    if ( !empty( $form_detail ) ) {
                        $field_data = $form_detail['field_data'];
                        $entry_detail = maybe_unserialize( $entry_row['entry_detail'] );
                        $except_field_types = array( 'submit', 'captcha' );
                        $field_count = 0;
                        ?>
                        <?php // UFB_Lib::print_array( $entry_detail ); ?>

                        <?php
                        /*
                        foreach ( $field_data as $field_key => $field_settings ) {
                            $field_count++;
                            if ( !in_array( $field_settings['field_type'], $except_field_types ) ) {
                                $field_label = ($field_settings['field_label'] != '') ? esc_attr( $field_settings['field_label'] ) : __( 'Untitled', UFB_TD ) . ' ' . $field_settings['field_type'];
                                if ( isset( $entry_detail[$field_key] ) ) {
                                    if ( is_array( $entry_detail[$field_key] ) ) {
                                        $entry_detail[$field_key] = array_map( 'esc_attr', $entry_detail[$field_key] );
                                        $entry_value = implode( ', ', $entry_detail[$field_key] );
                                    } else {
                                        $entry_value = ($entry_detail[$field_key] != '') ? esc_attr( $entry_detail[$field_key] ) : '';
                                    }
                                } else {
                                    $entry_value = '';
                                } */
                        $entry_detail['email_reference_array'] = isset($entry_detail['email_reference_array'])?$entry_detail['email_reference_array']:array();
                        foreach($entry_detail['email_reference_array'] as $key => $entry_detail_val){
                              $field_count++;
                                ?>
                                <div class="ufb-entry-field-wrap <?php echo ($field_count % 2 == 0) ? 'ufb-entry-even' : ''; ?>">
                                    <label><?php echo $entry_detail_val['label']; ?></label>
                                    <div class="ufb-entry-value"><?php echo $entry_detail_val['value']; ?></div>
                                </div>
                                <?php
                        }
                         /*   } 
                        }  */
                        //self::print_array( $field_data );
                        //self::print_array( $entry_detail );
                    }
                    ?>
                </div>
                <div class="ufb-entry-detail-block ufb-entry-extra-block" style="display:none;">
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'Entry Posted Date', UFB_TD ); ?></label>
                        <div class="ufb-entry-value"><?php echo date( 'h:i:s A M jS, Y ', strtotime( $entry_row['entry_created'] ) ); ?></div>
                    </div>
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'User IP', UFB_TD ); ?></label>
                        <div class="ufb-entry-value"><?php echo isset( $entry_detail['user_ip'] ) ? esc_attr( $entry_detail['user_ip'] ) : ''; ?></div>
                    </div>
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'Page URL', UFB_TD ); ?></label>
                        <div class="ufb-entry-value">
                            <?php
                            $page_url = isset( $entry_detail['page_url'] ) ? esc_attr( $entry_detail['page_url'] ) : '';
                            if ( $page_url != '' ) {
                                ?>
                                <a href="<?php echo esc_url( $page_url ) ?>" target="_blank"><?php echo esc_url( $page_url ); ?></a>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'User Logged In', UFB_TD ); ?></label>
                        <div class="ufb-entry-value"><?php echo isset( $entry_detail['user_logged_in'] ) ? esc_attr( $entry_detail['user_logged_in'] ) : ''; ?></div>
                    </div>
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'Logged In Username', UFB_TD ); ?></label>
                        <div class="ufb-entry-value"><?php echo isset( $entry_detail['loggedin_username'] ) ? esc_attr( $entry_detail['loggedin_username'] ) : ''; ?></div>
                    </div>
                    <div class="ufb-entry-field-wrap">
                        <label><?php _e( 'Logged In User Email', UFB_TD ); ?></label>
                        <div class="ufb-entry-value"><?php echo isset( $entry_detail['loggedin_user_email'] ) ? esc_attr( $entry_detail['loggedin_user_email'] ) : ''; ?></div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <p><?php _e( "It seems that you have deleted the form of this entry.Entry not found in database!", UFB_TD ); ?></p>
                <?php
            }
            ?>

        </div>
    </div>
</div>

