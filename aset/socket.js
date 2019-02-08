var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

io.on('connection', function(socket){
  socket.on('notification-sync', function(data){
  	console.log(`
\x1b[97m                            ++====================++
\x1b[97m ++=======================  ||    Notification    ||  ==========================
\x1b[97m ||                         ++====================++
\x1b[97m ||\t\x1b[92mData Loop    : \x1b[33m`+data.loop+`
\x1b[97m ||\t\x1b[92mTime         : \x1b[93m` + new Date().toString() + `
\x1b[97m ||\t\t\x1b[91mka_waka_setum\t\t\x1b[0m: \x1b[96m`+data.ka_waka_setum+`
\x1b[97m ||\t\t\x1b[91mtgl_surat\t\t\x1b[0m: \x1b[96m`+data.tgl_surat+`
\x1b[97m ||\t\t\x1b[91mtablenya\t\t\x1b[0m: \x1b[96m`+data.tablenya+`
\x1b[97m ||\t\t\x1b[91mstatus\t\t\t\x1b[0m: \x1b[96m`+data.status+`
\x1b[97m ||\t\t\x1b[91mopened\t\t\t\x1b[0m: \x1b[96m`+data.opened+`
\x1b[97m ||\t\t\x1b[91mkepada\t\t\t\x1b[0m: \x1b[96m`+data.kepada+`
\x1b[97m ||\t\t\x1b[91mid_jabatan\t\t\x1b[0m: \x1b[96m`+data.id_jabatan+`
\x1b[97m ||\t\t\x1b[91mperihal\t\t\t\x1b[0m: \x1b[96m`+data.perihal+`
\x1b[97m ||\t\t\x1b[91mstatus_surat_keluar\t\x1b[0m: \x1b[96m`+data.status_surat_keluar+`
\x1b[97m ||\t\t\x1b[91midnya\t\t\t\x1b[0m: \x1b[96m`+data.idnya+`
\x1b[97m ||\t\t\x1b[91mcreate_by\t\t\x1b[0m: \x1b[96m`+data.create_by+`
\x1b[97m ++=============================================================================`);
    io.emit('notification-sync', {
      	ka_waka_setum			: data.ka_waka_setum,
      	tgl_surat				: data.tgl_surat,
      	tablenya				: data.tablenya,
      	status 					: data.status,
      	opened 					: data.opened,
      	kepada					: data.kepada,
      	id_jabatan				: data.id_jabatan,
      	perihal					: data.perihal,
      	status_surat_keluar		: data.status_surat_keluar,
      	idnya					: data.idnya,
      	create_by				: data.create_by
    });
  });
});
server.listen(port, function(){
  var path = process.cwd();
  process.stdout.write('\033c\033[3J');
  console.log('\x1b[30m\x1b[40m                                                                                 \x1b[94m\x1b[40m');
  console.log('\x1b[30m\x1b[40m"\x1b[94m\x1b[40m###############################################################################\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m   _  __              _             _             _       _                \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m  | |/ /___  ___  ___| | ___ __ ___| |_ __ _ _ __(_) __ _| |_ __ _ _ __    \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m  | \' // _ \\/ __|/ _ \\ |/ / \'__/ _ \\ __/ _` | \'__| |/ _` | __/ _` | \'_ \\   \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m  | . \\  __/\\__ \\  __/   <| | |  __/ || (_| | |  | | (_| | || (_| | | | |  \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m  |_|\\_\\___||___/\\___|_|\\_\\_|  \\___|\\__\\__,_|_|  |_|\\__,_|\\__\\__,_|_| |_|  \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m##\x1b[91m\x1b[106m                                                                           \x1b[94m\x1b[40m##\x1b[30m\x1b[40m"');
  console.log('"\x1b[94m\x1b[40m###############################################################################\x1b[30m\x1b[40m"\x1b[94m\x1b[40m');
  console.log('\x1b[30m\x1b[40m                                                                                 \x1b[94m\x1b[40m');
  console.log('\x1b[30m\x1b[40m    \x1b[94m\x1b[40m[]  Path    : \x1b[93m\x1b[40m'+path+'\x1b[94m\x1b[40m');
  console.log('\x1b[30m\x1b[40m    \x1b[94m\x1b[40m[]  Command : \x1b[93m\x1b[40mnode '+path+'\\aset\\socket.js\x1b[94m\x1b[40m');
  console.log('    '+'[]  Status  : \x1b[92m%s\x1b[0m','Socket Running on port *:' + port+'\n');
  console.log(' '+'\x1b[37m++~~~~~~~~~~~~~~~~~~~~~~~  ++++++++++++++++++++++++  ~~~~~~~~~~~~~~~~~~~~~~~~++');
  console.log(' '+'\x1b[37m||=======================  ++\x1b[107m\x1b[30m  Listening Socket  \x1b[40m\x1b[37m++  ========================||');
  console.log(' '+'\x1b[37m++~~~~~~~~~~~~~~~~~~~~~~~  ++++++++++++++++++++++++  ~~~~~~~~~~~~~~~~~~~~~~~~++');
});
