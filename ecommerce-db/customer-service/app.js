const express = require("express");

const multer = require("multer");
const path = require("path");
const fs = require("fs");

// pastikan folder uploads ada
const UPLOAD_DIR = path.join(__dirname, "files");
if (!fs.existsSync(UPLOAD_DIR)) {
  fs.mkdirSync(UPLOAD_DIR, { recursive: true });
}

// konfigurasi penyimpanan
const storage = multer.diskStorage({
  destination: function (req, file, cb) {
    cb(null, UPLOAD_DIR);
  },
  filename: function (req, file, cb) {
    // beri nama unik: timestamp + originalname
    const ext = path.extname(file.originalname);
    const name = file.fieldname + "-" + Date.now() + ext;
    cb(null, name);
  },
});

// (opsional) filter file: hanya izinkan gambar
const fileFilter = (req, file, cb) => {
  const allowed = [".png", ".jpg", ".jpeg", ".gif"];
  const ext = path.extname(file.originalname).toLowerCase();
  if (allowed.includes(ext)) {
    cb(null, true);
  } else {
    cb(new Error("Hanya file gambar yang diizinkan (.png, .jpg, .jpeg, .gif)"));
  }
};

const upload = multer({
  storage,
  limits: { fileSize: 5 * 1024 * 1024 }, // max 5MB
  fileFilter,
});

// Import koneksi database
const sequelize = require("./config/koneksi.js");
// Import fungsi successResponse dan errorResponse
const { errorResponse, successResponse } = require("./helpers/response.js");

const app = express();
// Import dan gunakan middleware konfigurasi
require("./helpers/header")(app);

const { DataTypes } = require("sequelize");
const Customer = sequelize.define("tb_customer", {
  id: {
    type: DataTypes.INTEGER,
    primaryKey: true,
    autoIncrement: true,
  },
  name: DataTypes.STRING,
  email: DataTypes.STRING,
  phone: DataTypes.STRING,
  address: DataTypes.STRING,
  avatar: {
    type: DataTypes.STRING(255),
    allowNull: true,
  },
});

module.exports = Customer;

//Port Service
const PORT = process.env.PORT || 1001;

// expose folder upload supaya bisa diakses via URL


// Test koneksi database otomatis
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

// Route contoh
app.get("/", (req, res) => {
  res.json({ message: "Customer Service" });
});

// Route untuk menyimpan menampilkan file
app.use("/files", express.static(UPLOAD_DIR));

//List Customer
app.get("/customer", async (req, res) => {
  try {
    const customers = await Customer.findAll();
    successResponse(res, "Products Retrieved ok ", customers);
  } catch (error) {
    console.log(error);
    errorResponse(res, 500, error.message);
  }
});

//Detail Customer
app.get("/customer/:id", async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    const item = await Customer.findByPk(id);

    if (!item) {
      return errorResponse(res, 404, "Customer Not Found");
    }
    successResponse(res, "Customer Retrieved Successfully", item);
  } catch (error) {
    console.log(error);
    errorResponse(res, 500, error.message);
  }
});

//Create Customer
app.post("/customer", upload.single("avatar"), async (req, res) => {
  const { name, email, phone, address } = req.body;
  try {
    if (!name || !email) {
      // jika ada file yang diupload tapi validasi gagal, hapus file yg sudah tersimpan
      if (req.file && req.file.path) {
        fs.unlink(req.file.path, (err) => {
          if (err)
            console.error("Gagal hapus file setelah validasi gagal:", err);
        });
      }
      return errorResponse(res, 400, "Name and Email are required");
    }

    const avatarFilename = req.file ? req.file.filename : null;

    const customer = await Customer.create({
      name,
      email,
      phone,
      address,
      avatar: avatarFilename,
    });
    successResponse(res, "Product created successfully", customer);
  } catch (error) {
    errorResponse(res, 500, `Error creating product : ${error.message}`);
  }
});

//Update Customer
app.put("/customer/:id", upload.single("avatar"), async (req, res) => {
  try {
    const { name, email, phone, address } = req.body;

    if (!name || !email) {
      if (req.file && req.file.path) {
        fs.unlink(req.file.path, (err) => {
          if (err)
            console.error("Gagal hapus file setelah validasi gagal:", err);
        });
      }
      return errorResponse(res, 400, "Name and Email are required");
    }

    const id = parseInt(req.params.id);
    const item = await Customer.findByPk(id);

    if (!item) {
      return errorResponse(res, 404, "Customer Not Found");
    }

    const avatarFilename = req.file ? req.file.filename : null;

    item.name = name || item.name;
    item.email = email || item.email;
    item.phone = phone || item.phone;
    item.address = address || item.address;
    item.avatar = avatarFilename || item.avatar;

    await item.save();
    successResponse(res, "Product created successfully", item);
  } catch (error) {
    errorResponse(res, 500, `Error update product : ${error.message}`);
  }
});

//Delete Customer
app.delete("/customer/:id", async (req, res) => {
  try {
    const id = parseInt(req.params.id);
    const item = await Customer.findByPk(id);
    if (!item) {
      return errorResponse(res, 404, "Customer Not Found");
    }
    await item.destroy();
    successResponse(res, "Product Deleted");
  } catch (error) {
    console.log(error);
    errorResponse(res, 500, "Error Deleting Product");
  }
});

//Jalankan server
app.listen(PORT, "0.0.0.0", () => {
  console.log(`Server berjalan di port ${PORT}`);
});
