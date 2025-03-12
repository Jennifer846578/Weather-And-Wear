<link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
<div class="navbar-box">
    <nav class="navbar-main">
        <a href="{{ route('home') }}"  class="nav-item">
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

<script>
document.addEventListener("DOMContentLoaded", function () {
    const navItems = document.querySelectorAll(".nav-item");
    const currentPath = window.location.pathname;

    console.log("Current Path:", currentPath); // Debugging

    const iconMap = {
        "/": "navbaricon-inhome.png",
        "/wardrobe": "navbaricon-inwardrobe.png",
        "/history": "navbaricon-inhistory.png",
        "/profile": "navbaricon-inprofile.png"
    };

    navItems.forEach(item => {
        const linkPath = new URL(item.href, window.location.origin).pathname;
        // console.log("Checking:", linkPath);

        const img = item.querySelector(".nav-icon");

        if (currentPath === linkPath) {
            console.log(`Matched! Changing icon for ${linkPath}`);
            img.src = `/build/assets/navbar/${iconMap[linkPath]}`;
            console.log(img.src)
        }
    });
});

</script>
