<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="<?= base_url('dashboard'); ?>" class="simple-text logo-normal">
            <div class="text-center">
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

            <li>
                <a data-toggle="modal" data-target="#logout">
                    <i class="nc-icon nc-button-power"></i>
                    <p>Logout</p>
                </a>
            </li>
        </ul>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('auth/logout'); ?>">
                    <p>Apakah Anda yakin keluar dari sistem?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Logout</button>
            </div>
            </form>
        </div>
    </div>
</div>