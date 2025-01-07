<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Wardrobe</title>
    <link rel="stylesheet" href="css/wardrobe.css">
</head>
<body>
    <div class="phone-card">
        <x-navbar></x-navbar>
        <div class="wardrobe-header">
            <h1>Wardrobe</h1>

    <div class="InputFile">
        <button>
            <input type="file" id="FileInput" accept="image/*">
            <label for="FileInput">Add Clothes to Wardrobe</label>
        </button>
    </div>

    </div>

        <div class="categories-wrapper-luar">
            <div class="categories-wrapper">
                <div class="two-category-wrapper">
                    <a href="{{ route('wardrobe.blazer') }}" class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Blazer.png') }}" class="category-icon-image">
                        <p>Blazer</p>
                    </a>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Coat.png') }}" class="category-icon-image">
                        <p>Coat</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Dress.png') }}" class="category-icon-image">
                        <p>Dress</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Hoodie.png') }}" class="category-icon-image">
                        <p>Hoodie</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jacket.png') }}" class="category-icon-image">
                        <p>Jacket</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Shirt.png') }}" class="category-icon-image">
                        <p>Shirt</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Sweater.png') }}" class="category-icon-image">
                        <p>Sweater</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/T-Shirt.png') }}" class="category-icon-image">
                        <p>T-shirt</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Cargo.png') }}" class="category-icon-image">
                        <p>Cargo</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jeans.png') }}" class="category-icon-image">
                        <p>Jeans</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jogger.png') }}" class="category-icon-image">
                        <p>Jogger</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Legging.png') }}" class="category-icon-image">
                        <p>Legging</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Shorts.png') }}" class="category-icon-image">
                        <p>Shorts</p>
                    </div>

                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Skirt.png') }}" class="category-icon-image">
                        <p>Skirt</p>
                    </div>
                </div>

                <div class="two-category-wrapper">
                    <div class="category">
                        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Trousers.png') }}" class="category-icon-image">
                        <p>Trousers</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="notification-modal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <div class="modal-body">
                <img src="{{ asset('Asset/Wardrobe/checklist.png') }}" alt="Success" style="width: 80px; height: 80px;">
                <p>Clothes successfully added!</p>
            </div>
        </div>
    </div>

    <script src="js/addFile.js"></script>
</body>
</html>
