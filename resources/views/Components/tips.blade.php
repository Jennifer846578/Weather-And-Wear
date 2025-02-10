<!-- Button Tips -->
<button id="tips-button" class="tips-button">
    💡
  </button>

  <!-- Pop-up modal -->
  <div id="tips-popup" class="tips-popup">
    <div class="popup-content">
      <h2 id="close-popup">Tips for Hot</h2>
      <ul>
        <li>Use sunscreen before going outside</li>
        <li>Wear a hat and sunglasses</li>
        <li>Bring a water bottle to stay hydrated</li>
      </ul>
      <!-- Embedded Video -->
      <div class="video-container">
        <iframe
            id="youtube-video"
            width="300"
            height="200"
            src="https://www.youtube.com/embed/JsBiLN1Nw3M?autoplay=0&mute=1"
            frameborder="0"
            allow="autoplay; encrypted-media"
            allowfullscreen>
      </iframe>

      </div>
    </div>
  </div>

  <script>
    // Select elements
    const tipsButton = document.getElementById("tips-button");
    const tipsPopup = document.getElementById("tips-popup");
    const closePopupTips = document.getElementById("close-popup");
    const youtubeVideo = document.getElementById("youtube-video");

    // Original video URL
    const baseVideoURL = "https://www.youtube.com/embed/JsBiLN1Nw3M";

    // Show the pop-up and enable autoplay
    tipsButton.addEventListener("click", () => {
    youtubeVideo.src = baseVideoURL + "?autoplay=1&mute=1"; // Set autoplay dynamically
    tipsPopup.style.display = "flex";
    });

    // Hide the pop-up and reset the video
    closePopupTips.addEventListener("click", () => {
    tipsPopup.style.display = "none";
    youtubeVideo.src = baseVideoURL + "?autoplay=0&mute=1"; // Reset video
    });

    // Hide the pop-up when clicking outside the content
    window.addEventListener("click", (e) => {
    if (e.target === tipsPopup) {
        tipsPopup.style.display = "none";
        youtubeVideo.src = baseVideoURL + "?autoplay=0&mute=1"; // Reset video
    }
    });
  </script>
