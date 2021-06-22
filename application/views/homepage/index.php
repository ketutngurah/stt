<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>New Age - Start Bootstrap Theme</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/'); ?>favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Google fonts-->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Newsreader:ital,wght@0,600;1,600&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Mulish:ital,wght@0,300;0,500;0,600;0,700;1,300;1,500;1,600;1,700&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,400;1,400&amp;display=swap" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="<?= base_url('assets/'); ?>css/styles.css" rel="stylesheet" />
</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
        <div class="container px-5">
            <a class="navbar-brand fw-bold" href="#page-top">Start Bootstrap</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="bi-list"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="#download">Download</a></li>
                    <li class="nav-item"><a class="nav-link me-lg-3" href="<?= base_url('auth'); ?>">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Mashead header-->
    <header class="masthead">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

            </div>
        </div>
    </header>
    <!-- Quote/testimonial aside-->
    <aside class="text-center bg-gradient-primary-to-secondary">
        <div class="container px-5">
            <div class="row gx-5 justify-content-center">
                <div class="col-xl-8">
                    <div class="h2 fs-1 text-white mb-4">"An intuitive solution to a common problem that we all face, wrapped up in a single app!"</div>
                    <img src="<?= base_url('assets/'); ?>img/tnw-logo.svg" alt="..." style="height: 3rem" />
                </div>
            </div>
        </div>
    </aside>
    <!-- App features section-->
    <section id="features">
        <div class="container px-5">
            <div class="row gx-5 align-items-center">

            </div>
        </div>
    </section>
    <!-- Basic features section-->
    <section class="bg-light">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center justify-content-lg-between">
                <div class="col-12 col-lg-5">
                    <h2 class="display-4 lh-1 mb-4">Enter a new age of web design</h2>
                    <p class="lead fw-normal text-muted mb-5 mb-lg-0">This section is perfect for featuring some information about your application, why it was built, the problem it solves, or anything else! There's plenty of space for text here, so don't worry about writing too much.</p>
                </div>
                <div class="col-sm-8 col-md-6">
                    <div class="px-5 px-sm-0"><img class="img-fluid rounded-circle" src="https://source.unsplash.com/u8Jn2rzYIps/900x900" alt="..." /></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Call to action section-->
    <section class="cta">
        <div class="cta-content">
            <div class="container px-5">
                <h2 class="text-white display-1 lh-1 mb-4">
                    Stop waiting.
                    <br />
                    Start building.
                </h2>
                <a class="btn btn-outline-light py-3 px-4 rounded-pill" href="https://startbootstrap.com/theme/new-age" target="_blank">Download for free</a>
            </div>
        </div>
    </section>
    <!-- App badge section-->
    <section class="bg-gradient-primary-to-secondary" id="download">
        <div class="container px-5">

        </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="bg-black text-center py-5">
        <div class="container px-5">
            <div class="text-white-50 small">
                <div class="mb-2">&copy; Your Website 2021. All Rights Reserved.</div>
                <a href="#!">Privacy</a>
                <span class="mx-1">&middot;</span>
                <a href="#!">Terms</a>
                <span class="mx-1">&middot;</span>
                <a href="#!">FAQ</a>
            </div>
        </div>
    </footer>
    <!-- Feedback modal-->
    <div class="modal fade" id="feedbackModal" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-gradient-primary-to-secondary p-4">
                    <h5 class="modal-title font-alt text-white" id="feedbackModalLabel">Send feedback</h5>
                    <button class="btn-close btn-close-white" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body border-0 p-4">
                    <form>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="inputName" type="text" placeholder="Enter your name..." />
                            <label for="inputName">Name</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="inputEmail" type="email" placeholder="name@example.com" />
                            <label for="inputEmail">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input class="form-control" id="inputPhone" type="tel" placeholder="(123) 456-7890" />
                            <label for="inputPhone">Phone number</label>
                        </div>
                        <div class="form-floating mb-4">
                            <textarea class="form-control" id="inputMessage" placeholder="Enter your message here..." style="height: 10rem"></textarea>
                            <label for="inputMessage">Message</label>
                        </div>
                        <div class="d-grid"><button class="btn btn-primary rounded-pill py-3" type="submit">Submit</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>