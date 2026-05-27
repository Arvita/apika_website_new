<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Arvita Agus Kurniasari')</title>
</head>

<body style="background:#f7f2ea; color:#1f2933; font-family:Arial, sans-serif; margin:0;">

    <div style="background:#4f6f52; color:white; padding:20px;">
        LAYOUT TERBACA
    </div>

    <main style="padding:40px;">
        @yield('content')
    </main>

    <div style="background:#fffaf2; padding:20px; border-top:1px solid #e3d8c8;">
        FOOTER TERBACA
    </div>

</body>
</html>