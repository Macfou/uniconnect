#print("Script started")
import sys
#print("Arguments passed:", sys.argv)
import io
import os
import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.sentiment import SentimentIntensityAnalyzer
import string

# Set sys.stdout to use UTF-8 encoding
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

# Download necessary NLTK resource
nltk.download('punkt', quiet=True)
nltk.download('stopwords', quiet=True)
nltk.download('vader_lexicon', quiet=True)

# Function to preprocess the text
def preprocess_text(text):
    tokens = word_tokenize(text.lower())
    tokens = [word for word in tokens if word not in string.punctuation and word not in stopwords.words('english')]
    return " ".join(tokens)

# Function to classify sentiment
def classify_sentiment(text):
    sia = SentimentIntensityAnalyzer()
    score = sia.polarity_scores(text)
    return score['compound']

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Error: No feedback provided", file=sys.stderr)
        sys.exit(1)
    feedback = sys.argv[1]
    cleaned_feedback = preprocess_text(feedback)
    compound_score = classify_sentiment(cleaned_feedback)
    sentiment = 1 if compound_score >= 0.05 else -1 if compound_score <= -0.05 else 0
    print(sentiment)