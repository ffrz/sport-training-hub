<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title inertia>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link href="https://fonts.bunny.net" rel="preconnect">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">


  <!-- Scripts -->
  <script>
    window.CONFIG = {}
    window.CONFIG.APP_NAME = "{{ config('app.name', 'Laravel') }}";
    window.CONFIG.APP_VERSION = {{ config('app.version', 0x010000) }};
    window.CONFIG.APP_VERSION_STR = "{{ config('app.version_str', '1.0.0') }}";
    window.CONSTANTS = <?= json_encode([
          'USER_ROLES' => \App\Models\User::roleNames(),
      ]) ?>;
    window.CONSTANTS.USER_ROLE_ADMIN = "{{ \App\Models\User::ROLE_ADMIN }}";
    window.CONSTANTS.USER_ROLE_OWNER = "{{ \App\Models\User::ROLE_OWNER }}";
    window.CONSTANTS.USER_ROLE_GENERAL_MANAGER = "{{ \App\Models\User::ROLE_GENERAL_MANAGER }}";
    window.CONSTANTS.USER_ROLE_TECHNICAL_MANAGER = "{{ \App\Models\User::ROLE_TECHNICAL_MANAGER }}";
    window.CONSTANTS.USER_ROLE_COACH = "{{ \App\Models\User::ROLE_COACH }}";
    window.CONSTANTS.USER_ROLE_PLAYER = "{{ \App\Models\User::ROLE_PLAYER }}";
  </script>
  @routes
  @vite(['resources/js/app.js', 'resources/css/app.css'])

  @inertiaHead
</head>

<body class="font-sans antialiased">
  @inertia
</body>

</html>
