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

            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT *
            FROM `user_menu` JOIN `user_access_menu` 
            ON `user_menu`.`id` = `user_access_menu`.`menu_id`
            WHERE `user_access_menu`.`role_id` = $role_id
            ORDER BY `user_access_menu`.`menu_id` ASC
                ";
            $menu = $this->db->query($queryMenu)->result_array();
            ?>

            <!-- LOOPING MENU -->
            <?php foreach ($menu as $m) :    ?>
                <li>
                    <a href="<?= base_url($m['url']); ?>">
                        <i class="<?= $m['icon']; ?>"></i>
                        <p><?= $m['title']; ?></p>
                    </a>
                </li>

            <?php endforeach;    ?>

            <!-- <li>
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
                <a href="<?= base_url('iuran'); ?>">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Iuran</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('verifikasi'); ?>">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Verifikasi</p>
                </a>
            </li>
            <li>
                <a href="<?= base_url('donatur'); ?>">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>Donatur</p>
                </a>
            </li> -->
            <li>
                <a href="<?= base_url('auth/logout'); ?>">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>