<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/profile1.css">
</head>
<body>
    <div class="profile-card">
        <div class="profile-header">
            <img src="cat-icon.png" alt="Profile Icon">
            <h1>Kucing_Imut</h1>
        </div>
        <form class="profile-form" id="profileForm">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" value="Kucing_Imut" readonly>
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <input type="text" id="bio" value="Cat lovers">
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" placeholder="kucing_imut@gmail.com" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone number</label>
                <input type="text" id="phone" placeholder="+628263234768" required>
            </div>
        </form>
        <div class="footer-nav">
            <a href="#">🏠</a>
            <a href="#">📂</a>
            <a href="#">⏰</a>
            <a href="#">👤</a>
        </div>
    </div>
</body>
</html>