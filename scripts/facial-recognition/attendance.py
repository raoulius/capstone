import cv2
import numpy as np
import face_recognition
import os
import json
import sys
from datetime import datetime

def load_encodings():
    # Load the encodings from the CSV file
    encodings_path = os.path.join(os.path.dirname(__file__), 
                                 '../../storage/app/facial-recognition/encodings/known_faces.json')
    
    with open(encodings_path, 'r') as f:
        data = json.load(f)
        known_face_encodings = [np.array(enc) for enc in data['encodings']]
        known_face_names = data['names']
    
    return known_face_encodings, known_face_names

def recognize_faces(rapat_id):
    # Load the known face encodings
    known_face_encodings, known_face_names = load_encodings()
    
    # Initialize webcam
    cap = cv2.VideoCapture(0)
    
    # Dictionary to track recognized people
    recognized_people = set()
    
    while True:
        success, img = cap.read()
        if not success:
            continue
            
        # Resize frame for faster processing
        imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
        imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
        
        # Find faces in current frame
        face_locations = face_recognition.face_locations(imgS)
        face_encodings = face_recognition.face_encodings(imgS, face_locations)
        
        for face_encoding, face_loc in zip(face_encodings, face_locations):
            matches = face_recognition.compare_faces(known_face_encodings, face_encoding, tolerance=0.6)
            face_distances = face_recognition.face_distance(known_face_encodings, face_encoding)
            
            if len(face_distances) > 0:
                best_match_index = np.argmin(face_distances)
                if matches[best_match_index]:
                    name = known_face_names[best_match_index]
                    recognized_people.add(name)
                    
                    # Draw rectangle around face
                    y1, x2, y2, x1 = [coord * 4 for coord in face_loc]
                    cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
                    cv2.rectangle(img, (x1, y2 - 35), (x2, y2), (0, 255, 0), cv2.FILLED)
                    cv2.putText(img, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)
        
        cv2.imshow('Webcam', img)
        
        # Break loop if 'q' is pressed or after 30 seconds
        if cv2.waitKey(1) & 0xFF == ord('q'):
            break
    
    cap.release()
    cv2.destroyAllWindows()
    
    # Return the list of recognized people
    return list(recognized_people)

if __name__ == "__main__":
    rapat_id = sys.argv[1]
    recognized_people = recognize_faces(rapat_id)
    print(json.dumps(recognized_people)) 