<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
@foreach($post as $posts)
    <url>
        <loc>{{ url('/', $posts->slug) }}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($posts->updated_at)) }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach
@foreach($url as $urls)
  
    <url>
        <loc>{{url('/')}}{{$urls->url}}</loc>
        <lastmod>{{ gmdate(DateTime::W3C, strtotime($urls->updated_at)) }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>
@endforeach
<url>
  <loc>http://www.addressguru.in/</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>1.00</priority>
</url>
<url>
  <loc>http://www.addressguru.in/login</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/register</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/Pricing-Table</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/Contact-Us</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/About-Us</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/Privacy-Policy</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
<url>
  <loc>http://www.addressguru.in/Partner</loc>
  <lastmod>2018-10-19T06:03:26+00:00</lastmod>
  <changefreq>monthly</changefreq>
  <priority>0.80</priority>
</url>
</urlset>