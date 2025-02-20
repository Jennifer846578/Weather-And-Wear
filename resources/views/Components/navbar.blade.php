<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<div class="navbar-box">
    <nav class="navbar-main">
        <a href="{{ route("home") }}"  class="nav-item">
            <img src="{{ asset('build/assets/navbar/navbaricon-home.png') }}" alt="Home" class="nav-icon">
        </a>
        <a href="{{ route("wardrobe_page") }}" class="nav-item">
            <img src="{{ asset('build/assets/navbar/navbaricon-wardrobe.png') }}" alt="Wardrobe" class="nav-icon">

        </a>
        <a href="{{ route("history_page") }}" class="nav-item">
            <img src="{{ asset('build/assets/navbar/navbaricon-history.png') }}" alt="History" class="nav-icon">

        </a>
        <a href="{{ route("profile_page") }}" class="nav-item">
            <img src="{{ asset('build/assets/navbar/navbaricon-profile.png') }}" alt="Profile" class="nav-icon">

        </a>
    </nav>
</div>