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
    <div class="dvnbackbutton">
        <a href="wardrobe">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Add Clothes to Wardrobe</h1>

    <!-- Pratinjau gambar -->
    <div id="dvnPreviewContainer" style="display: none;">
        <img id="dvnPreviewImage" alt="Preview Image" style="width: 300px; height: auto;">
    </div>

    <div class="dvn-color-picker-container">
        <h2>Select your clothes color</h2>
        <div class="dvn-color-area" id="dvnColorArea"></div>
        <input type="range" class="dvn-color-slider" id="dvnColorSlider" min="0" max="360" value="360">
        <div class="dvn-color-display" id="dvnColorDisplay"></div>
        <div class="dvn-hex-display" id="dvnHexDisplay">HEX: #FF0000</div>
      </div>

    <div class="dvnbottomtop">
        <p>Top or Bottom</p>
        <div class="dvnpicktopbot">
            <form>
                <label for="dvntop" class="dvnlabeltop">
                    <input type="radio" id="dvntop" name="top" value="top">
                    <img src="Asset/detail/top.png" alt="Top" class="dvntop">
                </label>
                <label for="dvnbottom">
                    <input type="radio" id="dvnbottom" name="top" value="bottom">
                    <img src="Asset/detail/bot.png" alt="Bottom" class="dvnbottom">
                </label>
            </form>
            
        </div>
    </div>

    <div class="dvncontinue">
        <button type="submit" onclick="window.location.href='wardrobe'">Continue</button>
    </div>

    </form>
    <script src="js/details.js"></script>
    <script src="js/color.js"></script>
    
    
</body>
</html>
