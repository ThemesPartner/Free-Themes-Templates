<?php
function siaracorporatebusiness_add_design_template_menu() {
    add_theme_page(
        __('Starter Template', 'siaracorporatebusiness'), // page title
        __('Starter Template', 'siaracorporatebusiness'), // menu title
        'edit_theme_options',                      // capability
        'siaracorporatebusiness-select-template',              // slug
        'siaracorporatebusiness_render_template_admin_page'    // callback function
    );
}
add_action('admin_menu', 'siaracorporatebusiness_add_design_template_menu');

function siaracorporatebusiness_render_template_admin_page() {
    // Handle form submission
    if (isset($_POST['siaracorporatebusiness_selected_template'])) {
        $selected_template = sanitize_text_field($_POST['siaracorporatebusiness_selected_template']);
        set_theme_mod('siaracorporatebusiness_homepage_template', $selected_template);
        echo '<div class="updated"><p><strong>Design template updated!</strong></p></div>';
    }

    $current_template = get_theme_mod('siaracorporatebusiness_homepage_template', 'frontpage-design1.php');

    $free_templates = array(
        'frontpage-design1.php' => 'Design 1',
        'frontpage-design2.php' => 'Design 2',
        'frontpage-design3.php' => 'Design 3',
    );

    $pro_templates = array(
        'frontpage-pro1.php' => 'Pro Design 1',
        'frontpage-pro2.php' => 'Pro Design 2',
        'frontpage-pro3.php' => 'Pro Design 3',
    );

    $pro_link = 'https://www.buywpthemes.net/products/wordpress-portfolio-template'; // 🔁 Change this to your URL
    ?>

    <div class="wrap">
        <h1>Select Homepage Design</h1>
        <form method="post">
            <style>
                .template-option {
                    display: inline-block;
                    width: 20%;
                    margin: 20px;
                    border: 2px solid #ddd;
                    padding: 10px;
                    text-align: center;
                    background: #fff;
                    position: relative;
                }
                .template-option img {
                    max-width: 100%;
                    height: auto;
                    display: block;
                    margin-bottom: 10px;
                }
                .template-option.active {
                    border-color: #007cba;
                    box-shadow: 0 0 10px rgba(0, 124, 186, 0.4);
                }
                .template-option input[type="submit"] {
                    margin-top: 10px;
                }
                .template-option.locked::after {
                    content: "Pro";
                    position: absolute;
                    top: 10px;
                    left: 10px;
                    background: #d54e21;
                    color: #fff;
                    padding: 3px 8px;
                    font-size: 12px;
                    border-radius: 3px;
                }
            </style>

            <h2>Free Templates</h2>
            <?php foreach ($free_templates as $file => $label): ?>
                <div class="template-option <?php echo $current_template === $file ? 'active' : ''; ?>">
                    <img src="https://raw.githubusercontent.com/ThemesPartner/Free-Themes-Templates/main/siara-corporate-business/screenshots/<?php echo esc_attr($file); ?>.jpg" alt="<?php echo esc_attr($label); ?>" />
                    <p><?php echo esc_html($label); ?></p>
                    <button type="submit" name="siaracorporatebusiness_selected_template" value="<?php echo esc_attr($file); ?>" class="button button-primary">
                        <?php echo $current_template === $file ? 'Activated' : 'Select & Publish'; ?>
                    </button>
                </div>
            <?php endforeach; ?>

            <h2 style="margin-top: 50px;">Pro Templates</h2>
            <?php foreach ($pro_templates as $file => $label): ?>
                <div class="template-option locked">
					<img src="https://raw.githubusercontent.com/ThemesPartner/Free-Themes-Templates/main/siara-corporate-business/screenshots/<?php echo esc_attr($file); ?>.jpg" alt="<?php echo esc_attr($label); ?>" />
                    <p><?php echo esc_html($label); ?></p>
                    <a href="<?php echo esc_url($pro_link); ?>" target="_blank" class="button button-secondary">Unlock Pro</a>
                </div>
            <?php endforeach; ?>
        </form>
    </div>
    <?php
}
