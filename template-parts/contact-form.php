<?php
/**
 * Contact form template part — used on front-page and kontakt page.
 * Submits to admin-post.php which is handled in functions.php (pl_handle_contact).
 */
$sent  = isset($_GET['pl_contact']) && $_GET['pl_contact'] === 'sent';
$error = isset($_GET['pl_contact']) && $_GET['pl_contact'] === 'error';
?>

<?php if ($sent) : ?>
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg text-green-800 text-sm">
        Takk for henvendelsen! Vi kommer tilbake til deg så snart som mulig.
    </div>
<?php elseif ($error) : ?>
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg text-red-800 text-sm">
        Noe gikk galt. Vennligst prøv igjen eller ring oss direkte.
    </div>
<?php endif; ?>

<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="space-y-4 sm:space-y-6">
    <input type="hidden" name="action" value="pl_contact">
    <?php wp_nonce_field('pl_contact', 'pl_contact_nonce'); ?>
    <input type="hidden" name="redirect_to" value="<?php echo esc_url(get_permalink()); ?>">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
        <div>
            <label class="block text-gray-700 text-sm font-medium mb-2">Navn *</label>
            <input type="text" name="pl_name" required placeholder="Ditt navn"
                   class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-medium mb-2">Telefon *</label>
            <input type="tel" name="pl_phone" required placeholder="Ditt telefonnummer"
                   class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base">
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 sm:gap-6">
        <div>
            <label class="block text-gray-700 text-sm font-medium mb-2">E-post *</label>
            <input type="email" name="pl_email" required placeholder="din@epost.no"
                   class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base">
        </div>
        <div>
            <label class="block text-gray-700 text-sm font-medium mb-2">Bedrift</label>
            <input type="text" name="pl_company" placeholder="Bedriftsnavn (valgfritt)"
                   class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base">
        </div>
    </div>

    <div>
        <label class="block text-gray-700 text-sm font-medium mb-2">Hva kan vi hjelpe deg med? *</label>
        <select name="pl_project_type" required
                class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base">
            <option value="">Velg tjeneste</option>
            <option value="montering">Montering av ny hall</option>
            <option value="demontering">Demontering av hall</option>
            <option value="flytting">Flytting av eksisterende hall</option>
            <option value="vedlikehold">Service og vedlikehold</option>
            <option value="dukskift">Dukskift eller reparasjon</option>
            <option value="radgivning">Rådgivning og befaring</option>
            <option value="annet">Annet</option>
        </select>
    </div>

    <div>
        <label class="block text-gray-700 text-sm font-medium mb-2">Fortell oss mer om prosjektet</label>
        <textarea name="pl_message" rows="4" placeholder="Beskriv ditt prosjekt, ønsket tidsramme, eller andre spesielle behov..."
                  class="w-full px-4 py-3 sm:py-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#003a76] focus:border-transparent text-base"></textarea>
    </div>

    <!-- Honeypot -->
    <input type="text" name="pl_hp" value="" tabindex="-1" autocomplete="off" style="position:absolute;left:-9999px;">

    <div class="pt-2 sm:pt-4">
        <button type="submit"
                class="w-full sm:w-auto bg-[#003a76] text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg hover:bg-[#002855] transition-colors duration-300 font-medium text-base sm:text-lg">
            Send forespørsel
        </button>
    </div>

    <p class="text-sm text-gray-500 text-center">
        Vi behandler dine personopplysninger i henhold til vår personvernpolicy
    </p>
</form>
