// const ColorArea = document.getElementById('ColorArea');
// const ColorSlider = document.getElementById('ColorSlider');
// const ColorDisplay = document.getElementById('ColorDisplay');
// const HexDisplay = document.getElementById('HexDisplay');

// // Penanda klik
// const marker = document.createElement('div');
// marker.style.position = 'absolute';
// marker.style.width = '10px';
// marker.style.height = '10px';
// marker.style.border = '2px solid white';
// marker.style.borderRadius = '50%';
// marker.style.boxShadow = '0 0 5px rgba(0, 0, 0, 0.5)';
// marker.style.transform = 'translate(-50%, -50%)';
// marker.style.pointerEvents = 'none';
// ColorArea.appendChild(marker);

// let hue = 0;
// let saturation = 100;
// let brightness = 50;

// // Fungsi konversi HSB ke RGB
// function hsbToHex(h, s, b) {
//   s /= 100;
//   b /= 100;
//   const k = (n) => (n + h / 60) % 6;
//   const f = (n) => b * (1 - s * Math.max(0, Math.min(k(n), 4 - k(n), 1)));
//   const r = Math.round(255 * f(5));
//   const g = Math.round(255 * f(3));
//   const bVal = Math.round(255 * f(1));
//   return (
//     '#' +
//     [r, g, bVal]
//       .map((x) => {
//         const hex = x.toString(16);
//         return hex.length === 1 ? '0' + hex : hex;
//       })
//       .join('')
//   );
// }

// // Fungsi memperbarui warna area
// function updateColorArea() {
//   ColorArea.style.background = `linear-gradient(to top, black, transparent), linear-gradient(to right, white, hsl(${hue}, 100%, 50%))`;
// }

// // Fungsi memperbarui tampilan warna
// function updateColorDisplay() {
//   const selectedColor = hsbToHex(hue, saturation, brightness);
//   ColorDisplay.style.backgroundColor = selectedColor;
//   HexDisplay.textContent = `HEX: ${selectedColor.toUpperCase()}`;
//   document.querySelector('p.value').innerHTML=selectedColor;
// }

// // Event handler untuk klik di area warna
// ColorArea.addEventListener('click', (event) => {
//   const rect = ColorArea.getBoundingClientRect();
//   const x = event.clientX - rect.left;
//   const y = event.clientY - rect.top;

//   saturation = Math.round((x / rect.width) * 100);
//   brightness = 100 - Math.round((y / rect.height) * 100);

//   // Memindahkan penanda ke posisi klik
//   marker.style.left = `${x}px`;
//   marker.style.top = `${y}px`;

//   updateColorDisplay();
// });

// // Event handler untuk slider warna
// ColorSlider.addEventListener('input', (event) => {
//   hue = event.target.value;
//   updateColorArea();
//   updateColorDisplay();
// });

// // Inisialisasi awal
// updateColorArea();
// updateColorDisplay();

const ColorArea = document.getElementById('ColorArea');
const ColorSlider = document.getElementById('ColorSlider');
const ColorDisplay = document.getElementById('ColorDisplay');
const HexDisplay = document.getElementById('HexDisplay');
const colorContainer = document.querySelector('.-color-picker-container');

// Penanda klik
const marker = document.createElement('div');
marker.style.position = 'absolute';
marker.style.width = '10px';
marker.style.height = '10px';
marker.style.border = '2px solid white';
marker.style.borderRadius = '50%';
marker.style.boxShadow = '0 0 5px rgba(0, 0, 0, 0.5)';
marker.style.transform = 'translate(-50%, -50%)';
marker.style.pointerEvents = 'none';
ColorArea.appendChild(marker);

// Nilai awal dari API atau fallback ke putih
let dominantColor = colorContainer.getAttribute('data-dominant-color') || '#FFFFFF';
let hue = 0;
let saturation = 100;
let brightness = 50;

// Konversi HEX ke HSB
function hexToHsb(hex) {
    const r = parseInt(hex.slice(1, 3), 16) / 255;
    const g = parseInt(hex.slice(3, 5), 16) / 255;
    const b = parseInt(hex.slice(5, 7), 16) / 255;

    const max = Math.max(r, g, b);
    const min = Math.min(r, g, b);
    const delta = max - min;

    // Hue Calculation
    let h = 0;
    if (delta !== 0) {
        if (max === r) {
            h = ((g - b) / delta) % 6;
        } else if (max === g) {
            h = (b - r) / delta + 2;
        } else if (max === b) {
            h = (r - g) / delta + 4;
        }
        h = Math.round(h * 60);
        if (h < 0) h += 360;
    }

    // Saturation & Brightness
    const bVal = max * 100;
    const s = max === 0 ? 0 : (delta / max) * 100;

    return { h, s, b: bVal };
}

// Fungsi konversi HSB ke HEX
function hsbToHex(h, s, b) {
    s /= 100;
    b /= 100;
    const k = (n) => (n + h / 60) % 6;
    const f = (n) => b * (1 - s * Math.max(0, Math.min(k(n), 4 - k(n), 1)));
    const r = Math.round(255 * f(5));
    const g = Math.round(255 * f(3));
    const bVal = Math.round(255 * f(1));
    return (
        '#' +
        [r, g, bVal]
            .map((x) => {
                const hex = x.toString(16);
                return hex.length === 1 ? '0' + hex : hex;
            })
            .join('')
    );
}

// Fungsi memperbarui warna area
function updateColorArea() {
    ColorArea.style.background = `linear-gradient(to top, black, transparent), linear-gradient(to right, white, hsl(${hue}, 100%, 50%))`;
}

// Fungsi memperbarui tampilan warna
function updateColorDisplay(color = null) {
    const selectedColor = color || hsbToHex(hue, saturation, brightness);
    ColorDisplay.style.backgroundColor = selectedColor;
    HexDisplay.textContent = `HEX: ${selectedColor.toUpperCase()}`;
    document.querySelector('p.value').textContent = selectedColor;
}

// Event handler untuk klik di area warna
ColorArea.addEventListener('click', (event) => {
    const rect = ColorArea.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    saturation = Math.round((x / rect.width) * 100);
    brightness = 100 - Math.round((y / rect.height) * 100);

    // Memindahkan penanda ke posisi klik
    marker.style.left = `${x}px`;
    marker.style.top = `${y}px`;

    updateColorDisplay();
});

// Event handler untuk slider warna
ColorSlider.addEventListener('input', (event) => {
    hue = event.target.value;
    updateColorArea();
    updateColorDisplay();
});

// Inisialisasi awal dengan warna dari API
function initializeFromDominantColor() {
    const hsb = hexToHsb(dominantColor);

    hue = hsb.h;
    saturation = hsb.s;
    brightness = hsb.b;

    // Set slider sesuai hue
    ColorSlider.value = hue;

    // Atur posisi marker berdasarkan saturasi dan brightness
    const rect = ColorArea.getBoundingClientRect();
    const x = (saturation / 100) * rect.width;
    const y = ((100 - brightness) / 100) * rect.height;
    marker.style.left = `${x}px`;
    marker.style.top = `${y}px`;

    updateColorArea();
    updateColorDisplay(dominantColor);
}

// Panggil inisialisasi awal
initializeFromDominantColor();