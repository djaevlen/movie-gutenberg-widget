<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://coyo.dk
 * @since      1.0.0
 *
 * @package    Movie_Gutenberg_Widget
 * @subpackage Movie_Gutenberg_Widget/admin/partials
 */
?>

<div class="wrap">

    <?php settings_errors(); ?>

    <h1>Movei Gutenberg Setting</h1>

    <form method="post" action="options.php">
        <?php settings_fields('MGW_settings'); ?>
        <?php do_settings_sections('MGW_settings'); ?>

        <table class="form-table">
            <tr valign="top">
                <th scope="row">The Movie Database API Key</th>
                <td>
                    <input type="text" name="MGW_api_key" style="width:50%;" value="<?php echo esc_attr(get_option('MGW_api_key')); ?>" />
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>
</div>