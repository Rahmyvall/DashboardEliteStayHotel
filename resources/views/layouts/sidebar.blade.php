 <!-- ========== Left Sidebar ========== -->
 <div class="main-menu">
     <!-- Brand Logo -->
     <div class="logo-box">
         <!-- Brand Logo Light -->
         <a href="index.html" class="logo-light">
             <img src="{{asset('dashtrap/admin/dist/assets/images/logo.png')}}" alt="logo" class="logo-lg" height="50">
             <img src="{{asset('dashtrap/admin/dist/assets/images/logo.png')}}" alt="small logo" class="logo-sm"
                 height="50">
         </a>

         <!-- Brand Logo Dark -->
         <a href="index.html" class="logo-dark">
             <img src="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}" alt="dark logo" class="logo-lg"
                 height="30">
             <img src="{{asset('dashtrap/admin/dist/assets/images/logo3.png')}}" alt="small logo" class="logo-sm"
                 height="30">
         </a>
     </div>

     <!--- Menu -->
     <div data-simplebar>
         <ul class="app-menu">

             <li class="menu-title">Menu</li>

             <!-- Dashboard -->
             <li class="menu-item">
                 <a href="{{ route('dashboard') }}" class="menu-link waves-effect waves-light">
                     <span class="menu-icon">
                         <i class="bx bx-home-smile"></i>
                     </span>

                     <span class="menu-text" data-key="dashboard">
                         Dashboard
                     </span>
                 </a>
             </li>
             <!-- Data Master -->
             <li class="menu-title">Data Master</li>

             <li class="menu-item">
                 <a href="#menuMaster" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                     <span class="menu-icon">
                         <i class="bx bx-data"></i>
                     </span>

                     <span class="menu-text" data-key="data_master">
                         Master Data
                     </span>

                     <span class="menu-arrow"></span>
                 </a>

                 <div class="collapse" id="menuMaster">
                     <ul class="sub-menu">
                         <li class="menu-item">
                             <a href="{{ route('users.index') }}" class="menu-link">
                                 <span class="menu-text" data-key="users">
                                     Users
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="pelanggan.html" class="menu-link">
                                 <span class="menu-text" data-key="pelanggan">
                                     Pelanggan
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="tipe_kamar.html" class="menu-link">
                                 <span class="menu-text" data-key="tipe_kamar">
                                     Tipe Kamar
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="kamar.html" class="menu-link">
                                 <span class="menu-text" data-key="kamar">
                                     Kamar
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="fasilitas.html" class="menu-link">
                                 <span class="menu-text" data-key="fasilitas">
                                     Fasilitas
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="tipe_kamar_fasilitas.html" class="menu-link">
                                 <span class="menu-text" data-key="tipe_kamar_fasilitas">
                                     Tipe Kamar Fasilitas
                                 </span>
                             </a>
                         </li>

                     </ul>
                 </div>
             </li>

             <!-- Transaksi -->
             <li class="menu-title">Transaksi</li>

             <li class="menu-item">
                 <a href="#menuTransaksi" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                     <span class="menu-icon">
                         <i class="bx bx-cart"></i>
                     </span>

                     <span class="menu-text" data-key="transaksi">
                         Reservasi
                     </span>

                     <span class="menu-arrow"></span>
                 </a>

                 <div class="collapse" id="menuTransaksi">
                     <ul class="sub-menu">

                         <li class="menu-item">
                             <a href="reservasi.html" class="menu-link">
                                 <span class="menu-text" data-key="reservasi">
                                     Reservasi
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="detail_reservasi.html" class="menu-link">
                                 <span class="menu-text" data-key="detail_reservasi">
                                     Detail Reservasi
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="pembayaran.html" class="menu-link">
                                 <span class="menu-text" data-key="pembayaran">
                                     Pembayaran
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="checkin_checkout.html" class="menu-link">
                                 <span class="menu-text" data-key="checkin_checkout">
                                     Checkin Checkout
                                 </span>
                             </a>
                         </li>

                     </ul>
                 </div>
             </li>

             <!-- Lainnya -->
             <li class="menu-title">Lainnya</li>

             <li class="menu-item">
                 <a href="#menuLainnya" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">

                     <span class="menu-icon">
                         <i class="bx bx-cog"></i>
                     </span>

                     <span class="menu-text" data-key="fitur_lainnya">
                         Fitur Lainnya
                     </span>

                     <span class="menu-arrow"></span>
                 </a>

                 <div class="collapse" id="menuLainnya">
                     <ul class="sub-menu">

                         <li class="menu-item">
                             <a href="review.html" class="menu-link">
                                 <span class="menu-text" data-key="review">
                                     Review
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="promo.html" class="menu-link">
                                 <span class="menu-text" data-key="promo">
                                     Promo
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="reservasi_promo.html" class="menu-link">
                                 <span class="menu-text" data-key="reservasi_promo">
                                     Reservasi Promo
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="log_aktivitas.html" class="menu-link">
                                 <span class="menu-text" data-key="log_aktivitas">
                                     Log Aktivitas
                                 </span>
                             </a>
                         </li>

                         <li class="menu-item">
                             <a href="notifikasi.html" class="menu-link">
                                 <span class="menu-text" data-key="notifikasi">
                                     Notifikasi
                                 </span>
                             </a>
                         </li>

                     </ul>
                 </div>
             </li>

         </ul>
     </div>
 </div>