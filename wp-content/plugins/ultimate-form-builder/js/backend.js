(function ($) {
    /**
     * Function to capture field type html
     * @param {string} field_type
     * @returns {string}
     */
    function get_field_html(field_type) {
        var form_key_count = $('.ufb-form-key-count').val();
        form_key_count++;
        var field_key = 'ufb_field_' + form_key_count;
        $('.ufb-form-key-count').val(form_key_count);
        var html = $('.ufb-' + field_type + '-reference').html();
        $('.ufb-form-temp-holder').html(html);
        $('.ufb-form-temp-holder input').each(function () {
            var name_attr = $(this).attr('name');
            if (name_attr) {
                name_attr = name_attr.replace('ufb_key', field_key);
                $(this).attr('name', name_attr);
                //alert(name_attr);
            }



        });
        $('.ufb-form-temp-holder textarea').each(function () {
            var name_attr = $(this).attr('name');
            if (name_attr) {
                name_attr = name_attr.replace('ufb_key', field_key);
                $(this).attr('name', name_attr);
                //alert(name_attr);
            }



        });
        $('.ufb-form-temp-holder select').each(function () {
            var name_attr = $(this).attr('name');
            if (name_attr) {
                name_attr = name_attr.replace('ufb_key', field_key);
                $(this).attr('name', name_attr);
                //alert(name_attr);
            }



        });
        var html = $('.ufb-form-temp-holder').html();
        $('.ufb-form-temp-holder').html('');
        return html;

    }

    $(function () {
        /**
         * Add Form Popup Hide Show
         */
        $('.ufb-add-form-trigger').click(function () {
            $('.ufb-popup-wrap').fadeIn(400);
            $('.ufb-form-title').focus();
        });

        $('.ufb-overlay').click(function () {
            $('.ufb-popup-wrap').fadeOut(200);
        });

        /**
         * Form ajax add
         */
        $('.ufb-form-add-btn').click(function () {
            var selector = $(this);
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'add_form_action',
                    form_title: $('.ufb-form-title').val(),
                    form_type: $('.ufb-form-type').val()
                },
                beforeSend: function () {
                    selector.parent().find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    $('.ufb-ajax-loader').hide();
                    res = $.parseJSON(res);
                    if (res.success == 1) {
                        $('.ufb-msg').show();
                        window.location = res.redirect_url;
                        return false;
                    } else {
                        $('.ufb-add-error').html(res.error_msg).show();
                    }

                }
            });
        });

        /**
         * Form on and off toggle
         */
        $('.onoffswitch-label').click(function () {
            var selector = $(this);
            var form_id = $(this).data('form-id');
            if ($(this).parent().find('.onoffswitch-checkbox').is(':checked')) {
                var status = 0;
            } else {
                var status = 1;
            }
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    status: status,
                    form_id: form_id,
                    action: 'ufb_form_status_action'
                },
                beforeSend: function () {
                    selector.closest('.shortcode').find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    selector.closest('.shortcode').find('.ufb-ajax-loader').hide();
                    selector.closest('.shortcode').find('.ufb-status-message').html(res).show().fadeOut(3500);

                }

            });
        });

        /**
         * Tabs Trigger show hide
         */
        $('.ufb-tab-trigger').click(function () {
            var attr_id = $(this).data('id');
            $('.ufb-tab-trigger').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            $('.ufb-tab-content').hide();
            $('#ufb-' + attr_id + '-tab').show();
        });

        /**
         * Form Title edit trigger
         */
        $('.ufb-form-title').click(function () {
            if ($('.ufb-form-title #ufb-form-title').length == 0) {
                var form_title = $(this).html();
                $(this).html('<input type="text" id="ufb-form-title" value="' + form_title + '"/>');
                $('.ufb-form-title #ufb-form-title').focus();
            }

        });

        $('body').on('blur', '.ufb-form-title #ufb-form-title', function () {
            var form_title = $(this).val();
            form_title = (form_title == '') ? 'Untitled Form' : form_title;
            $('.ufb-form-title').html(form_title);
            $('.ufb-form-title-field').val(form_title);
        });

        /**
         * Form Builder functionality
         */
        $('.ufb-form-element').click(function () {
            var field_type = $(this).data('field-type');
            var field_html = get_field_html(field_type);
            var form_key_count = $('.ufb-form-key-count').val();
            var field_key = 'ufb_field_' + form_key_count;
            if ($('.ufb-form-type').val() == 'multi') {
                var active_step = 1;
                $('.ufb-each-step-wrap').each(function () {
                    if ($(this).is(':visible')) {
                        active_step = $(this).data('step-ref');
                        $(this).find('.ufb-step-fields-wrap').append(field_html)
                    }
                });

                var active_steps_fields = $('input[data-step-fields-ref="' + active_step + '"]').val();
                if (active_steps_fields == '') {
                    $('input[data-step-fields-ref="' + active_step + '"]').val(field_key);
                } else {
                    active_steps_fields_array = active_steps_fields.split(',');
                    active_steps_fields_array.push(field_key);
                    active_steps_fields = active_steps_fields_array.join();
                    $('input[data-step-fields-ref="' + active_step + '"]').val(active_steps_fields);
                }
                $('.ufb-step-fields-wrap').sortable({
                    handle: '.ufb-drag-arrow'
                });
            } else {
                $('.ufb-form-field-holder').append(field_html);

            }
            if (field_type == 'ui-slider') {
                $('.ufb-range-slider').slider({
                    min: 0,
                    max: 100,
                    range: true,
                    slide: function (event, ui) {
                        var min_value = ui.values[0];
                        var max_value = ui.values[1];
                        $(this).closest('.ufb-range-slider-ref-wrap').find('.ufb-slider-value').html(min_value + ' - ' + max_value);
                    }
                });
                $('.ufb-ui-slider').slider({
                    min: 0,
                    max: 100,
                    slide: function (event, ui) {
                        $(this).closest('.ufb-slider-ref-wrap').find('.ufb-slider-value').html(ui.value);
                    }
                });
            }
            $('.ufb-sortable').sortable({
                containment: "parent",
                handle: '.ufb-drag-icon'
            });


        });

        /**
         * Form Element Delete
         */
        var form_type = $('.ufb-form-type').val();
        $('body').on('click', '.ufb-field-delete-trigger', function () {
            if (confirm('If you delete this element then data related with this element will also be deleted. Are you sure you want to delete this element?')) {
                $(this).closest('.ufb-each-form-field').fadeOut(500, function () {
                    $(this).remove();
                });
            }

        });

        if (form_type && form_type == 'multi') {
            $('.ufb-step-fields-wrap').sortable({
                handle: '.ufb-drag-arrow',
                update: function (event, ui) {
                    var step_ref = $(this).closest('.ufb-each-step-wrap').data('step-ref');
                    var step_fields_array = [];
                    var count = 0;
                    $('.ufb-each-step-wrap[data-step-ref="' + step_ref + '"] .ufb-field-settings-wrap .ufb-field-label-field').each(function () {
                        count++;
                        var field_name = $(this).attr('name');
                        var field_name_array = field_name.split('][');
                        var field_key = field_name_array[0].replace('field_data[', '');
                        step_fields_array.push(field_key);
//                        console.log(count);
//                        console.log(field_key);
//                        console.log($(this).val());
                        //var field_type = $(this).parent().find('input[data-field-type]').val();
                        // console.log(field_type);

                    });
                    var step_fields = step_fields_array.join();
                    $('input[data-step-fields-ref="' + step_ref + '"]').val(step_fields);

                }
            });

        } else {
            $('.ufb-form-field-holder').sortable({
                handle: '.ufb-drag-arrow'
            });

        }

        $('.ufb-option-value-wrap').sortable({
            containment: "parent",
            handle: '.ufb-option-drag-arrow'
        });

        $('body').on('click', '.ufb-field-settings-trigger', function () {
            if ($(this).next('span').html() == '+') {
                var selector = $(this);
                $(this).closest('.ufb-each-form-field').find('.ufb-field-settings-wrap').slideDown(500, function () {

                    selector.next('span').html('-');
                });
            } else {
                var selector = $(this);
                $(this).closest('.ufb-each-form-field').find('.ufb-field-settings-wrap').slideUp(500, function () {
                    selector.next('span').html('+');

                });
            }

        });

        $('body').on('keyup', '.ufb-field-label-field', function () {
            if (!$(this).hasClass('ufb-no-label')) {
                var label_text = $(this).val();
                label_text = (label_text != '') ? label_text : 'Untitled Field';
                $(this).closest('.ufb-each-form-field').find('.ufb-field-label-ref').html(label_text);
            }
        });
        $('body').on('keyup', '.ufb-submit-button', function () {
            var label_text = $(this).val();
            label_text = (label_text != '') ? label_text : 'Submit';
            $(this).closest('.ufb-each-form-field').find('.ufb-submit-reference').val(label_text);
        });

        $('body').on('click', '.ufb-option-remover', function () {
            $(this).closest('.ufb-each-option').fadeOut(500, function () {
                $(this).remove();
            });
        });

        /**
         * Add Option for radio button, checkbox, dropdown
         */
        $('body').on('click', '.ufb-option-value-adder', function () {
            var html = $(this).closest('.ufb-form-field').find('.ufb-each-option').first().html();
            html = '<div class="ufb-each-option" style="display:none;">' + html + '</div>';
            $(this).closest('.ufb-form-field').find('.ufb-option-value-wrap').append(html);
            $(this).closest('.ufb-form-field').find('.ufb-option-value-wrap').find('.ufb-each-option').last().find('input[type="text"]').val('');
            $('.ufb-each-option').show();
            $(this).closest('.ufb-form-field').find('.ufb-option-value-wrap').find('.ufb-each-option').last().find('input[type="text"]').first().focus();
        });



        /**
         * Form Post
         */
        $('.ufb-save-form').click(function () {
            $('.ufb-form').submit();
        });

        $('.ufb-message button').click(function () {
            $(this).parent().remove();
        });

        /**
         * Email Reciever add trigger
         */
        $('.ufb-email-adder').click(function () {
            var html = '<div class="ufb-email-fields"><input type="text" name="email_settings[email_reciever][]" placeholder="test@abc.com"/><span class="ufb-email-remove">X</span></div>';
            $(this).parent().append(html);
            $('.ufb-email-fields').last().find('input').focus();
        });

        $('body').on('click', '.ufb-email-remove', function () {
            $(this).parent().fadeOut(300, function () {
                $(this).remove();
            });
        });

        $('.ufb-delete').click(function () {
            $(this).parent().find('.ufb-delete-confirmation').slideToggle(500);
        });
        $('.ufb-delete-cancel').click(function () {
            $(this).parent().slideUp(500);
        });

        /* $('.row-actions').mouseleave(function () {
         $(this).find('.ufb-delete-confirmation').slideUp(500);
         });
         */
        $('.ufb-form-delete-yes').click(function () {
            var form_id = $(this).data('form-id');
            var selector = $(this);
            $.ajax({
                url: ufb_ajax_obj.ajax_url,
                type: 'post',
                data: {
                    form_id: form_id,
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'ufb_form_delete_action'
                },
                beforeSend: function () {
                    selector.parent().find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    if (res == 'success') {
                        selector.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        });
                        console.log(res);
                    } else {
                        alert(res);
                    }



                }
            });
        });

        $('.ufb-add-form-wrap .ufb-form-title').keypress(function (e) {
            if (e.which == 13) {
                $(this).closest('.ufb-add-form-wrap').find('.ufb-form-add-btn').click();
            }
        });
        $('.ufb-new-form-wrap .ufb-form-title').keypress(function (e) {
            if (e.which == 13) {
                $(this).closest('.ufb-new-form-wrap').find('.ufb-form-add-btn').click();
            }
        });
        $('.ufb-copy-popup-wrap .ufb-form-title').keypress(function (e) {
            if (e.which == 13) {
                $(this).closest('.ufb-add-form-wrap').find('.ufb-form-copy-btn').click();
            }
        });


        /**
         * Delete Entry 
         */
        $('.ufb-delete-entry-yes').click(function () {
            var entry_id = $(this).data('entry-id');
            var selector = $(this);
            $.ajax({
                url: ufb_ajax_obj.ajax_url,
                type: 'post',
                data: {
                    entry_id: entry_id,
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'ufb_entry_delete_action'
                },
                beforeSend: function () {
                    selector.parent().find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    selector.parent().find('.ufb-ajax-loader').hide();
                    if (res == 'success') {
                        selector.closest('tr').fadeOut(500, function () {
                            $(this).remove();
                        });
                        console.log(res);
                    } else {
                        alert(res);
                    }



                }
            });
        });

        /**
         * View Entry Popup
         */
        $('.ufb-view-entry > a').click(function () {
            var selector = $(this);
            var entry_id = $(this).data('entry-id');
            $.ajax({
                url: ufb_ajax_obj.ajax_url,
                data: {
                    entry_id: entry_id,
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'ufb_get_entry_detail_action'
                },
                type: 'post',
                beforeSend: function () {
                    $('.ufb-entry-overlay').fadeIn(300, function () {
                        $('.ufb-entry-wrap').show();
                    });
                },
                success: function (res) {
                    selector.closest('tr').find('.ufb-entry-status').removeClass('ufb-entry-unread').addClass('ufb-entry-read').html('Read');
                    selector.closest('tr').find('.ufb-change-status > a').html('Mark as unread');
                    selector.closest('tr').find('.ufb-change-status > a').data('status', 1);

                    height = $(window).height();
                    var entry_inner_wrap_height = 0.64 * height;
                    $('.ufb-entry-wrap').html(res);
                    $('.ufb-entry-wrap .ufb-entry-inner-wrap').height(entry_inner_wrap_height);
                }
            });

        });

        /**
         * Entry Popup Close
         */
        $('body').on('click', '.ufb-entry-overlay,.ufb-entry-detail-close', function () {
            $('.ufb-entry-overlay').fadeOut(300, function () {
                $('.ufb-entry-wrap').html('<span class="ufb-entry-ajax-loader"></span>');

            });
            $('.ufb-entry-wrap').fadeOut(300);


        });

        /**
         * Entry Filter 
         */
        $('.ufb-entry-filter-select').change(function () {
            var form_id = $(this).val();
            var admin_url = $(this).data('admin-url');
            var redirect_url = (form_id == '') ? admin_url + 'admin.php?page=ufb-form-entries' : admin_url + 'admin.php?page=ufb-form-entries&form_id=' + form_id;
            window.location = redirect_url;
            return false;
        });

        /**
         * Form copy popup open
         */
        $('body').on('click', '.ufb-copy', function () {
            var form_id = $(this).data('form-id');
            $('.ufb-copy-form-id option[value="' + form_id + '"]').attr('selected', 'selected');
            $('.ufb-copy-popup-wrap').fadeIn(300);
            $('.ufb-copy-popup-wrap .ufb-form-title').focus();
        });

        $('.ufb-overlay').click(function () {
            $('.ufb-copy-popup-wrap').fadeOut(300);
        });

        /**
         * Form Copy 
         */
        $('.ufb-form-copy-btn').click(function () {
            var selector = $(this);
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'copy_form_action',
                    form_title: selector.closest('.ufb-copy-popup-wrap').find('.ufb-form-title').val(),
                    form_id: selector.closest('.ufb-copy-popup-wrap').find('.ufb-copy-form-id').val()
                },
                beforeSend: function () {
                    selector.closest('.ufb-add-form-wrap').find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    $('.ufb-ajax-loader').hide();
                    res = $.parseJSON(res);
                    if (res.success == 1) {
                        $('.ufb-msg').show();
                        window.location = res.redirect_url;
                        return false;
                    } else {
                        $('.ufb-add-error').html(res.error_msg).show();
                    }

                }
            });
        });

        /**
         * Captcha Type Dropdown on Change
         */
        $('body').on('change', '.ufb-captcha-type-dropdown', function () {
            var captcha_type = $(this).val();
            if (captcha_type == 'google') {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-captcha-field-ref').show();
            } else {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-captcha-field-ref').hide();

            }
        });

        /**
         * Backend template change
         */
        $('.ufb-form-template-dropdown').change(function () {
            var template_name = $(this).val();
            $('.ufb-template-preview img').hide();
            $('.ufb-template-preview #preview-' + template_name).show();
        });

        /**
         * Page Leave Message
         */
        $(".ufb-form :input").change(function () {
            $('.ufb-form').data("changed", true);
        });

        $(window).bind('beforeunload', function () {
            if ($('.ufb-form').data('changed') == true) {

                return 'The changes you made will be lost if you navigate away from this page.';
            }
        })

        $(".ufb-form").submit(function () {
            $(window).unbind("beforeunload");
        });

        /*
         * Field Elements Group Hide / Show
         */
        $('.ufb-group-trigger').click(function () {
            var group_type = $(this).data('group-ref');
            $('.ufb-group-trigger').removeClass('ufb-group-active-trigger');
            $(this).addClass('ufb-group-active-trigger');
            $('.ufb-elements-group').hide();
            $('div[data-group-type="' + group_type + '"]').show();
        });

        /**
         * Help Message Toggle
         */
        $('body').on('click', '.ufb-help-trigger', function () {
            $(this).parent().find('.ufb-help-message').toggle();
        });

        /**
         * Date format change
         */
        $('body').on('change', '.ufb-date-format', function () {
            $(this).closest('.ufb-field-settings-wrap').find('.ufb-date-ref').hide();
            var value = $(this).val();
            if (value == 'pre_available') {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-available-format').show();
            } else {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-custom-format').show();
            }
        });

        /**
         * Slider Preview Change
         */
        $('body').on('change', '.ufb-slider-type', function () {
            if ($(this).val() == 'range') {

                $(this).closest('.ufb-each-form-field').find('.ufb-slider-ref-wrap').hide();
                $(this).closest('.ufb-each-form-field').find('.ufb-range-slider-ref-wrap').show();
            } else {
                $(this).closest('.ufb-each-form-field').find('.ufb-slider-ref-wrap').show();
                $(this).closest('.ufb-each-form-field').find('.ufb-range-slider-ref-wrap').hide();
            }
        });

        /**
         * UI Slider Initialization
         */
        $('.ufb-form .ufb-ui-slider').each(function () {
            var min_value = $(this).data('min-value');
            var max_value = $(this).data('max-value');
            var step = $(this).data('step');
            var pre_value = String($(this).data('pre-value'));
            var pre_value_array = pre_value.split('-');
            if (pre_value_array.length == 1) {
                pre_value_array = pre_value;
                $(this).slider({
                    min: min_value,
                    max: max_value,
                    step: step,
                    value: pre_value_array,
                    slide: function (event, ui) {
                        $(this).closest('.ufb-slider-ref-wrap').find('.ufb-slider-value').html(ui.value);
                    }
                });
            } else {
                $(this).slider({
                    min: min_value,
                    max: max_value,
                    step: step,
                    slide: function (event, ui) {
                        $(this).closest('.ufb-slider-ref-wrap').find('.ufb-slider-value').html(ui.value);
                    }
                })
            }


        });
        $('.ufb-form .ufb-range-slider').each(function () {
            var min_value = $(this).data('min-value');
            var max_value = $(this).data('max-value');
            var step = $(this).data('step');
            var pre_value = String($(this).data('pre-value'));
            var pre_value_array = pre_value.split('-');
            if (pre_value_array.length == 1) {
                pre_value_array = pre_value;
            }
            if (typeof (pre_value_array)) {
                $(this).slider({
                    min: min_value,
                    max: max_value,
                    step: step,
                    range: true,
                    slide: function (event, ui) {
                        slider_min_value = ui.values[0];
                        slider_max_value = ui.values[1];
                        $(this).closest('.ufb-range-slider-ref-wrap').find('.ufb-slider-value').html(slider_min_value + ' - ' + slider_max_value);
                    }
                });
            } else {
                $(this).slider({
                    min: min_value,
                    max: max_value,
                    step: step,
                    values: pre_value_array,
                    range: true,
                    slide: function (event, ui) {
                        $(this).closest('.ufb-range-slider-ref-wrap').find('.ufb-slider-value').html(min_value + ' - ' + max_value);
                    }
                });
            }
        });

        /**
         * Multiple Uploads Trigger
         */
        $('body').on('change', '.ufb-multiple-upload-trigger', function () {
            if ($(this).is(':checked')) {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-allow-multiple-upload-ref').show();
            } else {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-allow-multiple-upload-ref').hide();
            }
        });

        /**
         * Star Ratings add star
         */
        $('body').on('click', '.ufb-star-value-adder', function () {
            var key = $(this).attr('name');
            key = key.replace('_ref_key', '');
            var html = '<div class="ufb-each-star">\n\
                           <div class="ufb-star-label-wrap">\n\
                            <span class="ufb-star-label">Value 1</span>\n\
                            <input type="text" name="field_data[' + key + '][value][]" value="value" placeholder="Value">\n\
                          </div>\n\
                         <div class="ufb-star-label-wrap">\n\
                           <span class="ufb-star-label1">Label 1</span>\n\
                           <input type="text" name="field_data[' + key + '][label][]"/>\n\
                         </div>\n\
                        <span class="ufb-star-remover">X</span>\n\
                      </div>';
            //console.log(html);
            $(this).closest('.ufb-form-field').find('.ufb-star-value-wrap').append(html);
            $(this).closest('.ufb-form-field').find('.ufb-star-value-wrap').find('.ufb-each-star').last().find('input[type="text"]').val('');
            var value_count = 0;
            var label_count = 0;
            $(this).closest('.ufb-form-field').find('.ufb-star-label').each(function () {
                value_count++;
                $(this).html('Value ' + value_count);
            });
            $(this).closest('.ufb-form-field').find('.ufb-star-label1').each(function () {
                label_count++;
                $(this).html('Label ' + label_count);
            });
            $('.ufb-each-star').show();
            $(this).closest('.ufb-form-field').find('.ufb-star-value-wrap').find('.ufb-each-star').last().find('input[type="text"]').first().focus();

        });

        /**
         * Star Ratings star remover
         */
        $('body').on('click', '.ufb-star-remover', function () {
            var selector = $(this);
            $(this).closest('.ufb-each-star').fadeOut(50, function () {
                var value_count = 0;
                var label_count = 0;
                selector.closest('.ufb-star-value-wrap').find('.ufb-star-label').each(function () {
                    // alert(value_count);
                    if ($(this).closest('.ufb-each-star').is(':visible')) {
                        value_count++;
                        //alert($(this).html());
                        $(this).html('Value ' + value_count);
                    }

                });
                selector.closest('.ufb-star-value-wrap').find('.ufb-star-label1').each(function () {
                    // alert(value_count);
                    if ($(this).closest('.ufb-each-star').is(':visible')) {
                        label_count++;
                        //alert($(this).html());
                        $(this).html('Label ' + value_count);
                    }

                });
                $(this).remove();
            });

        });

        /**
         * Matrix Column Change Trigger
         */
        $('body').on('change', '.ufb-matrix-column', function () {
            $(this).closest('.ufb-field-settings-wrap').find('.ufb-matrix-each-head').hide();
            var column = $(this).val();
            var i;
            for (i = 1; i <= column; i++) {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-matrix-heading-' + i).show();
            }
        });

        /**
         * Matrix Row Adder
         */
        $('body').on('click', '.ufb-matrix-row-adder', function () {
            var key = $(this).attr('name');
            key = key.replace('_matrix_row_ref', '');
            var html = '<div class="ufb-each-matrix-row"><span class="ufb-matrix-row-label">Row 1 Heading</span> <input type="text" name="field_data[' + key + '][matrix_row_value][]" placeholder="Service" /> <span class="ufb-matrix-row-remover ufb-remove-btn">X</span></div>';
            $(this).closest('.ufb-form-field').find('.ufb-matrix-row-wrap').append(html);
            var value_count = 0;
            $(this).closest('.ufb-form-field').find('.ufb-matrix-row-label').each(function () {
                value_count++;
                $(this).html('Row ' + value_count + ' Heading');
            });
            $(this).closest('.ufb-form-field').find('.ufb-matrix-row-wrap').find('.ufb-each-matrix-row').last().find('input[type="text"]').first().focus();

        });

        /**
         * Matrix Row Remover
         */
        $('body').on('click', '.ufb-matrix-row-remover', function () {
            var selector = $(this);
            $(this).closest('.ufb-each-matrix-row').fadeOut(50, function () {
                var value_count = 0;
                selector.closest('.ufb-matrix-row-wrap').find('.ufb-matrix-row-label').each(function () {
                    // alert(value_count);
                    if ($(this).closest('.ufb-each-matrix-row').is(':visible')) {
                        value_count++;
                        //alert($(this).html());
                        $(this).html('Row ' + value_count + ' Heading');
                    }

                });
                $(this).remove();
            });

        });

        /**
         * Date Display Fields Sortable
         */

        $('.ufb-sortable').sortable();

        /**
         * Field Notes Fields Show Hide
         */
        $('body').on('change', '.ufb-field-notes-trigger', function () {
            if ($(this).val() == '0') {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-field-note-text').hide();
            } else {
                $(this).closest('.ufb-field-settings-wrap').find('.ufb-field-note-text').show();
            }
        });

        /**
         * Steps Change Trigger
         */
        $('body').on('click', '.ufb-step-trigger', function () {
            $('.ufb-step-trigger').removeClass('ufb-step-active-trigger');
            $(this).addClass('ufb-step-active-trigger');
            var step_ref = $(this).data('step-ref');
            $('.ufb-each-step-wrap').hide();
            $('.ufb-form-field-holder div[data-step-ref="' + step_ref + '"]').show();
        });

        /**
         * Steps Adder
         */
        $('body').on('click', '.ufb-step-adder', function () {
            var total_steps = $('.ufb-field-total-steps').val();
            var new_step = parseInt(total_steps) + 1;
            var step_trigger_html = '<li data-step-ref="' + new_step + '" class="ufb-step-trigger">Step ' + new_step + '</li>';
            var step_fields_html = '<input type="hidden" name="field_steps[step' + new_step + '_fields]" data-step-fields-ref="' + new_step + '" >';
            $('.ufb-form-wrap').append(step_fields_html);
            $('.ufb-form-steps').append(step_trigger_html);
            $('.ufb-field-total-steps').val(new_step);
            var step_details_html = '<div class="ufb-each-step-wrap" data-step-ref="' + new_step + '" style="display:none;">\n\
                                        <div class="ufb-step-title">Step ' + new_step + '</div>\n\
                                            <ul class="ufb-step-details-actions">\n\
                                                <li class="ufb-step-actions-triggers ufb-active-step-action" data-action="fields">Fields</li>\n\
                                                <li class="ufb-step-actions-triggers" data-action="details">Step Details</li>\n\
                                            </ul>\n\
                                        <div class="ufb-step-fields-wrap"></div>\n\
                                        <div class="ufb-step-details-wrap" style="display:none">\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Show Step Title</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="checkbox" name="field_data[step' + new_step + '_details][show_step_title]" value="1"/>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Step Title</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="text" name="field_steps[step' + new_step + '_details][step_title]"/>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Show Back Button</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="checkbox" name="field_steps[step' + new_step + '_details][show_back]" value="1"/>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Back Button Label</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="text" name="field_steps[step' + new_step + '_details][back_button_label]" placeholder="Back"/>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Show Next Step Button</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="checkbox" name="field_steps[step' + new_step + '_details][show_next]" value="1"/>\n\
                                                </div>\n\
                                            </div>\n\
                                            <div class="ufb-form-field-wrap">\n\
                                                <label>Next Button Label</label>\n\
                                                <div class="ufb-form-field">\n\
                                                    <input type="text" name="field_steps[step' + new_step + '_details][next_button_label]"  placeholder="Next"/>\n\
                                                </div>\n\
                                            </div>\n\
                                        </div>\n\
                                    </div>';
            $('.ufb-form-field-holder').append(step_details_html);

        });

        /**
         * Steps Remover
         */
        $('body').on('click', '.ufb-step-remover', function () {
            var confirmation_message = $(this).data('confirm-message');
            if (confirm(confirmation_message)) {
                var total_steps = $('.ufb-field-total-steps').val();
                var new_steps = parseInt(total_steps) - 1;
                if (new_steps != 0) {
                    $('li[data-step-ref="' + total_steps + '"]').remove();
                    $('input[data-step-fields-ref="' + total_steps + '"]').remove();
                    $('div.ufb-each-step-wrap[data-step-ref="' + total_steps + '"]').remove();
                    $('.ufb-field-total-steps').val(new_steps)
                }
            }
        });

        /**
         * Steps Action Change
         */
        $('body').on('click', '.ufb-step-actions-triggers', function () {
            $(this).parent().find('.ufb-step-actions-triggers').removeClass('ufb-active-step-action');
            $(this).addClass('ufb-active-step-action');
            if ($(this).data('action') == 'fields') {
                $(this).closest('.ufb-each-step-wrap').find('.ufb-step-fields-wrap').show();
                $(this).closest('.ufb-each-step-wrap').find('.ufb-step-details-wrap').hide();
            } else {
                $(this).closest('.ufb-each-step-wrap').find('.ufb-step-fields-wrap').hide();
                $(this).closest('.ufb-each-step-wrap').find('.ufb-step-details-wrap').show();
            }
        });

        /**
         * Conditional Tabs Trigger
         */
        $('.ufb-conditon-trigger').click(function () {
            var condition = $(this).data('condition');
            $('.ufb-conditon-trigger').removeClass('ufb-active-condition-trigger');
            $(this).addClass('ufb-active-condition-trigger');
            $('.ufb-condition-section').hide();
            $('.ufb-condition-section[data-condition="' + condition + '"]').show();

        });

        /**
         * Display Logic adder
         */
        $('.ufb-display-condition-adder').click(function () {
            var valid_fields = $('.ufb-condition-valid-fields-ref').html();
            var ref_fields = $('.ufb-condition-fields-ref').html();
            var condition_html = '<div class="ufb-each-condition">\n\
                                    <span class="ufb-condition-text">If</span> <select name="conditional_logic[display_logic][change_field][]">' + valid_fields + '</select>\n\
                                    <span class="ufb-condition-text">is</span> <select name="conditional_logic[display_logic][logic][]">\n\
                                            <option value="equal">Equals to</option>\n\
                                            <option value="less">Less than</option>\n\
                                            <option value="greater">Greater than</option>\n\
                                        </select>\n\
                                    <input type="text" name="conditional_logic[display_logic][logic_check_field][]"/>\n\
                                    <span class="ufb-condition-text"> then </span><select name="conditional_logic[display_logic][logic_action][]">\n\
                                        <option value="show">Show</option>\n\
                                        <option value="hide">Hide</option>\n\
                                    </select>\n\
                                    <select name="conditional_logic[display_logic][effect_field][]">' + ref_fields + '</select>\n\
                                    <span class="ufb-condition-remove ufb-remove-btn">X</span>\n\
                                </div>';
            $('.ufb-display-condition-wrap').append(condition_html);
        });

        /**
         * Email condition adder
         */
        $('.ufb-email-condition-adder').click(function () {
            var valid_fields = $('.ufb-condition-valid-fields-ref').html();
            var ref_fields = $('.ufb-condition-fields-ref').html();
            var condition_html = '<div class="ufb-each-condition">\n\
                                    <span class="ufb-condition-text">If</span> <select name="conditional_logic[email_logic][change_field][]">' + valid_fields + '</select>\n\
                                    <span class="ufb-condition-text">is</span> <select name="conditional_logic[email_logic][logic][]">\n\
                                            <option value="equal">Equals to</option>\n\
                                            <option value="less">Less than</option>\n\
                                            <option value="greater">Greater than</option>\n\
                                        </select>\n\
                                    <input type="text" name="conditional_logic[email_logic][logic_check_field][]"/>\n\
                                    <span class="ufb-condition-text"> then email to </span>\n\
                                    <input type="text" name="conditional_logic[email_logic][email_to][]" placeholder="abc@something.com"/>\n\
                                    <span class="ufb-condition-remove ufb-remove-btn">X</span>\n\
                                </div>';
            $('.ufb-email-condition-wrap').append(condition_html);
        });

        /**
         * Redirect condition adder
         */
        $('.ufb-redirect-condition-adder').click(function () {
            var valid_fields = $('.ufb-condition-valid-fields-ref').html();
            var ref_fields = $('.ufb-condition-fields-ref').html();
            var condition_html = '<div class="ufb-each-condition">\n\
                                    <span class="ufb-condition-text">If</span> <select name="conditional_logic[redirect_logic][change_field][]">' + valid_fields + '</select>\n\
                                    <span class="ufb-condition-text">is</span> <select name="conditional_logic[redirect_logic][logic][]">\n\
                                            <option value="equal">Equals to</option>\n\
                                            <option value="less">Less than</option>\n\
                                            <option value="greater">Greater than</option>\n\
                                        </select>\n\
                                    <input type="text" name="conditional_logic[redirect_logic][logic_check_field][]"/>\n\
                                    <span class="ufb-condition-text">then redirect to</span>\n\
                                    <input type="text" name="conditional_logic[redirect_logic][redirect_to][]" placeholder="http://something.com"/>\n\
                                    <span class="ufb-condition-remove ufb-remove-btn">X</span>\n\
                                </div>';
            $('.ufb-redirect-condition-wrap').append(condition_html);
        });

        $('body').on('click', '.ufb-condition-remove', function () {
            $(this).parent().fadeOut(500, function () {
                $(this).remove();
            })
        });

        /*
         * Change Entry Status
         */
        $('.ufb-change-status > a').click(function () {
            var entry_id = $(this).data('entry-id');
            var status = $(this).data('status');
            var selector = $(this);
            $.ajax({
                url: ufb_ajax_obj.ajax_url,
                type: 'post',
                data: {
                    entry_id: entry_id,
                    status: status,
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'ufb_entry_status_change_action'
                },
                success: function (res) {
                    var status_class = (status == 0) ? 'ufb-entry-read' : 'ufb-entry-unread';
                    var status_remove_class = (status == 0) ? 'ufb-entry-unread' : 'ufb-entry-read';
                    var status_text = (status == 0) ? 'Read' : 'Unread';
                    var new_status = (status == 0) ? 1 : 0;
                    var new_status_text = (status == 0) ? 'unread' : 'read';
                    selector.closest('tr').find('.ufb-entry-status').removeClass(status_remove_class).addClass(status_class).html(status_text);
                    selector.data('status', new_status);
                    selector.html('Mark as ' + new_status_text)
                }
            });
        });

        /*
         * Entry bulk actions
         */
        $('.ufb-entry-bulk-trigger').click(function () {
            if ($(this).closest('form').find('#bulk-action-selector-top').val() == '-1') {
                return false;
            }
        });

        /**
         * Entry details tab action
         */
        $('body').on('click', '.ufb-entry-detail-tab li', function () {
            $('.ufb-entry-detail-tab li').removeClass('ufb-active-entry-tab');
            $(this).addClass('ufb-active-entry-tab');
            $('.ufb-entry-detail-block').hide();
            if ($(this).data('entry-tab') == 'basic') {
                $('.ufb-entry-block').show();
            } else {
                $('.ufb-entry-extra-block').show();

            }
        });

        /**
         * Backend save settings
         */
        $('.ufb-save-settings-btn').click(function () {
            var selector = $(this);
            var disable_ui = ($('.ufb-ui-disable').is(':checked')) ? 1 : 0;
            var disable_fa = ($('.ufb-fa-disable').is(':checked')) ? 1 : 0;
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'save_settings_action',
                    disable_ui: disable_ui,
                    disable_fa: disable_fa
                },
                beforeSend: function () {
                    selector.parent().find('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    $('.ufb-ajax-loader').hide();
                    $('.ufb-msg').show().fadeOut(3000);

                }
            });
        });

        $('.ufb-free-form-importer').click(function () {
            var form_id = $('.ufb-form-id').val();
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'ufb_new_form_import_action',
                    form_id: form_id
                },
                beforeSend: function () {
                    $('.ufb-ajax-loader').show();
                },
                success: function (res) {
                    $('.ufb-ajax-loader').hide();
                    $('.ufb-msg').html(res).show().fadeOut(5000);

                }
            });
        });

        $('.ufb-from-type-trigger').click(function () {
            var from_type = $(this).val();
            if (from_type == 'custom') {

                $(this).closest('.ufb-field').find('.ufb-from-type input[type="text"]').show();
                $(this).closest('.ufb-field').find('.ufb-from-type select').hide();
            } else {
                $(this).closest('.ufb-field').find('.ufb-from-type input[type="text"]').hide();
                $(this).closest('.ufb-field').find('.ufb-from-type select').show();
            }
        });

        /**
         * Country State City Import
         */
        $('.ufb-import-button').click(function () {
            var import_type = $(this).data('import');
            var selector = $(this);
            $.ajax({
                type: 'post',
                url: ufb_ajax_obj.ajax_url,
                data: {
                    _wpnonce: ufb_ajax_obj.ajax_nonce,
                    action: 'import_table_action',
                    import_type: import_type
                },
                beforeSend: function (xhr) {
                    selector.parent().find('.ufb-ajax-loader').show();
                    selector.parent().find('.ufb-msg').show();
                },
                success: function (res) {
                    selector.parent().find('.ufb-ajax-loader').hide();
                    selector.parent().find('.ufb-msg').html(res);

                }
            });

        });

        $('body').on('change','.ufb-pre-populate-states-trigger',function () {
           var selector = $(this);
            var country_id = $(this).val();
            if (country_id != '') {
                $.ajax({
                    type: 'post',
                    url: ufb_ajax_obj.ajax_url,
                    data: {
                        _wpnonce: ufb_ajax_obj.ajax_nonce,
                        action: 'ufb_get_states_from_country_action',
                        country_id: country_id
                    },
                    beforeSend: function (xhr) {
                        selector.parent().find('.ufb-ajax-loader').show();
                        
                    },
                    success: function (res) {
                        selector.parent().find('.ufb-ajax-loader').hide();
                        selector.closest('.ufb-each-form-field').find('.ufb-states-ref').html(res);
                        

                    }
                });
            }
        });
        $('body').on('change','.ufb-pre-country-city-trigger',function(){
            var selector = $(this);
            var country_id = $(this).val();
            if (country_id != '') {
                $.ajax({
                    type: 'post',
                    url: ufb_ajax_obj.ajax_url,
                    data: {
                        _wpnonce: ufb_ajax_obj.ajax_nonce,
                        action: 'ufb_get_states_from_country_action',
                        country_id: country_id
                    },
                    beforeSend: function (xhr) {
                        
                        
                    },
                    success: function (res) {
                        
                        selector.closest('.ufb-each-form-field').find('.ufb-pre-populated-states-ref').html(res);
                        

                    }
                });
            }
        });
        $('body').on('change','.ufb-pre-populated-states-ref',function(){
            var selector = $(this);
            var state_id = $(this).val();
            
            if (state_id != '') {
                $.ajax({
                    type: 'post',
                    url: ufb_ajax_obj.ajax_url,
                    data: {
                        _wpnonce: ufb_ajax_obj.ajax_nonce,
                        action: 'ufb_get_cities_from_state_action',
                        state_id: state_id
                    },
                    beforeSend: function (xhr) {
                        
                        
                    },
                    success: function (res) {
                        
                        selector.closest('.ufb-each-form-field').find('.ufb-pre-populated-city-ref').html(res);
                        

                    }
                });
            }
        });
        



    }); //document.ready close
}(jQuery));