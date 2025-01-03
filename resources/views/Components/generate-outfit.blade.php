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
    <button class="wear-button">Wear This Outfit</button>
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
</script>
