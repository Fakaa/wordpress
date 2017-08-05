<?php

if (!class_exists('RoarkInstagram')) {
    class RoarkInstagram
    {

        public function __construct()
        {
            add_action('admin_menu', array($this, 'register_menu'));
        }

        public function register_menu()
        {
            add_theme_page(esc_html__('Roark Instagram', 'roark'), esc_html__('Instagram Settings', 'roark'), 'edit_theme_options', 'roak-instagram', array($this, 'instagram_settings'));
        }

        public function instagram_settings()
        {
            if (current_user_can('edit_theme_options') && isset($_POST['instagram'])) {
                $this->update_settings('roak_instagram_settings', $_POST['instagram']);
            }

            $aInstagram           = get_option('roak_instagram_settings');
            $aInstagram           = $aInstagram ? $aInstagram : array('userid' => '', 'profile_picture' => '', 'access_token' => '', 'username' => '', 'profile_picture', 'cache_interval' => 864000);
            $instagramRedirectUri = 'https://www.instagram.com/oauth/authorize/?client_id=54da896cf80343ecb0e356ac5479d9ec&scope=basic+public_content&redirect_uri=http://api.web-dorado.com/instagram/?return_url=' . admin_url('options-general.php?page=roak-instagram') . '&response_type=token';

            if (isset($_GET['access_token']) && !empty($_GET['access_token'])) {
                $url       = 'https://api.instagram.com/v1/users/self/?access_token=' . $_GET['access_token'];
                $oResponse = wp_remote_get($url, array('timeout' => 120, 'httpversion' => '1.1'));

                if (!empty($oResponse) && !is_wp_error($oResponse)) {
                    $oResponse = $oResponse['body'];
                    $oResponse = json_decode($oResponse);

                    if ($oResponse->meta->code == 200) {
                        $aNewInstagram['username']        = $oResponse->data->username;
                        $aNewInstagram['userid']          = $oResponse->data->id;
                        $aNewInstagram['profile_picture'] = $oResponse->data->profile_picture;
                        $aNewInstagram['access_token']    = $_GET['access_token'];
                        $aInstagram                       = array_merge($aInstagram, $aNewInstagram);

                        update_option('roak_instagram_settings', $aInstagram);
                    }
                }

                unset($_GET['access_token']);
            }?>

            <form action="" method="POST">

                <table class="form-table">
                    <tbody>
                        <tr>
                            <th scope="row"><label for="sign-in-with-instagram"><?php esc_html_e('Sign in with Instagram', 'roark');?></label></th>
                            <td>
                                <a id="sign-in-with-instagram" class="button button-primary" href="<?php echo esc_url($instagramRedirectUri); ?>"><?php esc_html_e('Do It', 'roark');?></a>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"></th>
                            <td>
                                <?php if (!empty($aInstagram['profile_picture'])) {?>
                                    <img style="width: 50px; height: 50px; border-radius: 100%;" src="<?php echo esc_url($aInstagram['profile_picture']); ?>" alt="Profile Picture" />
                                <?php }?>
                                <input id="profilepicture" type="hidden" name="instagram[profile_picture]" value="<?php echo esc_url($aInstagram['profile_picture']); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="userid"><?php esc_html_e('User ID', 'roark');?></label></th>
                            <td>
                                <input id="userid" type="text" name="instagram[userid]" value="<?php echo esc_attr($aInstagram['userid']); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="username"><?php esc_html_e('User Name', 'roark');?></label></th>
                            <td>
                                <input id="username" type="text" name="instagram[username]" value="<?php echo esc_attr($aInstagram['username']); ?>"/>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="access-token"><?php esc_html_e('Access Token', 'roark');?></label>
                            </th>
                            <td>
                                <input id="access-token" type="text" name="instagram[access_token]" value="<?php echo esc_attr($aInstagram['access_token']); ?>"/>
                                </p>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><label for="cache-interval"><?php esc_html_e('Cache Interval', 'roark');?></label></th>
                            <td>
                                <input id="cache-interval" type="text" name="instagram[cache_interval]" value="<?php echo esc_attr($aInstagram['cache_interval']); ?>"/>
                                <p><?php esc_html_e('Leave empty to clear cache. Unit: mini seconds', 'roark');?></p>
                            </td>
                        </tr>

                    </tbody>
                    <tr>
                        <th></th>
                        <td><input type="submit" class="button button-primary" value="<?php esc_html_e('Save', 'roark');?>"></td>
                    </tr>
                </table>

            </form>

            <?php
        }

        public function update_settings($key, $aData)
        {
            update_option($key, $aData);
        }

    }

    new RoarkInstagram();
}