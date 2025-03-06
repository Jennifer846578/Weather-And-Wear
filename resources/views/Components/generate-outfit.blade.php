<button class="generate-button" onclick="showOutfit()">Generate Outfit</button>

<div class="outfit-display" id="outfitDisplay">
    <div class="item">
        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Hoodie.png') }}" class="category-icon-image">
        <p>Hoodie</p>
    </div>
    <div class="item">
        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jeans.png') }}" class="category-icon-image">
        <p>Jeans</p>
    </div>
        <!-- Rating Stars -->
    <div class="rating">
        <span class="star" onclick="rate(1)" data-value="1">&#9733;</span>
        <span class="star" onclick="rate(2)" data-value="2">&#9733;</span>
        <span class="star" onclick="rate(3)" data-value="3">&#9733;</span>
        <span class="star" onclick="rate(4)" data-value="4">&#9733;</span>
        <span class="star" onclick="rate(5)" data-value="5">&#9733;</span>
    </div>

    <div class="navigation">
        <button onclick="previousItem()">&#8249;</button>
        <button onclick="nextItem()">&#8250;</button>
    </div>

    <button class="wear-button" onclick="showPopupWear()">Wear This Outfit</button> <!-- Onclick added -->
</div>

<!-- Popup Wear -->
<div id="popup-wear" class="popup-wear" style="display: none;">
    <div class="popup-wear-content">
        <span class="close-buttoncool" onclick="closePopupWear()">&#10005;</span>
        <div class="check-icon">
            <img src="{{ asset('Asset/Wardrobe/checklist.png') }}" alt="Success" style="width: 80px; height: 80px;">
        </div>
        <p>You look so cool!</p>
    </div>
</div>

<script>
function showOutfit() {
    let outfitDisplay = document.getElementById('outfitDisplay');
    if (outfitDisplay) {
        outfitDisplay.style.display = 'block'; // Tampilkan outfit
    }

    let phoneCard = document.querySelector('.phone-card');
    if (phoneCard) {
        phoneCard.style.minHeight = '203vh'; // Perubahan tinggi
    }

    // Pastikan tombol Wear This Outfit juga tampil
    let wearButton = document.querySelector('.wear-button');
    if (wearButton) {
        wearButton.style.display = 'block';
    }
}


    function previousItem() {
        alert('Show previous item');
    }

    function nextItem() {
        alert('Show next item');
    }

    function showPopupWear() {
        document.getElementById('popup-wear').style.display = 'flex';
    }

    function closePopupWear() {
        document.getElementById('popup-wear').style.display = 'none';
    }

    document.addEventListener("DOMContentLoaded", function() {
    let generateButton = document.querySelector('.generate-button');
    generateButton.addEventListener('click', showOutfit);
});

// RATING FUNCTION

function rate(stars) {
    let starElements = document.querySelectorAll('.star');
    starElements.forEach(star => {
        if (parseInt(star.getAttribute('data-value')) <= stars) {
            star.classList.add('active');
        } else {
            star.classList.remove('active');
        }
    });
}


</script>
