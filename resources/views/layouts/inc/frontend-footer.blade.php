<!-- Remove the container if you want to extend the Footer to full width. -->
<div class=" my-5">
    <!-- Footer -->
    <footer class="text-center text-lg-start text-white" style="background-color: #3e4551">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!--Grid column-->
                    <div class="col-lg-8 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">About this project</h5>

                        <p>
                            This blog post is all about technology .
                            It contains many posts which are related to JS PHP Laravel NodeJS and many of another
                            programming
                            languages as well as frameworks .
                            This blog post is built by PHP Laravel version 8 and the database used in the project is
                            MySQL.
                            Please login first to use full services .
                            The users can interact by posting new posts , like the posts and make comments to it .
                        </p>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-lg-4 col-md-6 mb-4 mb-md-0">
                        <h5 class="text-uppercase">Members</h5>

                        <ul class="list-unstyled mb-0">
                            <li>
                                <a href="#!" class="text-white">Lê Bảo Anh</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Đỗ Minh Quân</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Nguyễn Đức Lâm</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Trương Minh Hồng</a>
                            </li>
                            <li>
                                <a href="#!" class="text-white">Trần Đức Mạnh</a>
                            </li>
                        </ul>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->

                    <!--Grid column-->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->

            <hr class="mb-4" />

            <!-- Section: CTA -->
            <section class="">
                <p class="d-flex justify-content-center align-items-center">
                    <span class="me-3">Register for free</span>
                    {{-- <button type="button" class="btn btn-outline-light btn-rounded">
                        Sign up!
                    </button> --}}
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-rounded">
                        Sign up!
                    </a>
                </p>
            </section>
            <!-- Section: CTA -->

            <hr class="mb-4" />

            <!-- Section: Social media -->
            <section class="mb-4 text-center">
                <!-- Facebook -->
                <h5>Contact us via:</h5>
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-facebook-f"></i></a>

                <!-- Twitter -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-twitter"></i></a>

                <!-- Google -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-google"></i></a>

                <!-- Instagram -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-instagram"></i></a>

                <!-- Linkedin -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-linkedin-in"></i></a>

                <!-- Github -->
                <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i
                        class="fab fa-github"></i></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            &copy; Made by group 1
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</div>
<!-- End of .container -->
