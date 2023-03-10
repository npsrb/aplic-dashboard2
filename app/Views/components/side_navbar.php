 <div id="layoutSidenav_nav">
     <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
         <div class="sb-sidenav-menu">
             <div class="nav">
                 <a class="nav-link" href="<?= base_url() ?>">
                     <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                     Dashboard
                 </a>
                 <a class="nav-link" href="<?= base_url('timesheet') ?>">
                     <div class="sb-nav-link-icon"><i class="fas fa-clock"></i></div>
                     Timesheet
                 </a>
                 <a class="nav-link" href="<?= base_url('request') ?>">
                     <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
                     Request
                 </a>
                 <a class="nav-link" href="<?= base_url('report') ?>">
                     <div class="sb-nav-link-icon"><i class="fas fa-tag"></i></div>
                     Report
                 </a>

             </div>
         </div>
         <div class="sb-sidenav-footer">
             <div class="small">Logged in as:</div>
             <?= session()->username; ?>
         </div>
     </nav>
 </div>