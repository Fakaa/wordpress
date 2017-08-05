<?php
                   
                            switch ( $field_type ) {
                                /**
                                 * HTML Fields
                                 */
                                case 'textfield':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/textfield.php');
                                    break;
                                case 'textarea':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/textarea.php');
                                    break;
                                case 'email':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/email.php');
                                    break;
                                case 'dropdown':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/dropdown.php');
                                    break;
                                case 'radio':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/radio.php');
                                    break;
                                case 'checkbox':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/checkbox.php');
                                    break;
                                case 'password':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/password.php');
                                    break;
                                case 'hidden':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/hidden.php');
                                    break;
                                case 'number':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/number.php');
                                    break;
                                case 'submit':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/submit.php');
                                    break;
                                case 'captcha':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/html-fields/captcha.php');
                                    break;
                                /**
                                 * UI Elements
                                 */
                                case 'datepicker':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/ui-elements/datepicker.php');
                                    break;
                                case 'datepicker-daterange':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/ui-elements/datepicker-daterange.php');
                                    break;
                                case 'dropdown-date':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/ui-elements/dropdown-date.php');
                                    break;
                                case 'dropdown-daterange':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/ui-elements/dropdown-daterange.php');
                                    break;
                                case 'ui-slider':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/ui-elements/ui-slider.php');
                                    break;

                                /**
                                 * Custom Elements
                                 */
                                case 'file-uploader':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/file-uploader.php');
                                    break;
                                case 'custom-texts':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/custom-texts.php');
                                    break;
                                case 'agreement-block':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/agreement-block.php');
                                    break;
                                case 'google-map-address':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/google-map-address.php');
                                    break;
                                case 'url':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/url.php');
                                    break;
                                case 'country-dropdown':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/countries-dropdown.php');
                                    break;
                                case 'states-dropdown':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/states-dropdown.php');
                                    break;
                                case 'city-dropdown':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/cities-dropdown.php');
                                    break;
                                case 'wysiwyg':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/custom-elements/wysiwyg.php');
                                    break;

                                /**
                                 * Survey Elements
                                 */
                                case 'star-rating':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/survey-elements/star-rating.php');
                                    break;
                                case 'like-dislike':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/survey-elements/like-dislike.php');
                                    break;
                                case 'choice-matrix':
                                    include(UFB_PATH . '/inc/views/backend/form-elements/survey-elements/choice-matrix.php');
                                    break;
                                default:
                                    break;
                            }
                        