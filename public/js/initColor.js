const ColorArea = document.getElementById('ColorArea');
const ColorSlider = document.getElementById('ColorSlider');
const ColorDisplay = document.getElementById('ColorDisplay');
const HexDisplay = document.getElementById('HexDisplay');

// Penanda klik pada color picker
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

let hue = 0;
let saturation = 100;
let brightness = 50;

// Mengambil warna awal dari elemen HexDisplay
const initialHexColor = HexDisplay.getAttribute('data-color') || '#FFFFFF';
HexDisplay.textContent = `HEX: ${initialHexColor.toUpperCase()}`;
ColorDisplay.style.backgroundColor = initialHexColor;
document.querySelector('p.value').innerHTML = initialHexColor;

// Fungsi konversi warna HEX ke HSB (tanpa pembulatan ekstrem)
function hexToHsb(hex) {
    let r = parseInt(hex.substring(1, 3), 16) / 255;
    let g = parseInt(hex.substring(3, 5), 16) / 255;
    let b = parseInt(hex.substring(5, 7), 16) / 255;

    let max = Math.max(r, g, b), min = Math.min(r, g, b);
    let h, s, v = max;

    let d = max - min;
    s = max === 0 ? 0 : d / max;

    if (max === min) {
        h = 0; // achromatic
    } else {
        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h *= 60;
    }

    return [h, s * 100, v * 100];
}

// Konversi HSB ke HEX (presisi tinggi)
function hsbToHex(h, s, b) {
    s /= 100;
    b /= 100;
    const k = (n) => (n + h / 60) % 6;
    const f = (n) => b * (1 - s * Math.max(0, Math.min(k(n), 4 - k(n), 1)));
    const r = Math.round(255 * f(5));
    const g = Math.round(255 * f(3));
    const bVal = Math.round(255 * f(1));
    return `#${[r, g, bVal].map((x) => x.toString(16).padStart(2, '0')).join('')}`;
}

// Memperbarui warna area
function updateColorArea() {
    ColorArea.style.background = `linear-gradient(to top, black, transparent), linear-gradient(to right, white, hsl(${hue}, 100%, 50%))`;
}

// Memperbarui tampilan warna
function updateColorDisplay() {
    const selectedColor = hsbToHex(hue, saturation, brightness);
    ColorDisplay.style.backgroundColor = selectedColor;
    HexDisplay.textContent = `HEX: ${selectedColor.toUpperCase()}`;
    document.querySelector('p.value').innerHTML = selectedColor;
}

// Event klik di area warna
ColorArea.addEventListener('click', (event) => {
    const rect = ColorArea.getBoundingClientRect();
    const x = event.clientX - rect.left;
    const y = event.clientY - rect.top;

    saturation = (x / rect.width) * 100;
    brightness = 100 - (y / rect.height) * 100;

    // Pindahkan marker
    marker.style.left = `${x}px`;
    marker.style.top = `${y}px`;

    updateColorDisplay();
});

// Event untuk slider warna
ColorSlider.addEventListener('input', (event) => {
    hue = parseFloat(event.target.value);
    updateColorArea();
    updateColorDisplay();
});

// Inisialisasi warna awal dari database
function initializeColorPicker() {
    const [initHue, initSaturation, initBrightness] = hexToHsb(initialHexColor);

    hue = initHue;
    saturation = initSaturation;
    brightness = initBrightness;

    // Atur nilai slider sesuai hue
    ColorSlider.value = hue;

    // Atur marker di posisi sesuai saturation dan brightness
    const rect = ColorArea.getBoundingClientRect();
    const x = (saturation / 100) * rect.width;
    const y = ((100 - brightness) / 100) * rect.height;

    marker.style.left = `${x}px`;
    marker.style.top = `${y}px`;

    updateColorArea();
    updateColorDisplay();
}

// Panggil fungsi inisialisasi
initializeColorPicker();