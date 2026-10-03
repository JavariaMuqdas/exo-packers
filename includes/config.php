<?php
/* ------------------------------------------------------------------
   Site settings. Change your details here once and every page,
   meta tag and schema block updates automatically.
   ------------------------------------------------------------------ */
define('SITE_NAME',     'Exo Packers and Movers');
define('SITE_URL',      'https://www.exopackers.pk');   // your live domain, no trailing slash
define('CITY',          'Pakistan');                    // e.g. 'Islamabad' or 'Rawalpindi'. Used in titles and SEO text
define('PHONE_DISPLAY', '0515167042');
define('PHONE_LINK',    '+92515167042');
define('WA_NUMBER',     '923365366610');   // WhatsApp, digits only
define('ALT_PHONE_DISPLAY', '');                       // optional second number, e.g. '0321 0000000' (leave '' to hide)
define('ALT_PHONE_LINK',    '');                       // e.g. '+923210000000'
define('EMAIL',         'info@exopackers.pk');
define('ADDRESS',       'LGF Office 9, Rafay Mall, Peshawar Rd, Rwp');
define('HOURS',         'Mon to Sat, 8am to 8pm');




/* Optional: Google Maps embed link for the Contact page (Google Maps > Share > Embed a map > copy the src="..." link). Leave '' to hide the map. */
define('MAP_EMBED_URL', '');

/* Optional: paste your page links to show social icons (leave '' to hide) */
define('FACEBOOK_URL',  'https://www.facebook.com/expopackers/');// e.g. 'https://www.facebook.com/yourpage'
define('TWITTER_URL',   '');   // e.g. 'https://x.com/yourname'
define('LINKEDIN_URL',  '');   // e.g. 'https://www.linkedin.com/company/yourcompany'
define('INSTAGRAM_URL', '');   // e.g. 'https://www.instagram.com/yourname'
define('YOUTUBE_URL',   '');   // e.g. 'https://www.youtube

/* Cities shown in the "Areas we serve" section (good for local SEO). Edit freely. */
define('CITIES', ['Karachi', 'Lahore', 'Islamabad', 'Rawalpindi', 'Peshawar', 'Multan', 'Faisalabad', 'Quetta', 'Hyderabad', 'Sialkot', 'Gujranwala', 'Sukkur']);

/* Safe output helper: always wrap text you echo in h() */
function h(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}
  