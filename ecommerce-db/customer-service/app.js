const express = require("express");

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
});

module.exports = Customer;

//Port Service
const PORT = process.env.PORT || 1001;

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
app.post("/customer", async (req, res) => {
  const { name, email, phone, address } = req.body;
  try {
    if (!name || !email) {
      return errorResponse(res, 400, "Name and Email are required");
    }

    const customer = await Customer.create({ name, email, phone, address });
    successResponse(res, "Product created successfully", customer);
  } catch (error) {
    errorResponse(res, 500, `Error creating product : ${error.message}`);
  }
});

//Update Customer
app.put("/customer/:id", async (req, res) => {
  try {
    const { name, email, phone, address } = req.body;

    if (!name || !email) {
      return errorResponse(res, 400, "Name and Email are required");
    }

    const id = parseInt(req.params.id);
    const item = await Customer.findByPk(id);

    if (!item) {
      return errorResponse(res, 404, "Customer Not Found");
    }

    item.name = name || item.name;
    item.email = email || item.email;
    item.phone = phone || item.phone;
    item.address = address || item.address;

    await item.save();
    successResponse(res, "Product created successfully", item);
  } catch (error) {
    errorResponse(res, 500, `Error creating product : ${error.message}`);
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
