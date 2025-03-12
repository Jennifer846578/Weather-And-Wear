<button class="generate-button" onclick="">Generate Outfit</button>
 






<script>
function showOutfit() {
    let outfitDisplay = document.getElementById('outfitDisplay');
    if (outfitDisplay) {
        outfitDisplay.style.display = 'block'; // Tampilkan outfit
    }

    let phoneCard = document.querySelector('.phone-card');
    if (phoneCard) {
        phoneCard.style.minHeight = '214vh'; // Perubahan tinggi
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
