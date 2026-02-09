# SITEMAP.XML & SEO SETUP - Kalya Rentcar

## ✅ Yang Sudah Dikonfigurasi:

### 1. **Sitemap Controller** 
- File: `app/Http/Controllers/SitemapController.php`
- Membuat XML sitemap dengan:
  - Homepage (priority: 1.0)
  - Gallery page (priority: 0.9)
  - Calculator page (priority: 0.8)
  - Semua vehicles dari database (priority: 0.7)

### 2. **Route Setup**
- URL: `https://kalyarentcar.com/sitemap.xml`
- Defined in: `routes/web.php`

### 3. **Robots.txt**
- File: `public/robots.txt`
- Points ke sitemap
- Blocks: /admin, /login

---

## 🚀 LANGKAH SETUP UNTUK LIVE:

### Step 1: Update APP_URL di .env
```
APP_URL=https://kalyarentcar.com
```

### Step 2: Test Sitemap Locally
```
http://localhost:8000/sitemap.xml
```
✅ Harus menampilkan XML dengan semua URLs

### Step 3: Deploy ke Server
```
git push origin main
```

### Step 4: Verify Live
```
https://kalyarentcar.com/sitemap.xml
```

### Step 5: Submit ke Google Search Console
1. Buka: https://search.google.com/search-console
2. Login dengan Google account
3. Add property: `https://kalyarentcar.com`
4. Verify ownership (via DNS/file)
5. Sitemap section → Submit sitemap
6. URL: `https://kalyarentcar.com/sitemap.xml`

### Step 6: Submit ke Bing Webmaster
1. Buka: https://www.bing.com/webmaster
2. Add your site
3. Sitemaps → Submit sitemap URL

---

## 📋 SITEMAP STRUCTURE:

```xml
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>https://kalyarentcar.com/</loc>
        <lastmod>2026-02-10T10:30:00+00:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <!-- ... more URLs ... -->
</urlset>
```

---

## 🎯 SEO BEST PRACTICES (Next Steps):

### 1. Meta Tags (sudah ada di welcome.blade.php)
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="...">
```

### 2. Schema Markup (Optional tapi recommended)
- Add LocalBusiness schema untuk rental company
- Add Organization schema

### 3. Performance
- ✅ Already optimized (transform-based slider, no heavy JS)
- Ensure images are optimized

### 4. Backlinks
- Submit ke direktori bisnis lokal
- Get reviews di Google My Business

### 5. Content
- Update homepage copy untuk SEO keywords
- Target keywords: "rental mobil", "sewa mobil", city names, etc

---

## 🔧 MAINTENANCE:

Sitemap auto-generate setiap kali ada akses ke `/sitemap.xml`. 
- Jika ada vehicle baru → langsung muncul di sitemap
- Updated_at field digunakan untuk lastmod date
- Change frequency: Sesuai dengan update frequency

---

## 📊 MONITORING:

Google Search Console akan show:
- Crawl stats
- Index status
- Coverage issues
- Mobile usability
- Core Web Vitals

Monitor secara regular untuk lepat optimize!
