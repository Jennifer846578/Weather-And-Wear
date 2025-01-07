<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="css/detail.css">

</head>
<body>
    <div class="backbutton">
        <a href="details">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Add Clothes to Wardrobe</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" alt="Preview Image" style="width: 300px; height: auto;">
    </div>

    <div class="categoryBox">
        <h2>What are your clothes categories?</h2>
        <div class="categories">
          <button class="category-btn">🧢 Casual</button>
          <button class="category-btn">👨‍💼 Formal</button>
          <button class="category-btn">‍♀️ Sporty</button>
          <button class="category-btn">🛹 Streetwear</button>
          <button class="category-btn">🎞️ Vintage</button>
        </div>
        <div class="continue">
            <button type="button" id="continue-btn" disabled onclick="redirectToPageWardrobe()">Continue</button>
        </div>
    </div>

</body>
</form>
<script src="js/details.js"></script>
