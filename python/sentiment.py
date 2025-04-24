import warnings
warnings.filterwarnings("ignore", category=UserWarning, module="sklearn.base")

import sys
import io
import os
import joblib
import string
import re
import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords

# Load model and vectorizer
classifier = joblib.load("C:/xampp/htdocs/dashboard/umak_event/python/sentiment_nb_model.pkl")
vectorizer = joblib.load("C:/xampp/htdocs/dashboard/umak_event/python/tfidf_vectorizer.pkl")

# Set sys.stdout to UTF-8
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

# Debug logging
def log_debug(message):
    with open("C:/xampp/htdocs/dashboard/umak_event/python/sentiment_log.txt", "a", encoding="utf-8") as log_file:
        log_file.write(message + "\n")

# Preprocess text
def preprocess_text(text):
    if not text:
        return ""
    text = text.lower()
    text = ''.join([char for char in text if char not in string.punctuation])
    words = re.findall(r'\b\w+\b', text)
    stop_words = set(stopwords.words('english'))
    words = [word for word in words if word not in stop_words]
    return " ".join(words)

try:
    nltk.download('stopwords', quiet=True)
    nltk.download('punkt', quiet=True)

    if __name__ == "__main__":
        log_debug("Script started")
        log_debug(f"Arguments: {sys.argv}")

        if len(sys.argv) < 2:
            log_debug("No argument received.")
            sys.exit(1)

        feedback = sys.argv[1]
        log_debug(f"Raw feedback: {feedback}")

        cleaned_feedback = preprocess_text(feedback)
        log_debug(f"Cleaned feedback: {cleaned_feedback}")

        tfidf_feedback = vectorizer.transform([cleaned_feedback])
        sentiment = classifier.predict(tfidf_feedback)[0]
        print(sentiment)
        log_debug(f"Predicted sentiment: {sentiment}")

except Exception as e:
    log_debug(f"Exception: {str(e)}")