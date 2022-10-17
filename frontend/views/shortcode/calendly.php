<?php

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

$currentMonth = date("Y-m");
$calendly = "https://calendly.com/corehub-jay/15min?embed_domain=corehub.co&embed_type=Inline&back=1&month=$currentMonth";

?>
<script>
    const wp_calendly_base = '<?php echo $calendly; ?>';
</script>
<div id="wp_calendly">
    <div class="calendly-inline-widget" data-url="<?php echo "{$calendly}"; ?>" style="min-width:100%; width:100%; height:100%;">
    </div>
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
</div>