FROM node:latest
WORKDIR /app
COPY package*.json ./
RUN npm install
# Install nodemon secara global agar bisa pakai langsung
RUN npm install -g nodemon
EXPOSE 1001

CMD ["nodemon", "--legacy-watch", "--watch", ".", "app.js"]