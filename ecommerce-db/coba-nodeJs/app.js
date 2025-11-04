const express = require("express");

const app = express();
// Import dan gunakan middleware konfigurasi
require("./helpers/header")(app);
// Import koneksi database
const sequelize = require("./config/koneksi.js");

async function connectDB() {
  try {
    await sequelize.authenticate();
    console.log("Koneksi ke database berhasil!");
  } catch (error) {
    console.error("Gagal konek ke database:", error.message);
  }
}

// Jalankan koneksi saat server mulai
connectDB();

app.get("/", (req, res) => {
  res.json({ message: "Customer Service" });
});

//Port Service
const PORT = process.env.PORT || 1001;

//Jalankan server
app.listen(PORT, "0.0.0.0", () => {
  console.log(`Server berjalan di port ${PORT}`);
});
