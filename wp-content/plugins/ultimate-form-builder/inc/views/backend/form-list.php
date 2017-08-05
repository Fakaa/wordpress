<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
?>
<div class="wrap">
    <?php
    /**
     * Always use self::load_view to load view inside a view
     */
    self::load_view( 'backend/header' );
    ?>


    <div class="ufb-form-list">
        <h2><?php _e( 'Forms', UFB_TD ); ?><a href="javascript:void(0);" class="ufb-add-form-trigger add-new-h2"><?php _e( 'Add New Form' ); ?></a></h2>

        <table class="wp-list-table widefat fixed posts">
            <thead>
                <tr>
                    <th scope="col" id="title" class="manage-column column-shortcode">
                        <?php _e( 'Form Title', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Shortcode', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="last-modified" class="manage-column column-shortcode">
                        <?php _e( 'Last Modified', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="status" class="manage-column column-shortcode">
                        <?php _e( 'Status', UFB_TD ); ?>
                    </th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col" id="title" class="manage-column column-shortcode" >
                        <?php _e( 'Form Title', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Shortcode', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="last-modified" class="manage-column column-shortcode">
                        <?php _e( 'Last Modified', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="status" class="manage-column column-shortcode">
                        <?php _e( 'Status', UFB_TD ); ?>
                    </th>
                </tr>
            </tfoot>
            <tbody id="the-list" data-wp-lists="list:post">
                <?php
                if ( count( $forms ) > 0 ) {
                    $form_counter = 1;
                    foreach ( $forms as $form ) {
                        $delete_nonce = wp_create_nonce( 'ufb-delete-nonce' );
                        $copy_nonce = wp_create_nonce( 'ufb-copy-nonce' );
                        ?>
                        <tr class="<?php if ( $form_counter % 2 != 0 ) { ?>alternate<?php } ?>">
                            <td class="title column-title">
                                <strong>
                                    <a class="row-title" href="<?php echo admin_url( 'admin.php?page=ufb&action=edit-form&form_id=' . $form->form_id ); ?>" title="Edit">
                                        <?php echo esc_attr( $form->form_title ); ?>
                                    </a>
                                </strong>
                                <div class="row-actions ufb-relative">
                                    <span class="edit"><a href="<?php echo admin_url() . 'admin.php?page=ufb&action=edit-form&form_id=' . $form->form_id; ?>">Edit</a> | </span>
                                    <span class="ufb-copy" data-form-id="<?php echo $form->form_id; ?>"><a href="javascript:void(0);">Copy</a> | </span>
                                    <span class="delete ufb-delete"><a href="javascript:void(0);">Delete</a> | </span>
                                    <span class="ufb-preview"><a href="<?php echo site_url( '?ufb_form_preview=true&ufb_form_id=' . $form->form_id ); ?>" target="_blank"><?php _e( 'Preview', UFB_TD ); ?></a> | </span>
                                    <span class="ufb-entries"><a href="<?php echo admin_url( 'admin.php?page=ufb-form-entries&form_id=' . $form->form_id ); ?>"><?php _e( 'Entries', UFB_TD ); ?></a></span>
                                    <div class="ufb-delete-confirmation" style="display:none">
                                        <p><?php _e( 'Are you sure you want to delete this form?', UFB_TD ); ?></p>
                                        <input type="button" value="<?php _e( 'Yes', UFB_TD ); ?>"  data-form-id="<?php echo $form->form_id; ?>" class="ufb-delete-yes ufb-form-delete-yes"/>
                                        <input type="button" value="<?php _e( 'Cancel', UFB_TD ); ?>"  data-form-id="<?php echo $form->form_id; ?>" class="ufb-delete-cancel ufb-form-cancel"/>
                                        <span class="ufb-ajax-loader" style="display:none;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="shortcode column-shortcode"><input type="text" onFocus="this.select();" readonly="readonly" value="[ufb form_id=&quot;<?php echo $form->form_id; ?>&quot;]" class="shortcode-in-list-table wp-ui-text-highlight code"></td>
                            <td class="shortcode column-shortcode"><?php echo date( 'h:i:s A M jS, Y ', strtotime( $form->form_modified ) ); ?></td>
                            <td class="shortcode column-shortcode ufb-relative">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch-<?php echo $form->form_id; ?>" <?php checked( $form->form_status, true ); ?> style="display:none;">
                                    <label class="onoffswitch-label" for="myonoffswitch-<?php echo $form->form_id; ?>"  data-form-id="<?php echo $form->form_id; ?>">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>

                                </div>
                                <span class="ufb-ajax-loader ufb-status-loader" style="display:none;"></span>
                                <span class="ufb-status-message" style="display:none;"></span>
                            </td>

                        </tr>
                        <?php
                        $form_counter++;
                    }
                } else {
                    ?>
                    <tr><td colspan="4"><div class="ufb-noresult"><?php _e( 'Forms not added yet', UFB_TD ); ?></div></td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
<div class="ufb-popup-wrap" style="display: none">
    <div class="ufb-overlay"></div>
    <div class="ufb-add-form-wrap">
        <div class="ufb-add-field-wrap">
            <label><?php _e( 'Form Title', UFB_TD ); ?></label>
            <div class="ufb-field"><input type="text" class="ufb-form-title" placeholder="<?php _e( 'Contact Form', UFB_TD ); ?>"/></div>
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
        <div class="ufb-add-field-wrap">
            <input type="button" class="ufb-form-add-btn button-primary" value="<?php _e( 'Add Form', UFB_TD ); ?>"/><span class="ufb-ajax-loader" style="display: none"></span><span class="ufb-msg" style="display:none;"><?php _e( 'Form Created.Redirecting...' ); ?></span>
            <div class="ufb-add-error ufb-error" style="display: none;"></div>
        </div>
    </div>
</div>
<div class="ufb-copy-popup-wrap" style="display: none">
    <div class="ufb-overlay"></div>
    <div class="ufb-add-form-wrap">
        <div class="ufb-add-field-wrap">
            <label><?php _e( 'Copy Form Title', UFB_TD ); ?></label>
            <div class="ufb-field"><input type="text" class="ufb-form-title" placeholder="<?php _e( 'Contact Form', UFB_TD ); ?>"/></div>
            <div class="ufb-field-note"><?php _e( 'Please enter the form title', UFB_TD ); ?></div>
        </div>
        <div class="ufb-add-field-wrap">
            <div class="ufb-field">
                <select class="ufb-copy-form-id"><?php foreach ( $forms as $form ) {
                    ?>
                        <option value="<?php echo $form->form_id; ?>"><?php echo esc_attr( $form->form_title ); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            <div class="ufb-field-note"><?php _e( 'Please choose a form to copy.', UFB_TD ); ?></div>
        </div>
        <div class="ufb-add-field-wrap">
            <input type="button" class="ufb-form-copy-btn button-primary" value="<?php _e( 'Copy Form', UFB_TD ); ?>"/><span class="ufb-ajax-loader" style="display: none"></span><span class="ufb-msg" style="display:none;"><?php _e( 'Form Copied.Redirecting...' ); ?></span>
            <div class="ufb-add-error ufb-error" style="display: none;"></div>
        </div>
    </div>
</div>