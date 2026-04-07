<?php
$logo_white  = pl_opt('logo_white', get_template_directory_uri() . '/assets/images/logo-white.png');
$addr_1      = pl_opt('address_1', 'Sundvollhovet');
$addr_2      = pl_opt('address_2', 'N-3535 Krøderen');
$phone       = pl_opt('phone',     '+47 70 00 86 04');
$email       = pl_opt('email',     'post@plamek.no');
$footer_note = pl_opt('footer_note', 'Plamek er en del av Rubb Industries, som igjen er del av Zurhaar AS');
?>

<!-- Footer -->
<footer class="bg-[#041024] text-white py-12 sm:py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 gap-6 md:grid-cols-4 md:gap-8 lg:gap-12">
            <!-- Column 1: Company Info -->
            <div>
                <div class="mb-6 md:mb-8">
                    <img src="<?php echo esc_url($logo_white); ?>" alt="<?php bloginfo('name'); ?>" class="h-10 md:h-12 w-auto mb-4 md:mb-6" />
                </div>
                <div class="space-y-1 md:space-y-2 text-gray-300 text-xs md:text-sm">
                    <p><?php echo esc_html($addr_1); ?></p>
                    <p><?php echo esc_html($addr_2); ?></p>
                    <p><?php echo esc_html($phone); ?></p>
                    <p><a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-white transition-colors"><?php echo esc_html($email); ?></a></p>
                </div>
            </div>

            <!-- Column 2: Firma -->
            <div>
                <h3 class="text-sm md:text-lg font-medium mb-4 md:mb-6 uppercase tracking-wide">Firma</h3>
                <ul class="space-y-2 md:space-y-3 text-gray-300 text-xs md:text-sm">
                    <li><a href="<?php echo esc_url(home_url('/referanser')); ?>" class="hover:text-white transition-colors">Prosjekter</a></li>
                    <li><a href="https://www.rubbindustries.com" target="_blank" rel="noopener" class="hover:text-white transition-colors">Rubb Industries</a></li>
                    <li><a href="<?php echo esc_url(home_url('/om-plamek')); ?>" class="hover:text-white transition-colors">Om Plamek</a></li>
                    <li><a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="hover:text-white transition-colors">Kontakt</a></li>
                </ul>
            </div>

            <!-- Column 3: Tjenester -->
            <div>
                <h3 class="text-sm md:text-lg font-medium mb-4 md:mb-6 uppercase tracking-wide">Tjenester</h3>
                <ul class="space-y-2 md:space-y-3 text-gray-300 text-xs md:text-sm">
                    <li><a href="<?php echo esc_url(home_url('/dukskift-isolering')); ?>" class="hover:text-white transition-colors">Dukskift og isolering</a></li>
                    <li><a href="<?php echo esc_url(home_url('/montering')); ?>" class="hover:text-white transition-colors">Montering</a></li>
                    <li><a href="<?php echo esc_url(home_url('/vedlikehold')); ?>" class="hover:text-white transition-colors">Vedlikehold</a></li>
                    <li><a href="<?php echo esc_url(home_url('/flytting-av-hall')); ?>" class="hover:text-white transition-colors">Flytting av hall</a></li>
                    <li><a href="<?php echo esc_url(home_url('/reparering-av-skader')); ?>" class="hover:text-white transition-colors">Reparering av skader</a></li>
                </ul>
            </div>

            <!-- Column 4: Ressurser -->
            <div>
                <h3 class="text-sm md:text-lg font-medium mb-4 md:mb-6 uppercase tracking-wide">Ressurser</h3>
                <ul class="space-y-2 md:space-y-3 text-gray-300 text-xs md:text-sm">
                    <li><a href="<?php echo esc_url(home_url('/nyheter')); ?>" class="hover:text-white transition-colors">Nyheter</a></li>
                    <li><a href="<?php echo esc_url(home_url('/referanser')); ?>" class="hover:text-white transition-colors">Referanser</a></li>
                    <li><a href="<?php echo esc_url(home_url('/personvern')); ?>" class="hover:text-white transition-colors">Personvern</a></li>
                    <li><a href="<?php echo esc_url(home_url('/vilkar')); ?>" class="hover:text-white transition-colors">Vilkår og betingelser</a></li>
                </ul>
            </div>
        </div>

        <!-- Bottom Section -->
        <div class="border-t border-gray-700 mt-8 sm:mt-12 pt-6 sm:pt-8">
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                <div class="text-gray-400 text-xs sm:text-sm">
                    <p>&copy; <?php echo date('Y'); ?> — Plamek AS</p>
                </div>
                <div class="text-gray-400 text-xs sm:text-sm text-center sm:text-left">
                    <p><?php echo esc_html($footer_note); ?></p>
                </div>
                <div class="flex-shrink-0">
                    <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/miljofyrtarn.webp'); ?>"
                         alt="Miljøfyrtårn"
                         class="h-16 w-auto"
                         loading="lazy">
                </div>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
