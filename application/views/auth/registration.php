    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">BUAT AKUN</h1>
                            </div>
                            <form class="user" method="post" action="<?= base_url('auth/registration'); ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                                    <?=
                                    form_error('nama', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <label for="tgl_lahir" class="ml-2">Tanggal Lahir</label>
                                    <input type="date" class="form-control form-control-user" id="tgl_lahir" name="tgl_lahir" value="<?= set_value('tgl_lahir'); ?>">
                                    <?=
                                    form_error('tgl_lahir', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="alamat" name="alamat" placeholder="Alamat" value="<?= set_value('alamat'); ?>">
                                    <?=
                                    form_error('alamat', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="d-block ml-2">
                                    <label for="jk">Jenis Kelamin</label>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <div class="custom-control custom-radio">
                                            <input id="laki-laki" name="jk" type="radio" class="custom-control-input" checked="" value="laki-laki">
                                            <label class="custom-control-label" for="laki-laki">Laki-Laki</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="custom-control custom-radio">
                                            <input id="perempuan" name="jk" type="radio" class="custom-control-input" value="perempuan">
                                            <label class="custom-control-label" for="perempuan">Perempuan</label>
                                        </div>
                                    </div>
                                    <?=
                                    form_error('jk', '<small class="text-danger pl-2">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="hobi" name="hobi" placeholder="Hobi" value="<?= set_value('hobi'); ?>">
                                    <?=
                                    form_error('hobi', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="telp" name="telp" placeholder="Telp" value="<?= set_value('telp'); ?>">
                                    <?=
                                    form_error('telp', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="pekerjaan" name="pekerjaan" placeholder="Pekerjaan" value="<?= set_value('pekerjaan'); ?>">
                                    <?=
                                    form_error('pekerjaan', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="nama_ortu" name="nama_ortu" placeholder="Nama Orang Tua" value="<?= set_value('nama_ortu'); ?>">
                                    <?=
                                    form_error('nama_ortu', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="telp_ortu" name="telp_ortu" placeholder="Telepon Orang Tua" value="<?= set_value('telp_ortu'); ?>">
                                    <?=
                                    form_error('telp_ortu', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                                    <?=
                                    form_error('email', '<small class="text-danger pl-3">', '</small>');
                                    ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                        <?=
                                        form_error('password1', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repeat Password">
                                        <?=
                                        form_error('password2', '<small class="text-danger pl-3">', '</small>');
                                        ?>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    DAFTAR
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login disini!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>