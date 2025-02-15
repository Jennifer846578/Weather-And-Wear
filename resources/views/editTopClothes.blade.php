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
        <a href="editClothes">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Edit Clothes</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" alt="Preview Image" style="width: 300px; height: auto;">
    </div>

    <div class="categoryBox">
        <h2>What are your clothes categories?</h2>
        <div class="categories">
          <button class="category-btn">🕶️ Blazer</button>
          <button class="category-btn">🧥 Coat</button>
          <button class="category-btn">👗 Dress</button>
          <button class="category-btn">🧥 Hoodie</button>
          <button class="category-btn">🧥 Jacket</button>
          <button class="category-btn">👔 Shirt</button>
          <button class="category-btn">🧶 Sweater</button>
          <button class="category-btn">👕 T-Shirt</button>
        </div>
        <div class="continue">
            <button type="button" id="continue-btn" disabled onclick="redirectToPageStyle()">Continue</button>
        </div>
      </div>

</form>
<script src="js/editClothes.js"></script>
