const { Sequelize } = require("sequelize");

const sequelize = new Sequelize("customer_db", "root", "123456", {
  host: process.env.DB_HOST || "customer_db", // Host database yang akan digunakan
  dialect: "mysql", // Jenis database yang digunakan
  port: 3306, // Port default MySQL
});

module.exports = sequelize;