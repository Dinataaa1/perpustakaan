{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Perpustakaan Digital Kampus')</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: sans-serif; margin: 0; color: #1f2937; }
        nav { background: #1e3a8a; padding: 14px 40px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; }
        nav .brand { color: #fff; font-weight: bold; font-size: 18px; }
        nav ul { list-style: none; display: flex; gap: 20px; margin: 0; padding: 0; }
        nav ul li a { color: #cbd5e1; text-decoration: none; padding: 6px 4px; }
        nav ul li a.active { color: #fff; font-weight: bold; border-bottom: 2px solid #fff; }
        nav .navbar-user { display: flex; align-items: center; gap: 12px; color: #cbd5e1; font-size: 14px; }
        nav .btn-logout { background: none; border: 1px solid #cbd5e1; color: #cbd5e1; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 14px; }
        nav .btn-logout:hover { background: #1e40af; color: #fff; }
        main { max-width: 900px; margin: 0 auto; padding: 30px 40px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ccc; padding: 8px 12px; text-align: left; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 10px 14px; border-radius: 4px; margin-bottom: 16px; }
        .btn { display: inline-block; padding: 6px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn-success { background: #059669; }
        form.inline { display: inline; }
        label { display: block; margin-top: 12px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 6px; margin-top: 4px; box-sizing: border-box; }
        .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .readonly { background: #f3f4f6; padding: 8px; border-radius: 4px; margin-top: 4px; }
        .checkbox-list { border: 1px solid #ccc; border-radius: 4px; padding: 10px; margin-top: 4px; max-height: 200px; overflow-y: auto; }
        .checkbox-list label { display: block; font-weight: normal; margin-top: 0; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; }
        .badge-warning { background: #fef3c7; color: #92400e; }
        .badge-success { background: #d1fae5; color: #065f46; }
        .badge-danger { background: #fee2e2; color: #991b1b; }
        /* Stats Dashboard */
        .stats-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px; margin-top: 24px; }
        .stat-card { background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 8px; padding: 24px 20px; text-align: center; }
        .stat-card--warning { background: #fffbeb; border-color: #fde68a; }
        .stat-card--success { background: #ecfdf5; border-color: #a7f3d0; }
        .stat-number { font-size: 42px; font-weight: bold; color: #1e3a8a; line-height: 1; }
        .stat-card--warning .stat-number { color: #92400e; }
        .stat-card--success .stat-number { color: #065f46; }
        .stat-label { margin-top: 8px; font-size: 14px; color: #4b5563; }
        /* Pagination */
        .pagination { display: flex; gap: 6px; list-style: none; padding: 0; margin: 20px 0; flex-wrap: wrap; }
        .pagination li a, .pagination li span { display: inline-block; padding: 6px 12px; border: 1px solid #cbd5e1; border-radius: 4px; color: #2563eb; text-decoration: none; font-size: 14px; }
        .pagination li.active span { background: #2563eb; color: #fff; border-color: #2563eb; }
        .pagination li.disabled span { color: #9ca3af; cursor: default; }
        .pagination li a:hover { background: #eff6ff; }
        footer { text-align: center; padding: 20px; color: #6b7280; font-size: 14px; border-top: 1px solid #e5e7eb; margin-top: 40px; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <main>
        @include('partials.alert')

        @yield('content')
    </main>

    <footer>
        &copy; {{ date('Y') }} Sistem Perpustakaan Digital Kampus
    </footer>
</body>
</html>
