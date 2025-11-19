<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Armería') }} - Panel Admin</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans bg-gray-100 text-gray-900">

  <!-- SIDEBAR -->
  <x-admin-sidebar :user="Auth::user()" />

  <!-- OVERLAY for mobile -->
  <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden hidden" onclick="toggleSidebar()"></div>

  <!-- MAIN -->
  <main id="main-content" class="ml-0 md:ml-64 flex flex-col min-h-screen">
    <!-- HEADER -->
    <x-admin-header :user="Auth::user()" />

    <!-- CONTENT -->
    <section class="flex-1 p-6">
      @if (session('success'))
        <div class="bg-emerald-100 text-emerald-800 border border-emerald-300 px-4 py-2 rounded mb-6">{{ session('success') }}</div>
      @endif

      @if (session('error'))
        <div class="bg-red-100 text-red-800 border border-red-300 px-4 py-2 rounded mb-6">{{ session('error') }}</div>
      @endif

      @yield('content')
    </section>
  </main>

  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.getElementById('main-content');
      const overlay = document.getElementById('sidebar-overlay');

      if (sidebar.classList.contains('-translate-x-full')) {
        // Show sidebar
        sidebar.classList.remove('-translate-x-full');
        mainContent.classList.add('md:ml-64');
        overlay.classList.remove('hidden');
      } else {
        // Hide sidebar
        sidebar.classList.add('-translate-x-full');
        mainContent.classList.remove('md:ml-64');
        overlay.classList.add('hidden');
      }
    }

    // Add event listener to toggle button
    document.getElementById('sidebar-toggle').addEventListener('click', toggleSidebar);

    // Close sidebar when clicking on a link (mobile)
    document.querySelectorAll('#sidebar a').forEach(link => {
      link.addEventListener('click', () => {
        if (window.innerWidth < 768) { // md breakpoint
          toggleSidebar();
        }
      });
    });

    // Initialize sidebar state on page load
    document.addEventListener('DOMContentLoaded', function() {
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.getElementById('main-content');

      if (window.innerWidth >= 768) { // Desktop
        sidebar.classList.remove('-translate-x-full');
        sidebar.classList.add('md:translate-x-0');
      }
    });
  </script>
</body>
</html>
