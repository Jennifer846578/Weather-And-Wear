<button class="generate-button" onclick="showOutfit()">Generate Outfit</button>

<div class="outfit-display" id="outfitDisplay">
    <div class="item">
        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Hoodie.png') }}" class="category-icon-image">
        <p>Hoodie</p>
    </div>
    <div class="navigation">
        <button onclick="previousItem()">&#8249;</button>
        <button onclick="nextItem()">&#8250;</button>
    </div>
    <div class="item">
        <img src="{{ asset('Asset/Wardrobe/Icon Luar/Jeans.png') }}" class="category-icon-image">
        <p>Jeans</p>
    </div>
    <button class="wear-button" onclick="showPopupWear()">Wear This Outfit</button> <!-- Onclick added -->
</div>

<!-- Popup Wear -->
<div id="popup-wear" class="popup-wear" style="display: none;">
    <div class="popup-wear-content">
        <span class="close-button" onclick="closePopupWear()">&#10005;</span>
        <div class="check-icon">
            <svg width="48" height="48" viewBox="0 0 24 24" fill="green"><path d="M9 16.2l-4.2-4.2-1.4 1.4 5.6 5.6 12-12-1.4-1.4z"/></svg>
        </div>
        <p>You look so cool!</p>
    </div>
</div>

<script>
    function showOutfit() {
        document.getElementById('outfitDisplay').style.display = 'block';
        document.querySelector('.phone-card').style.minHeight = '210vh';
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
</script>
