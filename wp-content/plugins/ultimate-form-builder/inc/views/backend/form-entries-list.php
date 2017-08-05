<div class="wrap">

    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>">
        <input type="hidden" name="action" value="ufb_entries_bulk_actions"/>
        <?php wp_nonce_field( 'entries-nonce', 'entries_nonce_field' ); ?>
        <?php
        /**
         * Always use self::load_view to load view inside a view
         * Header view loaded
         */
        self::load_view( 'backend/header' );
        ?>
        <?php if ( isset( $_SESSION['ufb_message'] ) ) { ?>
            <div class="ufb-message">
                <p>
                    <?php
                    echo $_SESSION['ufb_message'];
                    unset( $_SESSION['ufb_message'] );
                    ?>
                </p>
                <button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
            </div>
            <div class="ufb-clear"></div>
        <?php } ?>
        <div class="ufb-entry-filter-wrap">
            <h3><?php _e( 'Form Entries', UFB_TD ); ?></h3>
            <div class="alignleft actions bulkactions">
                <label for="bulk-action-selector-top" class="screen-reader-text"><?php _e( 'Select bulk action', UFB_TD ); ?></label>
                <select name="bulk_action" id="bulk-action-selector-top">
                    <option value="-1"><?php _e( 'Bulk Action',UFB_TD ); ?></option>
                    <option value="read" class="hide-if-no-js"><?php _e( 'Mark as read', UFB_TD ); ?></option>
                    <option value="unread"><?php _e( 'Mark as unread', UFB_TD ); ?></option>
                    <option value="delete"><?php _e( 'Delete', UFB_TD ); ?></option>
                </select>
                <input type="submit" class="button action ufb-entry-bulk-trigger" value="<?php _e('Apply',UFB_TD);?>">
                <select class="ufb-entry-filter-select" data-admin-url="<?php echo admin_url(); ?>">
                    <option value=""><?php _e( 'All Form entries', UFB_TD ); ?></option>
                    <?php
                    $form_id = isset( $_GET['form_id'] ) ? $_GET['form_id'] : '';
                    if ( count( $form_rows ) > 0 ) {
                        foreach ( $form_rows as $form_row ) {
                            ?>
                            <option value="<?php echo $form_row['form_id'] ?>" <?php selected( $form_id, $form_row['form_id'] ); ?>><?php echo $form_row['form_title']; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <?php $csv_nonce = wp_create_nonce( 'ufb-csv-nonce' ); ?>
            <?php if ( $form_id != '' ) { ?>
                <a href="<?php echo admin_url( 'admin-post.php?action=ufb_csv_export&form_id=' . $form_id . '&_wpnonce=' . $csv_nonce ); ?>"><input type="button" class="ufb-csv-export-trigger" value="<?php _e( 'Export to CSV', UFB_TD ); ?>" data-admin-url="<?php echo admin_url(); ?>" data-form-id="<?php echo $form_id; ?>"/></a>
                <?php
            }

            $current_page = isset( $_GET['page_num'] ) ? $_GET['page_num'] : 1;
            $upper_page_limit = $current_page + 2;
            $upper_page_limit = ($upper_page_limit > $total_pages) ? $total_pages : $upper_page_limit;
            $lower_page_limit = $current_page - 2;
            $lower_page_limit = ($lower_page_limit <= 0) ? 1 : $lower_page_limit;
            if ( $total_pages > 1 ) {
                ?>
                <div class="ufb-entries-pagination-outerwrap">
                    <div class="ufb-entries-pagination-wrap">
                        <?php
                        $previous_page = $current_page - 1;
                        $next_page = $current_page + 1;
                        if ( $previous_page > 0 ) {
                            if ( isset( $_GET['form_id'] ) ) {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&form_id=' . $_GET['form_id'] . '&page_num=' . $previous_page );
                            } else {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&page_num=' . $previous_page );
                            }
                            ?>
                            <a class="ufb-entry-previous-page ufb-entry-page-link" href="<?php echo $page_link; ?>"><?php _e( 'Previous', UFB_TD ); ?></a>
                            <?php
                        }
                        for ( $page = $lower_page_limit; $page <= $upper_page_limit; $page++ ) {
                            if ( isset( $_GET['form_id'] ) ) {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&form_id=' . $_GET['form_id'] . '&page_num=' . $page );
                            } else {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&page_num=' . $page );
                            }
                            ?>
                            <a href="<?php echo $page_link; ?>" class="ufb-entry-page-link <?php echo ($current_page == $page) ? 'ufb-entry-current-page' : ''; ?>"><?php echo $page; ?></a>
                            <?php
                        }
                        if ( $next_page <= $total_pages ) {
                            if ( isset( $_GET['form_id'] ) ) {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&form_id=' . $_GET['form_id'] . '&page_num=' . $next_page );
                            } else {
                                $page_link = admin_url( 'admin.php?page=ufb-form-entries&page_num=' . $next_page );
                            }
                            ?>
                            <a class="ufb-entry-next-page ufb-entry-page-link" href="<?php echo $page_link; ?>"><?php _e( 'Next', UFB_TD ); ?></a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="ufb-clear"></div>
                <?php
            }
            ?>
        </div>
                        <div class="ufb-field-note"><?php _e('Note: Please select a form to export the entries to CSV file',UFB_TD);?></div>

        <table class="wp-list-table widefat fixed posts">
            <thead>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">
                            <?php _e( 'Select All', UFB_TD ); ?>
                        </label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <td class="ufb-sn-col">
                        <?php _e( 'SN', UFB_TD ); ?>
                    </td>
                    <th scope="col" id="title" class="manage-column column-shortcode">
                        <?php _e( 'Form Title', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Entry Recieved', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Status', UFB_TD ); ?>
                    </th>

                </tr>
            </thead>
            <tfoot>
                <tr>
                    <td id="cb" class="manage-column column-cb check-column">
                        <label class="screen-reader-text" for="cb-select-all-1">
                            <?php _e( 'Select All', UFB_TD ); ?>
                        </label>
                        <input id="cb-select-all-1" type="checkbox">
                    </td>
                    <th  class="ufb-sn-col">
                        <?php _e( 'SN', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="title" class="manage-column column-shortcode">
                        <?php _e( 'Form Title', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Entry Recieved', UFB_TD ); ?>
                    </th>
                    <th scope="col" id="shortcode" class="manage-column column-shortcode">
                        <?php _e( 'Status', UFB_TD ); ?>
                    </th>
                </tr>
            </tfoot>

            <tbody id="the-list" data-wp-lists="list:post">
                <?php
                if ( count( $form_entry_rows ) > 0 ) {
                    $form_counter = 1;
                    foreach ( $form_entry_rows as $form_entry_row ) {
                        $delete_nonce = wp_create_nonce( 'ufb-delete-nonce' );
                        $copy_nonce = wp_create_nonce( 'ufb-copy-nonce' );
                        ?>
                        <tr class="<?php if ( $form_counter % 2 != 0 ) { ?>alternate<?php } ?>">
                            <th scope="row" class="check-column">			
                                <input id="cb-select-<?php echo $form_counter + 1; ?>" type="checkbox" name="entry_id[]" value="<?php echo $form_entry_row['entry_id']; ?>">
                            </th>

                            <td>
                                <?php echo $form_counter; ?>
                            </td>
                            <td class="title column-title">
                                <strong>
                                    <a class="row-title" href="<?php echo admin_url( 'admin.php?page=ufb&action=edit-form&form_id=' . $form_entry_row['form_id'] ); ?>" title="Edit" data-entry-id="<?php echo $form_entry_row['entry_id']; ?>" target="_blank">
                                        <?php echo esc_attr( $form_entry_row['form_title'] ); ?>
                                    </a>

                                </strong>
                                <div class="row-actions ufb-relative">
                                    <span class="delete ufb-delete"><a href="javascript:void(0);"><?php _e( 'Delete', UFB_TD ); ?></a> | </span>
                                    <span class="ufb-change-status"><a href="javascript:void(0);" data-entry-id="<?php echo $form_entry_row['entry_id']; ?>" data-status="<?php echo $form_entry_row['status']; ?>"><?php echo ($form_entry_row['status'] == 0) ? __( 'Mark as read', UFB_TD ) : __( 'Mark as unread', UFB_TD ); ?></a> | </span>
                                    <span class="ufb-view-entry"><a href="javascript:void(0);" data-entry-id="<?php echo $form_entry_row['entry_id']; ?>"><?php _e( 'View Entry', UFB_TD ); ?></a></span>
                                    <div class="ufb-delete-confirmation" style="display:none">
                                        <p><?php _e( 'Are you sure you want to delete this entry?', UFB_TD ); ?></p>
                                        <input type="button" value="<?php _e( 'Yes', UFB_TD ); ?>"  data-entry-id="<?php echo $form_entry_row['entry_id']; ?>" class="ufb-delete-yes ufb-delete-entry-yes"/>
                                        <input type="button" value="<?php _e( 'Cancel', UFB_TD ); ?>" class="ufb-delete-cancel"/>
                                        <span class="ufb-ajax-loader" style="display:none;"></span>
                                    </div>
                                </div>
                            </td>
                            <td class="shortcode column-shortcode">
                                <?php echo date( 'h:i:s A M jS, Y ', strtotime( $form_entry_row['entry_created'] ) ); ?>
                            </td>
                            <th scope="col" id="shortcode" class="manage-column column-shortcode">
                                <?php
                                $status_class = ($form_entry_row['status'] == 0) ? 'ufb-entry-unread' : 'ufb-entry-read';
                                $status_text = ($form_entry_row['status'] == 0) ? __( 'Unread', UFB_TD ) : __( 'Read', UFB_TD );
                                ?>
                                <span class="ufb-entry-status <?php echo $status_class; ?>"><?php echo $status_text; ?></span>
                            </th>
                        </tr>
                        <?php
                        $form_counter++;
                    }
                } else {
                    ?>
                    <tr><td colspan="5"><div class="ufb-noresult"><?php _e( 'Entries not found for this form.', UFB_TD ); ?></div></td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </form>
</div>
<div class="ufb-entry-overlay" style="display:none"></div>
<div class="ufb-entry-wrap"  style="display:none"><span class="ufb-entry-ajax-loader"></span></div>

