const { Sequelize } = require("sequelize");

const sequelize = new Sequelize("produk_db", "root", "123456", {
  host: process.env.DB_HOST || "localhost", // Host database yang akan digunakan
  dialect: "mysql", // Jenis database yang digunakan
  port: 3306, // Port default MySQL
});

module.exports = sequelize;
