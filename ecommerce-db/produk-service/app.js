const express = require("express");
const app = express();
// Import koneksi database
const sequelize = require("./config/koneksi.js");

require("./helpers/header")(app);

// Test koneksi database otomatis
async function connectDB() {
  try {
    await sequelize.authenticate();
    console.log("Koneksi ke database berhasil!");
  } catch (error) {
    console.error("Gagal konek ke database:", error.message);
  }
}
//Panggil fungsi koneksi connectDB
connectDB();

//tb_produk
const { DataTypes } = require("sequelize");
const { successResponse, errorResponse } = require("./helpers/response.js");
const Produk = sequelize.define("tb_produks", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  kode_produk: DataTypes.STRING,
  nama_produk: DataTypes.STRING,
  kategori: DataTypes.STRING,
  deskripsi: DataTypes.TEXT,
  harga: DataTypes.DECIMAL,
  stok: DataTypes.INTEGER,
  satuan: DataTypes.STRING,
  berat: DataTypes.DECIMAL,
  gambar: DataTypes.STRING,
});

app.get("/", (req, res) => {
  res.json({ message: "Produk Service" });
});

app.get("/produk", async (req, res) => {
  try {
    const produk = await Produk.findAll();
    successResponse(res, "Data Produk", produk);
  } catch (error) {
    errorResponse(res, 500, error.message);
  }
});

app.get("/produk/:id", async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    const item = await Produk.findByPk(id);

    if (!item) {
      return errorResponse(res, 404, "Produk Not Found");
    }
    successResponse(res, "Produk Retrieved Successfully", item);
  } catch (error) {
    console.log(error);
    errorResponse(res, 500, error.message);
  }
});

app.post("/produk", async (req, res) => {
  const {
    kode_produk,
    nama_produk,
    kategori,
    deskripsi,
    harga,
    stok,
    satuan,
    berat,
  } = req.body;
  try {
    if (
      !kode_produk ||
      !nama_produk ||
      !kategori ||
      !deskripsi ||
      !harga ||
      !stok ||
      !satuan ||
      !berat
    ) {
      return errorResponse(res, 400, "All fields are required");
    }

    const produk = await Produk.create({
      kode_produk,
      nama_produk,
      kategori,
      deskripsi,
      harga,
      stok,
      satuan,
      berat,
    });
    successResponse(res, "Product created successfully", produk);
  } catch (error) {
    errorResponse(res, 500, `Error creating product : ${error.message}`);
  }
});

app.put("/produk/:id", async (req, res) => {
  try {
    const { kode_produk, name, email, phone, address } = req.body;

    if (
      !kode_produk ||
      !nama_produk ||
      !kategori ||
      !deskripsi ||
      !harga ||
      !stok ||
      !satuan ||
      !berat
    ) {
      return errorResponse(res, 400, "All fields are required");
    }

    const id = parseInt(req.params.id);
    const item = await Produk.findByPk(id);

    if (!item) {
      return errorResponse(res, 404, "Produk Not Found");
    }

    item.kode_produk = kode_produk || item.kode_produk;
    item.nama_produk = name || item.nama_produk;
    item.kategori = kategori || item.kategori;
    item.deskripsi = deskripsi || item.deskripsi;
    item.harga = harga || item.harga;
    item.stok = stok || item.stok;
    item.satuan = satuan || item.satuan;
    item.berat = berat || item.berat;

    await item.save();
    successResponse(res, "Produk created successfully", item);
  } catch (error) {
    errorResponse(res, 500, `Error update product : ${error.message}`);
  }
});

app.delete("/produk/:id", async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    const item = await Produk.findByPk(id);
    if (!item) {
      return errorResponse(res, 404, "Produk Not Found");
    }
    await item.destroy();
    successResponse(res, "Product Deleted");
  } catch (error) {
    console.log(error);
    errorResponse(res, 500, "Error Deleting Product");
  }
});

//Port Service
const PORT = process.env.PORT || 1001;
//Jalankan server
app.listen(PORT, "0.0.0.0", () => {
  console.log(`Server Produk Services berjalan di port ${PORT}`);
});
