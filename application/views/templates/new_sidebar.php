<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="<?= base_url('dashboard'); ?>" class="simple-text logo-normal">
            <div class="mr-4">
                <img class="w-50" src="<?= base_url(); ?>assets/img/stbk-logo.jpg">
            </div>
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">

            <!-- jika userdata jabatan bernilai 1 maka tampilkan menu yg bisa diakses pengurus -->
            <!-- cek apakah user data yang login itu pengurus atau anggota -->
            <?php
            $jabatan = $this->session->userdata('jabatan'); //anggap $jabatan = 2
            if ($jabatan == '1') {
                echo "";
            } else {
                echo "";
            }
            ?>
            <!-- jika userdata jabatan bernilai 2 maka tampilkan menu yg bisa diakses anggota saja -->
            <li>
                <a href="<?= base_url('user'); ?>">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Profil</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('rapat'); ?>">
                    <i class="nc-icon nc-bank"></i>
                    <p>Rapat</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('piket'); ?>">
                    <i class="nc-icon nc-diamond"></i>
                    <p>Piket</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('kegiatan'); ?>">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Kegiatan</p>
                </a>
            </li>
            <li>
                <a href="./notifications.html">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Iuran</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('donatur'); ?>">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Donatur</p>
                </a>
            </li>
            <li>
                <a href="./tables.html">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>