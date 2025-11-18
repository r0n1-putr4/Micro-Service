FROM node:latest
WORKDIR /app
COPY package*.json ./
RUN npm install
RUN npm install -g nodemon

EXPOSE 1001
CMD ["nodemon", "--legacy-watch", "--watch", ".", "app.js"]