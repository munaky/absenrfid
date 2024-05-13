void emoji(String type);

void classifyEmoji(String msg){
  if(msg == "Ruang Tidak Valid"){
    emoji("sad");
  }
  else if(msg == "ID Kartu Tidak Valid"){
    emoji("sad");
  }
  else if(msg == "Absensi Tidak Valid"){
    emoji("angry");
  }
  else if(msg == "Sekarang Weekend"){
    emoji("happy");
  }
  else if(msg == "Anda Berhasil Absen Masuk"){
    emoji("happy");
  }
  else if(msg == "Anda Gagal Absen Masuk"){
    emoji("angry");
  }
  else if(msg == "Anda Berhasil Absen Keluar"){
    emoji("happy");
  }
  else if(msg == "Anda Gagal Absen Keluar"){
    emoji("angry");
  }
  else if(msg == "hm?"){
    emoji("sad");
  }
  else if(msg == "ID Kartu Sudah Terdaftar"){
    emoji("sad");
  }
  else if(msg == "Tidak Ada Pendaftar"){
    emoji("sad");
  }
  else if(msg == "Anda Berhasil Mendaftar"){
    emoji("sad");
  }
  else if(msg == "Tidak Valid"){
    emoji("angry");
  }
  else{
    
  }
}