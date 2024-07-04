 <div class="row">
     <div class="col-lg-4 col-6">

         <div class="small-box bg-info">
             <div class="inner">
                 <h3>{{ $pelamar }}</h3>
                 <p>Pelamar</p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                     class="icon icon-tabler icons-tabler-outline icon-tabler-file-cv">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                     <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                     <path d="M11 12.5a1.5 1.5 0 0 0 -3 0v3a1.5 1.5 0 0 0 3 0" />
                     <path d="M13 11l1.5 6l1.5 -6" />
                 </svg>
             </div>
             <a href="{{ url('data_pelamar') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-4 col-6">

         <div class="small-box bg-success">
             <div class="inner">
                 <h3>{{ $jumlah_karyawan_baru }}</h3>
                 <p>Karyawan Baru</p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                     <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                     <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                     <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                 </svg>
             </div>
             <a href="{{ url('data_karyawan') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-4 col-6">

         <div class="small-box bg-warning">
             <div class="inner">
                 <h3>{{ $karyawan_hadir }}</h3>
                 <p>Karyawan Hadir</p>
             </div>
             <div class="icon">
                 <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24"
                     fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                     stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                     <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                     <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                     <path d="M16 3v4" />
                     <path d="M8 3v4" />
                     <path d="M4 11h16" />
                     <path d="M15 19l2 2l4 -4" />
                 </svg>
             </div>
             <a href="{{ url('presensi') }}" class="small-box-footer">More info <i
                     class="fas fa-arrow-circle-right"></i></a>
         </div>
     </div>

     <div class="col-lg-12 col-12">
         @include('dashboard.piechart')
     </div>

 </div>
