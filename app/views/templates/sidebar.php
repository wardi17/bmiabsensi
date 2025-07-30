
<?php 
// $log_menu = (isset($_SESSION["log_menu"]))? $_SESSION["log_menu"] : '';
 $level_us = (isset($_SESSION["level_user"]))? $_SESSION["level_user"] : '';

$page = (isset($data['page']))? $data['page'] : ''; 
$pages = (isset($data['pages']))? $data['pages'] : ''; 
?>
<div   id="app">
        <div  id="sidebar" class="active">
            <div class="sidebar-wrapper active">
            <div class="sidebar-header position-relative">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="logo">
                        <h5><a href="<?=base_url?>/home"><?=$_SESSION['login_user']?></a><h5>
                    </div>
                    <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                        <!-- <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--system-uicons" width="20" height="20" preserveAspectRatio="xMidYMid meet" viewBox="0 0 21 21"><g fill="none" fill-rule="evenodd" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"><path d="M10.5 14.5c2.219 0 4-1.763 4-3.982a4.003 4.003 0 0 0-4-4.018c-2.219 0-4 1.781-4 4c0 2.219 1.781 4 4 4zM4.136 4.136L5.55 5.55m9.9 9.9l1.414 1.414M1.5 10.5h2m14 0h2M4.135 16.863L5.55 15.45m9.899-9.9l1.414-1.415M10.5 19.5v-2m0-14v-2" opacity=".3"></path><g transform="translate(-210 -1)"><path d="M220.5 2.5v2m6.5.5l-1.5 1.5"></path><circle cx="220.5" cy="11.5" r="4"></circle><path d="m214 5l1.5 1.5m5 14v-2m6.5-.5l-1.5-1.5M214 18l1.5-1.5m-4-5h2m14 0h2"></path></g></g></svg> -->
                        <div class="form-check form-switch fs-6">
                            <input class="  me-0" type="hidden" id="toggle-dark" >
                        </div>
                    </div>
                    <div class="sidebar-toggler  x">
                        <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                    </div>
                </div>
            </div>
    <div   class="sidebar-menu">
  

        <ul class ="menu">
        <li class="sidebar-title">Menu</li>
            
            <li
                class="sidebar-item <?php  if ($pages == 'home') {echo 'active'; }else { echo ''; } ?> ">
                <a  href="<?= base_url; ?>/home" class='sidebar-link'>
                    <i class="bi bi-grid-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
        </ul>
        <ul <?php if ($level_us !="Y"){?>style="display:none"<?php } ?> class="menu">
        
            <li class="sidebar-title">Master</li>
            
            <li 
                class="sidebar-item   <?php if ($page == 'hari') {echo 'active';} else {echo'';} ?> " aria-current="page">
                <a href="<?= base_url; ?>/harikerja" class='sidebar-link'>
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <span>Hari Kerja</span>
                </a>
            </li>
            <li 
                class="sidebar-item   <?php if ($page == 'gapok') {echo 'active';} else {echo'';} ?> " aria-current="page">
                <a href="<?= base_url; ?>/gapok" class='sidebar-link'>
                    <i class="bi bi-cloud-arrow-up-fill"></i>
                    <span>Gapok</span>
                </a>
            </li>
        </ul>
            <ul  class="menu">
            <li class="sidebar-title">Transaksi</li>
            <li 
                class="sidebar-item   <?php if ($page == 'expor') {echo 'active';} else {echo'';} ?> " aria-current="page">
                <a href="<?= base_url; ?>/exporddata" class='sidebar-link'>
                    <i class="fa-solid fa-right-to-bracket"></i>
                    <span>CheckInOut</span>
                </a>
            </li>
            <li 
                class="sidebar-item   <?php if ($page == 'masalah') {echo 'active';} else {echo'';} ?> " aria-current="page">
                <a href="<?= base_url; ?>/hari/absmasalah" class='sidebar-link'>
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Absensi Masalah</span>
                </a>
            </li>
            <li 
                class="sidebar-item   <?php if ($page == 'report') {echo 'active';} else {echo'';} ?> " aria-current="page">
                <a href="<?= base_url; ?>/koreksiabsensi/" class='sidebar-link'>
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>Transaksi Hasil Koreksi</span>
                </a>
            </li>
        </ul>
            <!-- <li
                class="sidebar-item <?php  if ($pages == 'inv_sidebar') {echo 'active'; }else { echo ''; } ?> has-sub">
                <a href="#" class='sidebar-link '>
                    <i class="bi bi-hexagon-fill"></i>
                    <span>Inventory Movement</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item <?php  if ($page == 'inv') {echo 'active'; }else { echo ''; } ?> ">
                    <a href="<?= base_url; ?>/inventori">
                      Input
                    </a>                    
                   </li>
                    <li class="submenu-item <?php  if ($page == 'post') {echo 'active'; }else { echo ''; } ?>">
                    <a href="<?= base_url; ?>/sudahpost">
                      Sudah Posting
                    </a>                    
                  </li>
                   
                </ul>
            </li>
            <li
                class="sidebar-item <?php  if ($pages == 'tf_sidebar') {echo 'active'; }else { echo ''; } ?> has-sub">
                <a href="#" class='sidebar-link '>
                    <i class="bi bi-hexagon-fill"></i>
                    <span>Inventory Transfer FG</span>
                </a>
                <ul class="submenu ">
                    <li class="submenu-item <?php  if ($page == 'tf') {echo 'active'; }else { echo ''; } ?> ">
                    <a href="<?= base_url; ?>/transferfg">
                      Input
                    </a>                    
                   </li>
                    <li class="submenu-item ">
                    <a href="<?= base_url; ?>/transfersudahpost" class="nav-link <?php  if ($page == 'tf_post') {echo 'active'; }else { echo ''; } ?>">
                      Sudah Posting
                    </a>                    
                  </li>
                   
                </ul>
            </li>
        </ul> -->
          
        <ul class ="menu">
        <li
                class="sidebar-item" aria-current="page">
                <a  href="<?= base_url; ?>/logout" class='sidebar-link'>
                <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Sign Out</span>
                </a>
            </li>
        </ul>
    </div>
    </div>
</div>