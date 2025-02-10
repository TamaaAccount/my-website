const { createClient } = require('bedrock-protocol');

const bot = createClient({
  host: 'TamaaWorldMCPE.aternos.me', // Ganti dengan IP server Bedrock
  port: 36437, // Port default Bedrock
  username: 'TamaaBOT',
});

bot.on('join', () => {
  console.log(`${bot.options.username} berhasil masuk server!`);
  bot.write('text', {
    type: 'chat',
    needs_translation: false,
    source_name: bot.options.username,
    xuid: '',
    platform_chat_id: '',
    message: 'Halo, aku bot!',
  });
});

bot.on('disconnect', (reason) => {
  console.log('Bot keluar:', reason);
});
