const ColorArea = document.getElementById('ColorArea');
    const ColorSlider = document.getElementById('ColorSlider');
    const ColorDisplay = document.getElementById('ColorDisplay');
    const HexDisplay = document.getElementById('HexDisplay');

    let hue = 360; // Default slider value (set to the far right)
    let saturation = 100;
    let lightness = 50;
    let selectedColor = '#FF0000';

    // Convert HSL to HEX
    function hslToHex(h, s, l) {
      h /= 360;
      s /= 100;
      l /= 100;
      let r, g, b;
      if (s === 0) {
        r = g = b = l; // Achromatic
      } else {
        const hue2rgb = (p, q, t) => {
          if (t < 0) t += 1;
          if (t > 1) t -= 1;
          if (t < 1 / 6) return p + (q - p) * 6 * t;
          if (t < 1 / 2) return q;
          if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
          return p;
        };
        const q = l < 0.5 ? l * (1 + s) : l + s - l * s;
        const p = 2 * l - q;
        r = hue2rgb(p, q, h + 1 / 3);
        g = hue2rgb(p, q, h);
        b = hue2rgb(p, q, h - 1 / 3);
      }
      return (
        "#" +
        [r, g, b]
          .map((x) => {
            const hex = Math.round(x * 255).toString(16);
            return hex.length === 1 ? "0" + hex : hex;
          })
          .join("")
      );
    }

    // Update gradient on the color area
    function updateColorArea() {
      const gradient = `linear-gradient(to right, white, hsl(${hue}, 100%, 50%))`;
      ColorArea.style.background = `linear-gradient(to top, black, rgba(0, 0, 0, 0)), ${gradient}`;
    }

    // Update the selected color display
    function updateColorDisplay() {
      selectedColor = hslToHex(hue, saturation, lightness);
      ColorDisplay.style.backgroundColor = selectedColor;
      HexDisplay.textContent = `HEX: ${selectedColor.toUpperCase()}`;
    }

    // Handle color selection on the color area
    ColorArea.addEventListener('click', (event) => {
      const rect = ColorArea.getBoundingClientRect();
      const x = event.clientX - rect.left; // X position in the color area
      const y = event.clientY - rect.top; // Y position in the color area
      saturation = Math.round((x / rect.width) * 100);
      lightness = 100 - Math.round((y / rect.height) * 100);
      updateColorDisplay();
    });

    // Handle slider input
    ColorSlider.addEventListener('input', (event) => {
      hue = event.target.value;
      updateColorArea();
      updateColorDisplay();
    });

    // Initialize
    updateColorArea();
    updateColorDisplay();