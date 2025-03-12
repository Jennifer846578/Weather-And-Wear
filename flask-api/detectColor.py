from flask import Flask, request, jsonify
from rembg import remove
from sklearn.cluster import KMeans
from PIL import Image
import numpy as np
import cv2
import os

app = Flask(__name__)

def remove_background(image_path):
    """Remove background from image using rembg."""
    input_image = Image.open(image_path)
    output_image = remove(input_image)
    processed_image = cv2.cvtColor(np.array(output_image), cv2.COLOR_RGBA2BGRA)
    return processed_image

def rgb_to_hex(rgb):
    """Convert RGB color to HEX format."""
    return '#{:02x}{:02x}{:02x}'.format(rgb[0], rgb[1], rgb[2])

def detect_most_dominant_color(image):
    """Detect the most dominant color from the image, ignoring transparent pixels."""
    if image.shape[2] == 4:
        bgr, alpha = image[:, :, :3], image[:, :, 3]
        mask = alpha > 0
        bgr = bgr[mask]
    else:
        bgr = image

    rgb = cv2.cvtColor(bgr.reshape((-1, 1, 3)), cv2.COLOR_BGR2RGB).reshape((-1, 3))
    n_clusters = min(3, len(np.unique(rgb, axis=0)))
    kmeans = KMeans(n_clusters=n_clusters, random_state=42)
    kmeans.fit(rgb)
    labels, counts = np.unique(kmeans.labels_, return_counts=True)
    dominant_cluster_index = labels[np.argmax(counts)]
    dominant_color = kmeans.cluster_centers_[dominant_cluster_index]
    rgb_color = [int(c) for c in dominant_color]
    return rgb_color

@app.route('/process-image', methods=['POST'])
def process_image():
    if 'image' not in request.files:
        return jsonify({'error': 'No image uploaded'}), 400

    image_file = request.files['image']
    image_path = 'uploaded_image.png'
    image_file.save(image_path)

    # Menghapus background dari gambar
    image_without_bg = remove_background(image_path)
    output_path = os.path.join(os.getcwd(), 'output_image.png')

    # Konversi dari BGRA ke RGBA untuk transparansi yang benar
    image_rgba = cv2.cvtColor(image_without_bg, cv2.COLOR_BGRA2RGBA)

    try:
        # Simpan gambar PNG dengan transparansi yang benar
        output_image = Image.fromarray(image_rgba, 'RGBA')
        output_image.save(output_path, format='PNG')
        print(f"Gambar tanpa background disimpan di: {output_path}")
    except Exception as e:
        print(f"Error saat menyimpan gambar: {e}")
    
    # # Validasi apakah gambar benar-benar tersimpan
    # if os.path.exists(output_path):
    #     print(f"✅ Gambar transparan berhasil disimpan: {output_path}")
    # else:
    #     print("❌ Gagal menyimpan gambar tanpa background!")

    # Mendapatkan warna dominan
    dominant_color = detect_most_dominant_color(image_without_bg)
    hex_color = rgb_to_hex(dominant_color)

    # Mengembalikan gambar tanpa background dan warna dominan sebagai JSON
    return jsonify({
        'imagePath': 'output_image.png',
        'dominantColor': hex_color
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)
    # app.run(port=5000, debug=True)