# Gunakan image Python yang sudah stabil
FROM python:3.9-slim

# Install dependensi sistem yang diperlukan untuk opencv dan lain-lain
RUN apt-get update && \
    apt-get install -y --no-install-recommends \
    build-essential \
    python3-opencv \
    libglib2.0-0 \
    libsm6 \
    libxrender1 \
    libxext6 \
    && rm -rf /var/lib/apt/lists/*

# Set workdir
WORKDIR /app

# Salin requirements dan install dependensi python
COPY requirements.txt .
RUN pip install --no-cache-dir -r requirements.txt

# Salin semua file aplikasi ke dalam container
COPY . .

# Expose port flask
EXPOSE 5000

# Jalankan aplikasi dengan waitress
CMD ["sh", "-c", "waitress-serve --port=$PORT app:app"] 