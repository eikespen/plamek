<?php
/**
 * Site-wide settings page: Settings → Plamek.
 * Stores values in wp_options under pl_<key>. Read with pl_opt('key').
 */
defined('ABSPATH') || exit;

/* ── Register settings ── */
add_action('admin_init', function () {
    $keys = [
        'logo_white',
        'phone',
        'email',
        'address_1',
        'address_2',
        'footer_note',
    ];
    foreach ($keys as $k) {
        register_setting('pl_options_group', 'pl_' . $k, [
            'type'              => 'string',
            'sanitize_callback' => 'sanitize_text_field',
            'default'           => '',
        ]);
    }
});

/* ── Add menu item under Settings ── */
add_action('admin_menu', function () {
    add_options_page(
        'Plamek-innstillinger',
        'Plamek',
        'manage_options',
        'pl-options',
        'pl_render_options_page'
    );
});

/* ── Render settings page ── */
function pl_render_options_page() {
    if (!current_user_can('manage_options')) return;
    ?>
    <div class="wrap">
        <h1>Plamek-innstillinger</h1>
        <p>Globale innstillinger som vises på alle sider (header, footer, kontaktinfo).</p>

        <form method="post" action="options.php">
            <?php settings_fields('pl_options_group'); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="pl_logo_white">Logo (hvit)</label></th>
                    <td>
                        <input type="text" id="pl_logo_white" name="pl_logo_white" value="<?php echo esc_attr(get_option('pl_logo_white')); ?>" class="regular-text" placeholder="https://…/logo-white.png">
                        <p class="description">URL til hvit Plamek-logo som vises i header og footer. La stå tom for å bruke standardlogoen i temaet.</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pl_phone">Telefon</label></th>
                    <td>
                        <input type="text" id="pl_phone" name="pl_phone" value="<?php echo esc_attr(get_option('pl_phone')); ?>" class="regular-text" placeholder="+47 70 00 86 04">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pl_email">E-post</label></th>
                    <td>
                        <input type="text" id="pl_email" name="pl_email" value="<?php echo esc_attr(get_option('pl_email')); ?>" class="regular-text" placeholder="post@plamek.no">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pl_address_1">Adresse linje 1</label></th>
                    <td>
                        <input type="text" id="pl_address_1" name="pl_address_1" value="<?php echo esc_attr(get_option('pl_address_1')); ?>" class="regular-text" placeholder="Sundvollhovet">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pl_address_2">Adresse linje 2</label></th>
                    <td>
                        <input type="text" id="pl_address_2" name="pl_address_2" value="<?php echo esc_attr(get_option('pl_address_2')); ?>" class="regular-text" placeholder="N-3535 Krøderen">
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="pl_footer_note">Footer-notat</label></th>
                    <td>
                        <input type="text" id="pl_footer_note" name="pl_footer_note" value="<?php echo esc_attr(get_option('pl_footer_note')); ?>" class="large-text" placeholder="Plamek er en del av Rubb Industries, …">
                    </td>
                </tr>
            </table>

            <?php submit_button('Lagre endringer'); ?>
        </form>
    </div>
    <?php
}
