<?php
/* ------------------------------------------------------------------
   City service pages: one template (service-city.php) builds a page for
   every service x city, for example "House Shifting Services in Islamabad".
   The cities come from CITIES in includes/config.php, the services from
   $SERVICES in includes/data.php. Edit the wording below.
   ------------------------------------------------------------------ */
if (!function_exists('slugify')) {

    function slugify(string $s): string { return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($s)), '-'); }

    function find_service(string $slug): ?array {
        global $SERVICES;
        foreach ($SERVICES as $s) { if ($s['slug'] === $slug) return $s; }
        return null;
    }
    function find_city(string $slug): ?string {
        foreach (CITIES as $c) { if (slugify($c) === $slug) return $c; }
        return null;
    }
    /* Address of a city page. To use clean addresses like /house-shifting-in-islamabad, see the note in .htaccess */
    function city_page_url(string $svcSlug, string $city): string {
        return 'service-city.php?service=' . rawurlencode($svcSlug) . '&city=' . rawurlencode(slugify($city));
    }
    function title_case(string $s): string {
        $t = ucwords(strtolower($s));
        return str_replace([' And ', ' In ', ' Of '], [' and ', ' in ', ' of '], $t);
    }
    function city_page_title(array $svc, string $city): string { return title_case($svc['name']) . ' Services in ' . $city; }
    function city_page_label(array $svc, string $city): string { return title_case($svc['name']) . ' in ' . $city; }

    function city_areas(string $slug): array {
        $a = [
            'islamabad'  => ['F-6', 'F-7', 'F-10', 'G-9', 'G-11', 'E-11', 'I-8', 'DHA Islamabad', 'Bahria Town', 'Gulberg Greens'],
            'rawalpindi' => ['Saddar', 'Satellite Town', 'Chaklala Scheme III', 'Westridge', 'Bahria Town', 'DHA Rawalpindi', 'Peshawar Road', 'Adiala Road'],
            'lahore'     => ['Gulberg', 'DHA Lahore', 'Johar Town', 'Model Town', 'Wapda Town', 'Bahria Town Lahore', 'Lahore Cantt', 'Allama Iqbal Town'],
            'karachi'    => ['Clifton', 'DHA Karachi', 'Gulshan-e-Iqbal', 'North Nazimabad', 'PECHS', 'Bahria Town Karachi', 'Korangi', 'Saddar'],
            'peshawar'   => ['University Town', 'Hayatabad', 'Peshawar Cantt', 'Gulbahar', 'Warsak Road', 'Ring Road'],
            'multan'     => ['Gulgasht Colony', 'Multan Cantt', 'Bosan Road', 'Model Town', 'Shah Rukn-e-Alam Colony'],
            'faisalabad' => ['Peoples Colony', 'Madina Town', 'Jinnah Colony', 'Satiana Road', 'Canal Road'],
        ];
        return $a[$slug] ?? [];
    }

    /* Wording per service. Tokens: {SITE} {city} {Name} {phrase} {items} {vehicles} */
    function svc_copy(string $slug): array {
        static $c = [
            'house' => ['phrase' => 'house shifting', 'items' => 'furniture, beds, wardrobes, kitchen items, appliances and household goods', 'vehicles' => 'pickups, Mazda and Shehzore trucks and 20 ft containers',
                'img2' => 'svc-packing.jpg', 'biz' => 'Landlords, property dealers and families moving between homes rely on our crew for quick, tidy handovers in {city}.',
                'q' => ['Can you dismantle and reassemble my furniture in {city}?', 'Yes. Our crew dismantles beds, wardrobes and tables before loading and reassembles them at your new home in {city}, so you can settle in faster.']],
            'office' => ['phrase' => 'office shifting', 'items' => 'desks, chairs, computers, servers, files and cabinets', 'vehicles' => 'Mazda and Shehzore trucks and 20 ft containers',
                'img2' => 'svc-loading.jpg', 'biz' => 'We plan office moves around your working hours, including evenings and weekends, so your team in {city} loses as little time as possible.',
                'q' => ['Can you move our office after working hours?', 'Yes. We schedule office shifting in {city} in the evening or at the weekend so your business keeps running during the day.']],
            'packing' => ['phrase' => 'packing and unpacking', 'items' => 'crockery, glassware, electronics, clothes, books and other fragile items', 'vehicles' => 'closed trucks and pickups',
                'img2' => 'svc-house.jpg', 'biz' => 'Shops and offices in {city} use our packing crews to prepare stock, files and equipment quickly and neatly.',
                'q' => ['Do you pack fragile items like glassware and TVs?', 'Yes. Fragile items get extra padding and their own boxes, and are marked so they are handled with care throughout the move in {city}.']],
            'goods' => ['phrase' => 'goods transport', 'items' => 'household goods, office equipment, electronics, commercial stock, machinery and retail inventory', 'vehicles' => 'pickups, Mazda and Shehzore trucks, 20 ft and 40 ft containers and flatbeds',
                'img2' => 'svc-loading.jpg', 'biz' => 'Manufacturers, traders and retailers in {city} use our trucks for regular and one-time deliveries inside the city and to other cities.',
                'q' => ['Do you offer goods transport from {city} to other cities?', 'Yes. We run intercity routes from {city} with containers and open trucks, and we agree the delivery time before the vehicle leaves.']],
            'loading' => ['phrase' => 'loading and unloading', 'items' => 'heavy furniture, appliances, cartons, machinery parts and bulk stock', 'vehicles' => 'trolleys, ramps and straps, with our own trucks if you need them',
                'img2' => 'svc-goods.jpg', 'biz' => 'Warehouses and shops in {city} call us for extra loading crews when stock arrives or ships out.',
                'q' => ['Can you provide labour only, without a truck?', 'Yes. If you already have a vehicle, our trained loaders in {city} can load or unload it using trolleys, ramps and straps.']],
            'car' => ['phrase' => 'car carrier', 'items' => 'cars, SUVs and light vehicles', 'vehicles' => 'dedicated car carrier trucks',
                'img2' => 'svc-goods.jpg', 'biz' => 'Dealers, showrooms and families in {city} send vehicles to other cities safely on our carriers.',
                'q' => ['How is my car secured on the carrier?', 'Cars are fixed with wheel straps on the carrier deck and checked before departure from {city}, so they travel safely to the destination.']],
        ];
        return $c[$slug] ?? $c['house'];
    }

    /* Builds the page body as a list of blocks: p, h, ul, img, links */
    function city_page_blocks(array $svc, string $city): array {
        $k = svc_copy($svc['slug']);
        $slugC = slugify($city);
        $areas = city_areas($slugC);
        $tok = ['{SITE}' => SITE_NAME, '{city}' => $city, '{Name}' => title_case($svc['name']), '{phrase}' => $k['phrase'], '{items}' => $k['items'], '{vehicles}' => $k['vehicles']];
        $t = fn(string $s): string => strtr($s, $tok);
        $areaLine = $areas
            ? 'We provide ' . $k['phrase'] . ' across ' . $city . ', including ' . implode(', ', array_slice($areas, 0, -1)) . ' and ' . end($areas) . '. If your area is not listed, call us and we will confirm.'
            : 'We provide ' . $k['phrase'] . ' across all major residential and commercial areas of ' . $city . '. If you are not sure we cover your area, call us and we will confirm.';
        $b = [];
        $b[] = ['p', $t('{SITE} is a trusted provider of {phrase} services in {city}. Our trained crew, own vehicles and fixed prices make {phrase} simple for families, offices and businesses across {city} and nearby areas.')];
        $b[] = ['p', $t('We handle {items}. Every job starts with a clear quote, so you know the price before we begin, and our team plans the route, vehicle and crew size around your needs.')];
        $b[] = ['h', $t('Comprehensive {Name} Solutions in {city}')];
        $b[] = ['p', $t('Our {phrase} service in {city} covers the whole job: planning, wrapping, loading, transport, unloading and placing everything where you want it. Whether it is a single room or a full move, the same careful process applies.')];
        $b[] = ['p', 'Every item is padded or wrapped before it leaves the building, and heavy goods are strapped so they cannot slide. We bring boxes, blankets, tape and trolleys, so you do not need to arrange anything yourself.'];
        $b[] = ['img', $k['img2']];
        $b[] = ['h', 'Modern Fleet for Every Need'];
        $b[] = ['p', $t('Our vehicles include {vehicles}. We match the vehicle to your load, so you never pay for space you do not need and never run out of room on the day.')];
        $b[] = ['p', $t('All vehicles are kept clean and serviced, and our drivers know the roads of {city} and the best routes to avoid delays.')];
        $b[] = ['h', 'Safe and On-Time Service'];
        $b[] = ['p', 'Time matters during a move. We confirm the pickup time in advance, arrive when we say we will and keep you updated until delivery. Our crew follows a simple loading plan so the first things you need are the first things off the truck.'];
        $b[] = ['p', 'Safety comes first. We use straps, padding and careful stacking, and our loaders are trained to handle stairs, lifts and tight spaces.'];
        $b[] = ['h', 'Business and Commercial Moves'];
        $b[] = ['p', $t($k['biz'])];
        $b[] = ['p', $t('Shops, offices, warehouses and factories in {city} trust us for planned, low-downtime work. We can move at night or at weekends and label everything by area so your team can start work again quickly.')];
        $b[] = ['h', $t('Why Choose {SITE}?')];
        $b[] = ['ul', ['Trained and polite crew, not casual labour', 'Our own vehicles and drivers, no middlemen', 'Fixed price agreed before we start', 'Careful packing, padding and strapping', 'Free quote and on-time service']];
        $b[] = ['h', $t('{Name} Service Areas in {city}')];
        $b[] = ['p', $areaLine];
        $b[] = ['links', $svc['slug'], $city];
        return $b;
    }

    function city_page_faqs(array $svc, string $city): array {
        $k = svc_copy($svc['slug']);
        $areas = city_areas(slugify($city));
        $tok = ['{city}' => $city, '{phrase}' => $k['phrase'], '{items}' => $k['items'], '{SITE}' => SITE_NAME];
        $t = fn(string $s): string => strtr($s, $tok);
        return [
            [$t('How can I book {phrase} in {city}?'), $t('Booking is simple. Call or message us on WhatsApp, or fill in the quote form. Tell us what you are moving, where it is going and your preferred date, and we will confirm a fixed price.')],
            [$t('Do you offer door-to-door service in {city}?'), $t('Yes. Our crew collects from your door and delivers to the exact location in {city}, including unloading and placing items where you want them.')],
            [$t('What can you move?'), $t('We handle {items}. If you have something unusual, tell us when you call so we can bring the right equipment.')],
            [$t('Do you provide packing material?'), 'Yes. We bring boxes, bubble wrap, blankets and tape, and our crew wraps and packs your items safely.'],
            [$t('Is the service available across all areas of {city}?'), $areas ? $t('Yes. We cover ') . implode(', ', $areas) . $t(' and other areas of {city}.') : $t('Yes. We serve all major areas of {city}. Call us to confirm your exact location.')],
            [$t($k['q'][0]), $t($k['q'][1])],
            [$t('How much does {phrase} in {city} cost?'), $t('The price depends on the load, the distance, the floor and whether you need packing. Contact us for a free quote, and we agree a fixed price before the work starts.')],
        ];
    }
}
