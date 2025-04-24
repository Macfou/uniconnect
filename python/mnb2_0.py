

import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.naive_bayes import MultinomialNB
from sklearn.metrics import classification_report, accuracy_score, f1_score
import string
import re
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
import nltk

# Download NLTK resources
nltk.download('stopwords')
nltk.download('punkt')

# Load the first dataset
data1 = pd.read_csv('python/sentiment_dataset_english_100k.csv')

# Load the second dataset
data2 = pd.read_csv('python/sentiment_dataset_tagalog_100k.csv')

# Show the first few rows of both datasets
print("First dataset preview:")
print(data1.head())

print("\nSecond dataset preview:")
print(data2.head())

# Check column names for both datasets
print("\nFirst dataset columns:", data1.columns)
print("Second dataset columns:", data2.columns)

def preprocess_text(text):
    # Convert text to lowercase
    text = text.lower()

    # Remove punctuation
    text = ''.join([char for char in text if char not in string.punctuation])

    # Tokenize the text
    words = word_tokenize(text)

    # Remove stopwords
    stop_words = set(stopwords.words('english'))
    words = [word for word in words if word not in stop_words]

    # Join the words back into a single string
    return " ".join(words)

import pandas as pd
import nltk
import string
import re
from nltk.corpus import stopwords

# Download required NLTK resources
nltk.download('stopwords')
nltk.download('punkt')

# Load both datasets
data1 = pd.read_csv('python/sentiment_dataset_english_100k.csv')
data2 = pd.read_csv('python/sentiment_dataset_tagalog_100k.csv')

# Check dataset columns
print("Dataset 1 columns:", data1.columns)
print("Dataset 2 columns:", data2.columns)

# Define text preprocessing function
def preprocess_text(text):
    if pd.isnull(text):
        return ""
    text = text.lower()
    text = ''.join([char for char in text if char not in string.punctuation])
    words = re.findall(r'\b\w+\b', text)
    stop_words = set(stopwords.words('english'))
    words = [word for word in words if word not in stop_words]
    return " ".join(words)

# Preprocess 'Feedback' column if it exists in both datasets
for idx, dataset in enumerate([data1, data2], start=1):
    if 'Feedback' in dataset.columns:
        dataset['cleaned_feedback'] = dataset['Feedback'].apply(preprocess_text)
        print(f"\nDataset {idx} sample cleaned feedback:")
        print(dataset[['Feedback', 'cleaned_feedback']].head())
    else:
        print(f"Dataset {idx} does not contain a 'Feedback' column.")

data = pd.concat([data1, data2], ignore_index=True)
# Features (X) and labels (y)
X = data['cleaned_feedback']
y = data['Sentiment']  # Replace with the column containing sentiment labels (-1, 0, 1)

# Split data (80% training, 20% testing)
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

print("Training samples:", len(X_train))
print("Testing samples:", len(X_test))

# Initialize TF-IDF Vectorizer
vectorizer = TfidfVectorizer(max_features=5000)

# Fit and transform training data; transform test data
X_train_tfidf = vectorizer.fit_transform(X_train)
X_test_tfidf = vectorizer.transform(X_test)

print("TF-IDF matrix shape for training data:", X_train_tfidf.shape)

# Initialize Multinomial Naive Bayes model
classifier = MultinomialNB()

# Train the classifier
classifier.fit(X_train_tfidf, y_train)

print("Model training completed.")

# Predict sentiments for test data
y_pred = classifier.predict(X_test_tfidf)

# Calculate accuracy
accuracy = accuracy_score(y_test, y_pred)
print("Accuracy:", accuracy)

# Calculate F1-score
f1 = f1_score(y_test, y_pred, average='weighted')  # Use 'weighted' for multi-class
print("F1 Score:", f1)

# Print detailed classification report
print("Classification Report:")
print(classification_report(y_test, y_pred))

import joblib

# Save model and vectorizer for future use
joblib.dump(classifier, 'python/sentiment_nb_model.pkl')
joblib.dump(vectorizer, 'python/tfidf_vectorizer.pkl')

print("Model and vectorizer saved.")

# Load saved model and vectorizer
classifier = joblib.load('python/sentiment_nb_model.pkl')
vectorizer = joblib.load('python/tfidf_vectorizer.pkl')

# Example new feedback for testing
new_feedback = ["The event is amazing"]
new_feedback_tfidf = vectorizer.transform(new_feedback)

# Predict sentiment
predicted_sentiment = classifier.predict(new_feedback_tfidf)
print("Predicted Sentiment:", predicted_sentiment)