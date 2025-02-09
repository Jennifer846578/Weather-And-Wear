<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
    <div class="profile-card">
        <x-navbar></x-navbar>
        <div class="profile-header">
            <h1>Profile</h1>

            {{-- <div class="profile-username">
                <img src="{{ asset('Asset/Profile/catProfile.png') }}" alt="Profile">
                <h2>Kucing_Imut</h2>
            </div> --}}

            <div class="profile-username">
                <label for="profilePicInput" class="camera-icon">
                    <img src="{{ asset('Asset/Profile/catProfile.png') }}" alt="Profile" id="profilePic">
                    <img src="{{ asset('Asset/Profile/camera.png') }}" alt="Camera Icon" class="camera-icon-image">
                </label>
                <input type="file" id="profilePicInput" accept="image/*" style="display: none;">
                <h2>Kucing_Imut</h2>
            </div> 
        </div>       

        <form class="profile-form" id="profileForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" value="Kucing_Imut">
                <hr>
            </div>

            {{-- <div class="form-group">
                <label for="bio">Bio</label>
                <input type="text" id="bio" value="Cat lovers">
                <hr>
            </div> --}}

            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <hr>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" value="kucing_imut@gmail.com" required>
                <hr>
            </div>

            <div class="form-group">
                <label for="phone">Phone number</label>
                <input type="text" id="phone" value="+628263234768" required>
                <hr>
            </div>
        </form>
        
        <div class="error-saveButton">
            <div id="errorMessages" class="error-container"></div>

            <div class="btn-wrapper">
                <button type="submit" class="btn" id="saveButton">Save</button>
            </div>
        </div>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"  href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <script src="/js/profile.js"></script>
</body>
</html>