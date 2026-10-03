# Deploy the Exo website to Vercel (step by step)

Vercel cannot run PHP. So we turn the PHP site into plain HTML pages (the `dist` folder) and deploy that.
You keep working in XAMPP as normal, and run one command whenever you want to publish changes.

## IMPORTANT: Vercel's free plan is for non-commercial use
Vercel's free "Hobby" plan is only for personal, non-commercial projects. A business website that advertises
services (like Exo Packers) counts as commercial and needs the Pro plan (about $20 a month), or another host.
For a student demo or portfolio it is fine. The `dist` folder also works on other static hosts
(for example Netlify or Cloudflare Pages); check their terms for business use.

## Part 1: prepare (once)
1. Copy this kit into your project folder (D:\xampp\htdocs\exo):  tools\export-static.php, tools\render-one.php,
   thank-you.php, vercel.json, .gitignore
2. includes\config.php: set SITE_URL to your final website address, no slash at the end.
   Examples:  'https://exo-packers.vercel.app'   or your own domain  'https://www.exopackers.pk'
3. Quote forms: go to https://web3forms.com, enter YOUR email, and they email you an access key (free: 250 requests a month).
   Open tools\export-static.php and paste the key in  $WEB3FORMS_KEY.
4. Before the public sees it, replace the sample content: phone numbers, address, "10+ years", counters, reviews,
   the About image that points to another company's website, and the truck photo with the faint watermark.

## Part 2: build the static site
In a terminal, inside the project folder:
    D:\xampp\php\php.exe tools\export-static.php
It creates the folder  dist  (about 84 pages). Preview it:
    npx serve dist
and open http://localhost:3000 (check the menu, a service city page, a blog article, the contact form).

## Part 3: put the project on GitHub
Create an empty repository on github.com (private is fine), for example  exo-packers, then:
    git init
    git add .
    git commit -m "Exo Packers website"
    git branch -M main
    git remote add origin https://github.com/hamzatahir06/exo-packers.git
    git push -u origin main
(Commit the dist folder too. Vercel serves it as it is.)

## Part 4: deploy on Vercel
1. Go to vercel.com and sign in with GitHub.
2. Add New, then Project, then import the exo-packers repository.
3. Leave the settings as they are (vercel.json already says: no framework, no build, output folder dist). Click Deploy.
4. After about a minute you get an address like https://exo-packers.vercel.app
5. If that address is different from the SITE_URL you set, change SITE_URL, run the export again, then:
       git add . && git commit -m "update address" && git push
   Vercel redeploys by itself.

## Part 5: your own domain
1. Vercel project, Settings, Domains, add  exopackers.pk  and  www.exopackers.pk.
2. At the company where you bought the domain, add the DNS records that Vercel shows you (an A record for the main domain
   and a CNAME for www). Use exactly the values Vercel displays. HTTPS is added automatically.
3. Set SITE_URL to the final domain, export again, push.

## Part 6: after launch
- Send a test quote from the contact page and check that the email arrives (also check spam).
- Google Search Console: add the site, verify it, submit  https://yourdomain/sitemap.xml
- Create / claim the Google Business Profile.

## Updating the site later
Edit in XAMPP, then:  php tools\export-static.php   then   git add . && git commit -m "changes" && git push

## What does not work on Vercel
- PHP does not run there, only the exported HTML. actions\send-quote.php is not used; the forms use Web3Forms.
- Anything that needs a database or saved files would need a different setup.
