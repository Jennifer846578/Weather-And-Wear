  <!-- Button Tips -->
  <button id="tips-button" class="tips-button">
    💡
  </button>

  <!-- Pop-up modal -->
  <div id="tips-popup" class="tips-popup">
    <div class="popup-content">
      {{-- <span id="close-popup"></span> --}}
      <h2 id="close-popup">Tips for Hot</h2>
      <ul>
        <li>Use sunscreen before going outside</li>
        <li>Wear a hat and sunglasses </li>
        <li>Bring a water bottle to stay hydrated</li>
      </ul>
    </div>
  </div>

<script>
    // Select elements
    const tipsButton = document.getElementById("tips-button");
    const tipsPopup = document.getElementById("tips-popup");
    const closePopupTips = document.getElementById("close-popup");

    // Show the pop-up when the button is clicked
    tipsButton.addEventListener("click", () => {
    tipsPopup.style.display = "flex";
    });

    // Hide the pop-up when the close button is clicked
    closePopupTips.addEventListener("click", () => {
    tipsPopup.style.display = "none";
    });

    // Hide the pop-up when clicking outside the content
    window.addEventListener("click", (e) => {
    if (e.target === tipsPopup) {
        tipsPopup.style.display = "none";
    }
    });

</script>
