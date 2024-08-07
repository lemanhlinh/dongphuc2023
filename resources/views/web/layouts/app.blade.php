<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SEO::generate() !!}
    <meta name="robots" content="index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1" />
    <link type="image/x-icon" href="{{ asset('images/favicon.ico') }}" rel="icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ mix('css/web/imagehover.css') }}" rel="stylesheet" media="screen">
    @yield('link')
    <script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "LocalBusiness",
  "name": "Đồng phục cati",
  "description": "CATI Uniform Chuyên May In Đồng phục công ty, đồng phục công sở, áo sự kiện, áo sơ mi, áo bảo hộ cao cấp. Chất lượng hàng đầu tại Hà Nội Lấy sau 3 Ngày. Bảo hành 12 tháng. Miễn phí Vận chuyển",
  "image": "https://dongphuccati.com/images/config/64904221_372601110120073_8912722554188201984_n_1576645267_1623494665.jpg",
  "@id": "https://dongphuccati.com/",
  "url": "https://dongphuccati.com/",
  "telephone": "0889 979 886",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Toà N05, Golden Time, Đường Tân Xuân,  Phường Đông Ngạc",
    "addressLocality": "Quận Bắc Từ Liêm",
    "postalCode": "100000",
    "addressCountry": "VN"
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "07:30",
    "closes": "22:00"
  },
  "sameAs": [
    "https://www.facebook.com/CONGTYMAYDONGPHUCCATI"
  ]
}
</script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script defer src="https://www.googletagmanager.com/gtag/js?id=UA-152077928-1"></script>
    <script defer >
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-152077928-1');
    </script>
    <!-- Facebook Pixel Code -->
    <script defer >
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '2190934871034062');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=2190934871034062&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Facebook Pixel Code -->
    <!-- Google Tag Manager -->
    <script defer >(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-K39WG98');</script>
    <!-- End Google Tag Manager -->
</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K39WG98"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @yield('page')
    @yield('script')
</body>
</html>
