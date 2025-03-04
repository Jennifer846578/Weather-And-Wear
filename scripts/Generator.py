import sys
import json
import base64

if __name__ == "__main__":
    encoded_json = sys.argv[1]  # Get Base64-encoded string
    json_data = base64.b64decode(encoded_json).decode("utf-8")  # Decode Base64 to JSON
    clothes = json.loads(json_data)  # Convert JSON string to Python list

    weather=sys.argv[2]
    style=sys.argv[3]

    print(clothes,weather,style)