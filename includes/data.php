<?php
/* ------------------------------------------------------------------
   Content used on several pages (home, services, vehicles).
   Edit the text here once and every page updates.
   ------------------------------------------------------------------ */

$SERVICES = [
  ['slug' => 'house',   'img' => 'svc-house.jpg',   'icon' => 'i-home',     'name' => 'House shifting',
   'short' => 'Every room packed, moved and set up again.',
   'long'  => 'From a one-bedroom flat to a family home, our crew dismantles, wraps, loads, moves and sets everything up again, so you can start living in your new place straight away.',
   'points' => ['Furniture dismantled and rebuilt', 'Padded wrapping for every item', 'Fragile items packed separately'],
   'alt'   => 'House shifting truck with sofa and wardrobe ready to load'],
  ['slug' => 'office',  'img' => 'svc-office.jpg',  'icon' => 'i-building', 'name' => 'Office shifting',
   'short' => 'Desks, files and IT equipment moved with no lost working time.',
   'long'  => 'We plan office moves around your working hours, including evenings and weekends. Desks, files, computers and cabinets are labelled and placed where your team needs them.',
   'points' => ['After-hours and weekend moves', 'IT equipment packed with care', 'Floor-by-floor labelling'],
   'alt'   => 'Office shifting truck with desk and computer equipment'],
  ['slug' => 'packing', 'img' => 'svc-packing.jpg', 'icon' => 'i-box',      'name' => 'Packing and unpacking',
   'short' => 'Proper boxes, bubble wrap and careful handling.',
   'long'  => 'We bring boxes, bubble wrap, blankets and tape. Choose full packing, only the fragile items, or unpacking at your new place.',
   'points' => ['Boxes and materials supplied', 'Kitchen and glassware handled with care', 'Packing waste taken away'],
   'alt'   => 'Packing and unpacking service with cartons stacked beside a truck'],
  ['slug' => 'goods',   'img' => 'svc-goods.jpg',   'icon' => 'i-truck',    'name' => 'Goods transport',
   'short' => 'City and intercity delivery by pickup, truck or container.',
   'long'  => 'Need to send stock, machinery or household goods? We deliver inside the city and between cities with pickups, container trucks and flatbeds.',
   'points' => ['Pickups, containers and flatbeds', 'City and intercity routes', 'Safe strapping and loading'],
   'alt'   => 'Container truck for goods transport between cities'],
  ['slug' => 'loading', 'img' => 'svc-loading.jpg', 'icon' => 'i-lift',     'name' => 'Loading and unloading',
   'short' => 'Extra hands for heavy items, safely strapped.',
   'long'  => 'Already have a vehicle? Our trained labour loads and unloads heavy furniture, appliances and cartons using trolleys, straps and ramps.',
   'points' => ['Trained loading crew', 'Straps, trolleys and ramps', 'Care with stairs and lifts'],
   'alt'   => 'Workers loading and unloading boxes onto a moving truck'],
  ['slug' => 'car',     'img' => 'svc-car.jpg',     'icon' => 'i-car',      'name' => 'Car carrier',
   'short' => 'Your car travels on a carrier to the new city.',
   'long'  => 'Moving cities? Your car goes on a dedicated carrier while the rest of your things travel in the truck, and both arrive together.',
   'points' => ['Secured on a dedicated carrier', 'Door-to-door delivery', 'Moves alongside your household goods'],
   'alt'   => 'Car carrier truck moving cars between cities'],
];

/* SAMPLE CAPACITIES: replace with your real vehicle details */
$FLEET = [
  ['img' => 'fleet-suzuki.png',   'name' => 'Suzuki pickup',   'cap' => 'Up to 800 kg',   'best' => 'Flats and small loads',     'desc' => 'Quick and easy for single rooms, flats and small loads inside the city.',            'alt' => 'Suzuki pickup for small loads'],
  ['img' => 'fleet_mazda.png',    'name' => 'Mazda',           'cap' => 'Up to 2.5 tons', 'best' => 'Small homes and offices',   'desc' => 'The all-rounder for small homes, offices and shop stock.',                            'alt' => 'Mazda truck for small homes and offices'],
  ['img' => 'fleet-shehzore.png', 'name' => 'Shehzore',        'cap' => 'Up to 4 tons',   'best' => 'Full house shifting',       'desc' => 'Room for a complete household inside the city, with space for big furniture.',        'alt' => 'Shehzore truck for full house shifting'],
  ['img' => 'fleet-40ft.png',     'name' => '20 ft container', 'cap' => 'Up to 10 tons',  'best' => 'Large homes and intercity', 'desc' => 'Closed and secure for long-distance moves and bigger households.',                    'alt' => '20 foot container truck'],
  ['img' => 'fleet-20ft.png',     'name' => '40 ft container', 'cap' => 'Up to 20 tons',  'best' => 'Warehouse and bulk goods',  'desc' => 'Maximum space for stock, bulk goods and complete office or factory moves.',           'alt' => '40 foot container truck'],
  ['img' => 'fleet-bed.png',  'name' => 'Flatbed',         'cap' => 'Up to 12 tons',  'best' => 'Machinery and long items',  'desc' => 'Open bed for machinery, pipes, steel and anything too long or tall for a box.',       'alt' => 'Flatbed truck for machinery and long items'],
];

/* FAQs: shown on the FAQ page and the homepage, and sent to Google as structured data */
$FAQS = [
  ['How is the moving price decided?', 'The price depends on how much you are moving, the distance, the floor you live on and whether you need packing. We give you one fixed price before the job starts.'],
  ['Do you bring packing material?', 'Yes. We bring boxes, bubble wrap, blankets and tape, and our crew wraps and packs your items safely.'],
  ['Do you move goods between cities?', 'Yes. We run city and intercity moves with pickups, container trucks and flatbeds, and a car carrier is available for vehicles.'],
  ['How early should I book?', 'Two to three days ahead is comfortable. For month-end and weekends, book a week early. Urgent moves are possible, so call us.'],
  ['Is my furniture protected during the move?', 'Every item is wrapped or padded before it leaves the room, then loaded and strapped so it cannot slide. Ask us about cover for high-value items.'],
];



/* ------------------------------------------------------------------
   ARTICLES (blog). To add one: copy a block, change the text, add an image to assets/img/.
   body blocks:  ['p', 'paragraph']   ['h', 'heading']   ['ul', ['item', 'item']]
   ------------------------------------------------------------------ */
$ARTICLES = [
  ['slug' => 'electronics-goods-transport-pakistan', 'img' => 'art-electronics.jpg', 'date' => '2026-09-28', 'tag' => 'Electronics',
   'title'   => 'How to Move Electronics and Electrical Goods Safely in Pakistan',
   'excerpt' => 'Fridges, TVs, ACs and generators need more than a strong truck. Here is how to prepare, pack and load them without damage.',
   'alt'     => 'Fridge, washing machine, TV and air conditioner beside an Exo moving truck',
   'body'    => [
     ['p', 'Electronics and electrical goods are expensive, heavy and easy to damage. A cracked TV panel or a fridge that was laid on its side can cost far more than the move itself. A little preparation makes all the difference.'],
     ['h', 'Prepare before packing'],
     ['ul', ['Unplug everything and let fridges and freezers defrost for several hours before the move.', 'Take photos of cable connections so setup is quick at the new place.', 'Remove loose parts such as washing machine hoses, trays and remote controls, and pack them together.', 'Use the original boxes when you still have them. They are made to fit the product.']],
     ['h', 'Pack and load with care'],
     ['p', 'Wrap screens in soft blankets or foam and keep them upright. Secure appliance doors with tape, never glue. Heavy items go on the truck floor first, strapped to the sides, with lighter boxes on top. Large appliances should travel standing up, the way they are used.'],
     ['h', 'When to call a professional crew'],
     ['p', 'For bulk shipments such as shop stock, office equipment or generators, a trained crew with trolleys, ramps and straps lowers the risk of injury and breakage. At Exo Packers and Movers we agree a fixed price before the job and match the vehicle to the load, from a pickup to a container.'],
   ]],
  ['slug' => 'leather-footwear-transport-pakistan', 'img' => 'art-leather.jpg', 'date' => '2026-09-20', 'tag' => 'Leather and footwear',
   'title'   => 'Leather and Footwear Transport: How to Ship Stock Without Damage',
   'excerpt' => 'Leather rolls, shoe cartons and finished bags need dry, well-ventilated loads. These simple steps protect your stock on the road.',
   'alt'     => 'Leather rolls, shoe boxes and a handbag beside an Exo moving truck',
   'body'    => [
     ['p', 'Leather and footwear businesses move stock between factories, warehouses and shops all the time. The main risks are moisture, crushing and stains, and all three are avoidable.'],
     ['h', 'Keep stock dry and clean'],
     ['ul', ['Wrap leather rolls in plastic sheet and keep them off the truck floor.', 'Choose a covered vehicle or container, especially in the monsoon season.', 'Never load leather next to oily, wet or strongly scented goods.']],
     ['h', 'Load for shape, not just space'],
     ['p', 'Shoe cartons stack best in even columns with the heaviest cartons at the bottom. Rolls should lie flat, or stand upright and strapped, never leaning. Handbags and finished goods keep their shape better in firm cartons with paper stuffing.'],
     ['h', 'Plan the route and the unloading'],
     ['p', 'Label every carton by size and style so the receiving team can count and sort quickly, and share the delivery window with the driver in advance. Exo Packers and Movers handles city and intercity loads with trained loaders, so your stock arrives in the same condition it left.'],
   ]],
  ['slug' => 'medical-equipment-transport-pakistan', 'img' => 'art-medical.jpg', 'date' => '2026-09-12', 'tag' => 'Medical equipment',
   'title'   => 'Transporting Surgical and Medical Equipment Safely in Pakistan',
   'excerpt' => 'Surgical instruments and medical devices need clean, careful handling. Learn how to prepare them for a safe, on-time delivery.',
   'alt'     => 'Medical crates, a patient monitor and an instrument tray beside an Exo moving truck',
   'body'    => [
     ['p', 'Surgical instruments, monitors and other medical equipment are delicate and often time-critical. Hospitals, clinics and suppliers need them to arrive clean, undamaged and on time.'],
     ['h', 'Prepare the equipment'],
     ['ul', ['Clean and dry instruments before packing, and use sealed trays or sterile pouches where required.', 'Pack monitors and devices in foam-fitted cartons and mark them fragile.', 'Keep serial numbers and delivery paperwork together in a folder that travels with the driver.']],
     ['h', 'Handle with the right method'],
     ['p', 'Fragile devices should be carried by two people, loaded last and unloaded first, and kept away from heavy items that could shift on the road. A closed vehicle protects equipment from dust, rain and heat.'],
     ['h', 'Choose a reliable partner'],
     ['p', 'Ask for a fixed price, a confirmed delivery time and trained loading staff. Exo Packers and Movers plans each delivery around the load, so medical equipment travels in the right vehicle with proper padding and straps.'],
   ]],
];
