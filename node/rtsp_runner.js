// file: rtsp_runner.js

const mysql = require("mysql2/promise");
const { spawn } = require("child_process");
const path = require("path");
const fs = require("fs");

// Konfigurasi database
const dbConfig = {
  host: "localhost",
  user: "root",
  password: "",
  database: "db_cctv"
};

// Folder output
const OUTPUT_DIR = path.join(__dirname, "streams");

// Pastikan folder output ada
if (!fs.existsSync(OUTPUT_DIR)) {
  fs.mkdirSync(OUTPUT_DIR, { recursive: true });
}

async function start() {
  const conn = await mysql.createConnection(dbConfig);

  // Ambil semua kamera
  const [rows] = await conn.execute("SELECT * FROM cameras");

  rows.forEach((cam) => {
    if (!cam.rtsp_url) return;

    const dirPath = path.join(OUTPUT_DIR, cam.slug || `cam_${cam.id}`);
    if (!fs.existsSync(dirPath)) {
      fs.mkdirSync(dirPath, { recursive: true });
    }

    const outputPath = path.join(dirPath, "playlist.m3u8");
    const segmentPath = path.join(dirPath, "segment_%Y%m%d_%H%M%S.ts");

    // Command ffmpeg (pakai spawn biar gampang monitor log)
    const args = [
      "-i", cam.rtsp_url,
      "-c:v", "copy",
      "-preset", "ultrafast",
      "-tune", "zerolatency",
      "-hls_time", "2",
      "-hls_list_size", "2",
      "-hls_flags", "delete_segments",
      "-hls_segment_filename", segmentPath,
      "-strftime", "1",
      outputPath
    ];

    console.log(`Start streaming ${cam.name} (${cam.slug})...`);

    const ffmpeg = spawn("ffmpeg", args);

    ffmpeg.stdout.on("data", (data) => {
      console.log(`[FFMPEG ${cam.slug}] ${data}`);
    });

    ffmpeg.stderr.on("data", (data) => {
      console.error(`[FFMPEG ${cam.slug} ERROR] ${data}`);
    });

    ffmpeg.on("close", (code) => {
      console.log(`[FFMPEG ${cam.slug}] process exited with code ${code}`);
    });
  });

  await conn.end();
}

start().catch(err => {
  console.error("Error:", err);
});
