const express = require("express");
const bodyParser = require("body-parser");
const cors = require("cors");

module.exports = (app) => {
  // Parsing JSON dan form-urlencoded
  app.use(express.json());
  app.use(bodyParser.urlencoded({ extended: true }));

  // Setting CORS secara manual
  app.use(function (req, res, next) {
    res.header("Access-Control-Allow-Origin", "*");
    res.header(
      "Access-Control-Allow-Headers",
      "Origin, Content-Type, Accept, Authorization"
    );
    res.header(
      "Access-Control-Allow-Methods",
      "GET, POST, PUT, DELETE, OPTIONS"
    );
    next();
  });

  // Gunakan package cors juga (opsional)
  app.use(cors());
};
