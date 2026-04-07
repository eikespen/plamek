<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS via Play CDN (compile to a static file for production) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,typography"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            fontFamily: {
              sans: ['Inter', 'ui-sans-serif', 'system-ui', 'sans-serif']
            },
            colors: {
              plamek: {
                DEFAULT: '#003a76',
                dark:    '#002855',
                darker:  '#041024',
                light:   '#bfcedd'
              }
            }
          }
        }
      }
    </script>

    <?php wp_head(); ?>
</head>
<body <?php body_class('font-sans antialiased text-slate-800'); ?>>
<?php wp_body_open(); ?>

<?php
// Logos: site setting first, fall back to bundled image
$logo_white = pl_opt('logo_white', get_template_directory_uri() . '/assets/images/logo-white.png');
$site_phone = pl_opt('phone', '70 00 86 04');
?>

<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-[9998] transition-all duration-300 bg-[#003a76] shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 sm:h-24">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url($logo_white); ?>"
                         alt="<?php bloginfo('name'); ?>"
                         class="h-12 sm:h-16 w-auto" />
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6 xl:space-x-8">
                <a href="<?php echo esc_url(home_url('/')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_front_page() ? 'text-white' : ''; ?>">
                    Hjem
                </a>

                <!-- Services Dropdown -->
                <div class="relative group">
                    <button class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all flex items-center">
                        Tjenester
                        <svg class="w-4 h-4 ml-1 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div class="absolute left-0 mt-2 w-64 bg-white shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                        <div class="py-2">
                            <a href="<?php echo esc_url(home_url('/tjenester')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Alle tjenester</a>
                            <a href="<?php echo esc_url(home_url('/montering')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Montering</a>
                            <a href="<?php echo esc_url(home_url('/vedlikehold')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Vedlikehold</a>
                            <a href="<?php echo esc_url(home_url('/dukskift-isolering')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Dukskift og isolering</a>
                            <a href="<?php echo esc_url(home_url('/flytting-av-hall')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Flytting av hall</a>
                            <a href="<?php echo esc_url(home_url('/reparering-av-skader')); ?>" class="block px-4 py-3 text-sm text-gray-700 hover:bg-[#003a76] hover:text-white transition-colors">Reparering av skader</a>
                        </div>
                    </div>
                </div>

                <a href="<?php echo esc_url(home_url('/montering')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('montering') ? 'text-white' : ''; ?>">
                    Montering
                </a>
                <a href="<?php echo esc_url(home_url('/vedlikehold')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('vedlikehold') ? 'text-white' : ''; ?>">
                    Vedlikehold
                </a>
                <a href="<?php echo esc_url(home_url('/referanser')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('referanser') ? 'text-white' : ''; ?>">
                    Referanser
                </a>
                <a href="<?php echo esc_url(home_url('/nyheter')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('nyheter') ? 'text-white' : ''; ?>">
                    Nyheter
                </a>
                <a href="<?php echo esc_url(home_url('/om-plamek')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('om-plamek') ? 'text-white' : ''; ?>">
                    Om oss
                </a>
                <a href="<?php echo esc_url(home_url('/kontakt')); ?>"
                   class="font-medium text-base xl:text-lg text-white/90 hover:text-white transition-all <?php echo is_page('kontakt') ? 'text-white' : ''; ?>">
                    Kontakt
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button id="pl-mobile-menu-button" type="button" class="text-white hover:text-gray-200 focus:outline-none" aria-label="Meny">
                    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="pl-menu-icon"  stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path id="pl-close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="pl-mobile-menu" class="lg:hidden hidden bg-[#002a5c] border-t border-white/10">
        <div class="px-4 py-4 space-y-2">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="block py-2 text-base text-white/90 hover:text-white">Hjem</a>
            <div class="py-2">
                <button id="pl-mobile-services-toggle" class="flex items-center justify-between w-full text-base text-white/90 hover:text-white">
                    <span>Tjenester</span>
                    <svg class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div id="pl-mobile-services-menu" class="hidden mt-2 ml-4 space-y-2">
                    <a href="<?php echo esc_url(home_url('/tjenester')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Alle tjenester</a>
                    <a href="<?php echo esc_url(home_url('/montering')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Montering</a>
                    <a href="<?php echo esc_url(home_url('/vedlikehold')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Vedlikehold</a>
                    <a href="<?php echo esc_url(home_url('/dukskift-isolering')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Dukskift og isolering</a>
                    <a href="<?php echo esc_url(home_url('/flytting-av-hall')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Flytting av hall</a>
                    <a href="<?php echo esc_url(home_url('/reparering-av-skader')); ?>" class="block py-2 text-sm text-white/80 hover:text-white">Reparering av skader</a>
                </div>
            </div>
            <a href="<?php echo esc_url(home_url('/referanser')); ?>" class="block py-2 text-base text-white/90 hover:text-white">Referanser</a>
            <a href="<?php echo esc_url(home_url('/nyheter')); ?>" class="block py-2 text-base text-white/90 hover:text-white">Nyheter</a>
            <a href="<?php echo esc_url(home_url('/om-plamek')); ?>" class="block py-2 text-base text-white/90 hover:text-white">Om oss</a>
            <a href="<?php echo esc_url(home_url('/kontakt')); ?>" class="block py-2 text-base text-white/90 hover:text-white">Kontakt</a>
        </div>
    </div>
</nav>
