<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

define('PI_ENQUEUE_CORE', get_template_directory_uri() . '/core/');
define('PI_FILE_CORE', get_template_directory() . '/core/');

if (!class_exists('roark_framework')) {

    class roark_framework {

        public static $option;

        function __construct() {
            $this->_init();
            add_filter('mce_buttons_2', array($this, 'add_font_setting_menus') );
            add_action('wp_head', array($this, 'roark_render_css'));
            add_action('wp_footer', array($this, 'roark_render_js'));
            add_action('wp_enqueue_scripts', array($this, 'roark_render_custom_style'));
            add_action('wp_ajax_roark_notice', array($this, 'roark_update_notice_status'));
        }

        public static function wiloke_get_nav_menus()
        {
            $aNavMenus      = wp_get_nav_menus();
            $aParseNavMenus = array();

            if (!empty($aNavMenus)) {
                $aParseNavMenus[-1] = esc_html__('Use default menu', 'roark');
                foreach ($aNavMenus as $aMenu) {
                    $aParseNavMenus[$aMenu->term_id] = $aMenu->name;
                }
            } else {
                $aParseNavMenus[-1] = esc_html__('There are no menus', 'roark');
            }

            return $aParseNavMenus;
        }

        public function roark_update_notice_status()
        {
            if (isset($_POST['version'])) {
                $aData[] = $_POST['version'];
                update_option('roark_notice', $aData);
            }
            die();
        }

        public function _init()
        {
            $option       = get_option('roark_option');
            self::$option = $option;
            add_action('wp_enqueue_scripts', array($this, 'roark_render_google_font'));
        }

        public function add_font_setting_menus($buttons){
            array_unshift( $buttons, 'fontselect' ); // Add Font Select
            array_unshift( $buttons, 'fontsizeselect' ); // Add Font Size Select
            return $buttons;
        }

        public static function roark_loader()
        {
            if (isset(self::$option['preloader']) && !empty(self::$option['preloader'])): ?>
				<div class="preloader">
			  		<div class="progress"></div>
				</div>
			<?php endif;
        }

        // Custon CSS
        public function roark_render_css()
        {
            if (isset(self::$option['custom_css']) && !empty(self::$option['custom_css'])): ?>
				<style type="text/css">
					<?php print self::$option['custom_css'];?>
				</style>
			<?php endif;
        }

        public function roark_render_custom_style() {

            $css = '';

            $dir = get_template_directory();

            if( isset(self::$option['color_hover']['color']) && !empty(self::$option['color_hover']['color']) ) {
                $file = $content = $filename = '';
                $filename = $dir . '/css/custom/color-primary.css';

                if( file_exists($filename) ) {
                    ob_start();
                    include $filename;
                    $content = ob_get_clean();
                    $css .= str_replace('#363bf6', self::$option['color_hover']['color'], $content);
                }
            }

            if( isset(self::$option['color_paragraph']['color']) && !empty(self::$option['color_paragraph']['color']) ) {
                $file = $content = $filename = '';
                $filename = $dir . '/css/custom/color-base.css';

                if( file_exists($filename) ) {
                    ob_start();
                    include $filename;
                    $content = ob_get_clean();
                    $css .= str_replace('#666', self::$option['color_paragraph']['color'], $content);
                }
            }

            if( isset(self::$option['color_title']['color']) && !empty(self::$option['color_title']['color']) ) {
                $file = $content = $filename = '';
                $filename = $dir . '/css/custom/color-title.css';
                if( file_exists($filename) ) {
                    ob_start();
                    include $filename;
                    $content = ob_get_clean();
                    $css .= str_replace('#000', self::$option['color_title']['color'], $content);
                }
            }

            if (isset(self::$option['roark_google_font']) && !empty(self::$option['roark_google_font'])) {

                if (isset(self::$option['roark_font_title']) && !empty(self::$option['roark_font_title']) && self::$option['roark_font_title'] != 'default') {

                    $filename = $dir . '/css/custom/font-title.css';

                    if( file_exists($filename) ) {
                        $font        = roark_explode_font(self::$option['roark_font_title']);
                        $fontName   = trim(str_replace('+', ' ', $font[0]));

                        ob_start();
                        include $filename;
                        $content = ob_get_clean();                        
                        $css .= str_replace('Montserrat', $fontName, $content);
                    }

                }

                if (isset(self::$option['roark_font_sub_title']) && !empty(self::$option['roark_font_sub_title']) && self::$option['roark_font_sub_title'] != 'default') {

                    $filename = $dir . '/css/custom/font-sub-title.css';

                    if( file_exists($filename) ) {

                        $font        = roark_explode_font(self::$option['roark_font_sub_title']);
                        $fontName        = trim(str_replace('+', ' ', $font[0]));

                        ob_start();
                        include $filename;
                        $content = ob_get_clean();  
                        $css .= str_replace('Droid serif', $fontName, $content);
                    }
                }

                if (isset(self::$option['roark_font_content']) && !empty(self::$option['roark_font_content']) && self::$option['roark_font_content'] != 'default') {

                    $filename = $dir . '/css/custom/font-base.css';

                    if( file_exists($filename) ) {

                        $font        = roark_explode_font(self::$option['roark_font_content']);
                        $fontName        = trim(str_replace('+', ' ', $font[0]));

                        ob_start();
                        include $filename;
                        $content = ob_get_clean();  
                        $css .= str_replace('Droid serif', $fontName, $content);
                    }
                    
                }
            }

            if( !empty($css) ) {
                wp_add_inline_style( 'roark_style', $css );
            }
        }

        // Custon JS
        public function roark_render_js()
        {
            if (isset(self::$option['custom_js']) && !empty(self::$option['custom_js'])): ?>
				<script type="text/javascript">
					<?php print self::$option['custom_js'];?>
				</script>
			<?php endif;
        }

        // Option Google Font
        public static function roark_googlefont_option()
        {
            $font_google = array();

            if (isset(self::$option['roark_google_font']) && !empty(self::$option['roark_google_font'])) {
                $font_google = roark_parse_googlefont(self::$option['roark_google_font']);
            }

            return $font_google;
        }

        // RENDER GOOGLE FONT
        public function roark_render_google_font()
        {
            if (isset(self::$option['roark_google_font']) && !empty(self::$option['roark_google_font'])) {
                $customGoogleFont = explode("\n", self::$option['roark_google_font']);

                foreach ($customGoogleFont as $key => $googleFont) {
                    if (!empty($googleFont)) {

                        preg_match('/(?:family=)([^:&\'\"]*)(?:\:?)((?:[^&\'\"]*))/', $googleFont, $match);

                        $font = str_replace('+', ' ', $match[1]);

                        if (isset($match[2])) {
                            $font .= ':' . $match[2];
                        }

                        wp_enqueue_style('roark_customgooglefont_' . $key, roark_studio_fonts_url($font), array(), null);
                    }
                }
            }
        }

        // RENDER FAVICON
        public static function roark_render_favicon()
        {
            if (isset(self::$option['favicon']['url'])): ?>
				<link rel="shortcut icon" href="<?php echo esc_url(self::$option['favicon']['url']); ?>">
			<?php endif;
        }

        // RENDER LOGO
        public static function roark_render_logo()
        {
            $src = isset(self::$option['logo']['url']) ? self::$option['logo']['url'] : '';
            $src = empty($src) ? get_template_directory_uri() . '/img/logo.png' : $src;
            if (has_filter('roark_filter_render_logo')) {
                $src = apply_filters('roark_filter_render_logo', $src);
            }
            ?>
			<div class="logo">
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr(bloginfo('name')); ?>">
					<img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr(bloginfo('name')) ?>">
				</a>
			</div>
			<?php
		}

        // SHEARCH ICON
        public static function roark_icon_search()
        {
            if (!isset(self::$option['header_option']['social_icon']) || empty(self::$option['header_option']['social_icon'])): ?>
				<span class="icon-share"><i class="fa fa-share-alt"></i></span>
			<?php endif;
        }

        // SEARCH FROM POPUP
        public static function roark_popup_search_form()
        {
            if (!isset(self::$option['header_option']['search_icon']) || empty(self::$option['header_option']['search_icon'])): ?>
				<div class="popup-search">
					<div class="tb">
						<div class="tb-cell ver-middle">
							<form role="search" method="get" class="form-search" action="<?php echo esc_url(home_url('/')); ?>">
								<input type="search" class="input-search" value="<?php echo get_search_query(); ?>" name="s"  placeholder="<?php echo esc_html__('Search...', 'roark') ?>">
								<button type="submit" class="submit"><i class="fa fa-search"></i></button>
							</form>
						</div>
					</div>
					<div class="close-popup"></div>
				</div>
			<?php endif;
        }

        // SOCIAL ICON
        public static function roark_icon_social()
        {
            if (!isset(self::$option['header_option']['search_icon']) || empty(self::$option['header_option']['search_icon'])): ?>
				<span class="icon-search"><i class="fa fa-search"></i></span>
			<?php endif;
        }

        // POPUP SOCIAL
        public static function roark_popup_social()
        {
            $socials = array(
                'fa-facebook'     => 'Facebook',
                'fa-twitter'      => 'Twitter',
                'fa-google-plus'  => 'Google Plus',
                'fa-pinterest'    => 'Pinterest',
                'fa-linkedin'     => 'Linkedin',
                'fa-rss'          => 'RSS',
                'fa-instagram'    => 'Instagram',
                'fa-skype'        => 'Skype',
                'fa-tumblr'       => 'Tumblr',
                'fa-vimeo-square' => 'Vimeo',
                'fa-yahoo'        => 'Yahoo',
                'fa-youtube'      => 'Youtube',
            );
            if (!isset(self::$option['header_option']['social_icon']) || empty(self::$option['header_option']['social_icon'])): ?>
				<div class="popup-social">
					<div class="tb">
						<div class="tb-cell ver-middle">
							<?php foreach ($socials as $k => $v): ?>
								<?php if (isset(self::$option[$k]) && !empty(self::$option[$k])): ?>
									<a href="<?php echo esc_url(self::$option[$k]); ?>"><i class="fa <?php echo esc_attr($k) ?>"></i> <?php echo esc_html($v); ?></a>
								<?php endif;?>
							<?php endforeach;?>
						</div>
					</div>
					<div class="close-popup"></div>
				</div>
			<?php endif;
        }

        // COPPYRIGHT
        public static function roark_copyright()
        {
            if (isset(self::$option['footer_text']) && !empty(self::$option['footer_text'])): ?>
				<div class="copyright">
					<p><?php echo wp_kses(self::$option['footer_text'], array('a' => array('href' => array(), 'target' => array(), 'title' => array()), 'strong' => array(), 'i' => array())); ?></p>
				</div>
			<?php endif;
        }

        // FOOTER INSTAGRAM
        public static function roark_footer_instagram()
        {
            $settings     = get_option('roak_instagram_settings');
            $title        = isset(self::$option['instagram_title']) ? self::$option['instagram_title'] : '';
            $userName     = isset(self::$option['instagram_username']) ? self::$option['instagram_username'] : '';
            $accesstoken  = isset($settings['access_token']) ? $settings['access_token'] : '';
            $transientKey = 'wiloke_instagram_caching_' . $userName;

            if (!empty($userName) && !empty($accesstoken)): ?>

				<div class="widget">
					<h4 class="h6 widget-title"><?php echo esc_html($title); ?></h4>

					<?php 
						$isRequestInstagram = true;

			            if (!empty(self::$option['instagram_cache_interval'])) {
			                $instagramContent = get_transient($transientKey);

			                if (!empty($instagramContent)) {
			                    print $instagramContent;
			                    $isRequestInstagram = false;
			                }
			            }

		            if ($isRequestInstagram):

		            	$userId= self::get_instagram_userid($userName, $accesstoken,array( 'decompress' => false, 'timeout' => 30, 'sslverify'   => true ));

		                $url = 'https://api.instagram.com/v1/users/'. $userId .'/media/recent?access_token='. $accesstoken .'&count=6';
		            	
		                $getInstagram = wp_remote_get(esc_url_raw($url), array('decompress' => false));

		                if ( !is_wp_error($getInstagram) ):

		                    $getInstagram = wp_remote_retrieve_body($getInstagram);
		                    
		                    $getInstagram = json_decode($getInstagram);

		                    if ($getInstagram && $getInstagram->meta->code === 200) :

		                        $count = count($getInstagram->data) > 6 ? 6 : count($getInstagram->data);

		                        ob_start(); ?>

								<div class="footer-instagram">

									<?php for ($i = 0; $i < $count; $i++):

		                           	 	$caption = isset($getInstagram->data[$i]->caption->text) ? $getInstagram->data[$i]->caption->text : 'Instagram';?>
										<a href="<?php echo esc_url($getInstagram->data[$i]->link); ?>" style="background-image: url(<?php echo esc_url($getInstagram->data[$i]->images->standard_resolution->url) ?>)" target="_blank">
											<img src="<?php echo esc_url($getInstagram->data[$i]->images->standard_resolution->url); ?>" alt="<?php echo esc_attr($caption); ?>"  />
										</a>
									<?php endfor;?>

								</div>

    							<?php

	            				$instagramContent = ob_get_clean();

		                        print $instagramContent;

		                        if (!empty(self::$option['instagram_cache_interval'])) {
		                            delete_transient($transientKey);
		                            set_transient($transientKey, $instagramContent, absint(self::$option['instagram_cache_interval']));
		                        }

		                    endif;

		                endif;

		            endif;

		            ?>

	            </div>

            <?php endif;
        }

        protected static function get_instagram_userid($info, $accessToken, $args) {

	        $url = 'https://api.instagram.com/v1/users/search?q='.$info.'&access_token='.$accessToken;

	        $oSearchProfile = wp_remote_get( esc_url_raw( $url ), $args);
	        
	        if ( !empty($oSearchProfile) && !is_wp_error($oSearchProfile) ) {
	            $oSearchProfile = wp_remote_retrieve_body($oSearchProfile);
	            $oSearchProfile = json_decode($oSearchProfile);

	            if ( $oSearchProfile->meta->code === 200 ) {

	               foreach ( $oSearchProfile->data as $oInfo ) {

	                    if ( $oInfo->username === $info ) {
	                        return $oInfo->id;
	                    }
	               }
	            }
	        }

	        return '';
	    }

    }

    new roark_framework();

    require_once PI_FILE_CORE . 'TGM_Activation_Plugin/plugin_active.php';
    require_once PI_FILE_CORE . 'option_theme.php';
    require_once PI_FILE_CORE . 'admin/admin_init.php';
    require_once PI_FILE_CORE . 'blog/blog.php';
    require_once PI_FILE_CORE . 'visual/visual_init.php';
    require_once PI_FILE_CORE . 'portfolio/portfolio.php';
    require_once PI_FILE_CORE . 'instagram/instagram.php';

    // AFTER IMPORT DEMO
    add_action('import_end', 'roark_after_import_demo');
    function roark_after_import_demo() {

        // Update Front page displays
        $displays   = get_option('show_on_front');
        $page_front = get_page_by_path('revolution');
        $page_posts = get_page_by_path('blog');

        if ($page_front) {
            update_option('page_on_front', $page_front->ID);
        }

        if ($page_posts) {
            update_option('page_for_posts', $page_posts->ID);
        }

        if ($page_posts || $page_front) {

            if ($displays == 'posts') {
                update_option('show_on_front', 'page');
            }
        }
    }

}
