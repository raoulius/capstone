from flask import Flask, request, jsonify
import cv2
import numpy as np
import face_recognition
import os
import pickle
from datetime import datetime

app = Flask(__name__)

# Load encodings
with open("/Users/rajendraritmanto/capstone/coba1_backend/python-api/encodings/face_encodings.pkl", "rb") as f:
    encodeListKnown, classNames = pickle.load(f)

@app.route('/recognize', methods=['POST'])
def recognize_face():
    # Get image from request
    if 'image' not in request.files:
        return jsonify({'error': 'No image provided'}), 400
    
    file = request.files['image']
    img = face_recognition.load_image_file(file)
    
    # Process image
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
    
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)
    
    results = []
    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)
        
        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            confidence = 1 - faceDis[matchIndex]
            results.append({
                'name': name,
                'confidence': float(confidence),
                'location': faceLoc
            })
    
    return jsonify({'results': results})

if __name__ == '__main__':
    app.run(port=5000)