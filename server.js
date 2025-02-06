const express = require("express");
const multer = require("multer");
const { nanoid } = require("nanoid");
const cors = require("cors");
const fs = require("fs");
const path = require("path");

const app = express();
const port = 3000;
app.use(cors());
app.use(express.static("uploads"));

const DB_FILE = "files.json";
const readDB = () => JSON.parse(fs.readFileSync(DB_FILE, "utf-8") || "{}");
const writeDB = (data) => fs.writeFileSync(DB_FILE, JSON.stringify(data, null, 2));

if (!fs.existsSync(DB_FILE)) writeDB({});

const storage = multer.diskStorage({
  destination: "uploads/",
  filename: (req, file, cb) => {
    const uniqueName = nanoid(10) + path.extname(file.originalname);
    cb(null, uniqueName);
  },
});
const upload = multer({ storage });

app.post("/upload", upload.single("file"), (req, res) => {
  if (!req.file) return res.status(400).json({ error: "No file uploaded" });

  const fileId = nanoid(10);
  const fileUrl = `http://localhost:${port}/download/${fileId}`;
  const db = readDB();

  db[fileId] = { filename: req.file.filename, originalname: req.file.originalname };
  writeDB(db);

  res.json({ success: true, fileUrl });
});

app.get("/download/:id", (req, res) => {
  const db = readDB();
  const fileData = db[req.params.id];

  if (!fileData) return res.status(404).send("File not found!");

  res.download(path.join(__dirname, "uploads", fileData.filename), fileData.originalname);
});

app.listen(port, () => {
  console.log(`Server running at http://localhost:${port}`);
});