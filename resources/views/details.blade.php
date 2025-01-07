<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link rel="stylesheet" href="css/detail.css"">
    
</head>
<body>
    <div class="backbutton">
        <a href="wardrobe">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Add Clothes to Wardrobe</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" class="PreviewImage" alt="Preview Image" style="width: 250px;">
    </div>

    <div class="-color-picker-container">
        <h2>Select your clothes color</h2>
        <div class="-color-area" id="ColorArea"></div>
        <input type="range" class="-color-slider" id="ColorSlider" min="0" max="360" value="360">
        <div class="-color-display" id="ColorDisplay"></div>
        <div class="-hex-display" id="HexDisplay">HEX: #FF0000</div>
      </div>

    <div class="bottomtop">
        <p>Top or Bottom</p>
        <div class="picktopbot">
            <form>
                <label for="top" class="labeltop">
                    <input type="radio" id="top" name="top" value="top">
                    <img src="Asset/detail/top.png" alt="Top" class="top">
                </label>
                <label for="bottom">
                    <input type="radio" id="bottom" name="top" value="bottom">
                    <img src="Asset/detail/bot.png" alt="Bottom" class="bottom">
                </label>
            </form>
            
        </div>
    </div>

    <div class="continue">
        <button type="submit" onclick="window.location.href='wardrobe'">Continue</button>
    </div>

    </form>
    <script src="js/details.js"></script>
    <script src="js/color.js"></script>
    
    
</body>
</html>
