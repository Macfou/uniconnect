import sys
import io
import nltk
from nltk.tokenize import word_tokenize
from nltk.corpus import stopwords
from nltk.sentiment import SentimentIntensityAnalyzer
import string
from langdetect import detect
import joblib

# Set sys.stdout to use UTF-8 encoding
sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

# Download necessary NLTK resources
nltk.download('punkt', quiet=True)
nltk.download('stopwords', quiet=True)
nltk.download('vader_lexicon', quiet=True)

# Load Tagalog sentiment model
tagalog_model = joblib.load('python/tagalog_sentiment_model.pkl')

# Function to preprocess English text
def preprocess_text(text):
    tokens = word_tokenize(text.lower())
    tokens = [word for word in tokens if word not in string.punctuation and word not in stopwords.words('english')]
    return " ".join(tokens)

# Function to classify sentiment with language detection
def classify_sentiment(text):
    try:
        print(f"Classifying sentiment for: {text}", file=sys.stderr)
        lang = detect(text)
        print(f"Detected language: {lang}", file=sys.stderr)

        if lang == 'en':
            cleaned = preprocess_text(text)
            print(f"Cleaned text: {cleaned}", file=sys.stderr)
            sia = SentimentIntensityAnalyzer()
            score = sia.polarity_scores(cleaned)
            print(f"Sentiment score: {score}", file=sys.stderr)
            return 1 if score['compound'] >= 0.05 else -1 if score['compound'] <= -0.05 else 0

        elif lang == 'tl':
            prediction = tagalog_model.predict([text])[0]
            print(f"Tagalog prediction: {prediction}", file=sys.stderr)
            return int(prediction)

        else:
            print("Language not supported, returning neutral sentiment.", file=sys.stderr)
            return 0  # Neutral/default for unsupported languages
    except Exception as e:
        print(f"Error in sentiment classification: {e}", file=sys.stderr)
        return None

if __name__ == "__main__":
    if len(sys.argv) < 2:
        print("Error: No feedback provided", file=sys.stderr)
        sys.exit(1)

    feedback = sys.argv[1]
    sentiment = classify_sentiment(feedback)

    if sentiment is not None:
        print(sentiment)
    else:
        print("Error: Sentiment classification failed", file=sys.stderr)
        sys.exit(1)
