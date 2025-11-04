const successResponse = (res, message, data = null) => {
  res.status(200).json({
    success: true,
    message: message,
    data: data,
  });
};
const errorResponse = (res, status, message) => {
  res.status(status).json({
    success: false,
    message: message,
  });
};

module.exports = { successResponse, errorResponse };
