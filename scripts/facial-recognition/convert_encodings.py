import pandas as pd
import json
import os

# Define paths
base_dir = os.path.dirname(os.path.dirname(os.path.dirname(__file__)))
input_file = os.path.join(base_dir, 'storage', 'app', 'facial-recognition', 'encodings', 'encodings.csv')
output_dir = os.path.join(base_dir, 'storage', 'app', 'facial-recognition', 'encodings')
output_file = os.path.join(output_dir, 'known_faces.json')

# Create output directory if it doesn't exist
os.makedirs(output_dir, exist_ok=True)

try:
    # Read the CSV file
    print(f"Reading encodings from: {input_file}")
    df = pd.read_csv(input_file)

    # Extract names and encodings
    names = df['Name'].tolist()
    encodings = df.drop('Name', axis=1).values.tolist()

    # Save as JSON
    print(f"Saving encodings to: {output_file}")
    with open(output_file, 'w') as f:
        json.dump({
            'names': names,
            'encodings': encodings
        }, f)
    
    print("Conversion completed successfully!")

except FileNotFoundError:
    print(f"Error: Could not find the encodings file at {input_file}")
    print("Please make sure to place your encodings.csv file in the correct location:")
    print(f"  {input_file}")
except Exception as e:
    print(f"Error during conversion: {str(e)}") 