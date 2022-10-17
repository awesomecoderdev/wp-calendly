<?php

namespace AwesomeCoder\Plugin\Calendly\Backend;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Awesomecoder
 * @subpackage Awesomecoder/controller
 * @author     Mohammad Ibrahim <awesomecoder.org@gmail.com>
 *                                                              __
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ ____
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ ' __|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/	 |
 *  \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|__|
 *
 */
class Awesomecoder_Backend
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The pages of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $pages    The pages of this plugin.
	 */
	private  $pages;

	/**
	 * The metabox of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $metabox    The metabox of this plugin.
	 */
	private  $metabox;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		$this->pages = [
			"toplevel_page_calendly",
		];

		$this->metabox = [
			"post.php",
			"post-new.php",
		];
	}

	/**
	 * Initialize the main menu and set its properties.
	 *
	 * @since    1.0.0
	 *
	 */
	public function awesomecoder_admin_menu()
	{
		add_menu_page(__("WP Calendly", "awesomecoder"), __("WP Calendly", "awesomecoder"), 'manage_options', 'calendly', array($this, 'menu_activator_callback'), 'dashicons-image-filter', 50);
		add_submenu_page('calendly', __("Dashboard", "awesomecoder"), __("Dashboard", "awesomecoder"), 'manage_options', 'calendly', array($this, 'awesomecoder_dashboard_callback'));
	}

	/**
	 * Initialize the menu.
	 *
	 * @since    1.0.0
	 *
	 */
	public function menu_activator_callback()
	{
		// activate admin menu
	}

	/**
	 * Initialize the view of dashboard page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function awesomecoder_dashboard_callback()
	{
		ob_start();
		include_once AWESOMECODER_CALENDLY_PATH . 'backend/views/index.php';
		$index = ob_get_contents();
		ob_end_clean();
		echo $index;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Awesomecoder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Awesomecoder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (in_array($hook, $this->pages)) {
			wp_enqueue_style("{$this->plugin_name}", AWESOMECODER_CALENDLY_URL . 'backend/css/backend.css', array(), (filemtime(AWESOMECODER_CALENDLY_PATH . "backend/css/backend.css") ? filemtime(AWESOMECODER_CALENDLY_PATH . "backend/css/backend.css") : $this->version), 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Awesomecoder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Awesomecoder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script("{$this->plugin_name}", AWESOMECODER_CALENDLY_URL . 'backend/js/backend.js', array('jquery'), (filemtime(AWESOMECODER_CALENDLY_PATH . "backend/js/backend.js") ? filemtime(AWESOMECODER_CALENDLY_PATH . "backend/js/backend.js") : $this->version), false);
		// Some local vairable to get ajax url
		wp_localize_script($this->plugin_name, 'awesomecoder', array(
			"plugin" => [
				"name"		=> 	"Wp Calendly",
				"author" 	=>	"Mohammad Ibrahim",
				"email" 	=>	"awesomecoder.org@gmail.com",
				"website" 	=>	"https://awesomecoder.dev",
			],
			"url" 		=> get_bloginfo('url'),
			"ajaxurl"	=> admin_url("admin-ajax.php?action=awesomecoder_backend"),
		));

		if (in_array($hook, $this->pages)) {
			wp_enqueue_script("{$this->plugin_name}-backend", AWESOMECODER_CALENDLY_URL . 'backend/js/backend.js', array('jquery'), (filemtime(AWESOMECODER_CALENDLY_PATH . "backend/js/backend.js") ?? $this->version), true);
		}
	}
}
